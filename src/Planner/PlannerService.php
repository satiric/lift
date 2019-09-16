<?php
/**
 * Date: 16.09.19
 * Time: 14:16
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Planner;


use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Class PlannerService
 * @package Decadal\Lift\Planner
 */
class PlannerService implements PlannerInterface
{
    public function planPoint(NavigationPointInterface $point, ?string $direction)
    {
        // TODO: Implement planPoint() method.
    }

    public function getNextPoint(): ?NavigationPointInterface
    {
        // TODO: Implement getNextPoint() method.
    }

    public function arrived(NavigationPointInterface $point)
    {
        // TODO: Implement arrived() method.
    }

}