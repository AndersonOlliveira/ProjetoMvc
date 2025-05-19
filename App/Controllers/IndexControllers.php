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

        $this->render('listar');
    }
    public function listaResultado()
    {

        $dadosUsers =  Container::getModel('Usuarios');

        $result = $dadosUsers->allUser();
        if (!empty($result)) {
            //retorno um json para a api
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

        if ($usuario->validarCadastro() > 0) {

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

    public function buscauser()
    {
        $id = $_POST['id'];

        $conect = Container::getModel('usuarios');

        $conect->__set('inputId', $id);
        $procurarUser = $conect->getUserid($id);
        //limpaa qualquer solicitacao anterioo para nao ter problema no retorno
        ob_clean();
        if (!empty($procurarUser)) {
            header('Content-Type: application/json');
            echo json_encode([

                'Status' => 2,
                'data' => $procurarUser,
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

    public function editeUser()
    {


        $numeroTratado = $this->tratarCampo($_POST['InputTelEdit']);

        $data = empty($_POST['InputDateEdit']) ? null : $_POST['InputDateEdit'];

        $usuarioeditar = Container::getModel('usuarios');
        $usuarioeditar->__set('InputName', $_POST['InputNameEdit']);
        $usuarioeditar->__set('id', $_POST['InputdEdit']);
        $usuarioeditar->__set('InputEmail', $_POST['InputEmailEdit']);
        $usuarioeditar->__set('InputTel', $numeroTratado);
        $usuarioeditar->__set('InputDate', $data);
        $usuarioeditar->__set('date_criado', date('Y-m-d H:i:s'));



        if ($usuarioeditar->validarCadastro() > 0) {


            $this->view->erroCadastro =  $_SESSION['msg'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <strong> *Campo Precisam ser preenchido!</strong>  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

            return  $this->render('listar');
        } else {



            $update = Container::getModel('usuarios');
            $resultado = $update->getUpdate($usuarioeditar);
            $procuraEmail = $update->getEmail($usuarioeditar);

            if ($procuraEmail > 0) {
                $this->view->erroCadastro =  $_SESSION['msg'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <strong> *Email informado já utilizado !</strong>  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                return $this->render('listar');
            }

            if ($resultado > 0) {


                $this->view->erroCadastro =  $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> <strong> *Sucesso ao Atualizar !</strong>  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                return $this->render('listar');
            }
        }
    }

    public function deletarUser()
    {
        header('Content-Type: application/json');


        $id = $_POST['id'];
        $verificar = Container::getModel('usuarios');
        $verifcar =  $verificar->validaCampo($id);



        if ($verifcar) {
            header('Content-Type: application/json');
            echo json_encode([

                'Status' => 1,
                'message' => 'Precisa Selecionar Id'
            ]);
            exit;
        }


        $gerarLogs = Container::getModel('logs');
        $delUser = Container::getModel('usuarios');

        $deletar = $delUser->getDell($id);
        $gerarLogs->registarDelete($id);
        ob_clean();
        // limpa conteúdo do buffer de saída ativo.
        if ($deletar > 0) {
            header('Content-Type: application/json');
            //retorno um json para a api
            echo json_encode([
                'Status' => 2,
                'message' => 'Sucesso ao Deletar o Usuário'
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            //retorno um json para a api
            echo json_encode([

                'Status' => 1,
                'message' => 'Falha ao deletar Usuário',
                'data' => []
            ]);
            exit;
        }
    }
}
