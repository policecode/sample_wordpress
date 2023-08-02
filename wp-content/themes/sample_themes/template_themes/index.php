
<?php 
require_once 'define.php';
if (!class_exists('FvnHtml') && is_admin()) {
    require_once FVN_THEME_TEMPLATE_INC_DIR.'/html.php';
}
require_once FVN_THEME_TEMPLATE_ASSETS_DIR.'/add_styles.php';

// Cac file khoi tao chuc nang trong theme
foreach (glob(FVN_THEME_TEMPLATE_SYSTEM_DIR.'/*.php') as $key => $dir) {
    require_once $dir;
}
// WIDGET
require_once FVN_THEME_TEMPLATE_WIDGET_DIR.'/main.php';
new Fvn_Thene_Widget_Main();