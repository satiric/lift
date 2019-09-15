<?php
/**
 * Date: 14.09.19
 * Time: 16:56
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Common;



trait Processable
{
    private function process(int $time)
    {
        sleep($time);
    }
}