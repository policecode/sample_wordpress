<?php
class Fvn_Sp_CreateSlug_Helper {
    public function __construct() {

    }

    /**
     * $option():
     *      - 'table'=> 'wp_fvn_sp_manufactuer'
     *      - 'field' => 'slug'
     *      - 'exception' => array('field' => 'id', 'value' => 2)
     */
    public function getSlug($val = '', $option = array(0)) {
        global $wpdb, $fvnController;

        $newVal = $val;
        $result = array();
        $table = $wpdb->prefix. $option['table'];
        $field = $option['field'];
        for ($i=0; $i < 999; $i++) { 
            if ($i > 0) {
                $newVal = $val.'-'.$i;
            }
            if (!isset($option['exception'])) {
                
                $sql = "SELECT COUNT(id) FROM $table
                    WHERE $field = '$newVal'";
                $sql = $wpdb->prepare($sql, '%s', '%s', '%s');
                $result = $wpdb->get_col($sql);
            } else {
                $excep_field = $option['exception']['field'];
                $excep_value = $option['exception']['value'];
                $sql = "SELECT COUNT(id) FROM $table
                WHERE $field = '$newVal' AND $excep_field != $excep_value";
                $sql = $wpdb->prepare($sql, '%s', '%s', '%s', '%s', '%s');
                $result = $wpdb->get_col($sql);
            }
            if ($result[0] == 0) {
                return $newVal;
            }
        }
    }
}