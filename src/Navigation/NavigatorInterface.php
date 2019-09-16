<?php
/**
 * Date: 15.09.19
 * Time: 15:03
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation;

/**
 * Interface NavigatorInterface
 * @package Decadal\Lift\Navigation
 */
interface NavigatorInterface
{
    /**
     * @return NavigationPointInterface
     */
    public function getFirstPoint() : NavigationPointInterface;

    /**
     * @return NavigationPointInterface
     */
    public function getLastPoint() : NavigationPointInterface;

    /**
     * @return NavigationPointInterface
     */
    public function getCurrentPoint() : NavigationPointInterface;

    /**
     * @param NavigationPointInterface $point
     * @return string|null
     */
    public function determineDirection(NavigationPointInterface $point) : ?string;

    /**
     * @param NavigationPointInterface $point
     * @return int
     */
    public function determineDistance(NavigationPointInterface $point) : int;

    /**
     * @param int $position
     * @return mixed
     */
    public function getPointByPosition(int $position) : NavigationPointInterface;

    /**
     * @param NavigationPointInterface $point
     * @return mixed
     */
    public function registerMovementTo(NavigationPointInterface $point);

}