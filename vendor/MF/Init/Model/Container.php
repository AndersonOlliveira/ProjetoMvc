<?php

namespace MF\Init\Model;

use App\Connection;

class Container {

    public static function getModel($model)
    {

     

         $instancia = "\\App\Models\\".ucfirst($model);
       
    
           $connet =  Connection::getdb();
           
           return new $instancia($connet);
 

    }
}
?>