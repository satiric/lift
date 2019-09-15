<?php
/**
 * Date: 05.06.19
 * Time: 16:06
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\LiftTest\Zend;

use PHPUnit\Framework\TestCase;
use Decadal\Lift\Common\Enum\EnumInterface;
use Decadal\Lift\Common\Enum\EnumTrait;
use Decadal\Lift\Common\Zend\Validator\EnumValidator;

class SampleEnum implements EnumInterface
{
    use EnumTrait;
    const VALUE1 = 'value1';
    const VALUE2 = 'value2';
    const VALUE3 = '3';

}

class EnumValidatorTest extends TestCase
{

    /**
     * @throws \Exception
     */
    public function testEnumIsNotSetted()
    {
        $this->expectException(\Exception::class);
        $enumValidator = new EnumValidator();
        $enumValidator->isValid("1");
    }

    /**
     * @throws \Exception
     */
    public function testEnumIsInvalid()
    {
        $this->expectException(\TypeError::class);
        new EnumValidator(['enum' => 1]);
    }


    /**
     * @throws \Exception
     */
    public function testEnumValidation()
    {
        $enumValidator = new EnumValidator(['enum' => new SampleEnum]);

        $this->assertSame(true, $enumValidator->isValid("value1"));
        $this->assertSame(true, empty($enumValidator->getMessages()));

        $this->assertSame(false, $enumValidator->isValid("VALUE1"));
        $this->assertSame(true, !empty($enumValidator->getMessages()));

        $this->assertSame(false, $enumValidator->isValid("555555"));

        $enumValidator = new EnumValidator(['enum' => new SampleEnum]);
        $this->assertSame(true, $enumValidator->isValid("3"));
        $this->assertSame(true, empty($enumValidator->getMessages()));

    }

}