<?php


namespace App\Models;

use MF\Init\Model\Model;



class Usuarios extends Model
{
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $data_nascimento;
    private $date_criado;

    //
    public function __get($atributos)
    {
        //  print_r($atributos);
        return $this->$atributos;
    }
    public function __set($atributos, $value)
    {

        return $this->$atributos = $value;
    }
    //salvar
    public function salvar()
    {

        $query = "INSERT INTO usuarios (nome, email, telefone, data_nascimento, date_criado) 
     VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->mysqli->prepare($query);

        $nome = $this->__get('InputName');
        $email = $this->__get('InputEmail');
        $telefone = $this->__get('InputTel');
        $data_nascimento = $this->__get('InputDate');
        $date_criado = date('Y-m-d H:i:s');

        $stmt->bind_param('sssss', $nome, $email, $telefone, $data_nascimento, $date_criado);


        $stmt->execute();

        return $this;
    }

    public function validarCadastro()
    {

         
          $valido = true;
        if (null !== $this->__get('InputName')) {
            $valido  = false;
        }
          if (null !== $this->__get('InputEmail')) {
            $valido  = false;
        }
          if (null !==  $this->__get('InputTel')) {
            $valido  = false;
        }
          print_r($valido);
          
        return $valido;
    }

    public function getUser()
    {

        $email = $this->__get('InputEmail');
        $query = "SELECT nome, email FROM usuarios WHERE email = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $retornoQuery = $stmt->get_result();
     
         return $retornoQuery->num_rows;

    }

    function allUser()
    {
        $query = "SELECT nome, email FROM usuarios";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
        $retornoQuery = $stmt->get_result();



      while($result = $retornoQuery->fetch_all())
		{	
		      
            
            return $result;
        }

    }
}
