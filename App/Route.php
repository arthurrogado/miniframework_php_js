<?php

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap {

    public function initRoutes() {

        session_start();

        $routes['404'] = array(
            'route' => '/404',
            'controller' => 'IndexController',
            'action' => '_404'
        );

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'Pages/Home',
            'action' => 'index'
        );

        $routes['sobre_nos'] = array(
            'route' => '/sobre_nos',
            'controller' => 'IndexController',
            'action' => 'sobreNos'
        );

        $routes['contato'] = array(
            'route' => '/contato',
            'controller' => 'IndexController',
            'action' => 'contato'
        );

        $routes['produtos'] = array(
            'route' => '/produtos',
            'controller' => 'Pages/Produtos',
            'action' => 'listar'
        );




        // PESSOAS //
        $routes['usuarios'] = array(
            'route' => '/usuarios',
            'redirect' => '/usuarios/listar'
        );
            // pages
        array_push($routes, [
            'route' => '/usuarios/listar',
            'controller' => 'Pages/Usuarios',
            'action' => 'listar'
        ]);
        array_push($routes, [
            "route" => "/usuarios/criar",
            "controller" => "Pages/Usuarios",
            "action" => "criar"
        ]);
        array_push($routes, [
            "route" => "/usuarios/visualizar",
            "controller" => "Pages/Usuarios",
            "action" => "visualizar"
        ]);
            // api
        array_push($routes, [
            'route' => '/api/usuarios/criar',
            'controller' => 'UsuariosController',
            'action' => 'criarUsuario'
        ]);
        array_push($routes, [
            'route' => '/api/usuarios/listar',
            'controller' => 'UsuariosController',
            'action' => 'getUsuarios'
        ]);
        array_push($routes, [
            'route' => '/api/usuarios/visualizar',
            'controller' => 'UsuariosController',
            'action' => 'visualizarUsuario'
        ]);
        array_push($routes, [
            'route' => '/api/usuarios/editar',
            'controller' => 'UsuariosController',
            'action' => 'editar'
        ]);
        array_push($routes, [
            'route' => '/api/usuarios/mudar_senha',
            'controller' => 'UsuariosController',
            'action' => 'mudarSenhaUsuario'
        ]);
        array_push($routes, [
            'route' => '/api/usuarios/excluir',
            'controller' => 'UsuariosController',
            'action' => 'excluirUsuario'
        ]);


        // LOGIN

        $routes['tela_login'] = array(
            'route' => '/login',
            'controller' => 'Pages/Login',
            'action' => 'index',
            'public' => true
        );
        $routes['login'] = array(
            'route' => '/api/login',
            'controller' => 'AuthController',
            'action' => 'login',
            'public' => true
        );
        array_push($routes,[
            'route' => '/api/usuario/check_login',
            'controller' => 'AuthController',
            'action' => 'checkLogin',
            'public' => true
        ]);
        $routes['logout'] = array(
            'route' => '/logout',
            'controller' => 'AuthController',
            'action' => 'logout',
        );

        $this->setRoutes($routes);
    }



}

?>