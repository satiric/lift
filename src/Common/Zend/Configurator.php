<?php
/**
 * Date: 15.12.18
 * Time: 0:07
 * @author Konstantin Maruhnich <nocturneumbra@gmail.com>
 */

namespace Decadal\Lift\Common\Zend;

/**
 * Class Configurator
 * @package Decadal\Lift\Common\Zend
 */
class Configurator
{
    /**
     * @param string $moduleDir
     * @return array
     */
    public static function get(string $moduleDir) : array
    {
        $config = [];
        foreach (scandir($moduleDir . '/config/') as $fname) {
            if (preg_match('/(.*)\.config\.php$/', $fname, $m)) {
                $config = array_merge_recursive($config, include($moduleDir . '/config/' . $fname));
            }
        }
        return $config;
    }
}
