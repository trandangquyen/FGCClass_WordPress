<?php
/**
 * Plugin Name: FGC Class Manager
 * Plugin URI: http://localhost
 * Description: a plugin for FGC Quiz use custom post
 * Version: 1.0
 * Author: khoazero123
 * Author URI: http://localhost
 * License: GPLv2
 */

//define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ));
//define( 'PLUGIN_VERSION', '1.0');

class FGCQuizClass { /**
    * Constructor. Called when plugin is initialised
    */
    function __construct() {
        add_action( 'init', array( $this, 'register_custom_post_type' ) );
        //add_action( 'init', array( $this, 'create_taxonomy_class'), 0 );
        
        add_filter( 'manage_class_posts_columns' , array( $this, 'add_class_column' ));
        add_action( 'manage_class_posts_custom_column' , array( $this, 'display_number_member'), 10, 2 );

        add_filter( 'default_content', array( $this, 'timetable_editor_content'));

        add_action('add_meta_boxes',array( $this, 'register_meta_box_list_members'));
        add_action('admin_footer', array( $this, 'action_member_javascript') );
        add_action('wp_ajax_action_member', array( $this, 'ajax_action_member' ));
    }
    /*function create_taxonomy_class() {
        $labels = array(
                'name' => 'List class',
                'singular' => 'Class',
                'menu_name' => 'Class'
        );
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
                'show_in_menu' => true,
        );
        register_taxonomy('class', ['post','page'], $args);
    }*/
    /**
    * Registers a Custom Post Type called class
    */
    function register_custom_post_type() {
        register_post_type( 'class', array(
            'labels' => array(
                'name'               => 'List Class',// 'post type general name', title
                'singular_name'      => 'Class',// 'post type singular name',
                'menu_name'          => 'Class Manager',// 'admin menu', 
                'name_admin_bar'     => 'Class bar',// 'add new on admin bar', 'tuts-crm' ),
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New Class',
                'new_item'           => 'New Class',
                'edit_item'          => 'Edit class',
                'view_item'          => 'View class',
                'all_items'          => 'All class',
                'search_items'       => 'Search class',
                //'parent_item_colon'  => 'Parent:',
                'not_found'          => 'No class found.',
                'not_found_in_trash' => 'No class found in Trash.',
            ),     // Frontend
            'has_archive'        => false,
            'public'             => false,
            'publicly_queryable' => true,     // Admin
            'capability_type' => 'post',
            'menu_icon'     => 'dashicons-businessman',
            'menu_position' => 10,
            'query_var'     => true,
            'show_in_menu'  => true,
            'show_ui'       => true,
            'supports'      => array(
                'title',
                'author',
                'editor', // store timetable
                //'comments',
            ),
        ) );
    }
    function add_class_column( $columns ) {
        return array_merge( $columns, 
            array( 'members' => 'Members' ) );
    }
    function display_number_member( $column, $post_id ) {
        global $wpdb, $fgc_config;
        if ($column == 'members') {
            $args = array(
                'meta_key'     => '_class_id',
                'meta_value'   => $post_id,
                'orderby'      => 'nicename',
                'order'        => 'ASC',
            ); 
            $list_users = get_users( $args );
            echo count($list_users);
        }
    }
    function timetable_editor_content($content) {
        if(get_post_type() == 'class' || @$_REQUEST['post_type']=='class') {
            $content = '<table class="wp-list-table widefat fixed striped posts" style="width: 100%;">
                <thead>
                    <tr>
                        <th id="title" class="manage-column column-author" scope="col">Member</th>
                        <th id="count" class="manage-column column-author" scope="col">Monday</th>
                        <th id="count" class="manage-column column-author" scope="col">Tuesday</th>
                        <th id="count" class="manage-column column-author" scope="col">Wednesday</th>
                        <th id="count" class="manage-column column-author" scope="col">Thursday</th>
                        <th id="count" class="manage-column column-author" scope="col">Friday</th>
                        <th id="count" class="manage-column column-author" scope="col">Saturday</th>
                        <th id="count" class="manage-column column-author" scope="col">Sunday</th>
                    </tr>
                </thead>
                <tbody id="the-list">
                    <tr>
                        <td>Time</td>
                        <th class="manage-column column-author" rowspan="1" scope="col"></th>
                        <th class="manage-column column-author" rowspan="1" scope="col">2h-2h30</th>
                        <th class="manage-column column-author" rowspan="1" scope="col"></th>
                        <th class="manage-column column-author" rowspan="1" scope="col">2h-2h30</th>
                        <th class="manage-column column-author" rowspan="1" scope="col"></th>
                        <th class="manage-column column-author" rowspan="1" scope="col"></th>
                        <th class="manage-column column-author" rowspan="1" scope="col"></th>
                    </tr>
                </tbody>
            </table>';
        }
        return $content;
    }

