<?php
/*
Plugin Name: FVN sample plugin shopping
Plugin URI: 
Description: Xay dung shopping don gian
Version: 1.0.0
Author: FVN Hoang Dat
Author URI: 
*/

require_once 'define.php';
require_once FVN_SP_INCLUDES_PATH . DS . 'controller.php';
add_filter('use_block_editor_for_post', '__return_false');
/**
 * Thao tác khi bật tắt plugin
 */
register_activation_hook(__FILE__, 'fvn_mp_active');
register_deactivation_hook(__FILE__, 'fvn_mp_deactive');
function fvn_mp_active() {
    require_once 'active.php';
}
function fvn_mp_deactive() {
    require_once 'deactive.php';
 }


/**
 * Khởi tạo class toàn cục tìm và nạp file
 */
global $fvnController;
$fvnController = new FvnController();

if (is_admin()) {
    require_once FVN_SP_INCLUDES_PATH.DS.'html.php';
    require_once 'backend.php';
    new Fvn_Sp_Backend();
    /**
     * Xử lý việc custom lại link cho thanh menu
     */
    $fvnController->getHelper('AdminMenu');
    /**
     * Tạo category riêng trong phần admin, bên ngoài FE sẽ gọi hàm tương tự
     */
    $fvnController->getController('AdminCategories', DS . 'backend'); //edit-tags.php?taxonomy=fvn-category&post_type=fvn-product
    $fvnController->getController('AdminProducts', DS . 'backend'); //edit.php?post_type=fvn-product
} else {
    require_once 'frontend.php';
    new Fvn_Sp_Frontend();
}

/**
 * Gọi các phương thức sử dụng ở cả FE và BE
 */
// Custom post_type sử dụng cả ở frontend và backend nên ta sẽ khởi tạo class ở ngoài

