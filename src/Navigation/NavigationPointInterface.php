<?php
/**
 * Date: 14.09.19
 * Time: 12:44
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation;

interface NavigationPointInterface
{
    public function getHeight() : int;

    public function getPosition() : int;
}