<?php
/**
 * Date: 14.09.19
 * Time: 12:46
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift;


interface NavigationInterface
{
    public function getCurrentPosition() : int;

    public function getDestination() : ?int;

}