    function register_meta_box_list_members() {
        if(get_post_type() == 'class')
            add_meta_box( 'fgc-quiz-list-member', 'List members', array($this,'print_box_list_members'));
    }
    function print_box_list_members() {
        $class_id = get_the_ID();
        wp_nonce_field( 'get-members', 'add_member_nonce', false );
        ?>
        <p class="hide-if-no-js" id="add-new-member">
            <input type="text" name="member" value="" placeholder="Enter username or email">
            <a class="button" href="#" onclick="addMember(<?php echo $class_id; ?>);return false;"><?php _e('Add member'); ?></a>
        </p>
        <?php
        $args = array(
            'meta_key'     => '_class_id',
            'meta_value'   => $class_id,
            'orderby'      => 'nicename',
            'order'        => 'ASC',
        ); 
        $list_users = get_users( $args );
        //echo '<pre>';var_dump($list_users);echo '</pre>';
        //if(!empty($list_users)) {
        echo '<table class="wp-list-table widefat fixed striped users" style="width:100%;display:'.(!empty($list_users)?'block':'none').';">
            <thead>
                <tr>
                    <th scope="col" id="title" class="manage-column column-author">Name</th>
                    <th scope="col" id="count" class="manage-column column-author">Email</th>
                    <th scope="col" id="action" class="manage-column column-author">Action</th>
                </tr>
            </thead>
            <tbody id="the-list">';
                if(!empty($list_users)) foreach ( $list_users as $user ) {
                    echo '<tr id="'.$user->ID.'">';
                    echo '<td>' . esc_html( $user->user_nicename ) . '</td>';
                    echo '<td>' . esc_html( $user->user_email ) . '</td>';
                    echo '<td> <a href="#" onclick="removeMember('.$class_id.','.$user->ID.');return false;">Remove</a> </td>';
                    echo '</tr>';
                }
            echo '</tbody>
        </table>';
        //}
    }
    function ajax_action_member() {
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;
        switch ($type) {
            case 'add_member':
                return $this->add_member();
                break;
            case 'remove_member':
                return $this->remove_member();
                break;
            default:
                break;
        }
    }
    function add_member() {
        global $wpdb; // this is how you get access to the database
        $response = ['status'=>0,'message'=>'No input'];
        $class_id = intval($_POST['class_id']);
        $query = !empty($_POST['member']) ? $_POST['member'] : null;
        $class = get_post($class_id);//, ARRAY_A 
        if($class && $query) {
            if (filter_var($query, FILTER_VALIDATE_EMAIL))
                $user = get_user_by( 'email', $query );
            else
                $user = get_user_by( 'login', $query );
            if(!$user) $response['message'] = 'User not found!';
            else {
                $user_name = $user->user_nicename or $user->user_email;
                update_user_meta( $user->ID, '_class_id', $class->ID );
                $response['status'] = 1;
                //$response['message'] = 'Add member '.$user_name.'('.$user->ID.') to class '.$class->post_title;
                $response['message'] = '<tr id="'.$user->ID.'"><td>'.$user->user_nicename.'</td><td>'.$user->user_email.'</td><td> <a href="#" onclick="removeMember('.$class->ID.','.$user->ID.');return false;">Remove</a> </td></tr>';
            }
            
        } else $response['message'] = 'Please enter username or email address!';
        wp_send_json($response);
        wp_die(); // this is required to terminate immediately and return a proper response
    }
    function remove_member() {
        $class_id = intval($_POST['class_id']);
        $class = get_post($class_id);

        $user_id = intval($_POST['user_id']);
        $user = get_user_by( 'ID', $user_id);
        $response = ['status'=>0,'message'=>'No input'];
        if($user && $class) {
            $user_name = $user->user_nicename or $user->user_email;
            delete_user_meta( $user->ID, '_class_id');
            $response['status'] = 1;
            $response['message'] = 'Remove user '.$user_name.' form class '.$class->post_title.' success';
        } else $response['message'] = 'User or Class not found!';
        wp_send_json($response);
        wp_die();
    }
    function action_member_javascript() { ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {});
            function addMember(class_id) {
                var member = jQuery('#add-new-member [name=member]').val();
                var data = {
                    'action': 'action_member',
                    'type': 'add_member',
                    'class_id': class_id,
                    'member': member,
                };
                jQuery.post(ajaxurl, data, function(response) {
                    if(response.status===1) {
                        jQuery('table.wp-list-table.users').show();
                        jQuery('table.users tbody').append(response.message);
                    } else if(response.status===0) {
                        alert(response.message);
                    } else {
                        alert('Got this from the server: ' + response);
                    }
                });
            }
            function removeMember(class_id,user_id) {
                var data = {
                    'action': 'action_member',
                    'type': 'remove_member',
                    'class_id': class_id,
                    'user_id': user_id,
                };
                jQuery.post(ajaxurl, data, function(response) {
                    if(response.status===1) {
                        jQuery('table.users tbody tr#'+user_id).remove();
                    } else if(response.status===0) {
                        alert(response.message);
                    } else {
                        alert('Got this from the server: ' + response);
                    }
                });
            }
        </script><?php
    }
}

new FGCQuizClass;
