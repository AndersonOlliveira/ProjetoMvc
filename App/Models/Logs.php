<?php



namespace App\Models;

use MF\Init\Model\Model;



class Logs extends Model
{
    private $id;
    private $data;


      public function __get($atributos)
    {
    
        return $this->$atributos;
    }
    public function __set($atributos, $value)
    {

        return $this->$atributos = $value;
    }

    public function registarDelete($dados)
      {
    

        $acao = 'USUARIO FOI DELETADO DO SISTEMA' . $dados;
          $query = "INSERT INTO logs (data_registro, acao) 
               VALUES (?, ?)";

        $stmt = $this->mysqli->prepare($query);

       
        $date_delete = date('Y-m-d H:i:s');

        $stmt->bind_param('ss', $date_delete,$acao);
         $stmt->execute();
         
         $retornoQuery = $stmt->get_result();

        return $retornoQuery->num_rows;
        
    }
}

?>