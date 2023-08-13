<?php
class Fvn_Sp_Session_Helper {
    public $_ssName;
    public function __construct() {
        $this->_ssName = 'ss_'.md5(FVN_SP_PLUGIN_NANME.FVN_SP_PLUGIN_VERSION);
        if (!isset($_SESSION[$this->_ssName])) {
            $_SESSION[$this->_ssName] = array();
        }
    }

    public function set($name = null, $value = null) {
        if ($name != null || !empty($name)) {
            $_SESSION[$this->_ssName][$name] = $value;
        }
    }
    public function get($name = null, $default = null) {
        if ($name == null) {
            return $_SESSION[$this->_ssName];
        } else {
           return (!isset($_SESSION[$this->_ssName][$name])) ? $default: $_SESSION[$this->_ssName][$name];
        }
    }

    public function reset() {
        $_SESSION[$this->_ssName] = array();
    }
}