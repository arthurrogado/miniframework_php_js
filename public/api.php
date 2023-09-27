<?php
    //index.php

    //print_r($_SERVER['REQUEST_URI']);
    
    // Permitir acesso cross-origin
    header("Access-Control-Allow-Origin: *");

    require_once "../vendor/autoload.php";

    $route = new \App\Route;

?>