<?php
/**
 * Date: 16.09.19
 * Time: 10:10
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Factory;


use Decadal\Lift\Navigation\DefaultNavigator;
use Decadal\Lift\Navigation\Service\DistanceCalculatorInterface;
use Decadal\Lift\Navigation\Service\PointsMapInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DefaultNavigatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DefaultNavigator|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $calculator DistanceCalculatorInterface
         */
        $calculator = $container->get(DistanceCalculatorInterface::class);
        /**
         * @var $pointsMap PointsMapInterface
         */
        $pointsMap = $container->get(PointsMapInterface::class);
        $navigator = new DefaultNavigator($pointsMap, $calculator);
        return $navigator;
    }

}