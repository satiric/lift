<?php
/**
 * Date: 16.09.19
 * Time: 9:54
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Factory;


use Decadal\Lift\Movement\Engine\Collection\EnginesCollection;
use Decadal\Lift\Movement\Engine\EnginesManager;
use Decadal\Lift\Movement\Engine\Service\EngineCalculatorInterface;
use Decadal\Lift\Movement\Engine\Service\EngineInterface;
use Decadal\Lift\Movement\Engine\Service\EngineManipulatorInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class EnginesManagerFactory
 * @package Decadal\Lift\Movement\Engine\Factory
 */
class EnginesManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return EnginesManager|object
     * @throws \Decadal\Lift\Common\Exception\BadParamException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var $engine1 EngineInterface
         */
        $engine1 = $container->get(EngineInterface::class);

        /**
         * @var $engine2 EngineInterface
         */
        $engine2 = $container->get(EngineInterface::class);

        $enginesCollection = new EnginesCollection([$engine1, $engine2]);

        /**
         * @var $engineManipulator EngineManipulatorInterface
         */
        $engineManipulator = $container->get(EngineManipulatorInterface::class);

        /**
         * @var $calculator EngineCalculatorInterface
         */
        $calculator = $container->get(EngineCalculatorInterface::class);
        $engineManager = new EnginesManager($enginesCollection, $engineManipulator, $calculator);
        return $engineManager;
    }

}