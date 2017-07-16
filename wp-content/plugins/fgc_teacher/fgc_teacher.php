<?php
/**
Plugin Name: FGC Manager Events & News
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
        add_action('admin_enqueue_scripts', array( $this, 'admin_style'));
        add_action( 'init', array( $this, 'codex_events_init'));
        add_action( 'init', array( $this, 'codex_news_init'));
        add_action('add_meta_boxes', array( $this, 'add_metabox_events'));
        add_action('save_post', array($this,'save_selected_event'), 10, 3);
        add_filter( 'manage_events_posts_columns', array($this,'set_custom_edit_events_columns') );
        add_action( 'manage_events_posts_custom_column' , array($this,'custom_events_column'), 10, 2 );

    }
    // Update CSS and JS within in Admin area
    function admin_style() {
        wp_enqueue_style('admin-boostrap', FGC_ENDIR_URL.'css/bootstrap.min.css');
        wp_enqueue_style('admin-datetimepicker', FGC_ENDIR_URL.'css/bootstrap-datetimepicker.min.css');
        wp_enqueue_style('admin-styles', FGC_ENDIR_URL.'css/admin-style.css');
        wp_enqueue_script( 'admin-jquery', FGC_ENDIR_URL. 'js/jquery.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-moment', FGC_ENDIR_URL. 'js/moment.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-bootstrap', FGC_ENDIR_URL. 'js/bootstrap.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-datetimepickerjs', FGC_ENDIR_URL. 'js/bootstrap-datetimepicker.min.js', array(), 'v1', false );
        wp_enqueue_script( 'admin-fgc-customjs', FGC_ENDIR_URL. 'js/fgc-teacher-plugin.js', array(), 'v1', false );



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
        //get current post meta of this post
        $select_values = array('happening', 'upcoming', "expired");

        $event_selected  = get_post_meta($post->ID,'event-post',true);
        $show_event_time_start  = get_post_meta($post->ID,'event-post-time-start',true);
        $show_event_time_end  = get_post_meta($post->ID,'event-post-time-end',true);
        $show_event_time_location  = get_post_meta($post->ID,'event-post-location',true);

        $current_event_status = '';
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('m/d/Y h:i A');
        //echo $date.'===';
        $date = strtotime($date);
        $current_event_time_start = strtotime($show_event_time_start);
        $current_event_time_end = strtotime($show_event_time_end);
        if($date>=$current_event_time_start && $date<=$current_event_time_end) {
            $current_event_status = 'happening';
        }
        elseif($date<$current_event_time_start && $date<$current_event_time_end){
            $current_event_status = 'upcoming';
        }
        elseif($date>$current_event_time_end)
        {
            $current_event_status = 'expired';
        }
        else{
            //check if user not select event time
            $current_event_status = 'expired';
        }


        ?>
            <div class="date-time-picker">
                <div class="row">
                    <div class='col-sm-3'>
                        <?php
                        foreach ($select_values as $key => $value)
                        {

                            if($value == $current_event_status){
                                ?>
                                <input id="<?php echo $current_event_status; ?>" type="radio" name="events" value="<?php echo $current_event_status; ?>" checked>
                                <?php switch ($value){
                                    case 'happening' :
                                        echo '<span class="descript-ev">Đang diễn ra</span>';
                                        break;
                                    case 'upcoming' :
                                        echo '<span class="descript-ev">Sắp diễn ra</span>';
                                        break;
                                    case 'expired';
                                        echo '<span class="descript-ev">Đã kết thúc</span>';
                                        break;
                                    default:
                                        echo '<span class="descript-ev">Đã kết thúc</span>';
                                        break;
                                }
                                ?><br>
                                <?php
                            }//end if
                            else{
                                ?>

                                <input id="<?php echo $value; ?>" type="radio" name="events" value="<?php echo $value; ?>" disabled readonly>
                                <?php switch ($value) {
                                    case 'happening' :
                                        echo '<span class="descript-ev">Đang diễn ra</span>';
                                        break;
                                    case 'upcoming' :
                                        echo '<span class="descript-ev">Sắp diễn ra</span>';
                                        break;
                                    case 'expired';
                                        echo '<span class="descript-ev">Đã kết thúc</span>';
                                        break;
                                    default:
                                        echo '<span class="descript-ev">Đã kết thúc</span>';
                                        break;
                                }
                                ?><br>
                                <?php
                            }//end else
                        }//end foreach

                        ?>
                    </div>
                    <div class='col-sm-3'>
                        <label for="datetimepicker-start">Thời gian bắt đầu</label>
                        <input type='text' name="datetimepicker-start" class="form-control" id='datetimepicker-start' value="<?php echo $show_event_time_start; ?>" placeholder="<?php echo (($show_event_time_start != '')? $show_event_time_start:'Chọn thời gian bắt đầu'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Chọn thời gian bắt đầu'"/>
                    </div>
                    <div class='col-sm-3'>
                        <label for="datetimepicker-end">Thời gian kết thúc</label>
                        <input type='text' name="datetimepicker-end" class="form-control" id='datetimepicker-end' value="<?php echo $show_event_time_end; ?>" placeholder="<?php echo (($show_event_time_end != '')? $show_event_time_end:'Chọn thời gian kết thúc'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Chọn thời gian kết thúc'"/>
                        <div class="error-time">Thời gian kết thúc nhỏ</div>
                    </div>
                    <div class='col-sm-3'>
                        <label for="event-location">Địa điểm</label>
                        <input type='text' name="event-location" class="form-control" id='event-location' value="<?php echo $show_event_time_location; ?>" placeholder="<?php echo (($show_event_time_location != '')? $show_event_time_location:'Nhập vào địa điểm'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập vào địa điểm'"/>
                    </div>

                    <script type="text/javascript">
                        $(function() {
                            $('#datetimepicker-start , #datetimepicker-end').datetimepicker();
                        });
                    </script>
                </div>
            </div>
        <?php
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
        $time_start_event = (isset($_POST["datetimepicker-start"])) ? $_POST["datetimepicker-start"] : '';
        $time_end_event= (isset($_POST["datetimepicker-end"])) ? $_POST["datetimepicker-end"] : '';
        $event_location = (isset($_POST["event-location"])) ? $_POST["event-location"] : '';
        update_post_meta($post_id, 'event-post',$event_post);//Assign value to the post meta with event-post key
        update_post_meta($post_id, 'event-post-time-start',$time_start_event);//Assign value to the post meta with event-post-time-start key
        update_post_meta($post_id, 'event-post-time-end',$time_end_event);//Assign value to the post meta with event-post-time-end key
        update_post_meta($post_id, 'event-post-location',$event_location);//Assign value to the post meta with event-post-location key

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