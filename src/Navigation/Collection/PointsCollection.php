<?php
/**
 * Date: 15.09.19
 * Time: 23:59
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Collection;

use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Class PointsCollection
 * @package Decadal\Lift\Navigation\Collection
 */
class PointsCollection
{

    /**
     * @var NavigationPointInterface[]
     */
    private $points = [];

    /**
     * PointsCollection constructor.
     * @param NavigationPointInterface[] $points
     * @throws BadParamException
     */
    public function __construct(array $points = [])
    {
        $this->setPoints($points);
    }

    /**
     * @param NavigationPointInterface $point
     */
    public function addPoints(NavigationPointInterface $point)
    {
        //todo check that point already exists i'm sorry i'm lazy
        $this->points[] = $point;
    }

    /**
     * @param NavigationPointInterface[] $points
     * @throws BadParamException
     */
    public function setPoints(array $points)
    {
        for ($i = 0, $sz = count($points); $i < $sz; $i++) {
            $point = $points[$i];
            if(!$point instanceof NavigationPointInterface) {
                throw new BadParamException("CargoItem should be instance of CargoItemInterface");
            }
        }
        $this->points = $points;
    }

    /**
     * @return NavigationPointInterface[]
     */
    public function getPoints() : array
    {
        return $this->points;
    }
}