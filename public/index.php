<?php 
//chamo o autoload para arquitura funcionar.
require_once "../vendor/autoload.php";

date_default_timezone_set('America/Sao_Paulo');

$route = new \App\Route;
//  chama funcao das rotas pegando o que foi passado 
 $route->getRoutes();

?>