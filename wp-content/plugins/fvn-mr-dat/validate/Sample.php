<?php
class Fvn_Sp_Sample_Validate {
    private static $instance = null;
    private $_errors = array();
    private $_data = array();
    public function __construct() {
        
    }

    public static function getInstance() {
        if (self::$instance == null) {
            $objValidate = new Fvn_Sp_Sample_Validate();
            self::$instance = $objValidate;
        }

        return self::$instance;
    }

    public function isValidate($options = array()) {
        global $fvnController;
       
    }

    public function getErrors($name = '') {
        if (empty($name)) {
            return $this->_errors;
        } else {
            return isset($this->_errors[$name])?isset($this->_errors[$name]):'';
        }
    }

    public function getData($name = '') {
        if (empty($name)) {
            return $this->_data;
        } else {
            return isset($this->_data[$name])?isset($this->_data[$name]):'';
        }
    }
    public function setData($dataArr = array()) {
        return $this->_data = $dataArr;
    }
}