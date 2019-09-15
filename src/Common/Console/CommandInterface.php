<?php
/**
 * Date: 04.07.19
 * Time: 14:32
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\Lift\Common\Console;

use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

interface CommandInterface
{
    public function __invoke(Route $route, AdapterInterface $adapter);

}