<?php
class Fvn_Sp_Setting_Config {

    public function get() {
        return array(
            'product_number' => 15,
            'currency_unit' => 'VND',
            'payment' => array('send_mail'),
            'alert_to_email' => get_bloginfo('admin_email'),
            'select_type' => 'system',
            'email_address' => 'youremail@something.com',
            'from_name' => 'Fvn Team',
            'smtp_host' => 'mail.something.com',
            'encription' => 'none',
            'smpt_port' => 25,
            'smtp_auth' => 'yes',
            'smtp_password' => 'youremail@something.com',
            'smtp_username' => '123456'

        );
    }
}