<?php
/**
 * Date: 16.09.19
 * Time: 9:58
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Factory\Service;


use Decadal\Lift\Movement\Engine\Service\EngineManipulator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EnginesManipulatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return EngineManipulator|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $manipulator = new EngineManipulator();
        return $manipulator;
    }

}