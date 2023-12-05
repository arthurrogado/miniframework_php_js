<?php

namespace App\Models;
use MF\Model\Model;

class Usuario extends Model
{
    private $id;
    private $nome;

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value) {
        $this->$attr = $value;
    }

    public static function getUsuario($id) {
        self::getConn();
        $query = "SELECT id, nome FROM tb_usuarios WHERE id = :id";
        $stmt = self::$conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        // retornar um objeto do tipo Usuario
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public static function checkLogin() {
        // session_start();

        if(isset($_SESSION['usuario'])) {
            return self::getUsuario($_SESSION['usuario']->id);
        } else {
            return false;
        }
    }

    public static function login($usuario, $senha) {
        self::getConn();
        $query = "SELECT * FROM tb_pessoas WHERE usuario = :usuario";
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