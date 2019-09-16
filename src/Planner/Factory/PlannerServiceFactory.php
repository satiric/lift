<?php
/**
 * Date: 16.09.19
 * Time: 14:17
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Planner\Factory;


use Decadal\Lift\Planner\PlannerService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PlannerServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PlannerService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $planner = new PlannerService();
        return $planner;
    }

}