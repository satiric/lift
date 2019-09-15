<?php
/**
 * Date: 14.09.19
 * Time: 11:01
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Driver;

/**
 * Interface DoorsDriverInterface
 * @package Decadal\Lift\Doors\Driver
 */
interface DoorsDriverInterface
{
    /**
     * @return string
     */
    public function getState() : string;

    /**
     * @return bool
     */
    public function open() : bool;

    /**
     * @return bool
     */
    public function close() : bool;
}