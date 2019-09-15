<?php
/**
 * Date: 04.07.19
 * Time: 14:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\Lift\Common\Console;

use Psr\Container\ContainerInterface;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

/**
 * Interface CommandHandlerInterface
 * @package Common\Console
 */
interface CommandHandlerInterface
{
    public function __invoke(Route $route, AdapterInterface $console, ContainerInterface $container);

}