<?php 
class Fvn_Sp_Login_Controller {
    public function __construct() {
        // add_action( 'login_form_bottom', array($this, 'add_lost_password_link') );
        // login_form_top -login_form_middle - login_form_bottom
    }
    
    function add_lost_password_link() {
      return '<a href="' . esc_url(home_url('/')) . '/wp-login.php?action=lostpassword">Lost Password?</a>';
    }
    
}