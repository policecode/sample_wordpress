<?php
/**
 * Xử lý việc tạo page mới cho trang web
 */
class Fvn_Sp_CreatePage_Helper {
    private $_templatePage;

    public function __construct() {
        /**
         * Hook filter xử lý cho việc tạo page mới, có 2 filter hook tương ứng cho các phiên bản khác nhau
         */
        // Add a filter to the attributes metabox to inject template into the cache.
        if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
            // 4.6 and older
            add_filter('page_attributes_dropdown_pages_args',array( $this, 'register_template' ));
            // Xử lý việc lưu dữ liệu vào trong database
            add_filter('wp_insert_post_data', array($this, 'register_template'));
        } else {
            // Add a filter to the wp 4.7 version attributes metabox
            add_filter('theme_page_templates', array( $this, 'register_template_v1' ));
        }

        $this->_templatePage = array(
            'page-fvn-shopping.php' => 'Show all products',
            'page-fvn-cart.php' => 'Fvn Shopping Cart'
        );
    }
    public function register_template($attrs) {
        /**
         * Tạo theme page mới 
         * - get_theme_root(): Lấy đường dẫn tuyệt đối đên thư mục theme
         * - get_stylesheet(): Lấy tên theme đang được sử dụng
         */
        // Tạo key page
        $cache_key = 'page_templates-'. md5(get_theme_root().'/'.get_stylesheet()) ;
        // Lấy ra danh sách các page đang có sẵn của theme
        $templates = wp_get_theme()->get_page_templates();
        if ( empty( $templates ) ) {
            $templates = array();
        }

        $templates = array_merge($templates, $this->_templatePage);
        // Xóa cache cũ của theme
        wp_cache_delete($cache_key, 'themes');
        wp_cache_add($cache_key, $templates, 'themes', 1800);
        return $attrs;
    }

    public function register_template_v1( $posts_templates ) {
        $posts_templates = array_merge( $posts_templates, $this->_templatePage );
        return $posts_templates;
    }
}
