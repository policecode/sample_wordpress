<?php
class Fvn_Sp_AdminManafacturer_Controller {
    public function __construct()
    {
        $this->dispath_function();
    }

    /**
     * Điều hướng xử lý các thao tác trong table
     */
    public function dispath_function() {
        global $fvnController;
        $action = $fvnController->getParams('action');
        switch($action) {
            case 'add'      : $this->add(); break;
            case 'edit'     : $this->edit(); break;
            case 'delete'   : $this->delete(); break;
            case 'active'   :
            case 'inactive' : 
                $this->status(); break;
            default         : $this->display(); break;
        }
    }
    public function display() {
        global $fvnController;
        $fvnController->getView('display', DS.'backend'.DS.'manafacturer');
    }

    public function add() {
        echo __METHOD__;
    }

    public function edit() {
        echo __METHOD__;
        
    }

    public function delete() {
        echo __METHOD__;
        
    }

    public function status() {
        echo __METHOD__;
        
    }

    public function noAccess() {
        echo __METHOD__;
        
    }
}