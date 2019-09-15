<?php
/**
 * Date: 15.09.19
 * Time: 16:08
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation;


use Decadal\Lift\Movement\Engine\Enum\Directions;
use Decadal\Lift\Navigation\Service\DistanceCalculatorInterface;
use Decadal\Lift\Navigation\Service\PointsMapInterface;


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
    private $currentPosition = 0;

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

    public function getFirstPoint() : NavigationPointInterface
    {
        return $this->pointsMap->getFirst();

    }

    public function getLastPoint() : NavigationPointInterface
    {
        return $this->pointsMap->getLast();
    }

    public function getCurrentPoint() : NavigationPointInterface
    {
        return $this->calculator->calculatePointByPosition($this->currentPosition, $this->pointsMap->getSequence());
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

    public function determineDistance(NavigationPointInterface $point): int
    {
        // TODO: Implement determineDistance() method.
    }
}