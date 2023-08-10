<?php 
class Fvn_Sp_Frontend {
    public function __construct() {
        global $fvnController, $wp_query;
        // Khởi tạo các hàm post_type ngoài frontend
        $modelCategpry = $fvnController->getModel('Category');
        $modelProduct = $fvnController->getModel('Products');
        add_action('init', array($modelProduct, 'create'));
        add_action('init', array($modelCategpry, 'create'));
       
        /**
         * Xử lý việc truy cập các file load giao diện
         * - Nhận một tham số là đường dẫn tới file xử lys
         */
        add_filter('template_include', array($this, 'load_template'));

        /**
         * Luồng frontend: frontend.php -> templates/template_include.php (file template) -> controller/frontend/*.php -> templates/folder/display.php (giao diện)
         */
    }
    public function load_template($template) {
        global $post, $wp_query;
     
        if (is_page() == 1) {
            /**
             * Chỉ xử lý đường dẫn khi liên quan đến phần page
             * 
             */
            // Lấy tên file page được khởi tạo
            $page_template = get_post_meta($post->ID, '_wp_page_template', true);
         
            // Tạo đường dẫn tới file cần xử lý page
            $page_path = FVN_SP_TEMPLATE_PATH. DS . 'frontend' . DS . $page_template;
            if (file_exists($page_path)) {
                return $page_path;
            }
        }
        /**
         * - get_query_var('fvn-category'): Lấy giá trị liên quan đến post_type
         */
        // Trang chi tiết của cat
        if (get_query_var('fvn-category') != '') {
            $page_path = FVN_SP_TEMPLATE_PATH. DS . 'frontend' . DS . 'fvn-category.php';
            if (file_exists($page_path)) {
                return $page_path;
            }
        }
        // Trang chi tiết sản phẩm
        if (get_query_var('fvn-product') != '') {
            $page_path = FVN_SP_TEMPLATE_PATH. DS . 'frontend' . DS . 'fvn-product.php';
            if (file_exists($page_path)) {
                return $page_path;
            }
        }
       
        return $template;
    }
}