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
class BaseRouting {

    private static $scriptName = null;
    private static $includeScriptName = false;

    public static function identifyRoute() {
        $script_name = $_SERVER['SCRIPT_NAME'];
        preg_match('/([a-zA-Z0-9.]+)$/', $script_name, $matches);
        $script = $matches[0];
        self::$scriptName = $script;
        $dir_path = str_replace($script, '', $script_name);
        $url = $_SERVER['REQUEST_URI'];
        $url = preg_replace('/' . addcslashes($dir_path, '/') . '/', '', $url, 1);
        $url = preg_replace('/' . addcslashes($script, '/') . '?/', '', $url, 1, self::$includeScriptName);
        $part = explode('?', $url);
        $root = explode('/', str_replace('.html','', $part[0]));
        
        if(count($root) != 2 || empty ($root[0]) ){
            return array('home','index');
        }
        if(empty($root[1])){
            $root[1] = 'index';
        }
        return $root;     
    }
    
    public static function getScriptName(){
        return self::$scriptName;
    }

    public static function generateUrl($route,$params = array()){
        $part = explode('?', $route);
        $route = str_replace('.html','', $part[0]);
        
        if(isset($part[1])){
            parse_str($part[1],$qs);
            $params = array_merge($params,$qs);
        }
        if(count($params) != 0){
            $params = '?'.http_build_query($params);
        }else{
            $params = '';
        }
        
        $script = $_SERVER['SCRIPT_NAME'];
        if(!self::$includeScriptName){
            $script = str_replace('/'.self::$scriptName,'',$_SERVER['SCRIPT_NAME']);
        }
        return $script.'/'.$route.'.html'.$params;
    }

}

?>
