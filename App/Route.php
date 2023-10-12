<?php

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap {

    public function initRoutes() {

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

        $routes['pessoas'] = array(
            'route' => '/pessoas',
            'redirect' => '/pessoas/listar'
        );
        $routes['listar_pessoas'] = array(
            'route' => '/pessoas/listar',
            'controller' => 'Pages/Pessoas',
            'action' => 'listar'
        );
        $routes["page_criar_pessoa"] = array(
            "route" => "/pessoas/criar",
            "controller" => "Pages/Pessoas",
            "action" => "criar"
        );
        $routes['create_pessoa'] = array(
            'route' => '/pessoas/create',
            'controller' => 'PessoasController',
            'action' => 'createPessoa'
        );
        $routes['get_pessoas'] = array(
            'route' => '/pessoas/get_pessoas',
            'controller' => 'PessoasController',
            'action' => 'getPessoas'
        );
        $routes['delete_pessoa'] = array(
            'route' => '/pessoas/delete',
            'controller' => 'PessoasController',
            'action' => 'deletePessoa'
        );

        // LOGIN

        $routes['login'] = array(
            'route' => '/login',
            'controller' => 'Pages/Login',
            'action' => 'index'
        );

        $this->setRoutes($routes);
    }



}

?>