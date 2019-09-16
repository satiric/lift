<?php
/**
 * Date: 16.09.19
 * Time: 13:06
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Runple
 */

namespace Decadal\Lift\Navigation\Service;


use Decadal\Lift\Navigation\NavigationPointInterface;

/**
 * Class DefaultPointsMap
 * @package Decadal\Lift\Navigation\Service
 */
class DefaultPointsMap implements PointsMapInterface
{
    /**
     * @var $sequence NavigationPointInterface[]   map - position => point
     */
    private $sequence;

    /**
     * DefaultPointsMap constructor.
     * @param array $sequence
     * @throws \Exception
     */
    public function __construct(array $sequence)
    {
        if(empty($sequence)) {
            throw new \Exception("Sequence shouldn't be empty");
        }
        $this->sequence = $sequence;
    }

    /**
     * @return array
     */
    public function getSequence(): array
    {
        return $this->sequence;
    }

    /**
     * @param int $position
     * @return NavigationPointInterface|null
     */
    public function get(int $position): ?NavigationPointInterface
    {
        return $this->sequence[$position] ?? null;
    }

    /**
     * @return NavigationPointInterface
     */
    public function getFirst(): NavigationPointInterface
    {
        return $this->sequence[1];
    }

    /**
     * @return NavigationPointInterface
     */
    public function getLast(): NavigationPointInterface
    {
        $count = count($this->sequence);
        return $this->sequence[$count];
    }

}