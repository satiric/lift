<?php
/**
 * Date: 16.09.19
 * Time: 14:23
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Factory\Service;


use Decadal\Lift\Doors\Service\DoorsManipulator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DoorsManipulatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DoorsManipulator|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DoorsManipulator();
    }

}