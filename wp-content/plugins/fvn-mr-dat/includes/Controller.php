<?php
/**
 * Hỗ trợ việc map tới các file trong plugin
 */
if (!class_exists('fvnController')) {
    class fvnController {
        public function __construct($options = array()) {
            
        }
        public function is_post() {
            $flag = ($_SERVER['REQUEST_METHOD'] == 'POST')?true:false;
            return $flag;
        }
        public function get_params($name = null) {
            if ($name == null) {
                return $_REQUEST;
            } else {
                $val = (isset($_REQUEST[$name]))?$_REQUEST[$name]:'';
                return $val;
            }
        }
        public function get_config($filename = 'AdminShopping', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_CONFIG_PATH. $filename . '.php';
            } else {
                $file = FVN_CONFIG_PATH. $dir. DS . $filename . '.php';
            }
                if (file_exists($file)) {
                   require_once $file;
                   $controllerName = FVN_SP_PREFIX.$filename.'_Config';
                   $obj = new $controllerName ();
               }
    
            return $obj;
        }
        public function get_controller($filename = '', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_CONTROLLER_PATH. $filename . '.php';
            } else {
                $file = FVN_CONTROLLER_PATH. $dir. DS . $filename . '.php';
            }
                if (file_exists($file)) {
                   require_once $file;
                   $controllerName = FVN_SP_PREFIX.$filename.'_Controller';
                   $obj = new $controllerName ();
               }
    
            return $obj;
        }
    
        public function get_model($filename = 'Categories', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_MODELS_PATH. $filename . '.php';
            } else {
                $file = FVN_MODELS_PATH. $dir. DS . $filename . '.php';
            }
                if (file_exists($file)) {
                   require_once $file;
                   $modelName = FVN_SP_PREFIX.$filename.'_MODEL';
                   $obj = new $modelName ();
               }
    
            return $obj;
        }
    
        public function get_helper($filename = 'Categories', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_HELPERS_PATH. $filename . '.php';
            } else {
                $file = FVN_HELPERS_PATH. $dir. DS . $filename . '.php';
            }
            if (file_exists($file)) {
                require_once $file;
                $helperName = FVN_SP_PREFIX.$filename.'_Helper';
                $obj = $helperName::getInstance();
            }
    
            return $obj;
        }
    
        public function get_view($filename = '', $dir = '') {
            if (empty($dir)) {
                $file = FVN_TEMPLATES_PATH. $filename . '.php';
            } else {
                $file = FVN_TEMPLATES_PATH. $dir. DS . $filename . '.php';
            }
            if (file_exists($file)) {
                require_once $file;
            }
        }
    
        public function get_validate($filename = '', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_VALIDATE_PATH. $filename . '.php';
    
            } else {
                $file = FVN_VALIDATE_PATH. $dir. DS . $filename . '.php';
            }
                if (file_exists($file)) {
                   require_once $file;
                   $validateName = FVN_SP_PREFIX.$filename.'_Validate';
                   $obj = $validateName::getInstance();
               }
    
            return $obj;
        }
    
        public function get_css_url($filename = '', $dir = '') {
            $url = FVN_PLUGIN_CSS_URL.$dir.'/'.$filename.'.css';
            $headers = @get_headers($url);
            // Phương thức tìm ký tự trong một chuỗi
            $flag = stripos($headers[0], "200 OK")?true:false;
            if ($flag) {
                return $url;
            }
            return false;
        }
        public function get_js_url($filename = '', $dir = '') {
            $url = FVN_PLUGIN_JS_URL.$dir.'/'.$filename.'.js';
            $headers = @get_headers($url);
            // Phương thức tìm ký tự trong một chuỗi
            $flag = stripos($headers[0], "200 OK")?true:false;
            if ($flag) {
                return $url;
            }
            return false;
        }
        public function get_image_url($filename = '', $dir = '') {
            $url = FVN_PLUGIN_IMAGE_URL.$dir.'/'.$filename;
            $headers = @get_headers($url);
            // Phương thức tìm ký tự trong một chuỗi
            $flag = stripos($headers[0], "200 OK")?true:false;
            if ($flag) {
                return $url;
            }
            return false;
        }
    }
}