<?php
/**
 * Date: 15.09.19
 * Time: 22:38
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Common\Console;

use Decadal\Lift\Cargo\Collection\CargoCollection;
use Decadal\Lift\Cargo\Model\CargoItem;
use Decadal\Lift\LiftInterface;
use Decadal\Lift\Movement\Engine\Enum\Directions;
use Decadal\Lift\MovementControlInterface;
use Decadal\Lift\NavigationInterface;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

/**
 * Class LiftCommand
 * @package Decadal\Lift\Common\Console
 */
class LiftCommand implements CommandInterface
{
    /**
     * @var LiftInterface|NavigationInterface|MovementControlInterface
     */
    private $lift;

    /**
     * LiftCommand constructor.
     * @param LiftInterface $lift
     * @throws \Exception
     */
    public function __construct(LiftInterface $lift)
    {
        if(!$lift instanceof  NavigationInterface || !$lift instanceof MovementControlInterface) {
            throw new \Exception("Lift should implements Navigation and MovementControl interfaces");
        }
        $this->lift = $lift;
    }

    /**
     * @param Route $route
     * @param AdapterInterface $adapter
     * @throws \Decadal\Lift\Common\Exception\BadParamException
     */
    public function __invoke(Route $route, AdapterInterface $adapter)
    {

        $person1 = new CargoItem(60, 160,55, 4);
        $person2 = new CargoItem(60, 160,55, 1);
        $person3 = new CargoItem(60, 160,55, 2);

        // this guy on first floor, doors are opened!
        $this->lift->acceptCargo(new CargoCollection([$person1]));

        // and these guys waiting for us on other floors
        $this->lift->callTo([

            Directions::DOWN => [ //for both guys direction is down

                3, // person3 from 3 floor, wants to move down

                4 // person2 from 4 floor, wants to move down

            ]
        ]);

        while($this->lift->getDestination() !== null)
        {
            if($this->lift->getCurrentPosition() === 4 ) {
                // this guy waiting for us on 4 floor
                $this->lift->acceptCargo(new CargoCollection([$person2]));
            }

            if($this->lift->getCurrentPosition() === 3 ) {
                // this guy waiting for us on 3 floor
                $this->lift->acceptCargo(new CargoCollection([$person3]));
            }
            $this->lift->toNextDestination();
        }
    }

}