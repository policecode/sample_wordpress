
<?php 
require_once 'define.php';

require_once FVN_THEME_TEMPLATE_ASSETS_DIR.'/add_styles.php';

// echo '<pre>';
// echo var_dump(glob(FVN_THEME_TEMPLATE_WIDGET_DIR.'/*.php'));
// echo '</pre>';
foreach (glob(FVN_THEME_TEMPLATE_SYSTEM_DIR.'/*.php') as $key => $dir) {
    require_once $dir;
}
