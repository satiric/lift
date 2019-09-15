<?php
/**
 * Date: 14.09.19
 * Time: 10:20
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Enum;

use Decadal\Lift\Common\Enum\EnumInterface;
use Decadal\Lift\Common\Enum\EnumTrait;

/**
 * Class EngineStates
 * @package Decadal\Lift\Movement\Engine\Enum
 */
class EngineStates implements EnumInterface
{
    use EnumTrait;
    const WORKING = 'working';
    const STOPPED = 'stopped';

}