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
    public function acceptCargo(CargoCollection $collection);

    public function getTotalWeight() : int;

    public function getMaxWeight() : int;

    public function freeCargoByDestination(NavigationPointInterface $point) : array;

}