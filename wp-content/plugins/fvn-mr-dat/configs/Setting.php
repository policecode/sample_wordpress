<?php
class Fvn_Sp_Setting_Config {
    public function get() {
        $arr = array(
            'product_number' 	=> 15,
				'currency_unit' 	=> 'VND',
				'payment' 			=> array('send_mail'),
				'alert_to_email' 	=> get_bloginfo('admin_email'),
				'select_type' 		=> 'system',
				'email_address' 	=> 'yourmail@something.com',
				'from_name' 		=> 'ZendVN Team',
				'smtp_host' 		=> 'mail.something.com',
				'encription' 		=> 'none',
				'smpt_port' 		=> 25,
				'smtp_auth' 		=> 'yes',
				'smtp_password' 	=> 'yourmail@something.com',
				'smtp_username' 	=> '123456'
        );
        return $arr;
    }
}