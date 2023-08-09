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
            /**
             * Thêm cột trong bảng của post_type, có giá truyền vào mặc định là danh sách các cột
             * - thêm tất cả các posts, chú ý điều kiện post_type
             */
            add_filter( 'manage_posts_columns', array($this, 'add_column'));
            /**
             * Thêm giá trị vào các cột vừa thêm mới
             * - hook action: manage_{post_type}_posts_custom_column, chỉ tác động các cột đã thêm bằng filter hook
             * - action có 2 tham số: cột hiện tại và post_id hiện tại
             */
            add_action('manage_fvn-product_posts_custom_column', array($this, 'display_value_column'), 10, 2);

            /**
             * Thêm các cột trong bảng có chức năng sắp sếp
             */
            add_filter('manage_edit-fvn-product_sortable_columns', array($this, 'sortable_cols'));

            /**
             * Custom lại câu query
             * Viết lại câu query phù hợp với DB cho việc sắp xếp, tìm kiếm
             */
            add_action('pre_get_posts', array($this, 'modify_query'));

            /**
             * Thêm select trong bảng post_type
             * edit.php?s&post_status=all&post_type=fvn-product&action=-1&m=0&fvn-category=16&filter_action=Lọc&paged=1&action2=-1
             */
            add_action('restrict_manage_posts', array($this, 'fvn_category_list'));

        }
    }

    /**
     * Tạo select box category trong bảng
     */
    public function fvn_category_list() {
        global $fvnController;

        wp_dropdown_categories(array(
            'show_option_all'   => __('Show All Category Fvn'),
            'taxonomy'          => 'fvn-category',
            'name'              => 'fvn-category', // phần name trong select bõ
            'orderby'           => 'name', //Trường để sắp xếp (theo trường trong DB)
            'selected'          => $fvnController->getParams('fvn-category'), //Dữ liệu được select đầu tiên khi bật lên
            'hierarchical'      => true, // Có hiện thị theo dạng cây hay không
            'depth'             => 3, //Độ sâu tối đa
            'show_count'        => true, //Có hiện thị số lượng bài viết thuộc category này 
            'hide_empty'        => true, //ẩn đi các category không có bài viết
        ));
    }

    public function modify_query($query) {
        global $fvnController;
        // TH sắp xếp mặc định
        if (empty($fvnController->getParams('orderby'))) {
            $query->set('orderby', 'ID');
            $query->set('order', 'DESC');
        }
        // Sửa giá trị view giống với trường trong DB
        if ($query->get('orderby') == 'View') {
            // Thiết lập trường meta_key để so sánh, kiểu dữ liệu key ta lưu trong DB
            $query->set('meta_key', $this->create_key('view'));
            // Set order by
            $query->set('orderby', 'meta_value_num'); // meta_value_num - meta_value: Phân biệt dạng chuỗi hay dạng số
        }

        if ($query->get('fvn-category') > 0) {
            // Xử lý phần select (tìm kiếm) theo category
            $tax_query = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'fvn-category',
                    'field'     => 'term_id',
                    'terms'    => $fvnController->getParams('fvn-category'),
                )
            );
            $query->set('tax_query', $tax_query);
        }
      
    }
    public function sortable_cols($columns) {
       
        $columns['id'] = 'ID';
        $columns['view'] = 'View';

        return $columns;
    }
    // Xư lý dữ liệu trong cột, 
    public function display_value_column($column, $post_id) {
        if ($column == 'id') {
            echo $post_id;
        }
        if ($column == 'view') {
            $view = get_post_meta($post_id, $this->create_key('view'), true);
            // update_post_meta($post_id, $this->create_key('view'), $post_id - 220);
            echo $view;
        }
        if ($column == 'category') {
            echo get_the_term_list($post_id, 'fvn-category', '', ', ', '');
        }
    }
    // THêm cột
    public function add_column($columns) {
        $newArr = array ();
        foreach ($columns as $key => $title) {
            $newArr[$key] = $title;
            if ($key == 'author') {
                $newArr['category'] = __('Category');
            }
        }
        $new_columns = array(
            'view' => __('View'),
            'id' => __('ID')
        );
        $newArr = array_merge($newArr, $new_columns);
        return $newArr;
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
        if (!isset($arrParams['save'])) {
            // Trường hợp không có save thì ta đang ở chế độ thêm mới, khi đó ta sẽ cho view = 0
            $key = $this->create_key('view');
            $val = 0;
            update_post_meta($post_id, $key, $val);
        }
        /**
         * Lọc dữ liệu trước khi đưa vào DB
         */
        // fvn-sp-products-img-ordering
       
        $key = $this->create_key('img-ordering');
        $val = array_map('absint', $arrParams[$this->create_key('img-ordering')]);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-img-url
        $key = $this->create_key('img-url');
        $val = $arrParams[$this->create_key('img-url')];
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-routate360
        $key = $this->create_key('routate360');
        $val = esc_textarea($arrParams[$this->create_key('routate360')]);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-price
        $key = $this->create_key('price');
        $val = filter_var($arrParams[$this->create_key('price')], FILTER_VALIDATE_FLOAT);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-sale-off
        $key = $this->create_key('sale-off');
        $val = filter_var($arrParams[$this->create_key('sale-off')], FILTER_VALIDATE_FLOAT);;
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-manufacturer
        $key = $this->create_key('manufacturer');
        $val = absint($arrParams[$this->create_key('manufacturer')]);
        update_post_meta($post_id, $key, $val);

        // fvn-sp-products-gift
        $key = $this->create_key('gift');
        $val = esc_textarea($arrParams[$this->create_key('gift')]);
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