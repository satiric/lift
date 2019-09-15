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
     * @param NavigationPointInterface $point
     * @param string $direction
     */
    public function callTo(NavigationPointInterface $point, string $direction)
    {
        //todo check that direction is allowed
        if($this->movementManager->isMoving()) {
            throw new \RuntimeException("The lift moving");
        }
        $needMovement = $this->getNextPoint() === null;
        $this->planner->planPoint($point, $direction);
        if($needMovement) {
            $this->move($this->getNextPoint());
        }
    }

    /**
     * @param CargoCollection $cargoItem
     * @throws BadParamException
     */
    public function acceptCargo(CargoCollection $cargoItem)
    {
        if($this->movementManager->isMoving()) {
            throw new \RuntimeException("The lift moving");
        }
        if($this->doorsManager->isDoorsClosed()) {
            throw new BadParamException("Doors are closed");
        }
        $this->cargoService->acceptCargo($cargoItem);

        if($cargoItem instanceof HasDestinationInterface) {
            $point = $cargoItem->getDestination();

            $this->planner->planPoint($point, null);
        }
    }

    public function freeze()
    {
        if($this->movementManager->isMoving()) {
            throw new \RuntimeException("The lift moving");
        }
        $this->pause = true;
    }

    public function unfreeze()
    {
        $this->pause = false;
        $this->move($this->getNextPoint());
    }

    public function getCurrentPoint() : NavigationPointInterface
    {
        return $this->navigator->getCurrentPoint();
    }

    public function getDestinationPoint() : ? NavigationPointInterface
    {
        return $this->getNextPoint();
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
        $this->doorsManager->openDoors();
        $this->planner->arrived($point);
        $this->cargoManager->freeCargoByDestination($point);
        //todo for parallelism
        //set timeout for waiting acceptance cargo and calls
    }

    /**
     * @param NavigationPointInterface $point
     * @return Movement
     */
    private function convertPointToMovement(NavigationPointInterface $point) : Movement
    {
        $direction = $this->navigator->determineDirection($point);
        $weight = $this->cargoManager->getTotalWeight();
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
}