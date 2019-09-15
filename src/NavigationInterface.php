<?php
/**
 * Date: 14.09.19
 * Time: 12:46
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift;


use Decadal\Lift\Navigation\NavigationPointInterface;

interface NavigationInterface
{
    public function getCurrentPoint() : NavigationPointInterface;

    public function getDestinationPoint() : ?NavigationPointInterface;

}