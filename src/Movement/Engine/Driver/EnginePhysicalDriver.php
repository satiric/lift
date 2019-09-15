<?php
/**
 * Date: 14.09.19
 * Time: 15:26
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Movement\Engine\Driver;

use Decadal\Lift\Movement\Engine\Enum\EngineStates;

/**
 * Class EnginePhysicalDriver
 * @package Decadal\Lift\Movement\Engine\Driver
 */
class EnginePhysicalDriver implements EngineDriverInterface
{
    const MAX_POWER = 100;
    const MIN_POWER = -100;
    const POWERED_OFF_POWER = 0;

    /**
     * @var int
     */
    private $currentPower = self::POWERED_OFF_POWER;

    /**
     * @param int $power
     * @throws \Exception
     */
    public function start(int $power)
    {
        if($power === self::POWERED_OFF_POWER) {
            throw new \Exception("Cannot start with zero power");
        }
        if($this->isWorking()) {
            throw new \Exception("Already started");
        }
        if($power > self::MAX_POWER || $power < self::MIN_POWER) {
            throw new \Exception("Power is out of limitation range");
        }
        $this->currentPower = $power;
    }

    /**
     *
     */
    public function stop()
    {
        $this->currentPower = self::POWERED_OFF_POWER;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return ($this->isWorking())
            ? EngineStates::WORKING
            : EngineStates::STOPPED;
    }

    /**
     * @return int
     */
    public function getUpperPowerLimitation() : int
    {
        return self::MAX_POWER;
    }

    /**
     * @return int
     */
    public function getLowerPowerLimitation() : int
    {
        return self::MIN_POWER;
    }

    /**
     * @return bool
     */
    private function isWorking() : bool
    {
        return $this->currentPower !== self::POWERED_OFF_POWER;
    }
}