<?php
/**
 * Date: 14.09.19
 * Time: 10:43
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Service;


use Decadal\Lift\Doors\Model\DoorsOperation;

/**
 * Interface DoorsInterface
 * @package Decadal\Lift\Doors
 */
interface DoorsInterface
{
    /**
     * @return DoorsOperation
     */
    public function open() : DoorsOperation;

    /**
     * @return DoorsOperation
     */
    public function close() : DoorsOperation;

    /**
     * @return bool
     */
    public function isClosed() : bool;

}