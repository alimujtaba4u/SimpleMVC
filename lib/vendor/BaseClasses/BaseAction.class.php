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
class BaseAction {

    private static $instance = null;
    private $templateVars = array();

    public function execute() {
        $this->preExecute();
        $action_method = 'execute' . ucfirst(BaseContext::getInstance()->getActionName());
        if (!method_exists($this, $action_method)) {
            throw new Exception('Action Not found', '404');
        }
        call_user_func(array($this, $action_method));
    }

    public function preExecute() {
        // override if you do something before every action
    }

    public function __set($name, $value) {
        $this->templateVars[$name] = $value;
    }

    public function __get($name) {
        return @$this->templateVars[$name];
    }

    public function getTemplateVars() {
        return $this->templateVars;
    }

}