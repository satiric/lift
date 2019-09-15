<?php
/**
 * Date: 14.09.19
 * Time: 13:03
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement;


use Decadal\Lift\Movement\Model\Movement;

interface MovementManagerInterface
{
    public function isMoving() : bool;

    public function move(Movement $movement);
}