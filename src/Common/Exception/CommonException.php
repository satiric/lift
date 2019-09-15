<?php

namespace Decadal\Lift\Common\Exception;

/**
 * Class CommonException
 * @package Decadal\Lift\Common\Exception
 */
class CommonException extends \Exception
{
    protected $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

}