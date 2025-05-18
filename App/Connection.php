<?php 

namespace App;


use Exception;
use mysqli;

class Connection
{

    
    public static function getdb(){

        try{

              $mysql = new \mysqli("localhost",'usermanageasy', '', 'manageasy');
              $mysql->set_charset('utf8');

              if($mysql->connect_errno){
                 echo " teve erro " . $mysql->connect_error;

              }

              return $mysql;

             

        }catch (\Exception $e){

            //  print_r($e);
           return $e;
        }

    }
}
?>