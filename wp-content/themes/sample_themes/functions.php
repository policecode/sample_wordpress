<?php
// URL
define ( 'FVN_THEME_URL' , get_stylesheet_directory_uri() );

// DIR
define ( 'FVN_THEME_DIR' , get_stylesheet_directory() );
define ( 'FVN_THEME_TEMPLATE_DIR' , FVN_THEME_DIR.'/template_themes' );
define ( 'FVN_THEME_INC_DIR' , FVN_THEME_DIR.'/inc' );

// vào hệ thống xử lý theme
require_once FVN_THEME_TEMPLATE_DIR.'/index.php';