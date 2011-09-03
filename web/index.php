<?php

require_once '../config/ProjectConfiguration.class.php';

ProjectConfiguration::setupApplicationConfiguration('frontend');
// lets the fun Begin ! :)
BaseContext::getInstance()->dispatch();

?>
