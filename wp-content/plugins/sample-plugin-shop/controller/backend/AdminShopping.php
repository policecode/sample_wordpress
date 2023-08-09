<?php
class Fvn_Sp_AdminShopping_Controller {
    public function __construct() {
        $this->display();
    }

    public function display() {
        global $fvnController;
        $fvnController->getView('display', DS.'backend'.DS.'shopping');
    }
}