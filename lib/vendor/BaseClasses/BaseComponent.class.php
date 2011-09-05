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
class BaseComponent {

    private $templateVars = array();
    private $componentName = null;

    public function __construct($component, $params) {
        $this->componentName = $component;
        $this->templateVars = $params;
    }

    public function execute() {
        if (!method_exists($this, $this->componentName)) {
            throw new Exception('Component Not found', '404');
        }
        call_user_func(array($this, $this->componentName));
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
