<?php
/**
 * Date: 14.09.19
 * Time: 10:20
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Enum;

use Decadal\Lift\Common\Enum\EnumInterface;
use Decadal\Lift\Common\Enum\EnumTrait;

/**
 * Class DoorsStates
 * @package Decadal\Lift\Doors\Enum
 */
class DoorsStates implements EnumInterface
{
    use EnumTrait;

    const OPENED = 'opened';
    const CLOSED = 'closed';
}