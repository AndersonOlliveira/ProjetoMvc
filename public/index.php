<?php 

// ini_set('error_reporting', 'E_SCRIPT');

//chamo o autoload para arquetura funcionar.
require_once "../vendor/autoload.php";

$route = new \App\Route;
 
 $route->getRoutes();

?>