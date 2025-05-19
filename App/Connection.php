<?php

namespace App;

use mysqli;

class Connection
{


    public static function getdb()
    {
          try {
            //Gerenciar a exibição de informações
             mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysql = new \mysqli("localhost", 'usermanageasy', '', 'manageasy');
            $mysql->set_charset('utf8');
         
               return $mysql;
       
         } catch (\mysqli_sql_exception  $e) {
            
             die('Falha de conexão: Entre em contato com o Administrador do Sistema');
        }
    }
}
