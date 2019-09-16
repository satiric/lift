<?php
/**
 * Date: 16.09.19
 * Time: 9:46
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Cargo\Factory;


use Decadal\Lift\Cargo\DefaultCargoService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DefaultCargoServiceFactory
 * @package Decadal\Lift\Cargo\Factory
 */
class DefaultCargoServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DefaultCargoService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $cargoService = new DefaultCargoService();
        return $cargoService;
    }

}