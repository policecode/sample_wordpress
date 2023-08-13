<?php 
class Fvn_Sp_Product_Controller {
    public function __construct() {
        $this->dispath_function();
    }

    public function dispath_function() {
        global $fvnController;
        $action = $fvnController->getParams('action');
        switch ($action) {
            case 'add_cart':
                $this->add_cart();
                break;
            
            default:
                $this->display();
                break;
        }
    }

    public function add_cart() {
        global $fvnController;
        $id = (int) $fvnController->getParams('id');
        if ($id > 0) {
            $session = $fvnController->getHelper('Session');
            $ssCart = $session->get('fvn-cart', array());
            if (count($ssCart) == 0) {
                $ssCart[$id] = 1;
            } else {
                if (!isset($ssCart[$id])) {
                    $ssCart[$id] = 1;
                } else {
                    $ssCart[$id] = $ssCart[$id] + 1;
                }
            }
        }
        $session->set('fvn-cart', $ssCart);
        
        $URL = site_url( '?fvn-product='.get_query_var('fvn-product'));
        wp_redirect($URL);
    }

    public function display() {
        global $fvnController;
        $fvnController->getView('display', DS.'frontend'.DS.'product');
    }
}