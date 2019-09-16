<?php
/**
 * Date: 15.09.19
 * Time: 17:52
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Cargo;


use Decadal\Lift\Cargo\Collection\CargoCollection;
use Decadal\Lift\Common\Exception\CommonException;
use Decadal\Lift\Navigation\HasDestinationInterface;
use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Class DefaultCargoService
 * @package Decadal\Lift\Cargo
 */
class DefaultCargoService implements CargoServiceInterface
{
    const CONTAINER_WEIGHT_KG = 1000;
    const MAX_TOTAL_WEIGHT_KG = 1400;
    const MAX_HEIGHT_CM = 250;
    const MAX_WIDTH_CM = 150;

    /**
     * @var CargoItemInterface[]
     */
    private $cargo = [];

    /**
     * @var null|int
     */
    private $cachedWeight = null;
    /**
     * @param CargoCollection $collection
     * @throws CommonException
     */
    public function acceptCargo(CargoCollection $collection)
    {
        $currentWeight = $this->calculateCurrentWeight();
        $cargo = $collection->getCargo();
        for ($i = 0, $sz = count($cargo); $i < $sz; $i++) {
            $cargoItem = $cargo[$i];
            $this->validateDimensions($cargoItem->getDimensions());
            $cargoItemWeight = $cargoItem->getWeight();
            if($cargoItemWeight + $currentWeight > self::MAX_TOTAL_WEIGHT_KG) {
                throw new CommonException("Maximum weight is reached");
            }
            $this->cachedWeight += $cargoItemWeight;
            $this->cargo[] = $cargoItem;
        }
    }

    /**
     * @return int
     */
    public function getTotalWeight() : int
    {
        return $this->calculateCurrentWeight();
    }

    /**
     * @return int
     */
    public function getMaxWeight() : int
    {
        return self::MAX_TOTAL_WEIGHT_KG - self::CONTAINER_WEIGHT_KG;
    }

    /**
     * @param NavigationPointInterface $point
     * @return array
     */
    public function freeCargoByDestination(NavigationPointInterface $point) : array
    {
        $newCargoArray = [];
        $toFree = [];
        for ($i = 0, $sz = count($this->cargo); $i < $sz; $i++) {
            $item = $this->cargo[$i];
            if(
                $item instanceof HasDestinationInterface
                &&
                $item->getDestination() === $point->getPosition()
            ) {
                $toFree[] = $item;
                $this->cachedWeight-= $item->getWeight();
            }
            else {
                $newCargoArray[] = $item;
            }
        }
        $this->cargo = $newCargoArray;
        return $toFree;
    }

    /**
     * @return int
     */
    private function calculateCurrentWeight() : int
    {
        if(!is_null($this->cachedWeight)) {
            return $this->cachedWeight;
        }
        $total = self::CONTAINER_WEIGHT_KG;
        for ($i = 0, $sz = count($this->cargo); $i < $sz; $i++) {
            $cargoItem = $this->cargo[$i];
            $total+= $cargoItem->getWeight();
        }
        $this->cachedWeight = $total;
        return $total;
    }

    /**
     * @param DimensionsInterface $dimensions
     * @throws CommonException
     */
    private function validateDimensions(DimensionsInterface $dimensions)
    {
        if($dimensions->getHeight() > self::MAX_HEIGHT_CM || $dimensions->getWidth() > self::MAX_WIDTH_CM) {
            throw new CommonException("Cargo reached over to max dimensions");
        }
    }
}