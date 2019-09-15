<?php
/**
 * Date: 14.09.19
 * Time: 12:46
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift;


interface MovementControlInterface
{
    public function freeze();

    public function unfreeze();

    public function toNextPoint();
}