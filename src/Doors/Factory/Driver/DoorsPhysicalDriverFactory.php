<?php
/**
 * Date: 16.09.19
 * Time: 9:36
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Factory\Driver;

use Decadal\Lift\Doors\Driver\DoorsPhysicalDriver;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DoorsPhysicalDriverFactory
 * @package Decadal\Lift\Doors\Factory\Driver
 */
class DoorsPhysicalDriverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DoorsPhysicalDriver|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $driver = new DoorsPhysicalDriver();
        return $driver;
    }

}