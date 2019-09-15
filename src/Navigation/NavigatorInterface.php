<?php
/**
 * Date: 15.09.19
 * Time: 15:03
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation;


interface NavigatorInterface
{
    public function getFirstPoint() : NavigationPointInterface;

    public function getLastPoint() : NavigationPointInterface;
    /**
     * @param NavigationPointInterface[] $points
     * @return mixed
     */
    public function setPointsMap(array $points);

    public function getCurrentPoint() : NavigationPointInterface;

    public function determineDirection(NavigationPointInterface $point) : ?string;

    public function determineDistance(NavigationPointInterface $point) : int;


    public function getPointByPosition(int $position);

}