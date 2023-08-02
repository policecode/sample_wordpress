<?php
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH.'wp-admin/includes/class-wp-list-table.php';
}
class Fvn_Sp_Sample_Model extends WP_List_Table {
    private $_per_page = 5;
    private $_sql;
    public function __construct() {
        $this->create_database();
        parent::__construct(array(
            'plural'   => 'id', //class được gắn vào trong bảng table
            'singular' => 'id', //được thêm vào thẻ tbody data-wp-lists="list:article"
            'ajax'     => false,
            'screen'   => null,
        ));
    }

    /**
     * Dùng để đăng ký bảng, tự động chạy đầu tiên
     */
    public function prepare_items() {
        $columns = $this->get_columns();
        // Giá trị sẽ ẩn của arr $column
        $hidden = $this->get_hidden_columns();
        // Các cột hiển thị nút sortby
        $sortTable = $this->get_sortable_columns();
        /**
         * Dùng để tạo bảng 
         */
        $this->_column_headers = array($columns, $hidden, $sortTable);
        // Mảng dữ liệu
        $this->items = $this->table_data();
        /**
         * Phân trang
         */
        $total_items = $this->total_items();
        $per_page = $this->_per_page;
        $total_pages = ceil($total_items/$per_page);
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => $total_pages
        ));
    }

    private function total_items() {
        global $wpdb;
        return $wpdb->query($this->_sql);
    }

    private function table_data() {
        global $wpdb, $fvnController;
        $data = array();
        $orderby = empty($fvnController->getParams('orderby'))?'id':$_GET['orderby'];
        $order = empty($fvnController->getParams('order'))?'DESC':$_GET['order'];
        $tblManufactuer = $this->get_table_name('fvn_sp_manufactuer');
        // Query
        $sql = "SELECT m.* 
        FROM $tblManufactuer AS m";
        // condition
        $whereArr = array();
        if ($fvnController->getParams('filter_status') != '') {
            $status = ($fvnController->getParams('filter_status') == 'active')?1:0;
            $whereArr[] = "(m.status = $status)";
        }
        if ($fvnController->getParams('s') != '') {
            $s = esc_sql($fvnController->getParams('s'));
            $whereArr[] = "(m.name LIKE '%$s%')";
        }

        if (count($whereArr) > 0) {
            $sql .= " WHERE ".join(" AND", $whereArr);
        }
        $sql .= ' ORDER BY m.'.esc_sql($orderby).' '.esc_sql($order);

        $this->_sql = $sql;
        $paged = max(1, @$_REQUEST['paged']);
        $offset = ($paged - 1) * $this->_per_page;
        $sql .= " LIMIT ".$this->_per_page." OFFSET $offset";
        $data = $wpdb->get_results($sql, ARRAY_A);
        return $data;
    }

    public function save_item($arrData = array(), $options = array()) {
        global $fvnController, $wpdb;
        
        $action = $arrData['action'];
        $slug = '';
        if (!empty($arrData['slug'])) {
            $slug = sanitize_title($arrData['slug']);
        } else {
            $slug = sanitize_title($arrData['name']);
        }
        $createSlug = $fvnController->getHelper('CreateSlug');

        if ($action == 'add') {
            $optionSlug = array('table' => 'fvn_sp_manufactuer', 'field' => 'slug');
        } else if($action == 'edit') {
            $optionSlug = array('table' => 'fvn_sp_manufactuer', 
                                'field' => 'slug',
                                'exception' => array(
                                    'field' => 'id', 
                                    'value' => absint($arrData['id'])
                                ));

        }
        $slug = $createSlug->getSlug($slug, $optionSlug);

        $table = $this->get_table_name('fvn_sp_manufactuer');
        $data = array(
            'name'      => $arrData['name'],
            'slug'      => $slug,
            'status'    => $arrData['status'],
        );
        $format = array('%s', '%s', '%d');
        if ($action == 'add') {
            $wpdb->insert($table, $data, $format);
           
        } else if($action = 'edit') {
            $where = array('id' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
            
        }
    }

    public function get_item($arrData = array(), $options = array()) {
        global $wpdb;
        $table = $this->get_table_name('fvn_sp_manufactuer');
        if (isset($options['type']) && $options['type'] == 'all') {
            $status = isset($arrData['status'])? absint($arrData['status']):'all';
            if ($status == 'all') {
                $sql = "SELECT * FROM $table";
            } else {
                $sql = "SELECT * FROM $table WHERE status = $status ORDER BY name ASC";
            }
            $result = $wpdb->get_results($sql, ARRAY_A);
        } else {
            $id = absint($arrData['id']);
            $sql = "SELECT * FROM $table WHERE id=$id";
            $result = $wpdb->get_row($sql, ARRAY_A);
        }
        return $result;
    }
    public function change_status($arrData = array(), $options = array()) {
        global $wpdb;
        $status = ($arrData['action'] == 'active')?1:0;
        $table = $this->get_table_name('fvn_sp_manufactuer');
        
        if (is_array($arrData['id'])) {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
          
            $sql = "UPDATE $table SET status = $status WHERE id IN ($ids)";
            $wpdb->query($sql);
        } else {
            $data = array('status' => absint($status));
            $where = array('id' => absint($arrData['id']));
            $wpdb->update($table, $data, $where);
        }
    }

    public function deleteItem($arrData = array(), $options = array()) {
        global $wpdb;
        
        $table = $this->get_table_name('fvn_sp_manufactuer');
        
        if (is_array($arrData['id'])) {
            $arrData['id'] = array_map('absint', $arrData['id']);
            $ids = join(',', $arrData['id']);
          
            $sql = "DELETE FROM $table WHERE id IN ($ids)";
            $wpdb->query($sql);
        } else {
            $where = array('id' => absint($arrData['id']));
            $wpdb->delete($table, $where);
        }
    }

    public function get_columns() {
        $arr = array(
            'cb' => '<input type="checkbox" />', //Tạo ô checkbox all
            'id' => 'id',
            'name' => 'name',
            'slug' => 'slug',
            'status' => 'Status',
        );
        return $arr;
    }
    public function get_hidden_columns() {
        $arr = array();
        return $arr;
    }
    public function get_sortable_columns() {
        // Truyền vào cột có thể thao tác sort by
        $arr = array(
            'id' => array('id', true),
            'name' => array('name', true),
        );
        return $arr;
    }
    public function get_bulk_actions() {
        $action = array(
        'delete' => 'Delete', 
        'active' => 'Active', 
        'inactive' => 'Inactive'
        );
        return $action;
    }
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
            $attr = array(
                'id' => 'filter_action',
                'class' => 'button'
            );
            $btnFilter = $htmlObj->button('filter_action', 'Filter', $attr);
            $html = '<div class="alignleft actions bulkactions">
                    '.$slbFilter.$btnFilter.'
                    </div>';
            echo $html;
        }
    }

    protected function column_default($item, $column_name) {
        return $item[$column_name];
    }
    protected function column_cb($item) {
        $singular = $this->_args['singular'];
        $html = '<input type="checkbox" name="' . $singular . '[]" value="' . $item['id'] . '" />';
        return $html;
    }
    protected function column_name($item) {
        global $fvnController;
        $page = $fvnController->getParams('page');

        $name = 'security_code';
        $linkDelete = add_query_arg(array('action' => 'delete', 'id' => $item['id']));
        $action = 'delete_id_'.$item['id'];
        $linkDelete = wp_nonce_url($linkDelete, $action, $name);
        $actions = array(
            'edit' => '<a href="?page='.$page.'&action=edit&id='.$item['id'].'">Edit</a>',
            'delete' => '<a href="'.$linkDelete.'">Delete</a>',
            'view' => '<a href="#">View</a>'
        );
        $html = '<strong><a href=?page="'.$page.'&action=edit&id='.$item['id'].'">'.$item['name'].'</a></strong>'.$this->row_actions($actions);
        return $html;
    }
    protected function column_status($item) {
        global $fvnController;
        $page = $fvnController->getParams('page');
        if ($item['status'] == 1) {
            $action = 'inactive';
            $src = $fvnController->get_image_url('800px-Sign-check-icon.png', 'icon');
        } else {
            $action = 'active';
            $src = $fvnController->get_image_url('png-red-round-close-x-icon-31631915146jpppmdzihs.png', 'icon');
        }
        $paged = max(1, @$_REQUEST['paged']);
        
        $name = 'security_code';
        $linkStatus = add_query_arg(array('action' => $action, 'id' => $item['id'], 'paged' => $paged));
        $action = $action.'_id_'.$item['id'];
        $linkStatus = wp_nonce_url($linkStatus, $action, $name);

        $html = '<img alt="" src="'.$src.'" style="width: 30px;" />';
        $html = '<a href="'.$linkStatus.'">'.$html.'</a>';
        return $html;
    }
    public function create_database() {
        global $wpdb;

		if($wpdb->get_var("SHOW tables like '".$this->get_table_name('fvn_sp_manufactuer')."'") != $this->get_table_name('fvn_sp_manufactuer')){
		 $table_query = "CREATE TABLE `".$this->get_table_name('fvn_sp_manufactuer')."` (
								`id` int(11) NOT NULL AUTO_INCREMENT,
								`name` varchar(150) DEFAULT NULL,
								`slug` varchar(150) DEFAULT NULL,
								`status` TINYINT DEFAULT 0,
								PRIMARY KEY (`id`)
							 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"; // table create query

		 require_once (ABSPATH.'wp-admin/includes/upgrade.php');
		 dbDelta($table_query);
		} else {
            // echo "Table ".$this->get_table_name('fvn_sp_manufactuer')." đã được tạo";
        }
    }

    public function get_table_name($name=''){
		global $wpdb;
        if (!empty($name)) {
            return $wpdb->prefix.$name;
        }
        return false;
	}
}