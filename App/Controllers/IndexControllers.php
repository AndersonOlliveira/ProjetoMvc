<?php

namespace App\Controllers;

use MF\Init\Controller\Action;
use MF\Init\Model\Container;

class IndexControllers extends Action
{

    public function index()
    {

        $this->view->usuario = array(
            'InputName' => '',
            'InputEmail' => '',
            'InputTel' => '',
            'InputDate' => '',
        );

        $this->view->erroCadastro = false;
        $this->render('index');
    }

    public function listar()
    {

        $dadosUsers =  Container::getModel('Usuarios');

        $result = $dadosUsers->allUser();

        $this->view->dados = $result;

        //   header('Content-Type: application/json');

        //    $this->view->dados = json_encode($result);

        $this->render('listar');
    }
    public function listaResultado()
    {

        $dadosUsers =  Container::getModel('Usuarios');

        $result = $dadosUsers->allUser();
        if (!empty($result)) {
            header('Content-Type: application/json');
            echo json_encode([
                'Status' => 2,
                'data' => $result,
                'message' => 'Sucesso ao Consultar'
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'Status' => 1,
                'message' => 'Sem dados para ser Apresentado',
                'data' => []
            ]);
            exit;
        }
    }
    //receber os dados do formulario

    public function registrar()
    {

        $numeroTratado = $this->tratarCampo($_POST['InputTel']);

        $data = empty($_POST['InputDate']) ? null : $_POST['InputDate'];

        $usuario = Container::getModel('usuarios');
        $usuario->__set('InputName', $_POST['InputName']);
        $usuario->__set('InputEmail', $_POST['InputEmail']);
        $usuario->__set('InputTel', $numeroTratado);
        $usuario->__set('InputDate', $data);
        $usuario->__set('date_criado', date('Y-m-d H:i:s')); // Para a data de criação

        if ($usuario->getUser() > 0) {

            $this->view->usuario = array(
                'InputName' => $_POST['InputName'],
                'InputEmail' => $_POST['InputEmail'],
                'InputTel' => $_POST['InputTel'],
                'InputDate' => $_POST['InputDate'],
            );

            $this->view->erroCadastro =  $_SESSION['msg'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <strong> *Erro ao tentar realizar o cadastro!</strong>  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

            return  $this->render('index');
        }

        if ($usuario->validarCadastro()) {

            $this->view->erroCadastro =  $_SESSION['msg'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <strong> *Campo Precisam ser preenchido!</strong>  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

            return  $this->render('index');
        } else {

            $usuario->salvar();

            return $this->render('listar');
        }
    }


    public function tratarCampo($tel)
    {

        $result = preg_replace('/\D/', '', $tel);

        return $result;
    }
}
