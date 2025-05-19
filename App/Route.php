<?php

namespace App;
use MF\Init\bootstrap;

class Route extends bootstrap
{
   protected function initRoutes()
  {
    //classe com a definação das rotas para redenreizar a e trazer dados
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
     $routes['listaUser'] = array(
      'route' => '/buscaUser',
      'Controller' => 'IndexControllers',
      'action' => 'buscauser'

    );
      $routes['editarUser'] = array(
      'route' => '/PushUser',
      'Controller' => 'IndexControllers',
      'action' => 'editeUser'

    );
    $routes['deletarUser'] = array(
      'route' => '/deletarUser',
      'Controller' => 'IndexControllers',
      'action' => 'deletarUser'

    );
     
       $this->setRoutes($routes);
  }


}
