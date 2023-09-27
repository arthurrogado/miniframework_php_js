<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

use App\Models\Pessoa;

class PessoasController extends Action {

    public function PessoasListar() {
        $this->render("listar");
    }

    public function criarPessoa() {
        $this->render("criar");
    }

    public function createPessoa() {
        $nome = $_POST['nome'];
        $pessoa = Container::getModel("Pessoa");
        if($pessoa->createPessoa($nome)) {
            echo json_encode(array('ok' => true));
        } else {
            echo json_encode(array('ok' => false));
        }
    }

    public function getPessoas() {
        $pessoa = Container::getModel("Pessoa");
        $pessoas = $pessoa->getPessoas();
        echo json_encode(array('pessoas' => $pessoas));
    }

    public function deletePessoa() {
        $id = filter_input(INPUT_POST, 'id');
        $pessoa = Container::getModel("Pessoa");
        if($pessoa->deletePessoa($id)) {
            echo json_encode(array('ok' => true));
        } else {
            echo json_encode(array('ok' => false));
        }
    }

    // para diferenciar os métodos de renderização de páginas e os métodos que executam ações,
    // os métodos que executam ações devem ser iniciados com um underline
    // ou 

}

?>