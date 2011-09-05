<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author Ali Mujtaba
 */
class Config {

    private static $configHandler = array();

    public static function get($key) {
        if (isset(self::$configHandler[$key])) {
            return self::$configHandler[$key];
        }
        return null;
    }

    public static function set($key, $value) {
        self::$configHandler[$key] = $value;
    }

    public static function addConfig(Array $config) {
        self::$configHandler = array_merge(self::$configHandler, $config);
    }

}
