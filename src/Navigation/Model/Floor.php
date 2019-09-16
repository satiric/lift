<?php
/**
 * Date: 14.09.19
 * Time: 15:51
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Model;

use Decadal\Lift\Navigation\DistanceItemInterface;
use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Class Floor
 * @package Decadal\Lift\Navigation\Model
 */
class Floor implements NavigationPointInterface, DistanceItemInterface
{
    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $position;

    /**
     * Floor constructor.
     * @param int $height centimeters
     * @param int $position number of floor
     */
    public function __construct(int $height, int $position)
    {
        $this->height = $height;
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getHeight() : int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getPosition() : int
    {
        return $this->position;
    }

}