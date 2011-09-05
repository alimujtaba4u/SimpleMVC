<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autoload
 *
 * @author Ali Mujtaba
 */
class BaseAutoload {

    private static $registered = false, $instance = null;
    private $baseDir = null;

    /**
     * Retrieves the singleton instance of BaseAutoload class.
     *
     * @return BaseAutoload An BaseAutoload implementation instance.
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new BaseAutoload();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->baseDir = realpath(dirname(__FILE__));
    }

    public static function register() {
        if (!self::$registered) {
            spl_autoload_register(array(self::getInstance(), 'autoload'));
        }
        self::$registered = true;
    }

    public static function unRegister() {
        if (self::$registered) {
            spl_autoload_unregister(array(self::getInstance(), 'autoload'));
        }
        self::$registered = false;
    }

    private function autoload($class) {
        if (isset($this->classes[$class])) {
            include $this->baseDir . DIRECTORY_SEPARATOR . $this->classes[$class];
        } else {
            foreach ($this->posiblePaths as $path) {
                if (file_exists($path . DIRECTORY_SEPARATOR . $class . '.class.php')) {
                    include $path . DIRECTORY_SEPARATOR . $class . '.class.php';
                } else if (file_exists($path . DIRECTORY_SEPARATOR . $class . '.php')) {
                    include $path . DIRECTORY_SEPARATOR . $class . '.php';
                }
            }
        }
    }

    private $classes = array(
        'BaseAction' => 'BaseAction.class.php',
        'BaseContext' => 'BaseContext.class.php',
        'BaseConfiguration' => 'BaseConfiguration.class.php',
        'Config' => 'Config.class.php',
        'BaseApplicationConfiguration' => 'BaseApplicationConfiguration.class.php',
        'BaseRouting' => 'BaseRouting.class.php',
        'BaseComponent' => 'BaseComponent.class.php'
    );

    public function addPosiblePath(Array $path) {
        $this->posiblePaths = array_merge($this->posiblePaths, $path);
    }

    public function getPosiblePath() {
        return $this->posiblePaths;
    }

    private $posiblePaths = array();

}
