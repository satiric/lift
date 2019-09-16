<?php
/**
 * Date: 14.09.19
 * Time: 12:52
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Cargo;


use Decadal\Lift\Cargo\Collection\CargoCollection;
use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Interface CargoServiceInterface
 * @package Decadal\Lift\Cargo
 */
interface CargoServiceInterface
{
    /**
     * @param CargoCollection $collection
     * @return mixed
     */
    public function acceptCargo(CargoCollection $collection);

    /**
     * @return int
     */
    public function getTotalWeight() : int;

    /**
     * @return int
     */
    public function getMaxWeight() : int;

    /**
     * @param NavigationPointInterface $point
     * @return array
     */
    public function freeCargoByDestination(NavigationPointInterface $point) : array;

}