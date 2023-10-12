<?php

namespace App\Controllers\Pages;
use MF\Controller\Action;

class Index extends Action {

    public function produtos() {
        $this->render("produtos");
    }

}

?>