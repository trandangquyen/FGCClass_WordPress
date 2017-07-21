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
    function __construct()
    {
        //add js vs css to admin panel
        add_action('admin_enqueue_scripts', array( $this, 'admin_style'));
        // Add event manager menu to admin panel
        add_action('admin_menu', array($this,'add_menu_events_manager'));
        // Add event manager sub-menu to admin panel
        add_action('admin_menu', array($this,'add_submenu_events_manager'));
        // Remove event menu title
        add_action('admin_menu', array($this,'remove_event_menu_title'));
        register_activation_hook( __FILE__, array($this,'fgc_teacher_create_db'));

    }
    // Update CSS and JS within in Admin area
    function admin_style() {
        wp_enqueue_style('admin-boostrap', FGC_ENDIR_URL.'css/bootstrap.min.css');
        wp_enqueue_style('admin-datetimepicker', FGC_ENDIR_URL.'css/bootstrap-datetimepicker.min.css');
        wp_enqueue_style('admin-styles', FGC_ENDIR_URL.'css/admin-style.css');
        //wp_enqueue_script( 'admin-jquery', FGC_ENDIR_URL. 'js/jquery.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-moment', FGC_ENDIR_URL. 'js/moment.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-bootstrap', FGC_ENDIR_URL. 'js/bootstrap.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-datetimepickerjs', FGC_ENDIR_URL. 'js/bootstrap-datetimepicker.min.js', array(), 'v1', false );
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
          event_post_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          event_post_content longtext COLLATE utf8_unicode_ci NOT NULL,
          event_post_title text COLLATE utf8_unicode_ci NOT NULL,
          event_post_excerpt text COLLATE utf8_unicode_ci NOT NULL,
          event_post_status varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'publish',
          event_post_parent bigint(20) UNSIGNED NOT NULL,
          guid varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          event_post_type varchar(100) COLLATE utf8_unicode_ci NOT NULL,
          event_post_modified datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
        echo 'Heloo000';
    }
    //Add submenu to the events manager
    function add_submenu_events_manager(){
        add_submenu_page(
                'manager-fgc-events',
                'Tất cả sự kiện',
                'Tất cả sự kiện',
                'manage_options',
                'all-events-list',
                array($this,'show_setting_events_page')
        );
        add_submenu_page(
            'manager-fgc-events',
            'Thêm sự kiện mới',
            'Thêm sự kiện mới',
            'manage_options',
            'add-new-event',
            array($this,'add_new_event')
        );
        add_submenu_page(
            'manager-fgc-events',
            'Danh mục sự kiện',
            'Danh mục sự kiện',
            'manage_options',
            'all-category-event',
            array($this,'show_events_category')
        );
    }
    // Callback funcions in the events manager menu
    function show_setting_events_page(){
        echo 'This is general setting page';
    }
    function add_new_event(){
        if(!isset($_REQUEST['action'])) {
            ?>
            <div class="row">
                <div class="col-sm-8">
                    <form action="" method="post">
                        <?php
                        // Add a nonce field
                        wp_nonce_field('MyNonceAction', 'ticket_nonce');
                        ?>
                        <div class="form-group">
                            <label for="event-title">Tên sự kiện</label>
                            <input id="event-title" name="event-title" type="text" class="form-control"
                                   placeholder="Nhập tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="event-content">Nội dung sự kiện</label>
                            <textarea name="event-content" id="event-content" class="form-control" rows="20"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default" name="event-submit">Submit</button>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_POST['event-submit'])) {
                // Debugging output, since you are having troubles finding the issue.
                // If this doesn't fire, then you've got a problem with the select name or this code isn't included in your theme / plugin.
                echo "SAVING ENTRY";
                // Get the nonce value for validation
                $nonce = $_POST['ticket_nonce'];
                // If the nonce does not verify, do NOT process the form.
                if (!wp_verify_nonce($nonce, 'MyNonceAction')) {
                    // If this spits out an error, that means the nonce failed
                    echo 'Security error. Do not process the form.';
                    return;
                }

                $this->insert_event_post();
                if ($this->insert_event_post() == true){
                    ?>
                    <script type="text/javascript">
                        window.location = "http://localhost:8080/FGCClass_WordPress/wp-admin/admin.php?page=add-new-event&action=edit";
                    </script>
                    <?php
                }
                //
            }
        }
        else{
            ?>
            <div class="row">
                <div class="col-sm-8">
                    <form action="admin.php?page=add-new-event&action=edit" method="post">
                        <?php
                        // Add a nonce field
                        wp_nonce_field('MyNonceAction', 'ticket_nonce');
                        ?>
                        <div class="form-group">
                            <a href="admin.php?page=add-new-event" class="btn btn-info" role="button">Thêm mới sự kiện</a>
                            <div>Sua su kien</div>
                            <label for="event-title">Tên sự kiện</label>
                            <input id="event-title" name="event-title" type="text" class="form-control"
                                   placeholder="Nhập tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="event-content">Nội dung sự kiện</label>
                            <textarea name="event-content" id="event-content" class="form-control" rows="20"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default" name="event-submit">Submit</button>
                    </form>
                </div>
            </div>
            <?php
        }

    }
    function insert_event_post()
    {

        // You should use the WP table prefixes, so let's set that up....
        global $wpdb;
        $table_name = $wpdb->prefix . 'events_post';

        $data = array(
            'event_post_title' => $_POST['event-title'] ,
            'event_post_content' => $_POST['event-content']
        );

        // Debugging: Lets see what we're trying to save
        var_dump($data);

        // FOR database SQL injection security, set up the formats
        $formats = array(
            '%s', // ticket_id should be an integer
            '%s', // ticket_user_id should be an integer
        );

        // Debugging: Turn on error reporting for db to see if there's a database error
        $wpdb->show_errors();
        // Actually attempt to insert the data
        $wpdb->insert($table_name, $data, $formats);
        return true;
    }

    function show_events_category(){
        echo 'show event category';
    }


}
$fgc_manager = new FGC_Manager();