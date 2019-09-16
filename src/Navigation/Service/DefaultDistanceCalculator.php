<?php
/**
 * Date: 16.09.19
 * Time: 10:11
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Service;


use Decadal\Lift\Navigation\DistanceItemInterface;
use Decadal\Lift\Navigation\NavigationPointInterface;

class DefaultDistanceCalculator implements DistanceCalculatorInterface
{

    /**
     * @param int $distance
     * @param array $sequence
     * @return NavigationPointInterface
     */
    public function calculatePointByAbsoluteDistance(int $distance, array $sequence) : NavigationPointInterface
    {
        $currentDistance = 0;
        $prev = null;
        foreach ($sequence as $currentPoint) {
            if($currentDistance >= $distance ) {
                if($prev === null) {
                    return $currentPoint;
                }
                else {
                    return $prev;
                }
            }
            $prev = $currentPoint;
            $currentDistance += $currentPoint->getHeight();
        }
        return $prev;
    }

    /**
     * @param DistanceItemInterface|NavigationPointInterface $point1
     * @param DistanceItemInterface|NavigationPointInterface $point2
     * @param NavigationPointInterface[]|DistanceItemInterface[]| $sequence
     * @return int
     */
    public function absoluteDistanceDiff(
        DistanceItemInterface $point1,
        DistanceItemInterface $point2,
        array $sequence
    ) : int
    {
        $start = null;
        $distance = 0;
        foreach ($sequence as $currentPoint) {
            $currentPosition = $currentPoint->getPosition();
            if($currentPosition === $point1->getPosition() || $currentPosition === $point2->getPosition()) {
                if($start === null) {
                    $start = $currentPoint;
                }
                else {
                    break;
                }
            }
            if($start !== null) {
                $distance += $currentPoint->getHeight();
            }
        }
        return $distance;
    }
}