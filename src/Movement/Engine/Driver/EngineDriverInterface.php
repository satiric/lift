<?php
/**
 * Date: 14.09.19
 * Time: 15:26
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Driver;

/**
 * Interface EngineDriverInterface
 * @package Decadal\Lift\Movement\Engine\Driver
 */
interface EngineDriverInterface
{
    /**
     * @param int $power
     * @return mixed
     */
    public function start(int $power);

    /**
     * @return mixed
     */
    public function stop();

    /**
     * @return string
     */
    public function getState() : string;

    /**
     * @return int
     */
    public function getUpperPowerLimitation() : int;

    /**
     * @return int
     */
    public function getLowerPowerLimitation() : int;
}