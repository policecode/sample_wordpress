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
            /**
             * Lưu dữ liệu vào DB post_type
             */
            if ($fvnController->isPost()) {
                // func nhận giá trị post_id
                add_action('save_post', array($this, 'save'));
            }
        }
        global $wpdb;
        echo '<pre>';
        print_r(get_post_meta(283, 'test_key'));
        echo '</pre>';
        echo '<pre>';
        print_r($wpdb);
        echo '</pre>';

    }
   
    public function display() {
        /**
         * Thêm trường nhập cho form post_type
         */
        add_meta_box($this->_meta_box_id, 'Image of Products', array($this, 'productImages'), 'fvn-product');
        add_meta_box($this->_meta_box_id.'-detail', 'Detail Products', array($this, 'productDetail'), 'fvn-product');

    }

    public function save($post_id) {
        global $fvnController;
        $arrParams = $fvnController->getParams();

        $wpnonce_name = $this->_meta_box_id.'-nonce';
        $wpnonce_action = $this->_meta_box_id;

        if (!isset($arrParams[$wpnonce_name])) {
            return $post_id;
        }
        if (!wp_verify_nonce($arrParams[$wpnonce_name], $wpnonce_action)) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if (!current_user_can('edit_posts')) {
            return $post_id;
        }
        /**
         * Lọc dữ liệu trước khi đưa vào DB
         */
        // fvn-sp-products-img-ordering
        $key = $this->create_id('img-ordering');
        $val = array_map('absint', $arrParams[$this->create_id('img-ordering')]);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-img-url
        $key = $this->create_id('img-url');
        $val = $arrParams[$this->create_id('img-url')];
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-routate360
        $key = $this->create_id('routate360');
        $val = esc_textarea($arrParams[$this->create_id('routate360')]);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-price
        $key = $this->create_id('price');
        $val = filter_var($arrParams[$this->create_id('price')], FILTER_VALIDATE_FLOAT);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-sale-off
        $key = $this->create_id('sale-off');
        $val = filter_var($arrParams[$this->create_id('sale-off')], FILTER_VALIDATE_FLOAT);;
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-manufacturer
        $key = $this->create_id('manufacturer');
        $val = absint($arrParams[$this->create_id('manufacturer')]);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-gift
        $key = $this->create_id('gift');
        $val = esc_textarea($arrParams[$this->create_id('gift')]);
        update_post_meta($post_id, $key, $val);
    }

    public function productDetail() {
        global $fvnController;
        wp_nonce_field($this->_meta_box_id, $this->_meta_box_id.'-nonce');
        $fvnController->_data['controller'] = $this;
        $fvnController->getView('productDetail', DS.'backend'.DS.'products');
    }
    public function productImages() {
        global $fvnController;
        wp_nonce_field($this->_meta_box_id, $this->_meta_box_id.'-nonce');
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