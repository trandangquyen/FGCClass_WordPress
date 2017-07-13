<?php
/**
Plugin Name: FGC Manager Events & News
Plugin URI: http://fgc.com
Description: This plugin was created to help teachers who want to manage events...
Author: Brian 
Version: 1.0
Author URI: http://brian.com
*/
define('FGC_ENDIR_PATH',plugin_dir_path(__FILE__) );
define('FGC_ENDIR_URL',plugin_dir_url(__FILE__) );
class FGC_Manager{
    function __construct()
    {
        add_action('admin_menu',array( $this, 'fgc_add_exercise_menu'));
        add_action('admin_menu',array( $this, 'fgc_add_subexercise_menu'));
        add_action('admin_enqueue_scripts', array( $this, 'admin_style'));
        add_action( 'init', array( $this, 'codex_events_init'));
        add_action( 'init', array( $this, 'codex_news_init'));
        add_action('add_meta_boxes', array( $this, 'add_metabox_events'));
        add_action('save_post', array($this,'save_selected_event'), 10, 3);
        add_filter( 'manage_events_posts_columns', array($this,'set_custom_edit_events_columns') );
        add_action( 'manage_events_posts_custom_column' , array($this,'custom_events_column'), 10, 2 );

    }
    function fgc_add_exercise_menu(){
        add_menu_page('Quản lý bài tập',
                        'Quản lý Bài Tập',
                        'manage_options',
                        'quan_ly_bai_tap',
                        array($this,'fgc_show_exercise_menu'),
                        '',
                        3);
    }
    function fgc_add_subexercise_menu(){
        add_submenu_page(
            'quan_ly_bai_tap',
            'Bài nghe',
            'Bài tập nghe',
            'manage_options',
            'bai_nghe',
            array($this,'fgc_show_listen_menu')
        );
        add_submenu_page(
            'quan_ly_bai_tap',
            'Bài nghe',
            'Bài tập nói',
            'manage_options',
            'bai_noi',
            array($this,'fgc_show_talk_menu')
        );
        add_submenu_page(
            'quan_ly_bai_tap',
            'Bài nghe',
            'Bài tập đọc',
            'manage_options',
            'bai_doc',
            array($this,'fgc_show_read_menu')
        );
        add_submenu_page(
            'quan_ly_bai_tap',
            'Bài viết',
            'Bài tập viết',
            'manage_options',
            'bai_viet',
            array($this,'fgc_show_write_menu')
        );
    }
    function set_post_type(){
        global $typenow;
        $typenow = 'exercises';
    }
    function fgc_show_exercise_menu()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "wporg_options"
                settings_fields('wporg_options');
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections('wporg');
                // output save settings button
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
    function fgc_show_listen_menu()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <div id="container">
                    <div id="content" role="main">
                        <table class="table-listen">
                            <?php
                            global $post;

                            $myposts = get_posts( array(
                                'category'       => 21
                            ) );

                            if ( $myposts ):
                                ?>

