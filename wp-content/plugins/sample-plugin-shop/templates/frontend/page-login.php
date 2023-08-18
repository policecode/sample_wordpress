<?php
global $fvnController;
$fvnController->getView('header', DS . 'general');
$fvnController->getController('Login', DS . 'frontend');

?>
<!-- css files -->
<link rel="stylesheet" href="<?= $fvnController->getCssUrl('style-login'); ?>" type="text/css" media="all" /> <!-- Style-CSS -->
<!--form-stars-here-->
<div class="form-login-wrap">
    <div class="form-login">
        <h2>Đăng nhập</h2>
        <?php
        $home_url = get_home_url();
        if (is_user_logged_in()) {
            // echo 'Bạn đã đăng nhập rồi. <a href="' . wp_logout_url($home_url) . '">Đăng xuất</a> ?';
            wp_redirect($home_url);
        } else {
            $args = array(
                'redirect' => $home_url,
                'form_id' => 'login-form',
                'label_username' => 'Tài khoản',
                'label_password' => 'Mật khẩu',
                'remember' => true,
                'label_log_in' => 'Đăng nhập',
                'id_username' => 'user_login_custom',
                'id_password' => 'user_pass_custom',
                'id_remember' => 'rememberme',
                'id_submit' => 'wp-submit_custom'
            );
            wp_login_form($args);
        }
        ?>
        <div class="footer-login">
            <p>&copy; 2017 Glassy Login Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
        </div>
    </div>

</div>
<?php $fvnController->getView('footer', DS . 'general'); ?>