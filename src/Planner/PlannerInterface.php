<?php
/**
 * Date: 15.09.19
 * Time: 13:19
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Planner;


use Decadal\Lift\Navigation\NavigationPointInterface;

interface PlannerInterface
{
    public function planPoint(NavigationPointInterface $point, ?string $direction);

    public function getNextPoint() : ?NavigationPointInterface;

    public function arrived(NavigationPointInterface $point);
}