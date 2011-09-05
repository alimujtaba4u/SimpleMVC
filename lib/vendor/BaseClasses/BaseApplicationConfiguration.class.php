<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseAppConfig
 *
 * @author Ali Mujtaba
 */
class BaseApplicationConfiguration {

    private $appname = null;

    public function __construct($appname) {
        $this->appname = $appname;
        $this->setDirs();
        $this->setup();
    }

    public function setDirs() {
        $root_dir = $this->getRootDir();
        $path = array(
            'app_root_dir' => $root_dir,
            'app_lib_dir' => $root_dir . DIRECTORY_SEPARATOR . 'lib',
            'app_module_dir' => $root_dir . DIRECTORY_SEPARATOR . 'modules',
            'app_template_dir' => $root_dir . DIRECTORY_SEPARATOR . 'templates',
        );
        Config::addConfig($path);
        BaseAutoload::getInstance()->addPosiblePath($path);
    }

    public function getRootDir() {
        $r = new ReflectionClass(get_class($this));
        return realpath(dirname($r->getFilename()) . '/..');
    }

    public function getAppName() {
        return $this->appname;
    }

    public function setup() {
        // overide it for your app initialization
    }

}
