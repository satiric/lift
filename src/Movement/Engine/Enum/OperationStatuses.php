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
 * Class OperationStatuses
 * @package Decadal\Lift\Movement\Engine\Enum
 */
class OperationStatuses implements EnumInterface
{
    use EnumTrait;
    const SUCCESS = 'success';
    const FAILURE = 'failure';

}