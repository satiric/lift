<?php
/**
 * Date: 14.09.19
 * Time: 12:28
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation;

/**
 * Interface HasDestinationInterface
 * @package Decadal\Lift\Navigation
 */
interface HasDestinationInterface
{
    public function getDestination() : ? int;
}