<?php
if (!defined('FVN_PLUGIN')) {
    define('FVN_PLUGIN', true);
    /**
     * ============ URL =========================
     */
    define('FVN_PLUGIN_URL', plugin_dir_url(__FILE__));
    define('FVN_PLUGIN_PUBLIC_URL', FVN_PLUGIN_URL.'public/');
    define('FVN_PLUGIN_CSS_URL', FVN_PLUGIN_PUBLIC_URL.'css/');
    define('FVN_PLUGIN_JS_URL', FVN_PLUGIN_PUBLIC_URL.'js/');
    define('FVN_PLUGIN_IMAGE_URL', FVN_PLUGIN_PUBLIC_URL.'image/');
    
    /**
     * ============ PATH =========================
     */
    define('DS', DIRECTORY_SEPARATOR);//Dấu sổ tự thay đổi theo hệ điều hành
    define('FVN_PLUGIN_PATH', plugin_dir_path(__FILE__));
    define('FVN_CONFIG_PATH', FVN_PLUGIN_PATH.'configs'.DS);
    define('FVN_CONTROLLER_PATH', FVN_PLUGIN_PATH.'controllers'.DS);
    define('FVN_HELPERS_PATH', FVN_PLUGIN_PATH.'helpers'.DS);
    define('FVN_INCLUDES_PATH', FVN_PLUGIN_PATH.'includes'.DS);
    define('FVN_MODELS_PATH', FVN_PLUGIN_PATH.'models'.DS);
    define('FVN_PUBLIC_PATH', FVN_PLUGIN_PATH.'public'.DS);
    define('FVN_TEMPLATES_PATH', FVN_PLUGIN_PATH.'templates'.DS);
    define('FVN_VALIDATE_PATH', FVN_PLUGIN_PATH.'validate'.DS);
    
    /**
     * ============ ORTHER =========================
     */
    define('FVN_SP_PREFIX', 'Fvn_Sp_');
    define('FVN_IMAGE_PATH', FVN_PUBLIC_PATH.'image'.DS);
    define('FVN_PLUGIN_VERSION', '1.0.0');
    define('FVN_PLUGIN_NAME', 'FVN_PLUGIN_SHOP');
}

