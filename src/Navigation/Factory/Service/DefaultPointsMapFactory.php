<?php
/**
 * Date: 16.09.19
 * Time: 13:53
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Factory\Service;


use Decadal\Lift\Common\Tool\Arrays\ArrayHelper;
use Decadal\Lift\Navigation\Model\Floor;
use Decadal\Lift\Navigation\Service\DefaultPointsMap;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DefaultPointsMapFactory implements FactoryInterface
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
        $floor1 = new Floor(400, 1);
        $floor2 = new Floor(400, 2);
        $floor3 = new Floor(400, 3);
        $floor4 = new Floor(400, 4);
        $array = [$floor1, $floor2, $floor3, $floor4];
        $pointsMap = new DefaultPointsMap(ArrayHelper::index($array, 'position'));
        return $pointsMap;
    }


}