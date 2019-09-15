<?php
/**
 * Date: 14.09.19
 * Time: 15:25
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Movement\Engine\Service;


use Decadal\Lift\Movement\Engine\Model\EngineOperation;

/**
 * Interface EngineInterface
 * @package Decadal\Lift\Movement\Engine\Service
 */
interface EngineInterface
{
    /**
     * @param int $power
     * @return mixed
     */
    public function setCruisePower(int $power);

    /**
     * @return EngineOperation
     */
    public function startPositive() : EngineOperation;

    /**
     * @return EngineOperation
     */
    public function startNegative() : EngineOperation;

    /**
     * @return EngineOperation
     */
    public function stop() : EngineOperation;

    /**
     * @return int
     */
    public function getPowerLimitation() : int;
}