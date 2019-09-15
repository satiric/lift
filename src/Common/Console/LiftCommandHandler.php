<?php
/**
 * Date: 15.09.19
 * Time: 22:49
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Common\Console;


use Psr\Container\ContainerInterface;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

class LiftCommandHandler implements CommandHandlerInterface
{
    public function __invoke(Route $route, AdapterInterface $console, ContainerInterface $container)
    {
        $command = $container->get(LiftCommand::class);
        $command($route, $console);
    }
}