<?php
/**
 * Date: 14.09.19
 * Time: 11:49
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Doors\Service;

use Decadal\Lift\Doors\Collection\DoorsCollection;

/**
 * Interface DoorsManipulatorInterface
 * @package Decadal\Lift\Doors\Service
 */
interface DoorsManipulatorInterface
{
    /**
     * @param DoorsCollection $doorsCollection
     * @return mixed
     */
    public function closeAll(DoorsCollection $doorsCollection);

    /**
     * @param DoorsCollection $doorsCollection
     * @return mixed
     */
    public function openAll(DoorsCollection $doorsCollection);

    /**
     * @param DoorsCollection $doorsCollection
     * @return bool
     */
    public function areOpened(DoorsCollection $doorsCollection) : bool;

    /**
     * @param DoorsCollection $doorsCollection
     * @return bool
     */
    public function areClosed(DoorsCollection $doorsCollection) : bool;
}