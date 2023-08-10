<?php
class Fvn_Sp_Backend {
    // Slug menu sử dụng trong admuin
    private $_menuSlug = 'fvn-sp-manager';
    // Slug page đang hiển thị trên url
    private $_page = '';

    public function __construct() {
        global $fvnController;
        /**
         * Tạo page mới, hiển thị ở phần giao diện của admin
         */
        $fvnController->getHelper('CreatePage');

        if (isset($_GET['page'])) {
            /**
             * Lấy giá trị slug page
             */
            $this->_page = $_GET['page'];
            add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
        }
        add_action('admin_menu', array($this, 'menus'));

    }

    /**
     * Tạo menus
     */
    public function menus() {
        add_menu_page( 'FvnShopping', 'FvnShopping', 'manage_options', $this->_menuSlug, array($this, 'dispatch_function'), '', 3);
        add_submenu_page($this->_menuSlug, 'Dashboard', 'Dashboard', 'manage_options', $this->_menuSlug, array($this, 'dispatch_function'));
        add_submenu_page($this->_menuSlug, 'Categories', 'Categories', 'manage_options', $this->_menuSlug.'-categories', array($this, 'dispatch_function'));
        add_submenu_page($this->_menuSlug, 'Products', 'Products', 'manage_options', $this->_menuSlug.'-products', array($this, 'dispatch_function'));
        add_submenu_page($this->_menuSlug, 'Manafacturer', 'Manafacturer', 'manage_options', $this->_menuSlug.'-manafacturer', array($this, 'dispatch_function'));
        add_submenu_page($this->_menuSlug, 'Invoices', 'Invoices', 'manage_options', $this->_menuSlug.'-invoices', array($this, 'dispatch_function'));
        add_submenu_page($this->_menuSlug, 'Settings', 'Settings', 'manage_options', $this->_menuSlug.'-settings', array($this, 'dispatch_function'));

    }

    /**
     * Điều hướng phần tạo menu
     */
    public function dispatch_function() {
        $page = $this->_page;
        global $fvnController;
        if ($page == 'fvn-sp-manager') {
            // D:\Program Files\xampp\htdocs\wordpress\learn_v1\wp-content\plugins\sample-plugin-shop\controller\backend\AdminShopping.php
            $obj = $fvnController->getController('AdminShopping', DS.'backend');
        }
        if ($page == 'fvn-sp-manager-categories') {
            // $obj = $fvnController->getController('AdminCategories', DS.'backend');
        }
        if ($page == 'fvn-sp-manager-products') {
            // $obj = $fvnController->getController('AdminProducts', DS.'backend');
        }
        if ($page == 'fvn-sp-manager-manafacturer') {
            $obj = $fvnController->getController('AdminManafacturer', DS.'backend');
        }
        if ($page == 'fvn-sp-manager-invoices') {
            $obj = $fvnController->getController('AdminInvoices', DS.'backend');
        }
        if ($page == 'fvn-sp-manager-settings') {
            $obj = $fvnController->getController('AdminSettings', DS.'backend');
        }
    }


    public function add_css_file() {
        global $fvnController;
        if ($fvnController->getParams('page') === 'fvn-sp-manager-settings') {
            wp_register_style('fvn_sp_product_setting_be', $fvnController->getCssUrl('setting_be'), array(), FVN_SP_PLUGIN_VERSION);
            wp_enqueue_style('fvn_sp_product_setting_be');
        }
    }
}