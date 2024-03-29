<?php
/**
 * Date: 05.06.19
 * Time: 18:03
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\LiftTest\Tool;


use ArrayObject;
use PHPUnit\Framework\TestCase;
use Decadal\Lift\Common\Exception\BadParamException;
use Decadal\Lift\Common\Tool\Arrays\ArrayHelper;
use stdClass;


class Post1
{
    public $id = 23;
    public $title = 'tt';
}


class ArrayHelperTest extends TestCase
{

    public function testToArray()
    {
//        $dataArrayable = $this->getMockBuilder('yii\\base\\Arrayable')->getMock();
//        $dataArrayable->method('toArray')->willReturn([]);

        $object = new Post1();
        $this->assertEquals(get_object_vars($object), ArrayHelper::toArray($object));
        $object1 = new Post1();
        $this->assertEquals([
            get_object_vars($object1)
        ], ArrayHelper::toArray([
            $object1
        ]));
    }
    public function testRemove()
    {
        $array = ['name' => 'b', 'age' => 3];
        $name = ArrayHelper::remove($array, 'name');
        $this->assertEquals($name, 'b');
        $this->assertEquals($array, ['age' => 3]);
        $default = ArrayHelper::remove($array, 'nonExisting', 'defaultValue');
        $this->assertEquals('defaultValue', $default);
    }
    public function testRemoveValueMultiple()
    {
        $array = [
            'Bob' => 'Dylan',
            'Michael' => 'Jackson',
            'Mick' => 'Jagger',
            'Janet' => 'Jackson',
        ];
        $removed = ArrayHelper::removeValue($array, 'Jackson');
        $this->assertEquals([
            'Bob' => 'Dylan',
            'Mick' => 'Jagger',
        ], $array);
        $this->assertEquals([
            'Michael' => 'Jackson',
            'Janet' => 'Jackson',
        ], $removed);
    }
    public function testRemoveValueNotExisting()
    {
        $array = [
            'Bob' => 'Dylan',
            'Michael' => 'Jackson',
            'Mick' => 'Jagger',
            'Janet' => 'Jackson',
        ];
        $removed = ArrayHelper::removeValue($array, 'Marley');
        $this->assertEquals([
            'Bob' => 'Dylan',
            'Michael' => 'Jackson',
            'Mick' => 'Jagger',
            'Janet' => 'Jackson',
        ], $array);
        $this->assertEquals([], $removed);
    }

    /**
     * @throws BadParamException
     */
    public function testMultisort()
    {
        // empty key
        $dataEmpty = [];
        ArrayHelper::multisort($dataEmpty, '');
        $this->assertEquals([], $dataEmpty);
        // single key
        $array = [
            ['name' => 'b', 'age' => 3],
            ['name' => 'a', 'age' => 1],
            ['name' => 'c', 'age' => 2],
        ];
        ArrayHelper::multisort($array, 'name');
        $this->assertEquals(['name' => 'a', 'age' => 1], $array[0]);
        $this->assertEquals(['name' => 'b', 'age' => 3], $array[1]);
        $this->assertEquals(['name' => 'c', 'age' => 2], $array[2]);
        // multiple keys
        $array = [
            ['name' => 'b', 'age' => 3],
            ['name' => 'a', 'age' => 2],
            ['name' => 'a', 'age' => 1],
        ];
        ArrayHelper::multisort($array, ['name', 'age']);
        $this->assertEquals(['name' => 'a', 'age' => 1], $array[0]);
        $this->assertEquals(['name' => 'a', 'age' => 2], $array[1]);
        $this->assertEquals(['name' => 'b', 'age' => 3], $array[2]);
        // case-insensitive
        $array = [
            ['name' => 'a', 'age' => 3],
            ['name' => 'b', 'age' => 2],
            ['name' => 'B', 'age' => 4],
            ['name' => 'A', 'age' => 1],
        ];
        ArrayHelper::multisort($array, ['name', 'age'], SORT_ASC, [SORT_STRING, SORT_REGULAR]);
        $this->assertEquals(['name' => 'A', 'age' => 1], $array[0]);
        $this->assertEquals(['name' => 'B', 'age' => 4], $array[1]);
        $this->assertEquals(['name' => 'a', 'age' => 3], $array[2]);
        $this->assertEquals(['name' => 'b', 'age' => 2], $array[3]);
        ArrayHelper::multisort($array, ['name', 'age'], SORT_ASC, [SORT_STRING | SORT_FLAG_CASE, SORT_REGULAR]);
        $this->assertEquals(['name' => 'A', 'age' => 1], $array[0]);
        $this->assertEquals(['name' => 'a', 'age' => 3], $array[1]);
        $this->assertEquals(['name' => 'b', 'age' => 2], $array[2]);
        $this->assertEquals(['name' => 'B', 'age' => 4], $array[3]);
    }

    /**
     * @throws \Runple\Devtools\Exception\BadParamException
     */
    public function testMultisortNestedObjects()
    {
        $obj1 = new stdClass();
        $obj1->type = 'def';
        $obj1->owner = $obj1;
        $obj2 = new stdClass();
        $obj2->type = 'abc';
        $obj2->owner = $obj2;
        $obj3 = new stdClass();
        $obj3->type = 'abc';
        $obj3->owner = $obj3;
        $models = [
            $obj1,
            $obj2,
            $obj3,
        ];
        $this->assertEquals($obj2, $obj3);
        ArrayHelper::multisort($models, 'type', SORT_ASC);
        $this->assertEquals($obj2, $models[0]);
        $this->assertEquals($obj3, $models[1]);
        $this->assertEquals($obj1, $models[2]);
        ArrayHelper::multisort($models, 'type', SORT_DESC);
        $this->assertEquals($obj1, $models[0]);
        $this->assertEquals($obj2, $models[1]);
        $this->assertEquals($obj3, $models[2]);
    }

    /**
     * @throws BadParamException
     */
    public function testMultisortClosure()
    {
        $changelog = [
            '- Enh #123: test1',
            '- Bug #125: test2',
            '- Bug #123: test2',
            '- Enh: test3',
            '- Bug: test4',
        ];
        $i = 0;
        ArrayHelper::multisort($changelog, function ($line) use (&$i) {
            if (preg_match('/^- (Enh|Bug)( #\d+)?: .+$/', $line, $m)) {
                $o = ['Bug' => 'C', 'Enh' => 'D'];
                return $o[$m[1]] . ' ' . (!empty($m[2]) ? $m[2] : 'AAAA' . $i++);
            }
            return 'B' . $i++;
        }, SORT_ASC, SORT_NATURAL);
        $this->assertEquals([
            '- Bug #123: test2',
            '- Bug #125: test2',
            '- Bug: test4',
            '- Enh #123: test1',
            '- Enh: test3',
        ], $changelog);
    }

    /**
     * @throws BadParamException
     */
    public function testMultisortInvalidParamExceptionDirection()
    {
        $this->expectException(BadParamException::class);
        $data = ['foo' => 'bar'];
        ArrayHelper::multisort($data, ['foo'], []);
    }

    /**
     * @throws BadParamException
     */
    public function testMultisortInvalidParamExceptionSortFlag()
    {
        $this->expectException(BadParamException::class);
        $data = ['foo' => 'bar'];
        ArrayHelper::multisort($data, ['foo'], ['foo'], []);
    }

    /**
     * @see https://github.com/yiisoft/yii2/pull/11549
     */
    public function test()
    {
        $array = [];
        $array[1.0] = 'some value';
        $result = ArrayHelper::getValue($array, 1.0);
        $this->assertEquals('some value', $result);
    }
    public function testIndex()
    {
        $array = [
            ['id' => '123', 'data' => 'abc'],
            ['id' => '345', 'data' => 'def'],
            ['id' => '345', 'data' => 'ghi'],
        ];
        $result = ArrayHelper::index($array, 'id');
        $this->assertEquals([
            '123' => ['id' => '123', 'data' => 'abc'],
            '345' => ['id' => '345', 'data' => 'ghi'],
        ], $result);
        $result = ArrayHelper::index($array, function ($element) {
            return $element['data'];
        });
        $this->assertEquals([
            'abc' => ['id' => '123', 'data' => 'abc'],
            'def' => ['id' => '345', 'data' => 'def'],
            'ghi' => ['id' => '345', 'data' => 'ghi'],
        ], $result);
        $result = ArrayHelper::index($array, null);
        $this->assertEquals([], $result);
        $result = ArrayHelper::index($array, function ($element) {
            return null;
        });
        $this->assertEquals([], $result);
        $result = ArrayHelper::index($array, function ($element) {
            return $element['id'] == '345' ? null : $element['id'];
        });
        $this->assertEquals([
            '123' => ['id' => '123', 'data' => 'abc'],
        ], $result);
    }
    public function testIndexGroupBy()
    {
        $array = [
            ['id' => '123', 'data' => 'abc'],
            ['id' => '345', 'data' => 'def'],
            ['id' => '345', 'data' => 'ghi'],
        ];
        $expected = [
            '123' => [
                ['id' => '123', 'data' => 'abc'],
            ],
            '345' => [
                ['id' => '345', 'data' => 'def'],
                ['id' => '345', 'data' => 'ghi'],
            ],
        ];
        $result = ArrayHelper::index($array, null, ['id']);
        $this->assertEquals($expected, $result);
        $result = ArrayHelper::index($array, null, 'id');
        $this->assertEquals($expected, $result);
        $result = ArrayHelper::index($array, null, ['id', 'data']);
        $this->assertEquals([
            '123' => [
                'abc' => [
                    ['id' => '123', 'data' => 'abc'],
                ],
            ],
            '345' => [
                'def' => [
                    ['id' => '345', 'data' => 'def'],
                ],
                'ghi' => [
                    ['id' => '345', 'data' => 'ghi'],
                ],
            ],
        ], $result);
        $expected = [
            '123' => [
                'abc' => ['id' => '123', 'data' => 'abc'],
            ],
            '345' => [
                'def' => ['id' => '345', 'data' => 'def'],
                'ghi' => ['id' => '345', 'data' => 'ghi'],
            ],
        ];
        $result = ArrayHelper::index($array, 'data', ['id']);
        $this->assertEquals($expected, $result);
        $result = ArrayHelper::index($array, 'data', 'id');
        $this->assertEquals($expected, $result);
        $result = ArrayHelper::index($array, function ($element) {
            return $element['data'];
        }, 'id');
        $this->assertEquals($expected, $result);
        $expected = [
            '123' => [
                'abc' => [
                    'abc' => ['id' => '123', 'data' => 'abc'],
                ],
            ],
            '345' => [
                'def' => [
                    'def' => ['id' => '345', 'data' => 'def'],
                ],
                'ghi' => [
                    'ghi' => ['id' => '345', 'data' => 'ghi'],
                ],
            ],
        ];
        $result = ArrayHelper::index($array, 'data', ['id', 'data']);
        $this->assertEquals($expected, $result);
        $result = ArrayHelper::index($array, function ($element) {
            return $element['data'];
        }, ['id', 'data']);
        $this->assertEquals($expected, $result);
    }
    /**
     * @see https://github.com/yiisoft/yii2/issues/11739
     */
    public function testIndexFloat()
    {
        $array = [
            ['id' => 1e6],
            ['id' => 1e32],
            ['id' => 1e64],
            ['id' => 1465540807.522109],
        ];
        $expected = [
            '1000000' => ['id' => 1e6],
            '1.0E+32' => ['id' => 1e32],
            '1.0E+64' => ['id' => 1e64],
            '1465540807.5221' => ['id' => 1465540807.522109],
        ];
        $result = ArrayHelper::index($array, 'id');
        $this->assertEquals($expected, $result);
    }
    public function testGetColumn()
    {
        $array = [
            'a' => ['id' => '123', 'data' => 'abc'],
            'b' => ['id' => '345', 'data' => 'def'],
        ];
        $result = ArrayHelper::getColumn($array, 'id');
        $this->assertEquals(['a' => '123', 'b' => '345'], $result);
        $result = ArrayHelper::getColumn($array, 'id', false);
        $this->assertEquals(['123', '345'], $result);
        $result = ArrayHelper::getColumn($array, function ($element) {
            return $element['data'];
        });
        $this->assertEquals(['a' => 'abc', 'b' => 'def'], $result);
        $result = ArrayHelper::getColumn($array, function ($element) {
            return $element['data'];
        }, false);
        $this->assertEquals(['abc', 'def'], $result);
    }
    public function testMap()
    {
        $array = [
            ['id' => '123', 'name' => 'aaa', 'class' => 'x'],
            ['id' => '124', 'name' => 'bbb', 'class' => 'x'],
            ['id' => '345', 'name' => 'ccc', 'class' => 'y'],
        ];
        $result = ArrayHelper::map($array, 'id', 'name');
        $this->assertEquals([
            '123' => 'aaa',
            '124' => 'bbb',
            '345' => 'ccc',
        ], $result);
        $result = ArrayHelper::map($array, 'id', 'name', 'class');
        $this->assertEquals([
            'x' => [
                '123' => 'aaa',
                '124' => 'bbb',
            ],
            'y' => [
                '345' => 'ccc',
            ],
        ], $result);
    }
    public function testKeyExists()
    {
        $array = [
            'a' => 1,
            'B' => 2,
        ];
        $this->assertTrue(ArrayHelper::keyExists('a', $array));
        $this->assertFalse(ArrayHelper::keyExists('b', $array));
        $this->assertTrue(ArrayHelper::keyExists('B', $array));
        $this->assertFalse(ArrayHelper::keyExists('c', $array));
        $this->assertTrue(ArrayHelper::keyExists('a', $array, false));
        $this->assertTrue(ArrayHelper::keyExists('b', $array, false));
        $this->assertTrue(ArrayHelper::keyExists('B', $array, false));
        $this->assertFalse(ArrayHelper::keyExists('c', $array, false));
    }
    public function valueProvider()
    {
        return [
            ['name', 'test'],
            ['noname', null],
            ['noname', 'test', 'test'],
            ['post.id', 5],
            ['post.id', 5, 'test'],
            ['nopost.id', null],
            ['nopost.id', 'test', 'test'],
            ['post.author.name', 'cebe'],
            ['post.author.noname', null],
            ['post.author.noname', 'test', 'test'],
            ['post.author.profile.title', '1337'],
            ['admin.firstname', 'Qiang'],
            ['admin.firstname', 'Qiang', 'test'],
            ['admin.lastname', 'Xue'],
            [
                function ($array, $defaultValue) {
                    return $array['date'] . $defaultValue;
                },
                '31-12-2113test',
                'test',
            ],
            [['version', '1.0', 'status'], 'released'],
            [['version', '1.0', 'date'], 'defaultValue', 'defaultValue'],
        ];
    }
    /**
     * @dataProvider valueProvider
     *
     * @param $key
     * @param $expected
     * @param null $default
     */
    public function testGetValue($key, $expected, $default = null)
    {
        $array = [
            'name' => 'test',
            'date' => '31-12-2113',
            'post' => [
                'id' => 5,
                'author' => [
                    'name' => 'cebe',
                    'profile' => [
                        'title' => '1337',
                    ],
                ],
            ],
            'admin.firstname' => 'Qiang',
            'admin.lastname' => 'Xue',
            'admin' => [
                'lastname' => 'cebe',
            ],
            'version' => [
                '1.0' => [
                    'status' => 'released',
                ],
            ],
        ];
        $this->assertEquals($expected, ArrayHelper::getValue($array, $key, $default));
    }
    public function testGetValueObjects()
    {
        $arrayObject = new ArrayObject(['id' => 23], ArrayObject::ARRAY_AS_PROPS);
        $this->assertEquals(23, ArrayHelper::getValue($arrayObject, 'id'));
        $object = new Post1();
        $this->assertEquals(23, ArrayHelper::getValue($object, 'id'));
    }
    /**
     * This is expected to result in a PHP error.
     * @requires PHPUnit 6.0
     */
    public function testGetValueNonexistingProperties1()
    {
        $this->expectException('PHPUnit\Framework\Error\Notice');
        $object = new Post1();
        $this->assertNull(ArrayHelper::getValue($object, 'nonExisting'));
    }
    /**
     * This is expected to result in a PHP error.
     * @requires PHPUnit 6.0
     */
    public function testGetValueNonexistingProperties2()
    {
        $this->expectException('PHPUnit\Framework\Error\Notice');
        $arrayObject = new ArrayObject(['id' => 23], ArrayObject::ARRAY_AS_PROPS);
        $this->assertEquals(23, ArrayHelper::getValue($arrayObject, 'nonExisting'));
    }
    /**
     * Data provider for [[testSetValue()]].
     * @return array test data
     */
    public function dataProviderSetValue()
    {
        return [
            [
                [
                    'key1' => 'val1',
                    'key2' => 'val2',
                ],
                'key', 'val',
                [
                    'key1' => 'val1',
                    'key2' => 'val2',
                    'key' => 'val',
                ],
            ],
            [
                [
                    'key1' => 'val1',
                    'key2' => 'val2',
                ],
                'key2', 'val',
                [
                    'key1' => 'val1',
                    'key2' => 'val',
                ],
            ],
            [
                [
                    'key1' => 'val1',
                ],
                'key.in', 'val',
                [
                    'key1' => 'val1',
                    'key' => ['in' => 'val'],
                ],
            ],
            [
                [
                    'key' => 'val1',
                ],
                'key.in', 'val',
                [
                    'key' => [
                        'val1',
                        'in' => 'val',
                    ],
                ],
            ],
            [
                [
                    'key' => 'val1',
                ],
                'key', ['in' => 'val'],
                [
                    'key' => ['in' => 'val'],
                ],
            ],
            [
                [
                    'key1' => 'val1',
                ],
                'key.in.0', 'val',
                [
                    'key1' => 'val1',
                    'key' => [
                        'in' => ['val'],
                    ],
                ],
            ],
            [
                [
                    'key1' => 'val1',
                ],
                'key.in.arr', 'val',
                [
                    'key1' => 'val1',
                    'key' => [
                        'in' => [
                            'arr' => 'val',
                        ],
                    ],
                ],
            ],
            [
                [
                    'key1' => 'val1',
                ],
                'key.in.arr', ['val'],
                [
                    'key1' => 'val1',
                    'key' => [
                        'in' => [
                            'arr' => ['val'],
                        ],
                    ],
                ],
            ],
            [
                [
                    'key' => [
                        'in' => ['val1'],
                    ],
                ],
                'key.in.arr', 'val',
                [
                    'key' => [
                        'in' => [
                            'val1',
                            'arr' => 'val',
                        ],
                    ],
                ],
            ],
            [
                [
                    'key' => ['in' => 'val1'],
                ],
                'key.in.arr', ['val'],
                [
                    'key' => [
                        'in' => [
                            'val1',
                            'arr' => ['val'],
                        ],
                    ],
                ],
            ],
            [
                [
                    'key' => [
                        'in' => [
                            'val1',
                            'key' => 'val',
                        ],
                    ],
                ],
                'key.in.0', ['arr' => 'val'],
                [
                    'key' => [
                        'in' => [
                            ['arr' => 'val'],
                            'key' => 'val',
                        ],
                    ],
                ],
            ],
            [
                [
                    'key' => [
                        'in' => [
                            'val1',
                            'key' => 'val',
                        ],
                    ],
                ],
                'key.in', ['arr' => 'val'],
                [
                    'key' => [
                        'in' => ['arr' => 'val'],
                    ],
                ],
            ],
            [
                [
                    'key' => [
                        'in' => [
                            'key' => 'val',
                            'data' => [
                                'attr1',
                                'attr2',
                                'attr3',
                            ],
                        ],
                    ],
                ],
                'key.in.schema', 'array',
                [
                    'key' => [
                        'in' => [
                            'key' => 'val',
                            'schema' => 'array',
                            'data' => [
                                'attr1',
                                'attr2',
                                'attr3',
                            ],
                        ],
                    ],
                ],
            ],
            [
                [
                    'key' => [
                        'in.array' => [
                            'key' => 'val',
                        ],
                    ],
                ],
                ['key', 'in.array', 'ok.schema'], 'array',
                [
                    'key' => [
                        'in.array' => [
                            'key' => 'val',
                            'ok.schema' => 'array',
                        ],
                    ],
                ],
            ],
            [
                [
                    'key' => ['val'],
                ],
                null, 'data',
                'data',
            ],
        ];
    }
    /**
     * @dataProvider dataProviderSetValue
     *
     * @param array $array_input
     * @param string|array|null $key
     * @param mixed $value
     * @param mixed $expected
     */
    public function testSetValue($array_input, $key, $value, $expected)
    {
        ArrayHelper::setValue($array_input, $key, $value);
        $this->assertEquals($expected, $array_input);
    }
    public function testIsAssociative()
    {
        $this->assertFalse(ArrayHelper::isAssociative('test'));
        $this->assertFalse(ArrayHelper::isAssociative([]));
        $this->assertFalse(ArrayHelper::isAssociative([1, 2, 3]));
        $this->assertFalse(ArrayHelper::isAssociative([1], false));
        $this->assertTrue(ArrayHelper::isAssociative(['name' => 1, 'value' => 'test']));
        $this->assertFalse(ArrayHelper::isAssociative(['name' => 1, 'value' => 'test', 3]));
        $this->assertTrue(ArrayHelper::isAssociative(['name' => 1, 'value' => 'test', 3], false));
    }
    public function testIsIndexed()
    {
        $this->assertFalse(ArrayHelper::isIndexed('test'));
        $this->assertTrue(ArrayHelper::isIndexed([]));
        $this->assertTrue(ArrayHelper::isIndexed([1, 2, 3]));
        $this->assertTrue(ArrayHelper::isIndexed([2 => 'a', 3 => 'b']));
        $this->assertFalse(ArrayHelper::isIndexed([2 => 'a', 3 => 'b'], true));
        $this->assertFalse(ArrayHelper::isIndexed(['a' => 'b'], false));
    }
    public function testHtmlEncode()
    {
        $array = [
            'abc' => '123',
            '<' => '>',
            'cde' => false,
            3 => 'blank',
            [
                '<>' => 'a<>b',
                '23' => true,
            ],
            'invalid' => "a\x80b",
        ];
        $this->assertEquals([
            'abc' => '123',
            '<' => '&gt;',
            'cde' => false,
            3 => 'blank',
            [
                '<>' => 'a&lt;&gt;b',
                '23' => true,
            ],
            'invalid' => 'a�b',
        ], ArrayHelper::htmlEncode($array));
        $this->assertEquals([
            'abc' => '123',
            '&lt;' => '&gt;',
            'cde' => false,
            3 => 'blank',
            [
                '&lt;&gt;' => 'a&lt;&gt;b',
                '23' => true,
            ],
            'invalid' => 'a�b',
        ], ArrayHelper::htmlEncode($array, false));
    }
    public function testHtmlDecode()
    {
        $array = [
            'abc' => '123',
            '&lt;' => '&gt;',
            'cde' => false,
            3 => 'blank',
            [
                '<>' => 'a&lt;&gt;b',
                '23' => true,
            ],
        ];
        $this->assertEquals([
            'abc' => '123',
            '&lt;' => '>',
            'cde' => false,
            3 => 'blank',
            [
                '<>' => 'a<>b',
                '23' => true,
            ],
        ], ArrayHelper::htmlDecode($array));
        $this->assertEquals([
            'abc' => '123',
            '<' => '>',
            'cde' => false,
            3 => 'blank',
            [
                '<>' => 'a<>b',
                '23' => true,
            ],
        ], ArrayHelper::htmlDecode($array, false));
    }

    /**
     * @throws BadParamException
     */
    public function testIsIn()
    {
        $this->assertTrue(ArrayHelper::isIn('a', new ArrayObject(['a', 'b'])));
        $this->assertTrue(ArrayHelper::isIn('a', ['a', 'b']));
        $this->assertTrue(ArrayHelper::isIn('1', new ArrayObject([1, 'b'])));
        $this->assertTrue(ArrayHelper::isIn('1', [1, 'b']));
        $this->assertFalse(ArrayHelper::isIn('1', new ArrayObject([1, 'b']), true));
        $this->assertFalse(ArrayHelper::isIn('1', [1, 'b'], true));
        $this->assertTrue(ArrayHelper::isIn(['a'], new ArrayObject([['a'], 'b'])));
        $this->assertFalse(ArrayHelper::isIn('a', new ArrayObject([['a'], 'b'])));
        $this->assertFalse(ArrayHelper::isIn('a', [['a'], 'b']));
    }

    /**
     * @throws BadParamException
     */
    public function testIsInStrict()
    {
        // strict comparison
        $this->assertTrue(ArrayHelper::isIn(1, new ArrayObject([1, 'a']), true));
        $this->assertTrue(ArrayHelper::isIn(1, [1, 'a'], true));
        $this->assertFalse(ArrayHelper::isIn('1', new ArrayObject([1, 'a']), true));
        $this->assertFalse(ArrayHelper::isIn('1', [1, 'a'], true));
    }

    /**
     * @throws BadParamException
     */
    public function testInException()
    {
        $this->expectException(BadParamException::class);
        $this->expectExceptionMessage('Argument $haystack must be an array or implement Traversable');
        ArrayHelper::isIn('value', null);
    }

    /**
     * @throws BadParamException
     */
    public function testIsSubset()
    {
        $this->assertTrue(ArrayHelper::isSubset(['a'], new ArrayObject(['a', 'b'])));
        $this->assertTrue(ArrayHelper::isSubset(new ArrayObject(['a']), ['a', 'b']));
        $this->assertTrue(ArrayHelper::isSubset([1], new ArrayObject(['1', 'b'])));
        $this->assertTrue(ArrayHelper::isSubset(new ArrayObject([1]), ['1', 'b']));
        $this->assertFalse(ArrayHelper::isSubset([1], new ArrayObject(['1', 'b']), true));
        $this->assertFalse(ArrayHelper::isSubset(new ArrayObject([1]), ['1', 'b'], true));
    }

    /**
     * @throws BadParamException
     */
    public function testIsSubsetException()
    {
        $this->expectException(BadParamException::class);
        $this->expectExceptionMessage('Argument $needles must be an array or implement Traversable');
        ArrayHelper::isSubset('a', new ArrayObject(['a', 'b']));
    }
    public function testIsArray()
    {
        $this->assertTrue(ArrayHelper::isTraversable(['a']));
        $this->assertTrue(ArrayHelper::isTraversable(new ArrayObject(['1'])));
        $this->assertFalse(ArrayHelper::isTraversable(new stdClass()));
        $this->assertFalse(ArrayHelper::isTraversable('A,B,C'));
        $this->assertFalse(ArrayHelper::isTraversable(12));
        $this->assertFalse(ArrayHelper::isTraversable(false));
        $this->assertFalse(ArrayHelper::isTraversable(null));
    }
    public function testFilter()
    {
        $array = [
            'A' => [
                'B' => 1,
                'C' => 2,
            ],
            'G' => 1,
        ];
        $this->assertEquals(ArrayHelper::filter($array, ['A']), [
            'A' => [
                'B' => 1,
                'C' => 2,
            ],
        ]);
        $this->assertEquals(ArrayHelper::filter($array, ['A.B']), [
            'A' => [
                'B' => 1,
            ],
        ]);
        $this->assertEquals(ArrayHelper::filter($array, ['A', '!A.B']), [
            'A' => [
                'C' => 2,
            ],
        ]);
        $this->assertEquals(ArrayHelper::filter($array, ['!A.B', 'A']), [
            'A' => [
                'C' => 2,
            ],
        ]);
        $this->assertEquals(ArrayHelper::filter($array, ['A', 'G']), [
            'A' => [
                'B' => 1,
                'C' => 2,
            ],
            'G' => 1,
        ]);
        $this->assertEquals(ArrayHelper::filter($array, ['X']), []);
        $this->assertEquals(ArrayHelper::filter($array, ['X.Y']), []);
        $this->assertEquals(ArrayHelper::filter($array, ['A.X']), []);
        $tmp = [
            'a' => 0,
            'b' => '',
            'c' => false,
            'd' => null,
            'e' => true,
        ];
        $this->assertEquals(ArrayHelper::filter($tmp, array_keys($tmp)), $tmp);
    }

}



