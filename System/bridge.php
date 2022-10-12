<?php
session_start(); ob_start();

#root view
define('__VIEW__', __DIR__ . '/../App/Views/');

#helper
include 'helper.php';

#load config database
$configArray = ['database'];
foreach($configArray as $config){
    include __DIR__ . '/../config/' . $config . '.php';
}


#load routes
$routeArray = ['web', 'api'];
foreach($routeArray as $route){
    include __DIR__ . '/../routes/' . $route . '.php';
}