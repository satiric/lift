<?php
/**
 * Date: 14.09.19
 * Time: 12:21
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Factory\Service;

use Decadal\Lift\Cargo\CargoServiceInterface;
use Decadal\Lift\Doors\DoorsManagerInterface;
use Decadal\Lift\Movement\MovementManagerInterface;
use Decadal\Lift\Navigation\NavigatorInterface;
use Decadal\Lift\Planner\PlannerInterface;
use Decadal\Lift\Service\DefaultLift;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DefaultLiftFactory
 * @package Decadal\Lift\Factory\Service
 */
class DefaultLiftFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DefaultLift|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $doorsManager DoorsManagerInterface
         */
        $doorsManager = $container->get(DoorsManagerInterface::class);

        /**
         * @var $cargoService CargoServiceInterface
         */
        $cargoService = $container->get(CargoServiceInterface::class);

        /**
         * @var $movementManager MovementManagerInterface
         */
        $movementManager = $container->get(MovementManagerInterface::class);

        /**
         * @var $planner PlannerInterface
         */
        $planner = $container->get(PlannerInterface::class);

        /**
         * @var $navigator NavigatorInterface
         */
        $navigator = $container->get(NavigatorInterface::class);
        $service = new DefaultLift($doorsManager, $cargoService, $movementManager, $planner, $navigator);
        return $service;
    }
}