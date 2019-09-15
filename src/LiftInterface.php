<?php
/**
 * Date: 14.09.19
 * Time: 12:21
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift;


use Decadal\Lift\Cargo\Collection\CargoCollection;
use Decadal\Lift\Navigation\NavigationPointInterface;

interface LiftInterface
{
    /**
     * @param CargoCollection $cargoCollection
     * @return mixed
     */
    public function acceptCargo(CargoCollection $cargoCollection);


    public function callTo(NavigationPointInterface $point, string $direction);
}