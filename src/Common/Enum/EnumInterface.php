<?php
/**
 * Date: 23.01.19
 * Time: 21:38
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\Lift\Common\Enum;

/**
 * Interface EnumInterface
 * @package Decadal\Lift\Common\Enum
 */
interface EnumInterface
{
    /**
     * @return array
     */
    public static function getList() : array;

    /**
     * @return string
     */
    public function __toString() : string;
}