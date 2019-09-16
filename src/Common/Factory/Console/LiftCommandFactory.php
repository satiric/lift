<?php
/**
 * Date: 16.09.19
 * Time: 14:20
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Common\Factory\Console;


use Decadal\Lift\Common\Console\LiftCommand;
use Decadal\Lift\LiftInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LiftCommandFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|void
     * @throws \Exception
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $lift = $container->get(LiftInterface::class);
        $liftCommand = new LiftCommand($lift);
        return $liftCommand;
    }
}