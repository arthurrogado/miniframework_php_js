<?php

namespace App\Controllers;

// use MF\Controller\Action;
use MF\Model\Container; // dependency container: allows to instantiate models:
// this is a way to instantiate models without using the new keyword

// Models
// use App\Models\Pessoa;

class PessoasController {

    public function createPessoa() 
    {
        $nome = $_POST['nome'];
        $usuario = filter_input(INPUT_POST, 'usuario');
        $senha = filter_input(INPUT_POST, 'senha');
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $pessoa = Container::getModel("Pessoa");
        $status = $pessoa->createPessoa($nome, $usuario, $senha);
        if($status['ok']) {
            echo json_encode(array('ok' => true, 'message' => "Pessoa criada com sucesso"));
        } else {
            echo json_encode(array('ok' => false, 'message' => "Erro: " . $status['message'] ));
        }
    }

    public function getPessoas() 
    {
        $pessoa = Container::getModel("Pessoa");
        $status = $pessoa->getPessoas();
        if($status['ok']) {
            echo json_encode(array('ok' => true, 'pessoas' => $status['data']));
        } else {
            echo json_encode(array('ok' => false, 'message' => "Erro: " . $status['message'] ));
        }
    }

    public function getPessoa()
    {
        $id = filter_input(INPUT_POST, 'id');
        $pessoa = Container::getModel("Pessoa");
        $status = $pessoa->getPessoa($id);
        if($status['ok']) {
            echo json_encode(array('ok' => true, 'pessoa' => $status['data']));
        } else {
            echo json_encode(array('ok' => false, 'message' => "Erro: " . $status['message'] ));
        }
    }

    public function deletarPessoa() 
    {
        $id = filter_input(INPUT_POST, 'id');
        $pessoa = Container::getModel("Pessoa");
        $status = $pessoa->deletePessoa($id);
        if($status['ok']) {
            echo json_encode(array('ok' => true, 'message' => "Pessoa deletada com sucesso"));
        } else {
            echo json_encode(array('ok' => false, 'message' => "Erro: " . $status['message'] ));
        }
    }

    public function updatePessoa() 
    {
        $id = filter_input(INPUT_POST, 'id');
        $nome = filter_input(INPUT_POST, 'nome');
        $usuario = filter_input(INPUT_POST, 'usuario');
        $senha = filter_input(INPUT_POST, 'senha');
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $pessoa = Container::getModel("Pessoa");
        if($pessoa->update($id, $nome, $usuario, $senha)) {
            echo json_encode(array('ok' => true));
        } else {
            echo json_encode(array('ok' => false));
        }
    
    }

}

?>