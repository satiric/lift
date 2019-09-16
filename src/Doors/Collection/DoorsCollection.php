<?php
/**
 * Date: 14.09.19
 * Time: 11:33
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */


namespace Decadal\Lift\Doors\Collection;


use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Doors\Service\DoorsInterface;

/**
 * Class DoorsCollection
 * @package Runple\Devtools\LiftManagement\Collection
 */
class DoorsCollection
{
    private $doors = [];

    /**
     * DoorsCollection constructor.
     * @param DoorsInterface[] $doors
     * @throws BadParamException
     */
    public function __construct(array $doors = [])
    {
        $this->setDoors($doors);
    }

    /**
     * @param DoorsInterface $door
     */
    public function addDoor(DoorsInterface $door)
    {
        //todo check that door already exists i'm sorry i'm lazy
        $this->doors[] = $door;
    }

    /**
     * @param DoorsInterface[] $doors
     * @throws BadParamException
     */
    public function setDoors(array $doors)
    {
        for ($i = 0, $sz = count($doors); $i < $sz; $i++) {
            $door = $doors[$i];
            if(!$door instanceof DoorsInterface) {
                throw new BadParamException();
            }
        }
        $this->doors = $doors;
    }

    /**
     * @return DoorsInterface[]
     */
    public function getDoors() : array
    {
        return $this->doors;
    }
}