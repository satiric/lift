<?php
/**
 * Date: 14.09.19
 * Time: 11:41
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors;

/**
 * Interface DoorsManagerInterface
 * @package Decadal\Lift\Doors
 */
interface DoorsManagerInterface
{
    public function closeDoors();

    public function openDoors();

    public function isDoorsClosed() : bool;

    public function isDoorsOpened() : bool;

}