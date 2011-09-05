<?php

function include_partial($template, $params = array()) {
    $template = explode('/', $template);
    echo BaseContext::getInstance()->getPartial($template[0], $template[1], $params);
}

function include_component($module, $component, $params = array()) {
    echo BaseContext::getInstance()->loadComponent($module, $component, $params);
}

function url_for($route, $params = array()) {
    echo BaseRouting::generateUrl($route, $params);
}

function include_javascript($name) {
    $base_path = str_replace(BaseRouting::getScriptName(), '', $_SERVER['SCRIPT_NAME']);
    echo '<script src="' . $base_path . 'js/' . $name . '" type="text/javascript"></script>';
}

function include_stylesheet($name) {
    $base_path = str_replace(BaseRouting::getScriptName(), '', $_SERVER['SCRIPT_NAME']);
    echo '<link rel="stylesheet"  href="' . $base_path . 'css/' . $name . '" type="text/css" />';
}

function set_slot($name, $content) {
    BaseContext::getInstance()->setSlot($name, $content);
}

function get_slot($name) {
    return BaseContext::getInstance()->getSlot($name);
}

function start_slot($name) {
    BaseContext::getInstance()->startSlot($name);
}

function end_slot() {
    BaseContext::getInstance()->endSlot();
}

function has_slot($name) {
    return BaseContext::getInstance()->hasSlot($name);
}
