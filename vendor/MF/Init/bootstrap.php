<?php


namespace MF\Init;
//para herda os dados
abstract class  bootstrap
{
 private $routes;

 abstract protected function initRoutes();

  public function __construct()
  {
    $this->initRoutes();
      //chamo o metodo para ver a url
     $this->run($this->getUrl());
  }

  public function getRoutes()
  {
    return $this->routes;
  }
  public function setRoutes(array $routes)
  {
    $this->routes = $routes;
  }

    protected function run($url)
  {
    // echo $url . 'que vem do meu metodo run'; 

    foreach($this->getRoutes() as $key => $rotas)
    {
     
      if($url == $rotas['route'])
      {
        //controllers dinamicamente
        $class = "App\\Controllers\\". ucfirst($rotas['Controller']);

        $controller = new $class;
        $action  = $rotas['action'];

        $controller->$action();


      }
    }
  }
  protected function getUrl()
  {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }


     
}

