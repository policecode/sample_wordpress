<?php
class Fvn_Sp_AdminManafacturer_Controller {
    public function __construct()
    {
        $this->dispath_function();
    }

    /**
     * Điều hướng xử lý các thao tác trong table
     */
    public function dispath_function() {
        global $fvnController;
        $action = $fvnController->getParams('action');
        switch($action) {
            case 'add'      : $this->add(); break;
            case 'edit'     : $this->edit(); break;
            case 'delete'   : $this->delete(); break;
            case 'active'   :
            case 'inactive' : 
                $this->status(); break;
            default         : $this->display(); break;
        }
    }
    public function display() {
        global $fvnController;
        /**
         * Xử lý trường hợp tìm kiếm, lọc dữ liệu
         */
        if ($fvnController->getParams('action') == -1) {
            $url = $this->createUrl();
            wp_redirect($url);
        }
        $fvnController->getView('display', DS.'backend'.DS.'manafacturer');

    }

    /**
     * Tạo đường dẫn
     */
    public function createUrl() {
        global $fvnController;
        $url = 'admin.php?page='.$fvnController->getParams('page');
        // filter_status
        if ($fvnController->getParams('filter_status') != '0') {
            $url .= '&filter_status='.$fvnController->getParams('filter_status');
        }
        if (mb_strlen($fvnController->getParams('s')) > 1) {
            $url .= '&s='.$fvnController->getParams('s');
        }
        return $url;
    }

    public function add() {
        global $fvnController;
       
        if ($fvnController->isPost()) {
            /**
             * Validate trước khi lưu DB
             */
            $validate = $fvnController->getValidate('Manufacturer');
            $flag = $validate->isValidate();
            if ($flag) {
                // Lưu database
                $model = $fvnController->getModel('Manafacturer');
                $model->save_items($validate->getData());
                $url = 'admin.php?page='.$fvnController->getParams('page').'&msg=1';
                wp_redirect($url);
            } else {
                $fvnController->_errors = $validate->getErrors();
                $fvnController->_data = $validate->getData();
            }
        }
        // Form nhập liệu
        $fvnController->getView('data-form', DS.'backend'.DS.'manafacturer');

    }

    public function edit() {
        global $fvnController;
       
        if (!$fvnController->isPost()) {
            $model = $fvnController->getModel('Manafacturer');
            $fvnController->_data = $model->getItem($fvnController->getParams());
          
        } else {
            $validate = $fvnController->getValidate('Manufacturer');
            $flag = $validate->isValidate();
            if ($flag) {
                // Lưu database
                $model = $fvnController->getModel('Manafacturer');
                $model->save_items($validate->getData());
                $url = 'admin.php?page='.$fvnController->getParams('page').'&msg=1';
                wp_redirect($url);
            } else {
                $fvnController->_errors = $validate->getErrors();
                $fvnController->_data = $validate->getData();
            }
        }
        
        // Form nhập liệu
        $fvnController->getView('data-form', DS.'backend'.DS.'manafacturer');
    }

    public function delete() {
        global $fvnController;
        
        $arrParams = $fvnController->getParams();

        /**
         * Kiểm tra bảo mật khi gửi dữ liệu với 2 TH
         */
        if (!is_array($arrParams['id'])) {
            // id là một record
            $action = 'delete_id_'.$arrParams['id'];
            check_admin_referer($action, 'security_code');
        } else {
            // id là một mảng
            wp_verify_nonce('_wpnonce');
        }

        $model = $fvnController->getModel('Manafacturer');
        $model->deleteItem($arrParams);
        $url = 'admin.php?page='.$arrParams['page'].'&msg=1';
        wp_redirect($url);
        
    }

    public function status() {
        global $fvnController;
        
        $arrParams = $fvnController->getParams();

        /**
         * Kiểm tra bảo mật khi gửi dữ liệu với 2 TH
         */
        if (!is_array($arrParams['id'])) {
            // id là một record
            $action = $arrParams['action'].'_id_'.$arrParams['id'];
            check_admin_referer($action, 'security_code');
        } else {
            // id là một mảng
            wp_verify_nonce('_wpnonce');
        }

        $model = $fvnController->getModel('Manafacturer');
        $model->changeStatus($arrParams);
        $paged = max(1, $arrParams['paged']);
        $url = 'admin.php?page='.$arrParams['page'].'&paged='.$paged.'&msg=1';
        wp_redirect($url);
    }

    public function noAccess() {
        echo __METHOD__;
        
    }
}