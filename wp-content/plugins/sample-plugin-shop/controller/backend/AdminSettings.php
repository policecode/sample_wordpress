<?php
class Fvn_Sp_AdminSettings_Controller {
    public function __construct()
    {
        $this->display();

    }

    public function display() {
        global $fvnController;
        if ($fvnController->isPost()) {
            $fvn_sp_setting = $fvnController->getParams('fvn_sp_setting');
            update_option('fvn_sp_setting', $fvn_sp_setting, 'yes');
        }
        $fvnController->getView('display', DS.'backend'.DS.'setting');
    }


}