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
class BaseContext {

    private static  $instance = null;

    private $module = null;
    private $action = null;
    private $layout = 'layout';
    
    /**
     * Retrieves the singleton instance of BaseContext class.
     *
     * @return BaseContext An BaseContext implementation instance.
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new BaseContext();
        }
        return self::$instance;
    }
    
    public function dispatch() {
        $route = BaseRouting::identifyRoute();
        $this->module = $route[0];
        $this->action = $route[1];
        $module_root_dir = Config::get('app_module_dir').DIRECTORY_SEPARATOR.$this->module;
        $path = array(
            'module_action_dir' => $module_root_dir.DIRECTORY_SEPARATOR.'actions',
            'module_lib_dir' => $module_root_dir.DIRECTORY_SEPARATOR.'lib',
            'module_template_dir' => $module_root_dir.DIRECTORY_SEPARATOR.'templates',
        );
        Config::addConfig($path);
        BaseAutoload::getInstance()->addPosiblePath($path);
        
        // now dirty game begins..........hehe
        ob_start();
        $templateVars = $this->executeController();
        
        $this->loadHelper('Base');
        
        $this->executeTemplate($templateVars);
        $content = ob_get_clean();
        
        $this->executeLayout($content);
        //end
    }
    
    private function executeController(){
        $dir = Config::get('module_action_dir');
        include $dir.DIRECTORY_SEPARATOR.  'actions.class.php';
        $class = ucfirst($this->module).'Actions';
        $action = new $class();
        $action->execute();
        return $action->getTemplateVars();
    }


    private function executeTemplate($vars = array()){
        $dir = Config::get('module_template_dir');
        extract($vars);
        include $dir.DIRECTORY_SEPARATOR.  strtolower($this->action).'Success.php';
    }
    
    private function executeLayout($content){
        $dir = Config::get('app_template_dir');
        include $dir.DIRECTORY_SEPARATOR. $this->layout.'.php';
    }
    
    public function getModuleName(){
        return $this->module;
    }
    
    public function getActionName(){
        return $this->action;
    }
    
    public function getLayout(){
        return $this->layout;
    }
    
    public function setLayout($layout){
        $this->layout = $layout;
    }
    
    public function loadPartial($place, $partial, $params = array()){
        if($place == 'global'){
            $path = Config::get('app_template_dir');
        }else{
            $path = Config::get('app_module_dir').DIRECTORY_SEPARATOR.$place.DIRECTORY_SEPARATOR.'templates';
        }
        extract($params);
        include $path.DIRECTORY_SEPARATOR.'_'.$partial.'.php';
    }
    
    public function loadComponent($module, $component, $params = array()) {
        $dir = Config::get('app_module_dir').DIRECTORY_SEPARATOR.$module;
        include_once $dir . DIRECTORY_SEPARATOR.'actions' . DIRECTORY_SEPARATOR . 'components.class.php';
        $class = ucfirst($module).'Components';
        $action = new $class($component, $params);
        $action->execute();
        $params = $action->getTemplateVars();
        $this->loadPartial($module, $component, $params);
    }
    
    private function loadHelper($helper){
        $found = false;
        foreach (BaseAutoload::getInstance()->getPosiblePath() as $path) {
            if(stristr($path, DIRECTORY_SEPARATOR.'lib')){
                if (file_exists($path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . $helper . 'Helper.php')) {
                    include $path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . $helper . 'Helper.php';
                    $found = true;
                }
            }
        }
        if(!$found){
            throw new Exception('Helper not fount');
        }
    }
    
    public function loadHelpers($helpers = array()){
        if(is_string($helpers)){
            $temp = $helpers;
            $helpers = array();
            $helpers[] = $temp;
        }
        foreach ($helpers as $helper) {
            $this->loadHelper($helper);
        }
    }
}

?>
