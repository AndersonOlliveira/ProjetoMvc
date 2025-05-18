<?php

namespace App;
use MF\Init\bootstrap;

class Route extends bootstrap
{
   protected function initRoutes()
  {
    $routes['home'] = array(
      'route' => '/',
      'Controller' => 'IndexControllers',
      'action' => 'index'
    );

    $routes['listar'] = array(
      'route' => '/listar',
      'Controller' => 'IndexControllers',
      'action' => 'listar'

    ); 
    
    $routes['registrar'] = array(
      'route' => '/registrar',
      'Controller' => 'IndexControllers',
      'action' => 'registrar'

    );
     $routes['listarDados'] = array(
      'route' => '/listarDados',
      'Controller' => 'IndexControllers',
      'action' => 'listaResultado'

    );
     
      $this->setRoutes($routes);
  }


}
