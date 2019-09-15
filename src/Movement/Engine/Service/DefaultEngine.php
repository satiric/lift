<?php
/**
 * Date: 14.09.19
 * Time: 17:05
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Service;


use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Movement\Engine\Model\EngineOperation;
use Decadal\Lift\Movement\Engine\Driver\EngineDriverInterface;
use Decadal\Lift\Movement\Engine\Enum\EngineStates;
use Decadal\Lift\Movement\Engine\Enum\OperationStatuses;

/**
 * Class DefaultEngine
 * @package Decadal\Lift\Movement\Engine\Service
 */
class DefaultEngine implements EngineInterface
{
    /**
     * @var EngineDriverInterface
     */
    private $engineDriver;

    /**
     * @var int
     */
    private $cruisePower;

    /**
     * DefaultEngine constructor.
     * @param EngineDriverInterface $engineDriver
     */
    public function __construct(EngineDriverInterface $engineDriver)
    {
        $this->engineDriver = $engineDriver;
        $this->cruisePower = $this->getAbsoluteLimitation();
    }


    /**
     * @param int $power
     * @throws BadParamException
     */
    public function setCruisePower(int $power)
    {
        $maxAllowedPower = $this->getAbsoluteLimitation();
        if($power > $maxAllowedPower || $power === 0) {
            throw new BadParamException("Power value is not valid");
        }
        $this->cruisePower = $power ;
    }

    /**
     * @return EngineOperation
     */
    public function startPositive() : EngineOperation
    {
        return $this->start($this->cruisePower);
    }

    /**
     * @return EngineOperation
     */
    public function startNegative() : EngineOperation
    {
        return $this->start($this->cruisePower * (-1));
    }


    /**
     * @return EngineOperation
     */
    public function stop() : EngineOperation
    {
        $oldState = $this->engineDriver->getState();
        $this->engineDriver->stop();
        return $this->makeGoodConclusion($oldState, $this->engineDriver->getState());
    }

    /**
     * @return int
     */
    public function getPowerLimitation(): int
    {
        return $this->getPowerLimitation();
    }


    /**
     * @param int $power
     * @return EngineOperation
     */
    private function start(int $power) : EngineOperation
    {
        $oldState = $this->engineDriver->getState();
        if($oldState === EngineStates::WORKING) {
            $this->engineDriver->stop();
        }
        try {
            $this->engineDriver->start($power);
        }
        catch (\Exception $e) {
            return $this->makeBadConclusion($oldState, $this->engineDriver->getState(), $e->getMessage());
        }
        return $this->makeGoodConclusion($oldState, $this->engineDriver->getState());
    }


    /**
     * @return int
     */
    private function getAbsoluteLimitation() : int
    {
        $lower = abs($this->engineDriver->getLowerPowerLimitation());
        $upper = abs($this->engineDriver->getUpperPowerLimitation());
        // max power value equals to smaller limit of both limitations;
        return min($lower, $upper);
    }

    /**
     * @param string $oldState
     * @param string $currentState
     * @param string|null $cause
     * @return EngineOperation
     */
    private function makeBadConclusion(string $oldState, string $currentState, string $cause = null)
    {
        return new EngineOperation(OperationStatuses::FAILURE, $oldState, $currentState, $cause);
    }

    /**
     * @param string $oldState
     * @param string $currentState
     * @param string|null $cause
     * @return EngineOperation
     */
    private function makeGoodConclusion(string $oldState, string $currentState, string $cause = null)
    {
        return new EngineOperation(OperationStatuses::SUCCESS, $oldState, $currentState, $cause);
    }
}