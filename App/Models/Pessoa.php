<?php

namespace App\Models;
use MF\Model\Model;

class Pessoa extends Model {

    public function createPessoa($nome, $usuario, $senha) 
    {
        return $this->insert(
            "tb_pessoas",
            ["nome", "usuario", "senha"],
            [$nome, $usuario, $senha]
        );
    }

    public function getPessoas() 
    {
        return $this->select(
            'tb_pessoas',
            ['*']
        );
    }

    public function getPessoa($id)
    {
        return $this->selectOne(
            'tb_pessoas',
            ['*'],
            "id = $id"
        );
    }

    public function deletePessoa($id) 
    {
        return $this->delete(
            "tb_pessoas",
            "id = $id"
        );
    }

    public function updatePessoa($id, $nome, $usuario, $senha) 
    {
        return $this->update(
            "tb_pessoas",
            ["nome", "usuario", "senha"],
            [$nome, $usuario, $senha],
            "id = $id"
        );
    }

}



?>