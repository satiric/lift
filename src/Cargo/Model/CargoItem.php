<?php
/**
 * Date: 14.09.19
 * Time: 12:27
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Cargo\Model;


use Decadal\Lift\Cargo\CargoItemInterface;
use Decadal\Lift\Cargo\DimensionsInterface;
use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Navigation\HasDestinationInterface;
use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Class CargoItem
 * @package Decadal\Lift\Cargo\Model
 */
class CargoItem implements CargoItemInterface, HasDestinationInterface
{
    /**
     * @var int
     */
    private $weight;
    /**
     * @var Dimensions
     */
    private $dimensions;
    /**
     * @var int|null
     */
    private $destination;


    /**
     * CargoItem constructor.
     * @param int $weight
     * @param int $height
     * @param int $width
     * @param int|null $destination
     * @throws BadParamException
     */
    public function __construct(int $weight, int $height, int $width, ?int $destination)
    {
        $this->validateValues($weight, $height, $width);
        $this->weight = $weight;
        $this->dimensions = $this->transformToDimensions($height, $width);
        $this->destination = $destination;
    }

    /**
     * @return DimensionsInterface
     */
    public function getDimensions() : DimensionsInterface
    {
        return $this->dimensions;
    }

    /**
     * @return int
     */
    public function getWeight() : int
    {
        return $this->weight;
    }

    /**
     * @return int|null
     */
    public function getDestination(): ?int
    {
        return $this->destination;
    }

    /**
     * @param int $height
     * @param int $width
     * @return Dimensions
     */
    private function transformToDimensions(int $height, int $width) : Dimensions
    {
        $dimensions = new Dimensions($height, $width);
        return $dimensions;
    }

    /**
     * @param int $weight
     * @param int $height
     * @param int $width
     * @throws BadParamException
     */
    private function validateValues(int $weight, int $height, int $width)
    {
        if($weight < 0 || $height < 0 || $width < 0) {
            throw new BadParamException("All parameters should be greater that zero");
        }
    }
}