<?php
/**
 * Date: 16.09.19
 * Time: 9:59
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Factory\Service;


use Decadal\Lift\Movement\Engine\Service\SimpleCalculator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SimpleCalculatorFactory
 * @package Decadal\Lift\Movement\Engine\Factory\Service
 */
class SimpleCalculatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SimpleCalculator|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $calc = new SimpleCalculator();
        return $calc;
    }

}