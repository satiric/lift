<?php
/**
 * Date: 14.09.19
 * Time: 11:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Doors\Service;


use Decadal\Lift\Doors\Enum\OperationStatuses;
use Decadal\Lift\Doors\Collection\DoorsCollection;

class DoorsManipulator implements DoorsManipulatorInterface
{
    /**
     * @param DoorsCollection $doorsCollection
     */
    public function closeAll(DoorsCollection $doorsCollection)
    {

        // todo here nice to see parallelism

        $doors = $doorsCollection->getDoors();
        for ($i = 0, $sz = count($doors); $i < $sz; $i++) {
            $door = $doors[$i];
            $operation = $door->close();
            if($operation->getStatus() !== OperationStatuses::SUCCESS) {
                throw new \RuntimeException("Something going bad with doors %here doors id%");
            }
        }
    }

    /**
     * @param DoorsCollection $doorsCollection
     */
    public function openAll(DoorsCollection $doorsCollection)
    {

        // todo here nice to see parallelism

        $doors = $doorsCollection->getDoors();
        for ($i = 0, $sz = count($doors); $i < $sz; $i++) {
            $door = $doors[$i];
            $operation = $door->open();
            if($operation->getStatus() !== OperationStatuses::SUCCESS) {
                throw new \RuntimeException("Something going bad with doors %here doors id%");
            }
        }
    }

    /**
     * @param DoorsCollection $doorsCollection
     * @return bool
     */
    public function areOpened(DoorsCollection $doorsCollection) : bool
    {
        $doors = $doorsCollection->getDoors();
        for ($i = 0, $sz = count($doors); $i < $sz; $i++) {
            $door = $doors[$i];
            if($door->isClosed()) {
                return false;
            }
        }
        return true;
    }

    /**
     * NOTE: do not use (!$this->areOpened()); The method check that ALL doors are closed, not a "some" door
     * @param DoorsCollection $doorsCollection
     * @return bool
     */
    public function areClosed(DoorsCollection $doorsCollection) : bool
    {
        $doors = $doorsCollection->getDoors();
        for ($i = 0, $sz = count($doors); $i < $sz; $i++) {
            $door = $doors[$i];
            if(!$door->isClosed()) {
                return false;
            }
        }
        return true;
    }

}