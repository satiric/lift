<?php
/**
 * Date: 14.09.19
 * Time: 10:43
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Service;

use Decadal\Lift\Doors\Driver\DoorsDriverInterface;
use Decadal\Lift\Doors\Enum\DoorsStates;
use Decadal\Lift\Doors\Enum\OperationStatuses;
use Decadal\Lift\Doors\Model\DoorsOperation;

/**
 * Class DefaultDoors
 * @package Decadal\Lift\Doors\Service
 */
class DefaultDoors implements DoorsInterface
{
    /**
     * @var DoorsDriverInterface
     */
    private $driver;

    /**
     * DefaultDoors constructor.
     * @param DoorsDriverInterface $driver
     */
    public function __construct(DoorsDriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return DoorsOperation
     */
    public function open(): DoorsOperation
    {
        $oldState = $this->driver->getState();
        try {
            $result = $this->driver->open();
        }
        catch (\Exception $e) {
            // log
            return $this->makeBadConclusion($oldState, $this->driver->getState(), $e->getMessage());
        }

        return $result
            ? $this->makeGoodConclusion($oldState, $this->driver->getState())
            : $this->makeBadConclusion($oldState, $this->driver->getState());
    }

    /**
     * @return DoorsOperation
     */
    public function close(): DoorsOperation
    {
        $oldState = $this->driver->getState();
        try {
            $result = $this->driver->open();
        }
        catch (\Exception $e) {
            // log
            return $this->makeBadConclusion($oldState, $this->driver->getState(), $e->getMessage());
        }
        return $result
            ? $this->makeGoodConclusion($oldState, $this->driver->getState())
            : $this->makeBadConclusion($oldState, $this->driver->getState());
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->driver->getState() === DoorsStates::CLOSED;
    }

    /**
     * @param string $oldState
     * @param string $currentState
     * @param string|null $cause
     * @return DoorsOperation
     */
    private function makeBadConclusion(string $oldState, string $currentState, string $cause = null)
    {
        return new DoorsOperation(OperationStatuses::FAILURE, $oldState, $currentState, $cause);
    }

    /**
     * @param string $oldState
     * @param string $currentState
     * @param string|null $cause
     * @return DoorsOperation
     */
    private function makeGoodConclusion(string $oldState, string $currentState, string $cause = null)
    {
        return new DoorsOperation(OperationStatuses::SUCCESS, $oldState, $currentState, $cause);
    }
}