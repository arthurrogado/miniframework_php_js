<?php

namespace MF\Init;

abstract class Bootstrap {

    private $routes;

    abstract protected function initRoutes();

    public function __construct() {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function setRoutes(array $routes) {
        $this->routes = $routes;
    }

    protected function run($url) {
        foreach($this->getRoutes() as $key => $route) {

            // define a default route if "route->redirect" exists
            if(isset($route['redirect']) && $url == $route['route']) {
                $url = $route['redirect'];
            }
            
            if(isset($route['route']) && $url == $route['route']) {
                $class = "App\\Controllers\\".ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
            // } else {
            //     // echo "404";
            //     $class = "App\\Controllers\\IndexController";
            //     $controller = new $class;
            //     $action = "_404";
            //     $controller->$action();
            // }
        }
    }

    protected function getUrl() {
        return parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
        //return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

}

?>