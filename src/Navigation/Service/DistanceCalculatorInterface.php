<?php
/**
 * Date: 15.09.19
 * Time: 16:16
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Service;


use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Interface DistanceCalculatorInterface
 * @package Decadal\Lift\Navigation\Service
 */
interface DistanceCalculatorInterface
{
    /**
     * @param int $position
     * @param array $sequence
     * @return NavigationPointInterface
     */
    public function calculatePointByPosition(int $position, array $sequence) : NavigationPointInterface;
}