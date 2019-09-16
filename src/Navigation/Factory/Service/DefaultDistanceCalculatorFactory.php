<?php
/**
 * Date: 16.09.19
 * Time: 10:11
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Factory\Service;


use Decadal\Lift\Navigation\Service\DefaultDistanceCalculator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DefaultDistanceCalculatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $distanceCalculator = new DefaultDistanceCalculator();
        return $distanceCalculator;
    }

}