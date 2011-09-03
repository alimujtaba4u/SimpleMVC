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
class BaseConfiguration {

    private static $instance = null;
    private $app_instance = null;

    public static function getInstance() {
        if (!self::$instance) {
            //$class = get_called_class();
            $class = 'ProjectConfiguration';
            self::$instance = new $class();
        }
        return self::$instance;
    }

    public function __construct() {
        $this->setDirs();
        $this->setup();
    }

    public function setDirs() {
        $root_dir = $this->getRootDir();
        $path = array(
            'root_dir' => $root_dir,
            'lib_dir' => $root_dir . DIRECTORY_SEPARATOR . 'lib',
            'base_lib_dir' => realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'lib' ,
            'apps_dir' => $root_dir . DIRECTORY_SEPARATOR . 'apps',
            'model_dir' => $root_dir . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'model'
        );
        Config::addConfig($path);
        BaseAutoload::getInstance()->addPosiblePath($path);
    }

    public function getRootDir() {
        $r = new ReflectionClass(get_class($this));
        return realpath(dirname($r->getFilename()) . '/..');
    }

    public function setup() {
        // overide it for your externel lib initialization e.g db conn etc
    }

    public static function setupApplicationConfiguration($appname) {
        $me = self::getInstance();
        if (!$me->app_instance) {
            $app_config_dir = Config::get('apps_dir') . DIRECTORY_SEPARATOR . $appname . DIRECTORY_SEPARATOR . 'config';
            BaseAutoload::getInstance()->addPosiblePath(array($app_config_dir));
            $class = $appname . 'Configuration';
            return $me->app_instance = new $class($appname);
        } else {
            throw new Exception('Application already configured!', '404');
        }
    }

    public function getApplication() {
        return $this->app_instance;
    }

}

?>
