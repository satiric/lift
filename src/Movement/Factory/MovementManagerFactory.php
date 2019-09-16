<?php
/**
 * Date: 16.09.19
 * Time: 9:50
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Factory;


use Decadal\Lift\Movement\Engine\EnginesManagerInterface;
use Decadal\Lift\Movement\MovementManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MovementManagerFactory
 * @package Decadal\Lift\Movement\Factory
 */
class MovementManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|void
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $enginesManager EnginesManagerInterface
         */
        $enginesManager = $container->get(EnginesManagerInterface::class);

        $movementManager = new MovementManager($enginesManager);

        return $movementManager;
    }

}