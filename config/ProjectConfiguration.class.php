<?php

// external apis -> outlet + sfYml includes
//require_once dirname(__FILE__) . '/../lib/vendor/extlibs/outlet/Outlet.php';
//require_once dirname(__FILE__) . '/../lib/vendor/extlibs/yaml/lib/sfYaml.php';
// end

// Base Freamework include
require_once dirname(__FILE__) . '/../lib/vendor/BaseClasses/BaseAutoload.class.php';
// end
BaseAutoload::register();

class ProjectConfiguration extends BaseConfiguration {

    public function setup() {
        //your db initailization
        /* 
         * your db models must be in %root%/lib/model
         * 
         * Outlet::init(sfYaml::load(dirname(__FILE__).'/outlet/db.yml')); 
         * $outlet = Outlet::getInstance();
         * $outlet->createProxies();
         * 
         */
    }

}