<?php
/**
 * Hỗ trợ việc map tới các file trong plugin
 */
if (!class_exists('fvnController')) {
    class FvnController {
        public $_errors = array(); //Xử lý việc truyền dữ liêu từ controller sang view
        public $_data = array(); //Xử lý việc truyền dữ liệu từ controller sang view
        public function __construct($options = array()) {
            
        }

        /**
         * Kiểm tra phương thức request
         */
        public function isPost() {
            $flag = ($_SERVER['REQUEST_METHOD'] == 'POST')?true:false;
            return $flag;
        }

        /**
         * Lấy dữ liệu request
         */
        public function getParams($name = null) {
            if ($name == null) {
                return $_REQUEST;
            } else {
                $val = (isset($_REQUEST[$name]))?$_REQUEST[$name]:'';
                return $val;
            }
        }
        public function getConfig($filename = '', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_SP_CONFIG_PATH. DS . $filename . '.php';
            } else {
                $file = FVN_SP_CONFIG_PATH. $dir. DS . $filename . '.php';
            }
                if (file_exists($file)) {
                   require_once $file;
                   $controllerName = FVN_SP_PREFIX.$filename.'_Config';
                   $obj = new $controllerName ();
               }
    
            return $obj;
        }
        /**
         * Lấy file ở trong thư mục controller và khởi tạo class được kết nối
         * D:\Program Files\xampp\htdocs\wordpress\learn_v1\wp-content\plugins\sample-plugin-shop\controller
         */
        public function getController($filename = '', $dir = '') {
            $obj = new stdClass();
            $file = '';
            if (empty($dir)) {
                $file = FVN_SP_CONTROLLER_PATH. DS . $filename . '.php';
            } else {
                $file = FVN_SP_CONTROLLER_PATH. $dir. DS . $filename . '.php';
            }
            if (file_exists($file)) {
                require_once $file;
                $controllerName = FVN_SP_PREFIX.$filename.'_Controller';
                $obj = new $controllerName ();
            }
    
            return $obj;
        }
    
        /**
         * Lấy file chứa Model và khởi tạo class
         * D:\Program Files\xampp\htdocs\wordpress\learn_v1\wp-content\plugins\sample-plugin-shop\model
         */
        public function getModel($filename = '', $dir = '') {
            $obj = new stdClass();
            $file = '';
            if (empty($dir)) {
                $file = FVN_SP_MODEL_PATH. DS . $filename . '.php';
            } else {
                $file = FVN_SP_MODEL_PATH. $dir. DS . $filename . '.php';
            }
                if (file_exists($file)) {
                   require_once $file;
                   $modelName = FVN_SP_PREFIX.$filename.'_Model';
                   $obj = new $modelName ();
               }
    
            return $obj;
        }
    
        /**
         * Lấy file chứa Helper và khởi tạo class
         * D:\Program Files\xampp\htdocs\wordpress\learn_v1\wp-content\plugins\sample-plugin-shop\helpers
         */
        public function getHelper($filename = '', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_SP_HELPER_PATH. DS . $filename . '.php';
            } else {
                $file = FVN_SP_HELPER_PATH. $dir. DS . $filename . '.php';
            }
            if (file_exists($file)) {
                require_once $file;
                $helperName = FVN_SP_PREFIX.$filename.'_Helper';
                $obj = new $helperName ();
            }
    
            return $obj;
        }
    
        /**
         * Lấy file chứa view
         * D:\Program Files\xampp\htdocs\wordpress\learn_v1\wp-content\plugins\sample-plugin-shop\templates
         */
        public function getView($filename = '', $dir = '') {
            $file = '';
            if (empty($dir)) {
                $file = FVN_SP_TEMPLATE_PATH. DS . $filename. '.php';
            } else {
                $file = FVN_SP_TEMPLATE_PATH. $dir. DS . $filename. '.php';
            }
            // echo $file.'<br>';
            // var_dump(file_exists($file));
            if (file_exists($file)) {
                require_once $file;
            }
        }
    
        public function getValidate($filename = '', $dir = '') {
            $obj = new stdClass();
            if (empty($dir)) {
                $file = FVN_SP_VALIDATE_PATH. DS . $filename . '.php';
    
            } else {
                $file = FVN_SP_VALIDATE_PATH. $dir. DS . $filename . '.php';
            }
            if (file_exists($file)) {
                require_once $file;
                $validateName = FVN_SP_PREFIX.$filename.'_Validate';
                $obj = new $validateName ();
            }
    
            return $obj;
        }

        public function getCssUrl($filename = '', $dir = '') {
            $url = FVN_SP_CSS_URL.$dir.'/'.$filename.'.css';
            $headers = @get_headers($url);
            // Phương thức tìm ký tự trong một chuỗi
            $flag = stripos($headers[0], "200 OK")?true:false;
            if ($flag) {
                return $url;
            }
            return false;
        }
        public function getJsUrl($filename = '', $dir = '') {
            $url = FVN_SP_JS_URL.$dir.'/'.$filename.'.js';
            $headers = @get_headers($url);
            // Phương thức tìm ký tự trong một chuỗi
            $flag = stripos($headers[0], "200 OK")?true:false;
            if ($flag == true) {
                return $url;
            }
            return false;
        }
        public function getImageUrl($filename = '', $dir = '') {
            $url = FVN_SP_IMAGE_URL.$dir.'/'.$filename;
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