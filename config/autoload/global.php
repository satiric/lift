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


use Decadal\Lift\Common\Console\LiftCommand;
use Decadal\Lift\Common\Console\LiftCommandHandler;
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
            LiftCommand::class => InvokableFactory::class,
            LiftCommandHandler::class => InvokableFactory::class,
        ]
    ]
];
