<?php
/**
 * Date: 14.09.19
 * Time: 12:28
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Cargo;

/**
 * Interface CargoItemInterface
 * @package Decadal\Lift\Cargo
 */
interface CargoItemInterface
{

    /**
     * @return DimensionsInterface
     */
    public function getDimensions() : DimensionsInterface;

    /**
     * @return int
     */
    public function getWeight() : int;
}