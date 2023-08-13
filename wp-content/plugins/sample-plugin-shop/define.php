<?php

// ================== URL ==================
define('FVN_SP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FVN_SP_PUBLIC_URL', FVN_SP_PLUGIN_URL. 'public');
define('FVN_SP_CSS_URL', FVN_SP_PUBLIC_URL. '/css');
define('FVN_SP_IMAGE_URL', FVN_SP_PUBLIC_URL. '/images');
define('FVN_SP_JS_URL', FVN_SP_PUBLIC_URL. '/js');
define('FVN_SP_RESIZE_URL', FVN_SP_PUBLIC_URL. '/resize');

// ================== PATH ==================
define('DS', DIRECTORY_SEPARATOR);
define('FVN_SP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('FVN_SP_CONFIG_PATH', FVN_SP_PLUGIN_PATH.'configs');
define('FVN_SP_CONTROLLER_PATH', FVN_SP_PLUGIN_PATH.'controller');
define('FVN_SP_HELPER_PATH', FVN_SP_PLUGIN_PATH.'helpers');
define('FVN_SP_INCLUDES_PATH', FVN_SP_PLUGIN_PATH.'includes');
define('FVN_SP_MODEL_PATH', FVN_SP_PLUGIN_PATH.'model');
define('FVN_SP_PUBLIC_PATH', FVN_SP_PLUGIN_PATH.'public');
define('FVN_SP_TEMPLATE_PATH', FVN_SP_PLUGIN_PATH.'templates');
define('FVN_SP_VALIDATE_PATH', FVN_SP_PLUGIN_PATH.'validates');

// ================== ORTHER ==================
define('FVN_SP_PREFIX', 'Fvn_Sp_');
define('FVN_SP_PLUGIN_VERSION', '1.0.0');
define('FVN_SP_PLUGIN_NANME', 'FVN_SAMPLE_PLUGIN');

// resize