<?php
class Fvn_Sp_AdminMenu_Helper {
    public function __construct()  {
        // Modify Menu: Thay đổi lại phần submenu gắn với posttype
        add_action('admin_menu', array($this, 'modify_admin_menus'));
        if (isset($_GET['post_type']) && $_GET['post_type'] == 'fvn-product') {
            // Thêm js
            add_action('admin_enqueue_scripts', array($this, 'add_js'));
        }
    }
    function add_js() {
        global $fvnController;
        $urlTmp = $fvnController->get_js_url('admin_menu');
        wp_enqueue_script('fvn_sp_admin_menu', $urlTmp, array('jquery'), FVN_PLUGIN_VERSION, false );
    }

    function modify_admin_menus() {
        global $menu, $submenu;
        $fvn_sp_manager = $submenu['fvn-sp-manager'];
        // Thay đổi đường dẫn cho submenu
        foreach ($fvn_sp_manager as $key => $value) {
            if ($value[2] == 'fvn-sp-manager-categories') {
                $fvn_sp_manager[$key][2] = 'edit-tags.php?taxonomy=fvn-category&post_type=fvn-product';
            }
            if ($value[2] == 'fvn-sp-manager-products') {
                $fvn_sp_manager[$key][2] = 'edit.php?post_type=fvn-product';
            }
        }
        $submenu['fvn-sp-manager'] = $fvn_sp_manager;
        // Xóa menu post type đã được tạo ở trên
        remove_menu_page('edit.php?post_type=fvn-product');
    }
}
