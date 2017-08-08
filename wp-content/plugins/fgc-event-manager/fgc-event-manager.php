<?php
/**
Plugin Name: FGC Events Manager V.2
Plugin URI: http://fgc.com
Description: This plugin was created to help teachers who want to manage events...
Author: Quyền - Brian
Version: 1.0
Author URI: http://brian.com
*/
define('FGC_ENDIR_PATH',plugin_dir_path(__FILE__) );
define('FGC_ENDIR_URL',plugin_dir_url(__FILE__) );
class FGC_Manager{
    protected $current_page;
    protected  $db;
    function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
    }
    public function execute(){
        //add js vs css to admin panel
        add_action('admin_enqueue_scripts', array( $this, 'admin_style'));
        // Add event manager menu to admin panel
        add_action('admin_menu', array($this,'add_menu_events_manager'));
        // Add event manager sub-menu to admin panel
        add_action('admin_menu', array($this,'add_submenu_events_manager'));
        // Remove event menu title
        add_action('admin_menu', array($this,'remove_event_menu_title'));
        register_activation_hook( __FILE__, array($this,'fgc_teacher_create_category_db'));
        register_activation_hook( __FILE__, array($this,'fgc_teacher_create_db'));
    }
    // Update CSS and JS within in Admin area
    public function admin_style() {
        wp_enqueue_style('admin-boostrap', FGC_ENDIR_URL.'css/bootstrap.css');
        wp_enqueue_style('admin-datetimepicker', FGC_ENDIR_URL.'css/bootstrap-datetimepicker.min.css');
        wp_enqueue_style('admin-styles', FGC_ENDIR_URL.'css/admin-style.css');
        //wp_enqueue_script( 'admin-jquery', FGC_ENDIR_URL. 'js/jquery.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-moment', FGC_ENDIR_URL. 'js/moment.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-bootstrap', FGC_ENDIR_URL. 'js/bootstrap.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-datetimepickerjs', FGC_ENDIR_URL. 'js/bootstrap-datetimepicker.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-ckeditor', FGC_ENDIR_URL. 'js/plugin/ckeditor/ckeditor.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-fgc-customjs', FGC_ENDIR_URL. 'js/fgc-teacher-plugin.js', array(), 'v1', false );


    }
    // Create Table event post
    function fgc_teacher_create_db() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'events_post';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
          event_post_author bigint(20) UNSIGNED NOT NULL,
          event_post_category bigint(20) UNSIGNED NULL DEFAULT NULL,
          event_post_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          event_post_start datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          event_post_end datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          event_post_location text COLLATE utf8_unicode_ci NOT NULL,
          event_post_content longtext COLLATE utf8_unicode_ci NOT NULL,
          event_post_title text COLLATE utf8_unicode_ci NOT NULL,
          event_post_excerpt text COLLATE utf8_unicode_ci NOT NULL,
          event_post_status varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '--',
          event_post_parent bigint(20) UNSIGNED NOT NULL,
          guid varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          event_post_type varchar(100) COLLATE utf8_unicode_ci NOT NULL,
          event_post_modified datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          PRIMARY KEY  (id),
          CONSTRAINT event_author FOREIGN KEY (event_post_author) REFERENCES wp_users(ID),
          CONSTRAINT event_category FOREIGN KEY (event_post_category) REFERENCES wp_events_category(ID)
          
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
    // Create Table category event post
    function fgc_teacher_create_category_db() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'events_category';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
           id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
           event_category_name text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
           parent bigint(20) UNSIGNED NOT NULL,
          PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
    // Add menu events manager  to the admin panel
    function add_menu_events_manager(){

        add_menu_page('Quản lý sự kiện',
            'Quản lý sự kiện',
            'manage_options',
            'manager-fgc-events',
            array($this,'show_general_events_page'),
            'dashicons-format-aside',
            2
        );

    }
    // Remove event menu title
    function  remove_event_menu_title(){
        global $submenu;
        unset($submenu['manager-fgc-events'][0]);
    }
    function show_general_events_page(){
        global $submenu;
        echo 'This content do not show in the admin panel';
    }
    //Add submenu to the events manager
    function add_submenu_events_manager(){
        add_submenu_page(
            'manager-fgc-events',
            'Tất cả sự kiện',
            'Tất cả sự kiện',
            'manage_options',
            'event.all-events-list',
            array($this,'link_router')
        );
        add_submenu_page(
            'manager-fgc-events',
            'Thêm sự kiện mới',
            'Thêm/Sửa sự kiện',
            'manage_options',
            'event.add-new-event',
            array($this,'link_router')
        );
        add_submenu_page(
            'manager-fgc-events',
            'Danh mục sự kiện',
            'Danh mục sự kiện',
            'manage_options',
            'event.all-category-event',
            array($this,'link_router')
        );
    }
    // Callback funcions in the events manager menu
    //Load controller
    function load_event_controller()
    {
        include_once (__DIR__.'/Controller/event-controller.php');
    }
    function link_router(){
        $this->current_page = isset($_GET['page']) ? $_GET['page'] : null;
        $subject = $this->current_page;
        $pattern = '/event.(.*?)$/';
        preg_match($pattern, $subject, $matches);
        if(isset($matches))
        {
            $this->load_event_controller();
            $controller = new EventController();
            switch($matches[1]){
                case 'all-events-list':
                    $controller->ShowAllEvents();
                    break;
                case 'add-new-event':
                    $controller->AddEditEvent();
                    break;
                case 'all-category-event':
                    $controller->ShowAllCategory();
                    break;
                default : break;
            }
        }
    }

}
$fgc_manager = new FGC_Manager();
$fgc_manager->execute();