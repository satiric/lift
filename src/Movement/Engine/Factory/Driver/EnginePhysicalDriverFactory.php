<?php
/**
 * Date: 16.09.19
 * Time: 10:05
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Factory\Driver;


use Decadal\Lift\Movement\Engine\Driver\EnginePhysicalDriver;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EnginePhysicalDriverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return EnginePhysicalDriver|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new EnginePhysicalDriver();
    }

}