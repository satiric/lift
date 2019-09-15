<?php
/**
 * Date: 15.09.19
 * Time: 12:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement;


use Decadal\Lift\Common\Exception\BadParamException;

use Decadal\Lift\Movement\Model\Movement;
use Decadal\Lift\Movement\Engine\EnginesManagerInterface;
use Decadal\Lift\Movement\Engine\Enum\Directions;

/**
 * Class MovementManager
 * @package Decadal\Lift\Movement
 */
class MovementManager implements MovementManagerInterface
{
    const DEFAULT_SPEED_CM_PER_S = 100;
    const MAX_ALLOWED_SPEED_CM_PER_S = 200;

    /**
     * @var EnginesManagerInterface
     */
    private $engineManager;

    /**
     * @var int
     */
    private $cruiseSpeed = self::DEFAULT_SPEED_CM_PER_S;


    /**
     * MovementManager constructor.
     * @param EnginesManagerInterface $enginesManager
     */
    public function __construct(EnginesManagerInterface $enginesManager)
    {
        $this->engineManager = $enginesManager;
    }

    /**
     * @param int $speed
     * @throws BadParamException
     */
    public function setCruiseSpeed(int $speed)
    {
        if($speed > self::MAX_ALLOWED_SPEED_CM_PER_S) {
            throw new BadParamException(sprintf("Speed greater than allowed %d",self::MAX_ALLOWED_SPEED_CM_PER_S));
        }
        $this->cruiseSpeed = $speed;
    }

    /**
     * @return bool
     */
    public function isMoving(): bool
    {
        //todo rework if parallelism will be added
        //as quick moving process will lock system by "sleep" function
        return false;
    }

    /**
     * @param Movement $movement
     */
    public function move(Movement $movement)
    {
        if($movement->getDirection() === Directions::UP) {
            $this->engineManager->moveDown($movement->getDistance(), $this->cruiseSpeed, $movement->getWeight());
        }
        else {
            $this->engineManager->moveUp($movement->getDistance(), $this->cruiseSpeed, $movement->getWeight());
        }
    }
}