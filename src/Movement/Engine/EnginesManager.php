<?php
/**
 * Date: 14.09.19
 * Time: 11:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine;

use Decadal\Lift\Movement\Engine\Collection\EnginesCollection;
use Decadal\Lift\Movement\Engine\Service\EngineCalculatorInterface;
use Decadal\Lift\Movement\Engine\Service\EngineManipulatorInterface;

/**
 * Class EnginesManager
 * @package Decadal\Lift\Movement\Engine
 */
class EnginesManager implements EnginesManagerInterface
{
    /**
     * @var EnginesCollection
     */
    private $enginesCollection;

    /**
     * @var EngineManipulatorInterface
     */
    private $manipulator;

    /**
     * @var EngineCalculatorInterface
     */
    private $calculator;

    /**
     * EnginesManager constructor.
     * @param EnginesCollection $collection
     * @param EngineManipulatorInterface $manipulator
     * @param EngineCalculatorInterface $calculator
     */
    public function __construct(
        EnginesCollection $collection,
        EngineManipulatorInterface $manipulator,
        EngineCalculatorInterface $calculator
    )
    {
        $this->enginesCollection = $collection;
        $this->manipulator = $manipulator;
        $this->calculator = $calculator;
    }

    /**
     * @param int $distance
     * @param int $expectedSpeed
     * @param int $weight
     * @return mixed|void
     * @throws \Exception
     */
    public function moveDown(int $distance, int $expectedSpeed, int $weight)
    {
        $power = $this->calculator->calculateCruisePowerDown($this->enginesCollection, $weight, $expectedSpeed);
        //the model based on time sleep - simplified model of tracking real lift position
        //in real life there should be position indicator that will stop the engine
        $time = $this->calculateTime($distance, $expectedSpeed);
        $this->manipulator->startAllNegative($this->enginesCollection, $power);
        sleep($time);
        $this->manipulator->stopAll($this->enginesCollection);
    }


    /**
     * @param int $distance
     * @param int $expectedSpeed
     * @param int $weight
     * @return mixed|void
     * @throws \Exception
     */
    public function moveUp(int $distance, int $expectedSpeed, int $weight)
    {
        $power = $this->calculator->calculateCruisePowerUp($this->enginesCollection, $weight, $expectedSpeed);
        //the model based on time sleep - simplified model of tracking real lift position
        //in real life there should be position indicator that will stop the engine
        $time = $this->calculateTime($distance, $expectedSpeed);
        $this->manipulator->startAllPositive($this->enginesCollection, $power);
        sleep($time);
        $this->manipulator->stopAll($this->enginesCollection);
    }

    /**
     * @param int $distance
     * @param int $expectedSpeed
     * @return float
     */
    private function calculateTime(int $distance, int $expectedSpeed) : float
    {
        return round($distance / $expectedSpeed);
    }
}