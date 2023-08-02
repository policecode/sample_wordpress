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

/**
 * Khởi tạo class toàn cục tìm và nạp file
 */
global $fvnController;
$fvnController = new FvnController();

if (is_admin()) {
    require_once 'backend.php';
    new Fvn_Sp_Backend();
} else {
    require_once 'frontend.php';
    new Fvn_Sp_Frontend();
}

/**
 * Gọi các phương thức sử dụng ở cả FE và BE
 */
// Custom post_type sử dụng cả ở frontend và backend nên ta sẽ khởi tạo class ở ngoài
$fvnController->getController('AdminProducts', DS . 'backend'); //edit.php?post_type=fvn-product
$fvnController->getController('AdminCategories', DS . 'backend'); //edit-tags.php?taxonomy=fvn-category&post_type=fvn-product

/**
 * Xử lý việc custom lại link cho thanh menu
 */
$fvnController->getHelper('AdminMenu');