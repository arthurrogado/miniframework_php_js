<?php

namespace MF\Controller;

// Classe para retornos positivos
class MyAppSuccess {
    public function __construct($message) {
        $array = array(
            'ok' => true,
            'message' => $message
        );
        echo json_encode($array);
        exit();
    }
}