<?php
/**
 * Date: 15.09.19
 * Time: 16:13
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Service;


use Decadal\Lift\Navigation\NavigationPointInterface;

interface PointsMapInterface
{
    public function getFirst() : NavigationPointInterface;

    public function getLast() : NavigationPointInterface;

    public function getSequence() : array;

    public function get(int $position) : ?NavigationPointInterface;
}