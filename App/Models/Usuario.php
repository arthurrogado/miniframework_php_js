<?php

namespace App\Models;
use MF\Model\Model;

class Usuario extends Model
{
    
    public static function criarUsuario($nome, $usuario, $senha_hash)
    {
        self::getConn(); // Usar esse método estático para que a conexão seja feita, já que o método é estático (não depende de instância da classe)
        return self::insert(
            "usuarios",
            [
                "nome" => $nome, 
                "usuario" => $usuario, 
                "senha" => $senha_hash
            ]
        );
    }

    public static function getUsuarios()
    {
        return self::select(
            "usuarios",
            ["id", "nome", "usuario"]
        );
    }

    public static function getUsuariosFromEscritorio($id_escritorio)
    {
        return self::select(
            "usuarios",
            ["id", "nome", "usuario"],
            // "id_escritorio = '$id_escritorio'"
            ["id_escritorio" => $id_escritorio]
        );
    }

    public static function visualizarUsuario($id)
    {
        return self::selectOne(
            "usuarios",
            ["*"],
            // "id = $id"
            ["id" => $id]
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

    public function editarUsuarioCnpj($id, $nome, $usuario, $cnpj_escritorio)
    {
        $sql = "UPDATE usuarios SET nome = :nome, usuario = :usuario, id_escritorio = (SELECT id FROM escritorios WHERE cnpj = :cnpj_escritorio) WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->bindValue(":cnpj_escritorio", $cnpj_escritorio);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public static function mudarSenhaUsuario($id, $senha)
    {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        return self::update(
            "usuarios",
            ["senha"],
            [$senha],
            "id = $id"
        );
    }

    public static function excluirUsuario($id)
    {
        return self::delete(
            "usuarios",
            ["id" => $id]
        );
    }

    public static function usuarioExiste($usuario)
    {
        $status = self::selectOne(
            "usuarios",
            ["*"],
            // "usuario = '$usuario'"
            ["usuario" => $usuario]
        );
        return $status != false;
    }

    public static function checkLogin() {
        // session_start();

        if(isset($_SESSION['usuario'])) {
            // return self::getUsuario($_SESSION['usuario']->id);
            return $_SESSION['usuario'];
        } else {
            if(isset($_SESSION['escritorio'])) {
                return $_SESSION['escritorio'];
            }
        }
        return false;
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