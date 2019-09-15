<?php
/**
 * Date: 14.09.19
 * Time: 22:26
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Enum;

use Decadal\Lift\Common\Enum\EnumInterface;
use Decadal\Lift\Common\Enum\EnumTrait;

/**
 * Class Directions
 * @package Decadal\Lift\Movement\Engine\Enum
 */
class Directions implements EnumInterface
{
    use EnumTrait;
    const UP = 'up';
    const DOWN = 'down';

}