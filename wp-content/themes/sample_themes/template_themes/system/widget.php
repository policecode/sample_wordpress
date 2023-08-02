<?php
// KHAI BÁO HỆ THỐNG WIDGET CỦA THEME
add_action('widgets_init', 'fvn_theme_widgets_init');
function fvn_theme_widgets_init() {
    register_sidebar( array(
		/* translators: %d: Sidebar number. */
		'name'           => __( 'Primary widget area', 'fvn' ),
		'id'             => "primary-widget-area",
		'description'    => __( 'Thêm widget vào phía bên tay phải của website', 'fvn' ),
		'class'          => '',
		'before_widget'  => '<div id="%1$s" class="sidebar-widget clr %2$s">',
		'after_widget'   => "</div>\n",
		'before_title'   => '<span class="widget-title">',
		'after_title'    => "</span>\n",
		'before_sidebar' => '',
		'after_sidebar'  => '',
		'show_in_rest'   => false,
        )
    );
}
