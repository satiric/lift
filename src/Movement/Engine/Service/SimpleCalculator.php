<?php
/**
 * Date: 14.09.19
 * Time: 22:22
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Service;

use Decadal\Lift\Movement\Engine\Collection\EnginesCollection;

/**
 * Class SimpleCalculator
 * @package Decadal\Lift\Movement\Engine\Service
 */
class SimpleCalculator implements EngineCalculatorInterface
{
    const GRAVITY_PENALTY_POWER = 2;

    /**
     * @param EnginesCollection $engines
     * @param int $weight
     * @param int $expectedSpeed
     * @return int
     */
    public function calculateCruisePowerUp(EnginesCollection $engines, int $weight, int $expectedSpeed): int
    {
        $engines = $engines->getEngines();
        $count = count($engines);
        $totalPower = $this->calculate($weight, $expectedSpeed);
        // it is a static penalty for gravity
        $totalPower = $totalPower + self::GRAVITY_PENALTY_POWER;
        return round($totalPower / $count);
    }

    /**
     * @param EnginesCollection $engines
     * @param int $weight
     * @param int $expectedSpeed
     * @return int
     */
    public function calculateCruisePowerDown(EnginesCollection $engines, int $weight, int $expectedSpeed): int
    {
        $engines = $engines->getEngines();
        $count = count($engines);
        $totalPower = $this->calculate($weight, $expectedSpeed);
        // it is a static penalty for gravity
        $totalPower = $totalPower - self::GRAVITY_PENALTY_POWER;
        return round($totalPower / $count);
    }

    /**
     * @param int $weight
     * @param int $expectedSpeed
     * @return int
     */
    private function calculate(int $weight, int $expectedSpeed) : int
    {
        //to up 10 kg with 100 sm/s we needed 1 power
        return  round((($weight / 10) * ($expectedSpeed / 100)));
    }
}