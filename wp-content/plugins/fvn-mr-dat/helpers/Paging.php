<?php
class Fvn_Sp_Paging_Helper
{
    public function __construct()
    {
    }

    public function get_paging($queryObj = null)
    {
        if ($queryObj != null) {
            /**
             * Phương thức tạo 2 nútnext và preve
             */
            // posts_nav_link(' | ', '<< Preve', 'Next >>');
            /**
             * 2 Phương thức tạo nút next và preve
             */
            // next_posts_link();
            // previous_posts_link();
            /**
             * Phương thức tạo link thường dùng
             */
            global $wp_rewrite;
            // Setting up default values based on the current URL.
            $pagenum_link = html_entity_decode(get_pagenum_link());
            $url_parts    = explode('?', $pagenum_link);

            // Get max pages and current page out of the current query, if available.
            $total   = isset($queryObj->max_num_pages) ? $queryObj->max_num_pages : 1;
            $current = get_query_var('paged') ? (int) get_query_var('paged') : 1;

            // Append the format placeholder to the base URL.
            $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

            // URL base depends on permalink settings.
            $format  = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
            $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';
            $defaults = array(
                'base'               => $pagenum_link, //Đường dẫn phân trang
                'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
                'total'              => $total, //Tổng số trang
                'current'            => $current, //Kiểm tra trang hiện tại
                'aria_current'       => 'page',
                'show_all'           => false, // Hiển thị tất cả các trang
                'prev_next'          => false, // Hiển thị nút lùi và tiến của phân trang
                'prev_text'          => __('&laquo; Previous'), // Text của trang lùi
                'next_text'          => __('Next &raquo;'), // Text của trang tiến
                'end_size'           => 1, //Xuất hiện số trang ở 2 đầu phân trang
                'mid_size'           => 2, //Hiển thị số trang bên cạnh trang current
                'type'               => 'list', //Kiểu hiển thị:plain - array - list
                'add_args'           => array(), // Array of query args to add.
                // 'add_fragment'       => '?&test=abc',//Đưa thêm một chuỗi vào trong phần link
                'before_page_number' => '', //Thêm phần tử vào phía trước số phân trang
                'after_page_number'  => '', //Thêm phần tử vào phía sau số phân trang
            );
            return paginate_links($defaults);
        }
    }
}
