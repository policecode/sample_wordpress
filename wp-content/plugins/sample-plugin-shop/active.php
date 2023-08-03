<?php
global $wpdb;
$table_manufacturer = $wpdb->prefix."fvn_sp_manufacturer";
if($wpdb->get_var("SHOW tables like '".$table_manufacturer."'") != $table_manufacturer){
    // tạo bảng manufacturer...
 $table_query = "CREATE TABLE `".$table_manufacturer."` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(50) DEFAULT NULL,
                        `slug` varchar(50) DEFAULT NULL,
                        `status` int(1) NOT NULL DEFAULT '1',
                        PRIMARY KEY (`id`)
                     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"; // table create query

 require_once (ABSPATH.'wp-admin/includes/upgrade.php');
 dbDelta($table_query);
}