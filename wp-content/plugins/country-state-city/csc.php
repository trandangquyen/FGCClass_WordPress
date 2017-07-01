<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
Plugin Name: Country State City
Plugin URI: http://www.NtechCorporate.com
Description: Country State City wordpress plugn.
Version: 1.0.0
Author: ntech-technologies
Author URI: http://www.NtechCorporate.com/
 * License: GPL2
 */
/*  Copyright 2014  N-Tech Technologies PVT LTD  (email : info@ntechcorporate.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Types
/*-----------------------------------------------------------------------------------*/
	require_once ( plugin_dir_path( __FILE__ ) . '/include/country-post-type.php' );
	require_once ( plugin_dir_path( __FILE__ ) . '/include/state-post-type.php' );
	require_once ( plugin_dir_path( __FILE__ ) . '/include/city-post-type.php' );


/*-----------------------------------------------------------------------------------*/
/*	Load Required JS Scripts
/*-----------------------------------------------------------------------------------*/
if(!function_exists('load_csc_scripts')){
	function load_csc_scripts(){
		if (is_admin()) {

			// Defining scripts directory url
			$java_script_url = plugin_dir_url( __FILE__ ).'js/';

			// Custom Script
			wp_register_script('jquery.validate.min',$java_script_url.'jquery.validate.min.js', array('jquery'));
			wp_register_script('custom',$java_script_url.'custom.js', array('jquery'), '1.0', true);

			// Enqueue Scripts that are needed on all the pages
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery.validate.min');
			wp_enqueue_script('custom');
		}
	}
}
add_action('admin_enqueue_scripts', 'load_csc_scripts');

add_action( 'wp_ajax_get_states_of_country', 'get_states_of_country' );
add_action( 'wp_ajax_nopriv_get_states_of_country', 'get_states_of_country' );

function get_states_of_country()
{
	global $wpdb; 
	$cid = intval( $_POST['CID'] );
	$state_posts = get_posts( array( 'post_type' => 'states', 'posts_per_page' => -1, 'suppress_filters' => 0, 'meta_query' => array(
		array(
			'key' => 'state_meta_box_country',
			'value' => $cid,
		)
	) ) );
	$state_ops = '<option value="">'.__('Select State')."</option>";
	if(!empty($state_posts)){
		foreach( $state_posts as $state_post ){
			$state_ops .= '<option value="'.$state_post->ID.'">'.$state_post->post_title."</option>";
		}
	}
	echo $state_ops;
	die(); // this is required to terminate immediately and return a proper response
}

function hide_country_add_new_custom_type()
{
    global $submenu;
    // replace my_type with the name of your post type
    unset($submenu['edit.php?post_type=countries'][10]);
}
add_action('admin_menu', 'hide_country_add_new_custom_type');


register_activation_hook( __FILE__, 'csc_activation_function' );
function csc_activation_function() {
	// Do stuff here
} 
?>