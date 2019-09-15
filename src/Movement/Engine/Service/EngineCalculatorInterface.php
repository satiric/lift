<?php
/**
 * Date: 14.09.19
 * Time: 21:15
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Service;


use Decadal\Lift\Movement\Engine\Collection\EnginesCollection;

/**
 * Interface EngineCalculatorInterface
 * @package Decadal\Lift\Movement\Engine\Service
 */
interface EngineCalculatorInterface
{
    public function calculateCruisePowerUp(EnginesCollection $engines, int $weight, int $expectedSpeed) : int;

    public function calculateCruisePowerDown(EnginesCollection $engines, int $weight, int $expectedSpeed) : int;

}