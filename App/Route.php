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
            'controller' => 'IndexController',
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
            'controller' => 'IndexController',
            'action' => 'produtos'
        );

        $routes['pessoas'] = array(
            'route' => '/pessoas',
            'redirect' => '/pessoas/listar'
        );
        $routes['listar_pessoas'] = array(
            'route' => '/pessoas/listar',
            'controller' => 'PessoasController',
            'action' => 'PessoasListar'
        );
        $routes["criar_pessoa"] = array(
            "route" => "/pessoas/criar",
            "controller" => "PessoasController",
            "action" => "criarPessoa"
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

        

        $this->setRoutes($routes);
    }



}

?>