<?php
/**
Plugin Name: FGC Voice Recorder
Plugin URI: http://fgc.com
Description: This plugin was created to help teachers who want to manage exercises attached with voices...
Author: Quyền - Brian
Version: 1.0
Author URI: http://brian.com
*/
define('FGC_VOICE_FODPATH',plugin_dir_path(__FILE__) );
define('FGC_VOICE_FODURL',plugin_dir_url(__FILE__) );
class FGC_Voice_Recorder{
    function __construct()
    {
        //add js vs css to admin panel
        //add_action('admin_enqueue_scripts', array( $this, 'admin_style'));
        add_action('wp_enqueue_scripts', array( $this, 'voice_recorder_style'));
        //Create post type & taxonomy events
        add_action( 'init', array( $this, 'codex_voice_menu_init'));
    }
    // Update CSS and JS within in Admin area
    function voice_recorder_style() {
        wp_enqueue_style('admin-styles', FGC_VOICE_FODURL.'css/voice-recorder-style.css');
        wp_enqueue_script( 'admin-fgc-bootstrap-minjs', FGC_VOICE_FODURL. 'js/bootstrap.min.js', array(), 'v1', false );

    }

    // Create post type events
    function codex_voice_menu_init(){
    	$labels = array(
		'name'               => _x( 'Bài đọc', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Bài đọc', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Bài đọc', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Bài đọc', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Thêm bài đọc mới', 'Bài đọc', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Thêm bài đọc mới', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Bài đọc mới', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Sửa bài đọc', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Xem bài đọc', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Tất cả bài đọc', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Tìm kiếm bài đọc', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Các bài đọc cha:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Không có bài nào được tìm thấy.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Không có bài nào trong nháp.', 'your-plugin-textdomain' )
		);
		$args = array(
		'labels'             => $labels,
        'description'        => __( 'Bài đọc tiếng annh qua các chủ đề.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'voice-recorder' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
        'supports' => array('title', 'editor', 'publicize', 'excerpt', 'custom-fields', 'thumbnail', 'tags', 'comments','author')
		);

		register_post_type( 'voicerecorder', $args );
        $labels = array(
            'name' => __('Tất cả danh mục','fgc-manager'),
            'singular_name' => __('Danh mục','fgc-manager'),
            'search_items' => __('Search Categories','fgc-manager'),
            'all_items' => __('All Categories','fgc-manager'),
            'parent_item' => __('Parent Category','fgc-manager'),
            'parent_item_colon' => __('Parent Category:','fgc-manager'),
            'edit_item' => __('Edit Category','fgc-manager'),
            'update_item' => __('Update Category','fgc-manager'),
            'add_new_item' => __('Add New Category','fgc-manager'),
            'new_item_name' => __('New Category Name','fgc-manager'),
            'menu_name' => __('Danh mục bài đọc','fgc-manager'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' =>  'recorder-category'),
        );

        register_taxonomy('voicescategory', array('voicerecorder'), $args);
    }


}
$fgc_comment_recorder = new FGC_Voice_Recorder();