<?php
namespace Decadal\Lift\Cargo\Model;

use Decadal\Lift\Cargo\DimensionsInterface;

/**
 * Class Dimensions
 * @package Decadal\Lift\Cargo\Model
 */
class Dimensions implements DimensionsInterface
{
    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * Dimensions constructor.
     * @param int $height
     * @param int $width
     */
    public function __construct(int $height, int $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }
}