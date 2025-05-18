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



        $valido = empty($this->__get('InputName'))
            || empty($this->__get('InputEmail'))
            || empty($this->__get('InputTel'));



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
        $query = "SELECT id, nome, email , telefone , data_nascimento, date_criado FROM usuarios ORDER BY date_criado DESC";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
        $retornoQuery = $stmt->get_result();



        while ($result = $retornoQuery->fetch_all()) {


            return $result;
        }
    }

    public function getUserid()
    {

        $id = $this->__get('inputId');
        $query = "SELECT id, nome, email,telefone, data_nascimento, date_criado FROM usuarios WHERE id = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $retornoQuery = $stmt->get_result();

        while ($result = $retornoQuery->fetch_all()) {

            return $result;
        }
    }

    public function getUpdate($dados)
    {

        $nome = $dados->InputName;
        $email = $dados->InputEmail;
        $telefone = $dados->InputTel;
        $date = $dados->InputDate;
        $id = $dados->id;
        $date_editado = date('Y-m-d H:i:s');

        $query = "UPDATE usuarios SET 
            nome = ?, 
            email = ?, 
            telefone = ?, 
            data_nascimento = ?, 
            data_edit = ?  
          WHERE id = ?";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('sssssi', $nome, $email, $telefone, $date, $date_editado, $id); // 'i' para ID (número inteiro)
        $stmt->execute();


        return $retornoQuery = $stmt->affected_rows;
    }

    public function getEmail($dados) {
        
        $email = $dados->InputEmail;
        $query = "SELECT nome, email FROM usuarios WHERE email = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $retornoQuery = $stmt->get_result();

        

        return $retornoQuery->num_rows;
    }

    public function getDell ($dados)
    {        
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $dados);
        $stmt->execute();

        $retornoQuery = $stmt->affected_rows;
        return $retornoQuery;

    }

    public function validaCampo($id)
    {
         $valido = empty($id);


        return $valido;
    }
}
