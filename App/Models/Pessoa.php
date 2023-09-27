<?php

namespace App\Models;
use MF\Model\Model;

class Pessoa extends Model {

    public function createPessoa($nome) {
        $query = "INSERT INTO tb_pessoas(nome) VALUES(:nome)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":nome", $nome);
        return $stmt->execute();
    }

    public function getPessoas() {
        $query = "SELECT id, nome FROM tb_pessoas";
        return $this->db->query($query)->fetchAll();
    }

    public function deletePessoa($id) {
        $query = "DELETE FROM tb_pessoas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}



?>