<?php
/**
 * Date: 16.09.19
 * Time: 9:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Factory\Service;


use Decadal\Lift\Doors\Driver\DoorsDriverInterface;
use Decadal\Lift\Doors\Service\DefaultDoors;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DefaultDoorsFactory
 * @package Decadal\Lift\Doors\Factory\Service
 */
class DefaultDoorsFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DefaultDoors|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $driver DoorsDriverInterface
         */
        $driver = $container->get(DoorsDriverInterface::class);
        $doors = new DefaultDoors($driver);
        return $doors;
    }
}