<?php

namespace MF\Init\Controller;

abstract class Action

{
     
     protected $view;

     public function __construct()
     {
        $this->view = new \stdClass();
     }

 protected function render($view)
    { 
         $this->view->page = $view;
         require_once "../App/Views/layout/index.phtml";
         
    }

    protected function content()
    {
        
        //pego o nome da rota dinamicamente.
        $classAtuaal = str_replace('App\\Controllers\\', '', get_class($this));
            
        //quebro a controller para pegar de forma dinamica caso tenha mais de uma controller,tanto controller e paginas
        $classAtuaal =  strtolower(str_replace('Controllers', '', $classAtuaal));

       
        require_once "../App/Views/" . $classAtuaal . "/" . $this->view->page . ".phtml";
    }
}
?>