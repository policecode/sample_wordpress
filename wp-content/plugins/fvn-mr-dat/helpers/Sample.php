<?php
class Fvn_Sp_Sample_Helper {
    private static $instance = null;

    public function __construct() {
        
    }

    public static function getInstance() {
        if (self::$instance == null) {
            $objHelper = new Fvn_Sp_Sample_Helper();
            self::$instance = $objHelper;
        }

        return self::$instance;
    }
}