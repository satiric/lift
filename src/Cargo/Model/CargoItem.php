<?php
/**
 * Date: 14.09.19
 * Time: 12:27
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
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
     * @var NavigationPointInterface|null
     */
    private $point;


    /**
     * CargoItem constructor.
     * @param int $weight
     * @param int $height
     * @param int $width
     * @param NavigationPointInterface|null $point
     * @throws BadParamException
     */
    public function __construct(int $weight, int $height, int $width, ?NavigationPointInterface $point)
    {
        $this->validateValues($weight, $height, $width);
        $this->weight = $weight;
        $this->dimensions = $this->transformToDimensions($height, $width);
        $this->point = $point;
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
     * @return NavigationPointInterface|null
     */
    public function getDestination(): ?NavigationPointInterface
    {
        return $this->point;
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