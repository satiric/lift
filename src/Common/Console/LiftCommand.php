<?php
/**
 * Date: 15.09.19
 * Time: 22:38
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Common\Console;


use Decadal\Lift\LiftControlInterface;
use Zend\Console\Adapter\AdapterInterface;
use ZF\Console\Route;

class LiftCommand implements CommandInterface
{
    /**
     * @var LiftControlInterface
     */
    private $liftControl;

    /**
     * LiftCommand constructor.
     * @param LiftControlInterface $control
     */
    public function __construct(LiftControlInterface $control = null)
    {
        $this->liftControl = $control;
    }

    /**
     * @param Route $route
     * @param AdapterInterface $adapter
     */
    public function __invoke(Route $route, AdapterInterface $adapter)
    {
        $this->liftControl;
    }

}