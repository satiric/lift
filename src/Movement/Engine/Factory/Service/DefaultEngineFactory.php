<?php
/**
 * Date: 16.09.19
 * Time: 10:02
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Factory\Service;


use Decadal\Lift\Movement\Engine\Driver\EngineDriverInterface;
use Decadal\Lift\Movement\Engine\Service\DefaultEngine;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DefaultEngineFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DefaultEngine|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $driver EngineDriverInterface
         */
        $driver = $container->get(EngineDriverInterface::class);
        $engine = new DefaultEngine($driver);
        return $engine;
    }

}