<?php
/**
 * Date: 14.09.19
 * Time: 17:59
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine;


interface EnginesManagerInterface
{

    /**
     * @param int $distance centimeters
     * @param int $expectedSpeed centimeters\s
     * @param int $weight
     * @return mixed
     */
    public function moveDown(int $distance, int $expectedSpeed, int $weight);

    /**
     * @param int $distance centimeters
     * @param int $expectedSpeed centimeters\s
     * @param int $weight
     * @return mixed
     */
    public function moveUp(int $distance, int $expectedSpeed, int $weight);

}