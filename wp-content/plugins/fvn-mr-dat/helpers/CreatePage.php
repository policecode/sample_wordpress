<?php
class Fvn_Sp_CreatePage_Helper {
    private $_templatePage;
    public function __construct() {
        $this->_templatePage = array(
            'page-fvnshopping.php' => 'Show All products',
            'page-fvncart.php' => 'fvnShopping Cart'
        );
        /**
         * Dùng để tạo thêm các template page cho trang web
         */
        if (version_compare(floatval(get_bloginfo('version')), '4.7', '<')) {
            add_filter('page_attributes_dropdown_pages_args', array($this, 'register_template'));
        } else {
            add_filter('theme_page_templates', array($this, 'add_new_template'));
        }
        add_filter('wp_insert_post_data', array($this, 'register_template'));
    }
    public function add_new_template($posts_template){
        $posts_template = array_merge($posts_template, $this->_templatePage);
        return $posts_template;
    }
    public function register_template($attrs) {
        /**
         * Key của template page
         */
        $cache_key = 'page_templates-'.md5(get_theme_root().'/'.get_stylesheet());
        /**
         * Lấy danh sách các page có trong phần giao diện: 'file_page' => 'tên page'
         */
        $templates = wp_get_theme()->get_page_templates();
        /**
         * Thêm phần tử page vào trong mảng mặc định
         */
        $templates = array_merge($templates, $this->_templatePage);
        /**
         * Xóa cache_key cũ 
         * Add lại cache_key để việc thêm phần tử page vào trong mảng được áp dụng,
         */
        wp_cache_delete($cache_key, 'themes');
        wp_cache_add($cache_key, $templates, 'themes', 1800);
        return $attrs;
    }
}