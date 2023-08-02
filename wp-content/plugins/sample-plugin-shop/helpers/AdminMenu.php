<?php
class Fvn_Sp_AdminMenu_Helper
{
    
    public function __construct() {
        /**
         * Xử lý việc thay đổi menus, custom menu
         */
        add_action('admin_menu', array($this, 'modify_admin_menus'));
    }

    function modify_admin_menus()
    {
        /**
         * - $menu: Liệt kê các menu chính trên thanh công cụ admin (ko có menu con)
         * - $submenu: Liệt kê chi tiết các menu con của trang admin
         */
        global $menu, $submenu;
        // Thực hiện gán link cho các menu
        $fvn_sp_manager = $submenu['fvn-sp-manager'];
        foreach ($fvn_sp_manager as $key => $value) {
            if ($value[2] == 'fvn-sp-manager-categories') {
                $fvn_sp_manager[$key][2] = 'edit-tags.php?taxonomy=fvn-category&post_type=fvn-product';
            }

            if ($value[2] == 'fvn-sp-manager-products') {
                $fvn_sp_manager[$key][2] = 'edit.php?post_type=fvn-product';
            }
            // Thay đổi menu trong $menusub
            $submenu['fvn-sp-manager'] = $fvn_sp_manager;
            // Xóa menu không cần thiết
            remove_menu_page('edit.php?post_type=fvn-product');
        }
    }
}
