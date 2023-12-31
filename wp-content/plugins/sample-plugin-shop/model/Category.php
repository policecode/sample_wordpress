<?php
class Fvn_Sp_Category_Model {
    public function __construct()
    {
        
    }

    public function create() {
     
        $labels = array(
            'name' => 'Fvn Categories',//Tên số nhiều của taxonomies 
            'singular' => 'Fvn Category', // Tên số ít của taxonomy
            'menu_name' => 'Category', //extend name
            'edit_item' => 'Edit Category', // Nhãn xuất hiện phần edit
            'update_item' => 'Update Category', // Nhãn xuất hiện ở thẻ cập nhật
            'add_new_item' => 'Add new Category', //btn thêm mới
            'search_items' => 'Search book category', // btn tìm kiếm
        );
        $args = array(
            'labels' => $labels,
            'public' => true, //Có hiển thị hay không
            'show_ui' => true, // Hiển thị thẻ menu ở admin
            'show_in_nav_menus' => true,
            'show_tagcloud' => false, // HIển thị những giá trị trong thẻ widget mặc định
            'hierarchical' => true, //Hiển thị phân cấp
            'show_admin_column' => true, //Hiển thị trong phần liệt kê table
            'query_var' => true,
        );
         register_taxonomy('fvn-category', 'fvn-product', $args );
    }
}