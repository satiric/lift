<?php
/**
 * Date: 14.09.19
 * Time: 12:21
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift;


use Decadal\Lift\Cargo\Collection\CargoCollection;

/**
 * Interface LiftInterface
 * @package Decadal\Lift
 */
interface LiftInterface
{
    /**
     * @param CargoCollection $cargoCollection
     * @return mixed
     */
    public function acceptCargo(CargoCollection $cargoCollection);

    /**
     * @param array[] ['direction1' => [1,2], 'direction2' => [3,4] ]
     * @return mixed
     */
    public function callTo(array $directionDestinationMap);
}