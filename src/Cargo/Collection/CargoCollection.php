<?php
/**
 * Date: 14.09.19
 * Time: 11:33
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Cargo\Collection;

use Decadal\Lift\Cargo\CargoItemInterface;
use Decadal\Lift\Common\Exception\BadParamException;

/**
 * Class CargoCollection
 * @package Decadal\Lift\Cargo\Collection
 */
class CargoCollection
{
    /**
     * @var CargoItemInterface[]
     */
    private $cargo = [];

    /**
     * CargoCollection constructor.
     * @param array $cargo
     * @throws BadParamException
     */
    public function __construct(array $cargo = [])
    {
        $this->setCargo($cargo);
    }

    /**
     * @param CargoItemInterface $cargoItem
     */
    public function addCargo(CargoItemInterface $cargoItem)
    {
        //todo check that cargoItem already exists i'm sorry i'm lazy
        $this->cargo[] = $cargoItem;
    }

    /**
     * @param CargoItemInterface[] $cargo
     * @throws BadParamException
     */
    public function setCargo(array $cargo)
    {
        for ($i = 0, $sz = count($cargo); $i < $sz; $i++) {
            $cargoItem = $cargo[$i];
            if(!$cargoItem instanceof CargoItemInterface) {
                throw new BadParamException("CargoItem should be instance of CargoItemInterface");
            }
        }
        $this->cargo = $cargo;
    }

    /**
     * @return CargoItemInterface[]
     */
    public function getCargo() : array
    {
        return $this->cargo;
    }
}