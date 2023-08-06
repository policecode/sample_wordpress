<?php
class Fvn_Sp_AdminCategories_Controller {
    private $_prefix_name ='fvn-sp-category';
    private $_prefix_id ='fvn-sp-category-';

    public function __construct()
    {
        global $fvnController;
        $modelCategory = $fvnController->getModel('Category');

        /**
         * Đưa phương thức tạo category vào trong model, phục vụ cho việc gọi category ở BE và FE riêng biệt
         */
        add_action('init', array($modelCategory, 'create'));

        if ($fvnController->getParams('taxonomy') == 'fvn-category') {
            /**
             * Custom form cho phần category, form add-edit
             */
            add_action('fvn-category_add_form_fields', array($this, 'display'));
            add_action('fvn-category_edit_form_fields', array($this, 'display'));
            /**
             * Lưu phần custom category thêm vào database
             */
            add_action('edited_fvn-category', array($this, 'save'));
            add_action('created_fvn-category', array($this, 'save'));

        }
    }

 
    public function display($term) {
        global $fvnController;
        
        $htmlObj = new FvnSetupHtml();
        $action = ($fvnController->getParams('tag_ID') != '') ? 'edit':'add';
        
        // Tạo nút btn
        $inputId = $this->create_id('button');
        $inputName = $this->create_name('button');
        $inputValue = esc_attr__('Media Library image');
        $arr = array('class' => 'button-secondary', 'id' => $inputId);
        $options = array('type' => 'button');
        $btnMedia = $htmlObj->button($inputName, $inputValue, $arr, $options);
        
        // Tạo phần tử chưa Picture
        if (is_object($term)) {
            $option_name = $this->_prefix_id.$term->term_id;
            $option_value = get_option($option_name);
        }
        $inputId = $this->create_id('picture');
        $inputName = $this->create_name('picture');
        $inputValue = esc_url(@$option_value['picture']);
        $arr = array('size' => '40', 'id' => $inputId);

        if ($action == 'add') {
            $html = '<div class="form-field">'
                .$htmlObj->label(esc_html__('Image of Categpry'), array('for' => $inputId))
                .$htmlObj->textbox($inputName, $inputValue, $arr)
                .' '.$btnMedia
                .$htmlObj->pTag(esc_html__('Upload image for category'))
                .'</div>';
            echo $html;
        } else if ($action == 'edit') {
            $lblPicture = $htmlObj->label(esc_html__('Image of Categpry'), array('for' => $inputId));
            $inputPicture = $htmlObj->textbox($inputName, $inputValue, $arr);
            $pPicture = $htmlObj->pTag(esc_html__('Upload image for category'));

            $fvnController->_data = array(
                'lblPicture' => $lblPicture,
                'inputPicture' => $inputPicture.' '.$btnMedia,
                'pPicture' => $pPicture
            );
            $fvnController->getView('display', DS.'backend'.DS.'categories');

        }
        echo $htmlObj->btn_media_script($this->create_id('button'), $this->create_id('picture'));
    }

    public function save($term_id) {
        global $fvnController;
        if ($fvnController->isPost()) {
            $option_name = $this->_prefix_id.$term_id;
            update_option($option_name, $fvnController->getParams($this->_prefix_name));
            $url = 'edit-tags.php?taxonomy=fvn-category&post_type=fvn-product&msg=1';
            wp_redirect($url);
            die;
        }
    }

    private function create_name($val) {
        return $this->_prefix_name.'['.$val.']';
    }
    private function create_id($val) {
        return $this->_prefix_id.$val;
    }


}