<?php
/**
 * Date: 14.09.19
 * Time: 11:33
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Movement\Engine\Collection;


use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Movement\Engine\Service\EngineInterface;

/**
 * Class EnginesCollection
 * @package Decadal\Lift\Movement\Engine\Collection
 */
class EnginesCollection
{
    private $engines = [];

    /**
     * DoorsCollection constructor.
     * @param array $engines
     * @throws BadParamException
     */
    public function __construct(array $engines = [])
    {
        $this->setEngines($engines);
    }

    /**
     * @param EngineInterface $engine
     */
    public function addDoor(EngineInterface $engine)
    {
        //todo check that engine already exists i'm sorry i'm lazy
        $this->engines[] = $engine;
    }

    /**
     * @param EngineInterface[] $engines
     * @throws BadParamException
     */
    public function setEngines(array $engines)
    {
        for ($i = 0, $sz = count($engines); $i < $sz; $i++) {
            $engine = $engines[$i];
            if(!$engine instanceof EngineInterface) {
                throw new BadParamException();
            }
        }
        $this->engines = $engines;
    }

    /**
     * @return EngineInterface[]
     */
    public function getEngines() : array
    {
        return $this->engines;
    }
}