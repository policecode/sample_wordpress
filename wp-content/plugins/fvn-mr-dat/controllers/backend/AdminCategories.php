<?php
class Fvn_Sp_AdminCategories_Controller {
    private $_prefix_name = 'fvn-sp-category';
    private $_prefix_id = 'fvn-sp-category-';
    public function __construct() {
        global $fvnController;
        $model = $fvnController->getModel('Categories');
        add_action('init', array($model, 'create'));
        if ($fvnController->getParams('taxonomy') == 'fvn-category') {
            // Chèn thêm phần nhập liệu trong phần add và edit của category
            add_action('fvn-category_add_form_fields', array($this, 'display'));
            add_action('fvn-category_edit_form_fields', array($this, 'display'));

            add_action('admin_enqueue_scripts', array($this, 'add_js_file'));
            add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
            // Chèn thêm phương thức lưu vào trong DB
            add_action('edited_fvn-category', array($this, 'save'));
            add_action('create_fvn-category', array($this, 'save'));
        }
    }

    // public function display() {
    //     $htmlObj = new FvnSetupHtml();
    //     // Tạo button
    //     $inputID = $this->create_id('button');
    //     $inputName = $this->create_name('button');
    //     $inputValue = esc_attr__('Media Library Image');
    //     $arr = array('class' => 'button-seconaary', 'id' => $inputID);
    //     $options = array('type' => 'button');
    //     $btnMedia = $htmlObj->button($inputName, $inputValue, $arr, $options);
    //     // Tạo phần tử chứa picture
    //     $inputID = $this->create_id('picture');
    //     $inputName = $this->create_name('picture');
    //     $inputValue = esc_url(@$option_value['picture']);
    //     $arr = array('size' => 40, 'id' => $inputID);

    //     $html = '<div class="form-field">'
    //             .$htmlObj->label(esc_html__('Image of Category'), array('for' => 'tag-name'))
    //             .$htmlObj->textbox($inputName, $inputValue, $arr)
    //             .' '.$btnMedia
    //             .$htmlObj->pTag(esc_html__('Upload image for Fvn Category'))
    //             .'</div>';
    //     echo $html;
    //     echo $htmlObj->btn_media_script($this->create_id('button'),$this->create_id('picture'));
    // }

    public function display($turm) {
        global $fvnController;
        $htmlObj = new FvnSetupHtml();
        if (is_object($turm)) {
            $option_name = $this->_prefix_id.$turm->term_id;
            $option_value = get_option( $option_name );
        }
        $action = ($fvnController->getParams('tag_ID') != '')?'edit' : 'add';

        $inputID = $this->create_id('picture');
        $inputName = $this->create_name('picture');
        $inputValue = @$option_value['picture'];
        $arr = array( 'class' => 'widefat', 'id' => $inputID);
        if ($action == 'add') {
            $html = '<div class="form-field">'
                    .$htmlObj->label(esc_html__('Image of Category'), array('for' => $inputID))
                    .$htmlObj->textbox($inputName, $inputValue, $arr)
                    .$htmlObj->pTag(esc_html__('Upload image for Fvn Category'))
                    .'</div>';
            echo $html;
        } else if($action == 'edit'){
            echo '<tr class="form-field form-required term-name-wrap">
                    <th scope="row">'.$htmlObj->label(esc_html__('Image of Category'), array('for' => $inputID)).'</th>
                    <td>'.$htmlObj->textbox($inputName, $inputValue, $arr).'
                    '.$htmlObj->pTag(esc_html__('Upload image for Fvn Category')).'</td>
                </tr>';
        }
    }
    public function save($turm_id) {
        global $fvnController;
        if ($fvnController->isPost()) {
            $option_name = $this->_prefix_id.$turm_id;
            $relust = update_option($option_name, $fvnController->getParams($this->_prefix_name));
        }
    }

    public function add_js_file() {
        global $fvnController;
        // wp_enqueue_script('jquery-ver1', get_bloginfo('url').'/wp-includes/js/jquery/jquery.js', array(), '1.0');
        // wp_enqueue_script('media-upload-ver1', get_bloginfo('url').'/wp-admin/js/media-upload.js', array(), '1.0');
        // wp_enqueue_script('thickbox-ver1', get_bloginfo('url').'/wp-includes/js/thickbox/thickbox.js', array(), '1.0');
        wp_register_script('fvn_sp_btn_media', $fvnController->get_js_url('fvn-media-button'), array('jquery', 'media-upload', 'thickbox'), '1.0');
        wp_enqueue_script('fvn_sp_btn_media');
    }

    public function add_css_file() {
        wp_enqueue_style('thickbox');
    }
    public function create_name($val) {
        return $this->_prefix_name.'['.$val.']';
    }
    public function create_id($val) {
        return $this->_prefix_id.''.$val.'';
    }
}