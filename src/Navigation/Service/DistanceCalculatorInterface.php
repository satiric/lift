<?php
/**
 * Date: 15.09.19
 * Time: 16:16
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Service;


use Decadal\Lift\Navigation\DistanceItemInterface;
use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Interface DistanceCalculatorInterface
 * @package Decadal\Lift\Navigation\Service
 */
interface DistanceCalculatorInterface
{

    /**
     * @param int $distance
     * @param array $sequence
     * @return NavigationPointInterface
     */
    public function calculatePointByAbsoluteDistance(int $distance, array $sequence) : NavigationPointInterface;

    /**
     * @param DistanceItemInterface $point1
     * @param DistanceItemInterface $point2
     * @param array $sequence
     * @return int
     */
    public function absoluteDistanceDiff(
        DistanceItemInterface $point1,
        DistanceItemInterface $point2,
        array $sequence
    ) : int;
}