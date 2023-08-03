<?php
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH.'wp-admin/includes/class-wp-list-table.php';
}
class Fvn_Sp_Manafacturer_Model extends WP_List_Table {

    private $_per_page = 5;

    private $_sql;
    public function __construct() {
        parent::__construct(array(
            'plural' => 'id', //Tương ứng với key của table
            'singular' => 'id',//Tương ứng với key của table
            'ajax' => false,
            'screen' => null
        ));
    }

    /**
     * Hàm bắt buộc trong khởi tạo bảng table, hàm này chạy đầu tiên
     */
    public function prepare_items() {
        $columns = $this->get_columns(); //Xác định những gì sẽ hiển thị trên bảng
        $hidden = $this->get_hidden_columns( ); // Xác định những cột sẽ ẩn đi
        $sortable = $this->get_sortable_columns(); // Xác định những cột sử dụng sort

        $this->_column_headers = array($columns, $hidden, $sortable); //Tạo bảng từ các phương thức đã khởi tạo
        $this->items = $this->table_data(); // Lấy dữ liệu từ DB

        $total_items = $this->total_items(); //Tổng rows trong Table
        $per_page = $this->_per_page;
        $total_pages = ceil($total_items/$per_page); // Tổng số trang

        /**
         * Tạo phần phân trang
         */
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages
        ));
    }

    public function total_items() {
        global $wpdb;
        return $wpdb->query($this->_sql);
    }

    public function column_default($item, $column_name) {
        return $item[$column_name];
    }

    /**
     * Custom giá trị cột name
     */
    public function column_name($item) {
        global $fvnController;
        $page = $fvnController->getParams('page');

        // Tạo link delete bảo mật
        $name = 'security_code';
        $linkDelete = add_query_arg(array(
            'action' => 'delete',
            'id'=>$item['id']
        ));
        $action = 'delete_id_'.$item['id'];
        $linkDelete = wp_nonce_url($linkDelete, $action, $name);

        $actions = array(
            'edit' => '<a href="?page='.$page.'&action=edit&id='.$item['id'].'">Edit</a>',
            'delete' => '<a href="'.$linkDelete.'">Delete</a>',
            'view' => '<a href="#">View</a>'
        );
        // Gắn các action vào trong col name
        $html = '<strong><a href="?page='.$page.'&action=edit&id='.$item['id'].'">'.$item['name'].'</a></strong>'.$this->row_actions($actions);
        return $html;
    }

    /**
     * Custom giá trị cột cb
     */
    public function column_cb($item) {
        $singular = $this->_args['singular'];
        $html = '<input type="checkbox" name="'.$singular.'[]" value="'.$item['id'].'" />';
        return $html;
    }
    /**
     * Custom giá trị cột status
     */
    public function column_status($item) {
        global $fvnController;
        $page = $fvnController->getParams('page');

        if ($item['status'] == 1) {
            $action = 'inactive';
            $src = $fvnController->getImageUrl('check.png', '/icons');
        } else {
            $action = 'active';
            $src = $fvnController->getImageUrl('close.png', '/icons');
        }

        $paged = max(1, @$_REQUEST['paged']);

        $name = 'security_code';
        $linkStatus = add_query_arg(array('action'=>$action, 'id' => $item['id'], 'paged' => $paged));
        $action = $action.'_id_'.$item['id'];
        $linkStatus = wp_nonce_url($linkStatus, $action, $name);

        $html = '<img alt="" style="width: 20px;" src="'.$src.'"/>';
        $html = '<a href="'.$linkStatus.'">'.$html.'</a>';
        return $html;
    }
    /**
     * Tạo ô input filter cho bảng
     * extra_tablenav($which): xử lý các khu vực trong bảng
     */
    protected function extra_tablenav($which) {
        if ($which == 'top') {
            $htmlObj = new FvnSetupHtml();
            $filterVal = @$_REQUEST['filter_status'];
            $options['data'] = array(
                '0' => 'Status Filter',
                'active' => 'Active',
                'inactive' => 'Inactive'
            ); 

            $slbFilter = $htmlObj->selectbox('filter_status', $filterVal, array(), $options);
            
            $attr = array('id' => 'filter_action', 'class' => 'button');
            $btnFilter = $htmlObj->button('filter_action', 'Filter', $attr);
            echo '<div class="alignleft actions bulkactions">'.$slbFilter.$btnFilter.'</div>';
        }
    }
    /**
     * Tạo ô select lựa chọn các hành động
     */
    public function get_bulk_actions() {
        return array(
            'delete' => 'Delete',
            'active' => 'Active',
            'inactive' => 'Inactive'
        );
    }
    /**
     * Dừng để lấy dữ liệu từ DB
     */
    public function table_data() {
        $data = array();

        global $fvnController, $wpdb;

        $orderBy = ($fvnController->getParams('orderby') == '')?'id':$_GET['orderby'];
        $order = ($fvnController->getParams('order') == '')?'DESC':$_GET['order'];

        $tblManafacturer = $wpdb->prefix.'fvn_sp_manufacturer';
        $sql = 'SELECT m.*
            FROM '.$tblManafacturer.' AS m';
        $whereArr = array();

        if ($fvnController->getParams('filter_status') != '') {
            $status = ($fvnController->getParams('orderby') == 'active')?1:0;
            $whereArr[] = " (m.status = $status) ";
        }
        if ($fvnController->getParams('s') != '') {
            $s = esc_sql($fvnController->getParams('s'));
            $whereArr[] = " (m.name LIKE '%$s%') ";
        }

        if (count($whereArr) > 0) {
            $sql .= " WHERE ".join('AND', $whereArr);
        }

        $sql .= ' ORDER BY m.'.esc_sql($orderBy).' '.esc_sql($order);
        $this->_sql = $sql;

        $paged = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_per_page;

        $sql .= ' LIMIT '.$this->_per_page.' OFFSET '.$offset;

        $data = $wpdb->get_results($sql, ARRAY_A);

        return $data;
    }

    public function get_columns() {
        // Các trường key trong mảng tương ứng với các key lấy từ DB
        return array(
            'cb' => '<input type="checkbox" />',
            'name' => 'Tên hãng',
            'slug' => 'Slug',
            'status' => 'Trạng thái',
            'id' => 'ID'
        );
    }

    public function get_hidden_columns() {
        return array();
    }

    public function get_sortable_columns() {
        return array(
            'name' => array('name', true),
            'id' => array('id', true)
        );
    }
}