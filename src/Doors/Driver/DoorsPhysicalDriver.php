<?php
/**
 * Date: 14.09.19
 * Time: 10:47
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Driver;


use Decadal\Lift\Doors\Enum\DoorsStates;


/**
 * Class DoorsPhysicalDriver
 * @package Decadal\Lift\Doors\Driver
 */
class DoorsPhysicalDriver implements DoorsDriverInterface
{
    const OPEN_DOOR_TIMEOUT_MS = 1000;
    const CLOSE_DOOR_TIMEOUT_MS = 1000;
    /**
     * @var string
     */
    private $state = DoorsStates::CLOSED;

    /**
     * @return string
     */
    public function getState() : string
    {
        return $this->state;
    }

    /**
     * @return bool
     */
    public function open() : bool
    {
        if($this->state === DoorsStates::OPENED) {
            return true;
        }
        //sleep timeout - open door imitation
        $this->state = DoorsStates::OPENED;

        return true;
    }

    /**
     * @return bool
     */
    public function close() : bool
    {
        if($this->state === DoorsStates::CLOSED) {
            return true;
        }
        //sleep timeout - close door imitation
        $this->state = DoorsStates::CLOSED;
        return true;
    }
}