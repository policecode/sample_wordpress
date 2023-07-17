<!-- HEADER -->
<!--[if lt IE 9]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<!-- <meta name='robots' content='noindex,follow' />
<link rel='stylesheet' href='<?php echo FVN_THEME_URL ?>/assets/css/symple_shortcodes_styles.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo FVN_THEME_URL ?>/assets/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo FVN_THEME_URL ?>/assets/css/responsive.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo FVN_THEME_URL ?>/assets/css/site.css' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo FVN_THEME_URL ?>/assets/js/jquery/jquery.js'></script>
<script type='text/javascript' src='<?php echo FVN_THEME_URL ?>/assets/js/jquery/jquery-migrate.min.js'></script> -->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen">
<![endif]-->

<!-- FOOTER -->
<!-- <script type='text/javascript' src='<?php echo FVN_THEME_URL ?>/assets/js/jquery.form.min.js'></script>
<script type='text/javascript' src='<?php echo FVN_THEME_URL ?>/assets/js/scripts.js'></script>
<script type='text/javascript' src='<?php echo FVN_THEME_URL ?>/assets/js/plugins.js'></script>
<script type='text/javascript'>
    /*           */
    var wpexLocalize = {
        "mobileMenuOpen": "Browse Categories",
        "mobileMenuClosed": "Close navigation",
        "homeSlideshow": "false",
        "homeSlideshowSpeed": "7000",
        "UsernamePlaceholder": "Username",
        "PasswordPlaceholder": "Password",
        "enableFitvids": "true"
    };
    /*     */
</script>
<script type='text/javascript' src='<?php echo FVN_THEME_URL ?>/assets/js/global.js'></script> -->
<?php
// Nạp những tập tin CSS
add_action('wp_enqueue_scripts', 'fvn_theme_register_style');
function fvn_theme_register_style() {
    global $wp_styles;
    wp_register_style('fvn_themes_symple_shortcodes_styles' ,FVN_THEME_URL.'/assets/css/symple_shortcodes_styles.css', array(), FVN_THEME_VERSION);
    wp_enqueue_style('fvn_themes_symple_shortcodes_styles');

    wp_register_style('fvn_themes_style' ,FVN_THEME_URL.'/assets/css/style.css', array(), FVN_THEME_VERSION);
    wp_enqueue_style('fvn_themes_style');

    wp_register_style('fvn_themes_responsive' ,FVN_THEME_URL.'/assets/css/responsive.css', array(), FVN_THEME_VERSION);
    wp_enqueue_style('fvn_themes_responsive');

    wp_register_style('fvn_themes_site' ,FVN_THEME_URL.'/assets/css/site.css', array(), FVN_THEME_VERSION);
    wp_enqueue_style('fvn_themes_site');

    wp_register_style('fvn_themes_ie8' ,FVN_THEME_URL.'/assets/css/ie8.css', array(), FVN_THEME_VERSION);
    $wp_styles->add_data('fvn_themes_ie8', 'conditional', 'IE 8');
    wp_enqueue_style('fvn_themes_ie8');
}

// Nạp những tập tin JS
add_action('wp_enqueue_scripts', 'fvn_theme_register_js');
function fvn_theme_register_js() {
    wp_register_script('fvn_themes_jquery_form_min' ,FVN_THEME_URL.'/assets/js/jquery.form.min.js', array('jquery'), FVN_THEME_VERSION, true);
    wp_enqueue_script('fvn_themes_jquery_form_min');

    wp_register_script('fvn_themes_scripts' ,FVN_THEME_URL.'/assets/js/scripts.js', array('jquery'), FVN_THEME_VERSION, true);
    wp_enqueue_script('fvn_themes_scripts');

    wp_register_script('fvn_themes_plugins' ,FVN_THEME_URL.'/assets/js/plugins.js', array('jquery'), FVN_THEME_VERSION, true);
    wp_enqueue_script('fvn_themes_plugins');

    wp_register_script('fvn_themes_global' ,FVN_THEME_URL.'/assets/js/global.js', array('jquery'), FVN_THEME_VERSION, true);
    wp_enqueue_script('fvn_themes_global');

}

add_action('wp_footer', 'fvn_theme_script_code');
function fvn_theme_script_code() {
    echo '<script type=\'text/javascript\'>
    var wpexLocalize = {
        "mobileMenuOpen": "Browse Categories",
        "mobileMenuClosed": "Close navigation",
        "homeSlideshow": "false",
        "homeSlideshowSpeed": "7000",
        "UsernamePlaceholder": "Username",
        "PasswordPlaceholder": "Password",
        "enableFitvids": "true"
    };
    </script>';
}