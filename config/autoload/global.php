<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */


use Decadal\Lift\Cargo\CargoServiceInterface;
use Decadal\Lift\Cargo\Factory\DefaultCargoServiceFactory;
use Decadal\Lift\Common\Console\LiftCommand;
use Decadal\Lift\Common\Console\LiftCommandHandler;
use Decadal\Lift\Common\Factory\Console\LiftCommandFactory;
use Decadal\Lift\Doors\DoorsManagerInterface;
use Decadal\Lift\Doors\Driver\DoorsDriverInterface;
use Decadal\Lift\Doors\Factory\DoorsManagerFactory;
use Decadal\Lift\Doors\Factory\Driver\DoorsPhysicalDriverFactory;
use Decadal\Lift\Doors\Factory\Service\DefaultDoorsFactory;
use Decadal\Lift\Doors\Factory\Service\DoorsManipulatorFactory;
use Decadal\Lift\Doors\Service\DoorsInterface;
use Decadal\Lift\Doors\Service\DoorsManipulatorInterface;
use Decadal\Lift\Factory\Service\DefaultLiftFactory;
use Decadal\Lift\LiftInterface;
use Decadal\Lift\Movement\Engine\Driver\EngineDriverInterface;
use Decadal\Lift\Movement\Engine\EnginesManagerInterface;
use Decadal\Lift\Movement\Engine\Factory\Driver\EnginePhysicalDriverFactory;
use Decadal\Lift\Movement\Engine\Factory\EnginesManagerFactory;
use Decadal\Lift\Movement\Engine\Factory\Service\DefaultEngineFactory;
use Decadal\Lift\Movement\Engine\Factory\Service\EnginesManipulatorFactory;
use Decadal\Lift\Movement\Engine\Factory\Service\SimpleCalculatorFactory;
use Decadal\Lift\Movement\Engine\Service\EngineCalculatorInterface;
use Decadal\Lift\Movement\Engine\Service\EngineInterface;
use Decadal\Lift\Movement\Engine\Service\EngineManipulatorInterface;
use Decadal\Lift\Movement\Factory\MovementManagerFactory;
use Decadal\Lift\Movement\MovementManagerInterface;
use Decadal\Lift\Navigation\Factory\DefaultNavigatorFactory;
use Decadal\Lift\Navigation\Factory\Service\DefaultDistanceCalculatorFactory;
use Decadal\Lift\Navigation\Factory\Service\DefaultPointsMapFactory;
use Decadal\Lift\Navigation\NavigatorInterface;
use Decadal\Lift\Navigation\Service\DistanceCalculatorInterface;
use Decadal\Lift\Navigation\Service\PointsMapInterface;
use Decadal\Lift\Planner\Factory\PlannerServiceFactory;
use Decadal\Lift\Planner\PlannerInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'console_routes' => [
        [
            'name' => 'run',
            'route' => '',
            'description' => 'Start lift test script',
            'handler' => LiftCommandHandler::class
        ]
    ],
    'service_manager' => [
        'factories' => [
            LiftCommand::class => LiftCommandFactory::class,
            LiftCommandHandler::class => InvokableFactory::class,
            LiftInterface::class => DefaultLiftFactory::class,

            DoorsInterface::class => DefaultDoorsFactory::class,
            DoorsManagerInterface::class => DoorsManagerFactory::class,
            DoorsDriverInterface::class => DoorsPhysicalDriverFactory::class,
            DoorsManipulatorInterface::class => DoorsManipulatorFactory::class,
            CargoServiceInterface::class => DefaultCargoServiceFactory::class,

            MovementManagerInterface::class => MovementManagerFactory::class,
            EnginesManagerInterface::class => EnginesManagerFactory::class,
            EngineManipulatorInterface::class => EnginesManipulatorFactory::class,
            EngineCalculatorInterface::class => SimpleCalculatorFactory::class,
            EngineInterface::class => DefaultEngineFactory::class,
            EngineDriverInterface::class => EnginePhysicalDriverFactory::class,

            NavigatorInterface::class => DefaultNavigatorFactory::class,
            PointsMapInterface::class => DefaultPointsMapFactory::class,
            DistanceCalculatorInterface::class => DefaultDistanceCalculatorFactory::class,

            PlannerInterface::class => PlannerServiceFactory::class,
        ],
        'shared' => [
            DoorsInterface::class => false,
            DoorsDriverInterface::class => false,
            MovementManagerInterface::class => false,
            EnginesManagerInterface::class => false,
            EngineInterface::class => false,
            EngineDriverInterface::class => false,
            NavigatorInterface::class => false,
            PointsMapInterface::class => false,
            PlannerInterface::class => false,
        ]
    ]
];
