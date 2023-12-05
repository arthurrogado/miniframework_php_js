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
        $routes['pessoas'] = array(
            'route' => '/pessoas',
            'redirect' => '/pessoas/listar'
        );
            // pages
        array_push($routes, [
            'route' => '/pessoas/listar',
            'controller' => 'Pages/Pessoas',
            'action' => 'listar'
        ]);
        array_push($routes, [
            "route" => "/pessoas/criar",
            "controller" => "Pages/Pessoas",
            "action" => "criar"
        ]);
        array_push($routes, [
            "route" => "/pessoas/visualizar",
            "controller" => "Pages/Pessoas",
            "action" => "visualizar"
        ]);
            // api
        array_push($routes, [
            'route' => '/api/pessoas/listar',
            'controller' => 'PessoasController',
            'action' => 'getPessoas'
        ]);
        array_push($routes, [
            'route' => '/api/pessoas/criar',
            'controller' => 'PessoasController',
            'action' => 'createPessoa'
        ]);
        array_push($routes, [
            'route' => '/api/pessoas/visualizar',
            'controller' => 'PessoasController',
            'action' => 'getPessoa'
        ]);
        array_push($routes, [
            'route' => '/api/pessoas/editar',
            'controller' => 'PessoasController',
            'action' => 'editar'
        ]);
        array_push($routes, [
            'route' => '/api/pessoas/deletar',
            'controller' => 'PessoasController',
            'action' => 'deletarPessoa'
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

        // LOGOUT
        $routes['logout'] = array(
            'route' => '/logout',
            'controller' => 'AuthController',
            'action' => 'logout',
        );

        $this->setRoutes($routes);
    }



}

?>