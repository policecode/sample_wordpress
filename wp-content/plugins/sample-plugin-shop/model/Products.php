<?php
class Fvn_Sp_Products_Model {
    public function __construct()
    {
        
    }

    public function create()
    {
        $labels = array(
            'name' => 'Fvn Products',
            'singular_name' => 'Products',
            'menu_name' => 'Products',
            'name_admin_bar' => 'Add Products',
            'add_new' => 'Add New Products',
            'add_new_item' => 'Add new Products',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'not found in trash',
            'search_items' => 'Tìm sản phẩm',
            'view_item' => 'Xem trang sản phẩm'
        );
        $args = array(
            'labels' => $labels,
            'description' => __('Hiển thị danh sách Product'),
            'public' => true, // Bật tắt hiển thị menu trong admin
            'hierarchical' => true, // Phân cấp bài đăng
            'menu_position' => 5, // Vị trí hiển thị của menu
            'menu_icon' => 'dashicons-products', //icon hiển thị của menu url or icon mặc định
            'capability_type' => 'post', //Phân quyền kế thừa
            'capabilities' => array(), //Phân quyền chi tiết
            'supports' => array('title', 'editor', 'comments', 'author', 'thumbnail', 'custom-fields'), //Các hỗ trợ trong post
            // 'taxonomies' => array('fvn_category'),
            'has_archive' => true, // Lưu trữ theo ngày-tháng-năm
            'rewrite' => true, //custom lại đường đãn frontend
            'can_export' => true, //Cho phép sử dụng tool để export
            '_edit_link' => 'post.php?post=%d', //Chỉnh sửa đường dẫn phần eidt
        );
        register_post_type('fvn-product', $args);
    }

}