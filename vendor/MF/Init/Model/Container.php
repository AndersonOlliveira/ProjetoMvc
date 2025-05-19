<?php

namespace MF\Init\Model;

use App\Connection;

class Container {

    public static function getModel($model)
    {

          
     

         $instancia = "\\App\Models\\".ucfirst($model);
       
    
           $connet = Connection::getdb();
          //chamo a conexáo para e chamo a model para redenrizar dados
           
           return new $instancia($connet);
 

    }
}
?>