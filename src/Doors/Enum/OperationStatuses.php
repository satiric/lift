<?php
/**
 * Date: 14.09.19
 * Time: 10:20
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios
 */

namespace Decadal\Lift\Doors\Enum;


use Decadal\Lift\Common\Enum\EnumInterface;
use Decadal\Lift\Common\Enum\EnumTrait;

class OperationStatuses implements EnumInterface
{
    use EnumTrait;

    const SUCCESS = 'success';
    const FAILURE = 'failure';
}