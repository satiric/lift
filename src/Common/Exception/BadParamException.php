<?php


namespace Decadal\Lift\Common\Exception;


/**
 * Class BadParamException
 * @package Decadal\Lift\Common\Exception
 */
class BadParamException extends CommonException
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