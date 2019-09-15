<?php
/**
 * Date: 14.09.19
 * Time: 11:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors;


use Decadal\Lift\Doors\Collection\DoorsCollection;
use Decadal\Lift\Doors\Service\DoorsManipulatorInterface;

/**
 * Class DoorsManager
 * @package Decadal\Lift\Doors
 */
class DoorsManager implements DoorsManagerInterface
{
    /**
     * @var DoorsCollection
     */
    private $doorsCollection;

    /**
     * @var DoorsManipulatorInterface
     */
    private $doorsManipulator;

    /**
     * DoorsManager constructor.
     * @param DoorsCollection $doorsCollection
     * @param DoorsManipulatorInterface $doorsManipulator
     */
    public function __construct(DoorsCollection $doorsCollection, DoorsManipulatorInterface $doorsManipulator)
    {
        $this->doorsCollection = $doorsCollection;
        $this->doorsManipulator = $doorsManipulator;
    }

    /**
     *
     */
    public function closeDoors()
    {
        $this->doorsManipulator->closeAll($this->doorsCollection);
    }

    /**
     *
     */
    public function openDoors()
    {
        $this->doorsManipulator->openAll($this->doorsCollection);
    }

    /**
     * @return bool
     */
    public function isDoorsClosed(): bool
    {
        return $this->doorsManipulator->areClosed($this->doorsCollection);
    }

    /**
     * @return bool
     */
    public function isDoorsOpened(): bool
    {
        return $this->doorsManipulator->areOpened($this->doorsCollection);
    }
}