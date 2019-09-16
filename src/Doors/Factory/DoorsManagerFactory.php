<?php
/**
 * Date: 16.09.19
 * Time: 9:28
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Doors\Factory;


use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Doors\Collection\DoorsCollection;
use Decadal\Lift\Doors\DoorsManager;
use Decadal\Lift\Doors\Service\DoorsInterface;
use Decadal\Lift\Doors\Service\DoorsManipulatorInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DoorsManagerFactory
 * @package Decadal\Lift\Doors\Factory
 */
class DoorsManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|void
     * @throws BadParamException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $doors DoorsInterface
         */
        $doors = $container->get(DoorsInterface::class);
        //here may be several doors
        $doorsCollection = new DoorsCollection([$doors]);

        /**
         * @var $doorsManipulator DoorsManipulatorInterface
         */
        $doorsManipulator = $container->get(DoorsManipulatorInterface::class);
        $doorsManager = new DoorsManager($doorsCollection, $doorsManipulator);
        return $doorsManager;
    }

}