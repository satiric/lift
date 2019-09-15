<?php
/**
 * Date: 14.09.19
 * Time: 21:15
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Service;

use Decadal\Lift\Movement\Engine\Collection\EnginesCollection;

/**
 * Interface EngineManipulatorInterface
 * @package Decadal\Lift\Movement\Engine\Service
 */
interface EngineManipulatorInterface
{
    public function startAllNegative(EnginesCollection $collection, int $power);

    public function startAllPositive(EnginesCollection $collection, int $power);

    public function stopAll(EnginesCollection $collection);
}