<?php
/**
 * Date: 15.09.19
 * Time: 16:08
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation;


use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Common\Exception\CommonException;
use Decadal\Lift\Movement\Engine\Enum\Directions;
use Decadal\Lift\Navigation\Service\DistanceCalculatorInterface;
use Decadal\Lift\Navigation\Service\PointsMapInterface;

/**
 * Class DefaultNavigator
 * @package Decadal\Lift\Navigation
 */
class DefaultNavigator implements NavigatorInterface
{
    /**
     * @var PointsMapInterface
     */
    private $pointsMap;

    /**
     * @var DistanceCalculatorInterface
     */
    private $calculator;

    /**
     * @var int
     */
    private $currentDistance = 0;

    /**
     * DefaultNavigator constructor.
     * @param PointsMapInterface $pointsMap
     * @param DistanceCalculatorInterface $calculator
     */
    public function __construct(PointsMapInterface $pointsMap, DistanceCalculatorInterface $calculator)
    {
        $this->pointsMap = $pointsMap;
        $this->calculator = $calculator;
    }

    /**
     * @return NavigationPointInterface
     */
    public function getFirstPoint() : NavigationPointInterface
    {
        return $this->pointsMap->getFirst();

    }

    /**
     * @return NavigationPointInterface
     */
    public function getLastPoint() : NavigationPointInterface
    {
        return $this->pointsMap->getLast();
    }

    /**
     * @return NavigationPointInterface|DistanceItemInterface
     */
    public function getCurrentPoint() : NavigationPointInterface
    {
        return $this->calculator->calculatePointByAbsoluteDistance($this->currentDistance, $this->pointsMap->getSequence());
    }

    /**
     * @param NavigationPointInterface $point
     * @return string|null
     */
    public function determineDirection(NavigationPointInterface $point): ? string
    {
        $currentPoint = $this->getCurrentPoint();
        $currentPosition = $currentPoint->getPosition();
        $calcPosition = $point->getPosition();
        if($currentPosition === $calcPosition) {
            return null;
        }
        return ($currentPosition > $calcPosition)
            ? Directions::DOWN
            : Directions::UP;
    }

    /**
     * @param NavigationPointInterface $point
     * @return int
     * @throws CommonException
     */
    public function determineDistance(NavigationPointInterface $point): int
    {
        if(!$point instanceof DistanceItemInterface) {
            throw new CommonException("Navigation point should be an DistanceItemInterface");
        }
        $currentPoint = $this->getCurrentPoint();
        return $this->calculator->absoluteDistanceDiff($currentPoint, $point, $this->pointsMap->getSequence());
    }

    /**
     * @param int $position - equals to floor's number
     * @return NavigationPointInterface
     * @throws BadParamException
     */
    public function getPointByPosition(int $position) : NavigationPointInterface
    {
        $point = $this->pointsMap->get($position);
        if($point === null) {
            throw new BadParamException("Such point is not found");
        }
        return $point;
    }

    /**
     * @param NavigationPointInterface $point
     * @return mixed|void
     * @throws CommonException
     */
    public function registerMovementTo(NavigationPointInterface $point)
    {
        $distance = $this->determineDistance($point);
        $currentPoint = $this->getCurrentPoint();
        if($currentPoint->getPosition() > $point->getPosition()) {
            $this->currentDistance -= $distance;
        }
        else {
            $this->currentDistance += $distance;
        }
    }
}