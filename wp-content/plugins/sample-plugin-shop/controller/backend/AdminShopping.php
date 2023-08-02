<?php
class Fvn_Sp_AdminShopping_Controller {
    public function __construct() {
        
    }

    public function display() {
        global $fvnController;
        $fvnController->getView('display.php', DS.'backend'.DS.'shopping');
    }
}