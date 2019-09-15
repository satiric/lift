<?php
/**
 * Date: 05.02.19
 * Time: 21:39
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 * Iterios core team
 */

namespace Decadal\Lift\Common\Tool;


/**
 * Class StringTool
 * @package Decadal\Lift\Common\Tool
 */
class StringTool
{
    /**
     * @param string $haystack
     * @param string $needle
     * @param bool $case
     * @return bool
     */
    public static function startsWith(string $haystack, string $needle, bool $case = true) : bool
    {
        return ($case)
            ? mb_strpos($haystack, $needle, 0) === 0
            : mb_stripos($haystack, $needle, 0) === 0;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool $case
     * @return bool
     */
    public static function endsWith(string $haystack, string $needle, bool $case = true) : bool
    {
        $expectedPosition = mb_strlen($haystack) - mb_strlen($needle);
        return ($case)
            ? mb_strrpos($haystack, $needle, 0) === $expectedPosition
            : mb_strripos($haystack, $needle, 0) === $expectedPosition;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function contains(string $haystack, string $needle) : bool
    {
        return mb_strpos($haystack, $needle) !== false;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function capitalizeFirstLetter(string $string) : string
    {
        return mb_convert_case($string, MB_CASE_TITLE);
    }

    /**
     * @param string $string
     * @param string $prefix
     * @return string
     */
    public static function removePrefix(string $string, string $prefix) : string
    {
        return mb_substr($string, mb_strlen($prefix));
    }

    /**
     * @param string $string
     * @param string $suffix
     * @return string
     */
    public static function removeSuffix(string $string, string $suffix) : string
    {
        return mb_substr($string, 0,  -1 * mb_strlen($suffix));
    }

    /**
     * @param string $input
     * @return string
     */
    public static function camelCaseToSnakeCase(string $input) : string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * @param string $input
     * @param bool $firstCharSmall if true then snake_case => snakeCase ; if false then snake_case => SnakeCase
     * @return string
     */
    public static function snakeCaseToCamelCase(string $input, bool $firstCharSmall = false) : string
    {
        $result = str_replace('_', '', ucwords($input, '_'));
        return ($firstCharSmall)
            ? lcfirst($result)
            : $result;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function snakeCaseToHuman(string $string) : string
    {
        return ucfirst(implode(' ', explode('_', $string)));
    }
    /**
     * @param array $input
     * @param $prefix
     * @return array
     */
    public static function getArrayWithRemovedPrefixRecursive(array $input, string $prefix) : array
    {
        mb_internal_encoding('UTF-8');
        $return = [];
        foreach ($input as $key => $value) {
            if (strpos($key, $prefix) === 0) {
                $key = substr($key, mb_strlen($prefix));
            }
            if (is_array($value)) {
                $value = self::getArrayWithRemovedPrefixRecursive($value, $prefix);
            }
            $return[$key] = $value;
        }
        return $return;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function toLower(string $string) : string
    {
        mb_internal_encoding('UTF-8');
        return mb_strtolower($string);
    }

    /**
     * @param $string
     * @return mixed|null|string|string[]
     */
    public static function toUpper(string $string) : string
    {
        mb_internal_encoding('UTF-8');
        return mb_strtoupper($string);
    }

    /**
     * https://www.php.net/manual/ru/function.str-split.php#107658
     * safe for utf-8
     * @param string $str
     * @param int $l
     * @return string[]
     * @throws \Exception
     */
    public static function splitStr(string $str, int $l) : array
    {
        if ($l > 0) {
            $ret = [];
            $len = mb_strlen($str, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
            }
            return $ret;
        }
        $result = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
        if(!is_array($result)) {
            throw new \Exception("Unsuccessful splitting of the string");
        }
        return $result;
    }
}