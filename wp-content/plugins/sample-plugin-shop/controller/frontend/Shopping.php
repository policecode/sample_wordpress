<?php 
class Fvn_Sp_Shopping_Controller {
    public function __construct() {
        $this->display();
    }

    public function display() {
        global $fvnController;
        $fvnController->getView('display', DS.'frontend'.DS.'shopping');
    }
}