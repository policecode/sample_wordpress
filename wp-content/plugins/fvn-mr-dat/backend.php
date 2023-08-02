<?php
class Fvn_Sp_Backend {
    private $_menuSlug = 'fvn-sp-manager';
    private $_page = '';
    public function __construct() {
        global $fvnController;
        if (isset($_GET['page'])) {
            $this->_page = $_GET['page'];
        }
        
        add_action('admin_menu', array($this, 'menus'));
        add_action('admin_enqueue_scripts', array($this, 'add_css_file'));

        // Tạo thêm template page
        // $fvnController->getHelper('CreatePage');
    }
    public function add_css_file() {
        global $fvnController;
       
    }
    public function menus() {
        
    }
    public function dispatch_function() {
        global $fvnController;

        
    }
}