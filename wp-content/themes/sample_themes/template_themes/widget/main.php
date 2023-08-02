<?php
class Fvn_Thene_Widget_Main {

    private $_widget_options = array();

    public function __construct() {
        $this->_widget_options = array(
            'searchForm' => true
        );
        foreach ($this->_widget_options as $key => $value) {
            if ($value) {
                add_action('widgets_init', array($this, $key));
            }
        }
    }

    public function searchForm() {
        require_once FVN_THEME_TEMPLATE_WIDGET_DIR.'/searchForm.php';
        register_widget('Fvn_Theme_Widget_SearchForm');
    }
}
