<?php

use Zend\Console\Console;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use ZF\Console\Application;
use ZF\Console\Dispatcher;
use ZF\Console\Route;

require_once __DIR__ . '/vendor/autoload.php';

$appConfig = require __DIR__ . '/config/application.config.php';
if (file_exists(__DIR__ . '/config/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/config/development.config.php');
}

// Prepare the service manager
$smConfig = isset($config['service_manager']) ? $appConfig['service_manager'] : [];
$smConfig = new \Zend\Mvc\Service\ServiceManagerConfig($smConfig);

$serviceManager = new ServiceManager();
$smConfig->configureServiceManager($serviceManager);
$serviceManager->setService('ApplicationConfig', $appConfig);

// Load modules
$serviceManager->get('ModuleManager')->loadModules();

$config = $serviceManager->get('config');
$routes = $config['console_routes'] ?? [];
$handledRoutes = [];
foreach($routes as $route) {
    $handlerClass = $route['handler'];
    $handler = $serviceManager->get($handlerClass);
    $route['handler'] = function(Route $route, $console) use ($serviceManager, $handler) {
        return $handler($route, $console, $serviceManager);
    };
    $handledRoutes[] = $route;
}

$application = new Application(
    'lift-console-app',
    '',
    $handledRoutes,
    Console::getInstance(),
    new Dispatcher()
);

$application->setDebug(true);

$exit = $application->run();
exit($exit);