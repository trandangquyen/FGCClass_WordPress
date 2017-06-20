<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
require( plugin_dir_path( __FILE__ ) . 'includes/functions.php' );
$meta_arr = array_merge(ics_return_arr('content'), ics_return_arr('background'));
$meta_arr = array_merge(ics_return_arr('general_options'), $meta_arr);
$meta_arr = array_merge(ics_return_arr('timeout'), $meta_arr);
$meta_arr = array_merge(ics_return_arr('subscribe'), $meta_arr);
foreach( $meta_arr as $k=>$v ){
    delete_option($k);
}
delete_option('ics_email_list');
?>