<?php
class Fvn_Sp_Frontend {
    private $_cssFlag = false;
    public function __construct() {
        global $fvnController;
     
        add_action('wp_enqueue_scripts', array($this, 'add_css_file'));
        add_action('wp_enqueue_scripts', array($this, 'add_js_file'));

        /**
         * Khởi tạo Session
         */
        add_action('init', array($this, 'session_start'), 1);
        /**
         * Xử lý việc không redirect được
         */
        add_action('init', array($this, 'do_output_buffer'));
    }
    public function do_output_buffer() {
        ob_start();
    }
    public function session_start() {
        if (!session_id()) {
            // Khởi tạo session
            session_start();
        }
    }

    public function add_js_file() {
        global $fvnController;
     
    }

    public function add_css_file() {
       
    }

}