                                <tr class="head-title">
                                    <th>Tên bài nghe</th>
                                    <th>Số người làm bài này</th>
                                    <th>Bình luận mới</th>
                                    <th>Sửa bài</th>
                                    <th>Xóa bài</th>
                                </tr>
                                <?php
                                foreach ( $myposts as $post ) :
                                    setup_postdata( $post );
                                    $detelte_post = "<a href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "'>Xóa</a>";
                                    $edit_post = "<a href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=edit&amp;post=" . $post->ID, 'edit-post_' . $post->ID) . "'>Sửa</a>";
                                    $comment_post = $post->comment_count."<a href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/edit-comments.php?p=" . $post->ID, 'edit-comment_' . $post->ID) . "'>(Xem)</a>";;

                                    ?>
                                    <tr>
                                        <td class="first-col"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                                        <td>0</td>
                                        <td><?php if($comment_post > 0)echo $comment_post; else echo 0; ?></td>
                                        <td><?php echo $edit_post; ?></td>
                                        <td><?php echo $detelte_post; ?></td>
                                    </tr>

                                    <?php
                                endforeach;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </table>

                    </div><!-- #content -->
                </div><!-- #container -->

                <?php
                // output security fields for the registered setting "wporg_options"
                settings_fields('wporg_options');
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections('wporg');
                // output save settings button
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
    function fgc_show_talk_menu()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "wporg_options"
                settings_fields('wporg_options');
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections('wporg');
                // output save settings button
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
    function fgc_show_read_menu()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>

            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "wporg_options"
                settings_fields('wporg_options');
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections('wporg');
                // output save settings button
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
    function fgc_show_write_menu()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "wporg_options"
                settings_fields('wporg_options');
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections('wporg');
                // output save settings button
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }
    // Update CSS within in Admin
    function admin_style() {
        wp_enqueue_style('admin-styles', FGC_ENDIR_URL.'css/admin-style.css');
    }
    // Create post type events
    function codex_events_init(){
    	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Sự kiện', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Thêm mới sự kiện', 'Event', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Event', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Event', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Event', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Event', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Tất cả sự kiện', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search events', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent events:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No events found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No events found in Trash.', 'your-plugin-textdomain' )
		);
		$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'Event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
        'supports' => array('title', 'editor', 'publicize', 'excerpt', 'custom-fields', 'thumbnail', 'tags', 'comments','author')
		);

		register_post_type( 'events', $args );
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
            'menu_name' => __('Danh mục sự kiện','fgc-manager'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' =>  'events-category'),
        );

        register_taxonomy('eventscategory', array('events'), $args);
    }

    // Create post type news
    function codex_news_init(){
        $labels = array(
            'name'               => _x( 'Tin tức', 'post type general name', 'your-plugin-textdomain' ),
            'singular_name'      => _x( 'News', 'post type singular name', 'your-plugin-textdomain' ),
            'menu_name'          => _x( 'Tin tức', 'admin menu', 'your-plugin-textdomain' ),
            'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'your-plugin-textdomain' ),
            'add_new'            => _x( 'Thêm tin tức mới', 'Event', 'your-plugin-textdomain' ),
            'add_new_item'       => __( 'Thêm tin tức mới', 'your-plugin-textdomain' ),
            'new_item'           => __( 'New News', 'your-plugin-textdomain' ),
            'edit_item'          => __( 'Edit News', 'your-plugin-textdomain' ),
            'view_item'          => __( 'View News', 'your-plugin-textdomain' ),
            'all_items'          => __( 'Tất cả tin tức', 'your-plugin-textdomain' ),
            'search_items'       => __( 'Tìm kiếm tin tức', 'your-plugin-textdomain' ),
            'parent_item_colon'  => __( 'Parent News:', 'your-plugin-textdomain' ),
            'not_found'          => __( 'No news found.', 'your-plugin-textdomain' ),
            'not_found_in_trash' => __( 'No news found in Trash.', 'your-plugin-textdomain' )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'your-plugin-textdomain' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'News' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports' => array('title', 'editor', 'publicize', 'excerpt', 'custom-fields', 'thumbnail', 'tags', 'comments','author')
        );

        register_post_type( 'news', $args );
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
            'menu_name' => __('Danh mục tin tức','fgc-manager'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' =>  'news-category'),
        );

        register_taxonomy('newscategory', array('news'), $args);
    }
    //add meta box with select option to events
    function add_metabox_events(){
        add_meta_box('events-option','Chọn hiển thị sự kiện',array($this,'show_option_event'),'events','advanced','high');
    }
    // function to show events option
    function show_option_event($post,$metabox){
        //get current info of this post
        $select_values = array('happening', 'upcoming', "expired");
        $event_selected  = get_post_meta($post->ID,'event-post',true);
        foreach ($select_values as $key => $value)
        {
            if($value == $event_selected){
                ?>
                <input type="radio" name="events" value="<?php echo $value?>" checked>
                <?php switch ($value){
                    case 'happening' :
                        echo 'Đang diễn ra';
                        break;
                    case 'upcoming' :
                        echo 'Sắp diễn ra';
                        break;
                    case 'expired';
                        echo 'Đã kết thúc';
                        break;
                    default:
                        return;
                }
                ?><br>
                <?php
            }
            else{
                ?>
                <input type="radio" name="events" value="<?php echo $value?>">
                <?php switch ($value) {
                    case 'happening' :
                        echo 'Đang diễn ra';
                        break;
                    case 'upcoming' :
                        echo 'Sắp diễn ra';
                        break;
                    case 'expired';
                        echo 'Đã kết thúc';
                        break;
                    default:
                        echo 'Chưa cài đặt';
                }
                ?><br>
                <?php
            }
        }
    }
    //function to save selected the event
    function save_selected_event($post_id, $post, $update){
        if(!current_user_can("edit_post", $post_id)){
            return $post_id;
        }
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        {
            return $post_id;
        }
        if('events' != $post->post_type)
        {
            return $post_id;
        }
        $event_post = (isset($_POST["events"])) ? $_POST["events"] : '';
        update_post_meta($post_id, 'event-post',$event_post);

    }
    // function to add the event column
    function set_custom_edit_events_columns($columns) {
        $columns['statusofevent'] = __( 'Sự kiện bài viết', 'your_text_domain' );

        return $columns;
    }
    //function to show value of the event column
    function custom_events_column( $column, $post_id ) {
        switch ( $column ) {
            case 'statusofevent' :
                echo get_post_meta( $post_id , 'event-post' , true );
                break;

        }
    }




}
$fgc_manager = new FGC_Manager();