<?php

namespace App\Models;
use MF\Model\Model;

class Usuario extends Model
{
    
    public function criarUsuario($nome, $usuario, $senha)
    {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        return $this->insert(
            "usuarios",
            [
                "nome", "usuario", "senha"
            ],
            [
                $nome, $usuario, $senha
            ]
        );
    }

    public function getUsuarios()
    {
        return $this->select(
            "usuarios",
            ["id", "nome", "usuario"]
        );
    }

    public function visualizarUsuario($id)
    {
        return $this->selectOne(
            "usuarios",
            ["*"],
            "id = $id"
        );
    }
        
    public function editarUsuario($id, $nome, $usuario)
    {
        return $this->update(
            "usuarios",
            ["nome", "usuario"],
            [$nome, $usuario],
            "id = $id"
        );
    }

    public function mudarSenhaUsuario($id, $senha)
    {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        return $this->update(
            "usuarios",
            ["senha"],
            [$senha],
            "id = $id"
        );
    }

    public function excluirUsuario($id)
    {
        return $this->delete(
            "usuarios",
            "id = $id"
        );
    }

    public static function checkLogin() {
        // session_start();

        if(isset($_SESSION['usuario'])) {
            // return self::getUsuario($_SESSION['usuario']->id);
            return $_SESSION['usuario'];
        } else {
            return false;
        }
    }

    public static function login($usuario, $senha) {
        self::getConn();
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = self::$conn->prepare($query);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->execute();
        $usuario = $stmt->fetch(\PDO::FETCH_OBJ);
        if($usuario) {
            if(password_verify($senha, $usuario->senha)) {
                // session_start();
                $_SESSION['usuario'] = $usuario;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function logout() {
        // session_start();
        return session_destroy();
    }

}

?>