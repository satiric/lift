<?php
/**
 * Date: 06.02.19
 * Time: 14:02
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\Lift\Common\Zend\Validator;

use Decadal\Lift\Common\Enum\EnumInterface;
use Zend\Validator\AbstractValidator;


/**
 * Class EnumValidator
 * @package Decadal\Lift\Common\Zend\Validator
 */
class EnumValidator extends AbstractValidator
{
    const DOESNT_MATCH_TO_ENUM  = 'doesntMatchToEnum';

    /**
     * @var array
     */
    protected $messageTemplates = [
        self::DOESNT_MATCH_TO_ENUM  => "The value doesn't belongs to enum"
    ];

    /**
     * @var $enum EnumInterface|null
     */
    protected $enum = null;

    /**
     * EnumValidator constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        if(is_array($options)) {
            $this->setEnum($options['enum'] ?? null);
        }
        parent::__construct($options);
    }


    /**
     * @param EnumInterface|null $enum
     */
    public function setEnum(?EnumInterface $enum)
    {
        $this->enum = $enum;
    }


    /**
     * @param mixed $value
     * @return bool
     * @throws \Exception
     */
    public function isValid($value) : bool
    {
        if(is_null($this->enum)) {
            throw new \Exception("Enum wasn't set");
        }
        $list = $this->enum::getList();
        if(!in_array($value, $list)) {
            $this->error(self::DOESNT_MATCH_TO_ENUM);
            return false;
        }
        return true;
    }
}
