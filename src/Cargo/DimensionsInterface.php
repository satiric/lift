<?php
/**
 * Date: 14.09.19
 * Time: 12:52
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Cargo;

/**
 * Interface DimensionsInterface
 * @package Decadal\Lift\Cargo
 */
interface DimensionsInterface
{
    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return int
     */
    public function getWidth(): int;

}