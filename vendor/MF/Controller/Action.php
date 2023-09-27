<?php

namespace MF\Controller;

use function PHPSTORM_META\type;

abstract class Action {
    
    protected $view;

    public function __construct() {
        $this->view = new \stdClass();
    }

    public function render($view) {
        
        $currentClass = get_class($this);
        $currentClass = str_replace("App\\Controllers\\", "", $currentClass);
        $currentClass = strtolower(str_replace("Controller", "", $currentClass));

        // Tentar encontrar o arquivo .phtml, se não encontrar, tentar encontrar o .html

        // criar array com as variáveis que serão usadas na view: html, css, js, etc
        $result = array();

        ob_start();

        if(file_exists("../App/Views/" . $currentClass . "/" . $view.".phtml")){
            require_once "../App/Views/" . $currentClass . "/" . $view.".phtml";
        } else if(file_exists("../App/Views/" . $currentClass . "/" . $view."/".$view.".html") ) {
            require_once "../App/Views/" . $currentClass . "/" . $view."/".$view.".html";
        } 
        
        else if(file_exists("../App/Views/" . $currentClass . "/" . $view.".html")) {
            require_once "../App/Views/" . $currentClass . "/" . $view.".html";
        } else if(file_exists("../App/Views/" . $currentClass . "/" . $view."/".$view.".phtml") ) {
            require_once "../App/Views/" . $currentClass . "/" . $view."/".$view.".phtml";
        }
        
        else {
            echo "View não encontrada";
        }

        
        
        $html = ob_get_clean();
        $html = (string)$html;
        $result['html'] = $html;
        
        // get css
        ob_start();

        if(file_exists("../App/Views/" . $currentClass . "/" . $view.".css")) {
            require_once "../App/Views/" . $currentClass . "/" . $view.".css";
        } else if(file_exists("../App/Views/" . $currentClass . "/" . $view."/".$view.".css") ) {
            require_once "../App/Views/" . $currentClass . "/" . $view."/".$view.".css";
        }

        $css = ob_get_clean();
        $css = (string)$css;
        $result['css'] = $css;


        
        // get js
        ob_start();
        if(file_exists("../App/Views/" . $currentClass . "/" . $view.".js")) {
            require_once "../App/Views/" . $currentClass . "/" . $view.".js";
        } else if(file_exists("../App/Views/" . $currentClass . "/" . $view."/".$view.".js") ) {
            require_once "../App/Views/" . $currentClass . "/" . $view."/".$view.".js";
        }
        
        $js = ob_get_clean();
        $js = (string)$js;
        $result['js'] = $js;

        $result['class'] = $currentClass;
        $result['view'] = $view;

        

        echo json_encode($result);

        // echo json_encode($result);

        

    }

}

?>