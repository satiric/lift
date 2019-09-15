<?php
/**
 * Date: 14.09.19
 * Time: 10:17
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Model;


use Decadal\Lift\Doors\Enum\DoorsStates;
use Decadal\Lift\Doors\Enum\OperationStatuses;

/**
 * Class DoorsOperation
 * @package Decadal\Lift\Doors\Model
 */
class DoorsOperation
{
    /**
     * DoorsOperation constructor.
     * @param string $status
     * @param string $oldState
     * @param string $newState
     * @param string|null $cause
     */
    public function __construct(string $status, string $oldState, string $newState, string $cause = null)
    {
        $this->status = $status;
        $this->oldState = $oldState;
        $this->newState = $newState;
        $this->cause = $cause;
    }

    /**
     * @var string
     * @see OperationStatuses
     */
    private $status;

    /**
     * @var string
     * @see DoorsStates
     */
    private $oldState;

    /**
     * @var string
     * @see DoorsStates
     */
    private $newState;

    /**
     * @var null|string
     */
    private $cause = null;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getOldState(): string
    {
        return $this->oldState;
    }

    /**
     * @return string
     */
    public function getNewState(): string
    {
        return $this->newState;
    }

    /**
     * @return string|null
     */
    public function getCause(): ?string
    {
        return $this->cause;
    }

}