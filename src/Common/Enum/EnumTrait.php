<?php
/**
 * Date: 12.03.19
 * Time: 23:51
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\Lift\Common\Enum;


/**
 * Trait EnumTrait
 * @package Decadal\Lift\Common\Enum
 */
trait EnumTrait
{
    /**
     * @return string
     * @throws \Exception
     */
    public function __toString(): string
    {
        if(!$this instanceof EnumInterface) {
            throw new \Exception("EnumTrait is available only for EnumInterface instance");
        }
        return implode(", ", self::getList());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getList(): array
    {
        $className = self::class; //DO NOT USE __CLASS__
        $constants = (new \ReflectionClass($className))->getConstants();
        return array_values($constants);
    }
}