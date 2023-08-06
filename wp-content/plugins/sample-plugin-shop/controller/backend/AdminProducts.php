<?php
class Fvn_Sp_AdminProducts_Controller {
    private $_meta_box_id = 'fvn-sp-products';
    private $_prefix_id = 'fvn-sp-products-';
    private $_prefix_key = '_fvn_sp_products_';

    public function __construct()
    {
        global $fvnController;
        $modelProduct = $fvnController->getModel('Products');
        // Gọi hàm sử dụng custom post
        add_action('init', array($modelProduct, 'create'));

        
        if ($fvnController->getParams('post_type') == 'fvn-product') {
            /**
             * Hook dùng để đưa phần tạo meta box vào
             */
            add_action('add_meta_boxes', array($this, 'display'));
            /**
             * Thêm style cần sử dụng thêm
             */
            add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
            /**
             * Thêm js xử lý phần mở popup chọn nhiều hình ảnh
             */
            add_action('admin_enqueue_scripts', array($this, 'media_button_js_file'));
        }
    }
   
    public function display() {
        /**
         * Thêm trường nhập cho form post_type
         */
        add_meta_box($this->_meta_box_id, 'Image of Products', array($this, 'productImages'), 'fvn-product');
    }

    public function productImages() {
        global $fvnController;
        $fvnController->_data['controller'] = $this;
        $fvnController->getView('productImages', DS.'backend'.DS.'products');

    }

    public function add_css_file() {
        global $fvnController;

        wp_register_style('fvn_sp_product_product_bk', $fvnController->getCssUrl('product-bk'), array(), FVN_SP_PLUGIN_VERSION);
        wp_enqueue_style('fvn_sp_product_product_bk');
    }

    public function media_button_js_file() {
        global $fvnController;
        /**
         * Bật popup chọn được nhiều hình ảnh một lúc
         * wp_enqueue_media(): Gọi tập tin hệ thống js có thể sử dụng đc popup này
         */
        wp_enqueue_media();
        wp_register_script('fvn_sp_product_media_button', $fvnController->getJsUrl('media_button'), array('jquery'), FVN_SP_PLUGIN_VERSION, true);
        wp_enqueue_script('fvn_sp_product_media_button');

    }

    public function create_id($val) {
        return $this->_prefix_id.$val;
    }
    public function create_key($val) {
        return $this->_prefix_key.$val;
    }
}