<?php
/**
 * Date: 15.09.19
 * Time: 13:01
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Model;

/**
 * Class Movement
 * @package Decadal\Lift\Movement\Model
 */
class Movement
{
    /**
     * @var string
     */
    private $direction;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var int
     */
    private $distance;

    /**
     * Movement constructor.
     * @param string $direction
     * @param int $weight
     * @param int $distance
     */
    public function __construct(string $direction, int $weight, int $distance)
    {
        $this->direction = $direction;
        $this->weight = $weight;
        $this->distance = $distance;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }
}