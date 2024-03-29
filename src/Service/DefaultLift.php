<?php
/**
 * Date: 14.09.19
 * Time: 12:21
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Service;

use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Cargo\Collection\CargoCollection;
use Decadal\Lift\Cargo\CargoServiceInterface;
use Decadal\Lift\Doors\DoorsManagerInterface;
use Decadal\Lift\LiftInterface;
use Decadal\Lift\Movement\Model\Movement;
use Decadal\Lift\Movement\MovementManagerInterface;
use Decadal\Lift\MovementControlInterface;
use Decadal\Lift\Navigation\HasDestinationInterface;
use Decadal\Lift\Navigation\NavigationPointInterface;
use Decadal\Lift\Navigation\NavigatorInterface;
use Decadal\Lift\NavigationInterface;
use Decadal\Lift\Planner\PlannerInterface;

/**
 * Class DefaultLift
 * @package Decadal\Lift\Service
 */
class DefaultLift implements LiftInterface, MovementControlInterface, NavigationInterface
{
    /**
     * @var DoorsManagerInterface
     */
    private $doorsManager;

    /**
     * @var CargoServiceInterface
     */
    private $cargoService;

    /**
     * @var MovementManagerInterface
     */
    private $movementManager;

    /**
     * @var PlannerInterface
     */
    private $planner;

    /**
     * @var NavigatorInterface
     */
    private $navigator;

    /**
     * @var bool
     */
    private $pause = false;

    /**
     * DefaultLift constructor.
     * @param DoorsManagerInterface $doorsManager
     * @param CargoServiceInterface $cargoService
     * @param MovementManagerInterface $movementManager
     * @param PlannerInterface $planner
     * @param NavigatorInterface $navigator
     */
    public function __construct(
        DoorsManagerInterface $doorsManager,
        CargoServiceInterface $cargoService,
        MovementManagerInterface $movementManager,
        PlannerInterface $planner,
        NavigatorInterface $navigator)
    {
        $this->doorsManager = $doorsManager;
        $this->cargoService = $cargoService;
        $this->movementManager = $movementManager;
        $this->planner = $planner;
        $this->navigator = $navigator;
    }

    /**
     * @param array $directionDestinationMap
     * @return mixed|void
     */
    public function callTo(array $directionDestinationMap)
    {
        //todo check that direction is allowed
        if($this->movementManager->isMoving()) {
            throw new \RuntimeException("The lift moving");
        }
        foreach ($directionDestinationMap as $direction => $destinations) {
            for ($i = 0, $sz = count($destinations); $i < $sz; $i++) {
                $destination = $destinations[$i];
                $point = $this->navigator->getPointByPosition($destination);
                $this->planPoint($point, $direction);
            }
        }
    }

    /**
     * @param CargoCollection $collection
     * @return mixed|void
     * @throws BadParamException
     */
    public function acceptCargo(CargoCollection $collection)
    {
        if($this->movementManager->isMoving()) {
            throw new \RuntimeException("The lift moving");
        }
        if($this->doorsManager->isDoorsClosed()) {
            throw new BadParamException("Doors are closed");
        }
        $this->cargoService->acceptCargo($collection);
        $cargo = $collection->getCargo();
        for ($i = 0, $sz = count($cargo); $i < $sz; $i++) {
            $cargoItem = $cargo[$i];
            if($cargoItem instanceof HasDestinationInterface) {
                $destination = $cargoItem->getDestination();
                $point = $this->navigator->getPointByPosition($destination);
                $this->planPoint($point, null);
            }
        }
    }

    /**
     *
     */
    public function freeze()
    {
        if($this->movementManager->isMoving()) {
            throw new \RuntimeException("The lift moving");
        }
        $this->pause = true;
    }

    /**
     *
     */
    public function unfreeze()
    {
        $this->pause = false;
        $this->move($this->getNextPoint());
    }

    /**
     * @return int
     */
    public function getCurrentPosition(): int
    {
        return $this->navigator->getCurrentPoint()->getPosition();
    }

    /**
     * @return int|null
     */
    public function getDestination() : ? int
    {
        $point = $this->getNextPoint();
        return  $point === null
            ? null
            : $point->getPosition();
    }

    /**
     *
     */
    public function toNextDestination()
    {
        $point = $this->getNextPoint();
        ($point !== null)
            ? $this->move($point)
            : $this->move($this->navigator->getFirstPoint()); //move to first floor
    }

    /**
     * @param NavigationPointInterface $point
     */
    private function move(NavigationPointInterface $point)
    {
        if ($this->pause) {
            return;
        }
        if(!$this->doorsManager->isDoorsClosed()) {
            $this->doorsManager->closeDoors();
        }
        $movement = $this->convertPointToMovement($point);
        $this->movementManager->move($movement);
        $this->navigator->registerMovementTo($point);
        $this->planner->arrived($point);
        $this->doorsManager->openDoors();
        $this->cargoService->freeCargoByDestination($point);
    }

    /**
     * @param NavigationPointInterface $point
     * @return Movement
     */
    private function convertPointToMovement(NavigationPointInterface $point) : Movement
    {
        $direction = $this->navigator->determineDirection($point);
        $weight = $this->cargoService->getTotalWeight();
        $distance = $this->navigator->determineDistance($point);
        $movement = new Movement($direction, $weight, $distance);
        return $movement;
    }

    /**
     * @return NavigationPointInterface|null
     */
    private function getNextPoint() : ?NavigationPointInterface
    {
        return $this->planner->getNextPoint();
    }

    /**
     * @param NavigationPointInterface $point
     * @param string|null $direction
     */
    private function planPoint(NavigationPointInterface $point, ?string $direction)
    {
        $currentPoint = $this->navigator->getCurrentPoint();
        //do not plan point that equals to current point
        if($currentPoint->getPosition() !== $point->getPosition()) {
            $this->planner->planPoint($point, $direction);
        }
    }
}