<?php
/**
 * Date: 14.09.19
 * Time: 21:15
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Service;

use Decadal\Lift\Movement\Engine\Collection\EnginesCollection;
use Decadal\Lift\Movement\Engine\Enum\OperationStatuses;

/**
 * Class EngineManipulator
 * @package Decadal\Lift\Movement\Engine\Service
 */
class EngineManipulator implements EngineManipulatorInterface
{
    /**
     * @param EnginesCollection $collection
     * @param int $power
     * @throws \Exception
     */
    public function startAllNegative(EnginesCollection $collection, int $power)
    {
        $this->syncCruisePower($collection, $power);
        $engines = $collection->getEngines();
        for ($i = 0, $sz = count($engines); $i < $sz; $i++) {
            $engine = $engines[$i];
            $operation = $engine->startNegative();
            if($operation->getStatus() === OperationStatuses::FAILURE) {
                $this->stopAll($collection);
                throw new \Exception("One of engines isnt runned");
            }
        }
    }

    /**
     * @param EnginesCollection $collection
     * @param int $power
     * @throws \Exception
     */
    public function startAllPositive(EnginesCollection $collection, int $power)
    {
        $this->syncCruisePower($collection, $power);
        $engines = $collection->getEngines();
        for ($i = 0, $sz = count($engines); $i < $sz; $i++) {
            $engine = $engines[$i];
            $operation = $engine->startPositive();
            if($operation->getStatus() === OperationStatuses::FAILURE) {
                $this->stopAll($collection);
                throw new \Exception("One of engines isnt runned");
            }
        }
    }

    /**
     * @param EnginesCollection $collection
     * @throws \Exception
     */
    public function stopAll(EnginesCollection $collection)
    {
        $engines = $collection->getEngines();
        for ($i = 0, $sz = count($engines); $i < $sz; $i++) {
            $engine = $engines[$i];
            $operation = $engine->stop();
            if($operation->getStatus() === OperationStatuses::FAILURE) {
                throw new \Exception("One of engines isnt stopped");
            }
        }
    }

    /**
     * @param EnginesCollection $collection
     * @param int $power
     */
    private function syncCruisePower(EnginesCollection $collection, int $power)
    {
        $engines = $collection->getEngines();
        for ($i = 0, $sz = count($engines); $i < $sz; $i++) {
            $engine = $engines[$i];
            $engine->setCruisePower($power);
        }
    }
}