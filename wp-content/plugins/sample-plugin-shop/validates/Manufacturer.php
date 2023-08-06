<?php
class Fvn_Sp_Manufacturer_Validate {
    private $_errors = array(); //Lưu các thông báo lỗi
    private $_data = array(); // Lưu dữ liệu từ trong form
    public function __construct()
    {
        
    }

    public function isValidate($options = array()) {
        global $fvnController;
        $flag = false;
        $action = $fvnController->getParams('action');
        
        /**
         * Kiểm tra theo wp_nonce_field() có ở form nhập
         */
        if (check_admin_referer($action, 'security_code')) {
            $this->_data = $fvnController->getParams();
            // ============= Kiểm tra input 'name' ================
            $name = $fvnController->getParams('name');
            if (mb_strlen($name) < 3) {
                $this->_errors['name'] = __('Manufacturer name: Value mist be greater than 2 charater');
                $this->_data['name'] = '';
            }

            // ============= Kiểm tra input 'slug' ================
            $slug = $fvnController->getParams('slug');
            if (!empty($slug)) {
                $this->_data['slug'] = sanitize_title($slug);
            }

            if (count($this->_errors) == 0) {
                $flag = true;
            }
        }
        return $flag;
    }

    public function getErrors($name = '') {
        if (empty($name)) {
            return $this->_errors;
        } else {
            return (isset($this->_errors[$name]) ? $this->_errors[$name]: '');
        }
    }

    public function getData($name = '') {
        if (empty($name)) {
            return $this->_data;
        } else {
            return (isset($this->_data[$name]) ? $this->_data[$name]: '');
        }
    }
}