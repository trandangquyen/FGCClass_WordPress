<?php 
/**
 * Plugin Name: FGC Quiz - Manager point of student
 * Plugin URI: http://localhost
 * Description: Plugin manager point, required plugin wp-pro-quiz
 * Version: 1.0
 * Author: khoazero123
 * Author URI: http://localhost
 * License: GPLv2
 */
     ini_set("display_errors", 1);
    ini_set('html_errors', false);
    error_reporting(E_ALL );
global $wpdb;
define('FGC_QUIZ_TABLE_POINT',$wpdb->prefix.'fgc_table_point');
define('FGC_QUIZ_CUSTOM_FIELD_NUMBER_DONE','_number_student_done');
define('FGC_QUIZ_POST_TYPE','exercise');
add_action( 'init', 'register_custom_post_type' );
register_activation_hook( __FILE__ , 'fgc_install'); 
function fgc_install() {
    global $wpdb, $fgc_table_point;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS ". FGC_QUIZ_TABLE_POINT ." (
        id int(11) NOT NULL AUTO_INCREMENT,
        post_id int(11) NOT NULL,
        quiz_id int(11) NOT NULL,
        user_id int(11) NOT NULL,
        point int(11) NOT NULL DEFAULT '0',
        time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
        ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    //exit;
}
function register_custom_post_type() {
    register_post_type(FGC_QUIZ_POST_TYPE, array(
        'labels' => array(
            'name'               => 'Quản lý bài tập',// 'post type general name', title
            'singular_name'      => 'Exercise',// 'post type singular name',
            'menu_name'          => 'Quản lý bài tập',// 'admin menu', 
            'name_admin_bar'     => 'Class bar',// 'add new on admin bar', 'tuts-crm' ),
            'add_new'            => 'Thêm mới',
            'add_new_item'       => 'Thêm mới bài tập',
            'new_item'           => 'New Class',
            'edit_item'          => 'Cập nhập bài tập',
            'view_item'          => 'View class',
            'all_items'          => 'Danh sách bài tập',
            'search_items'       => 'Search class',
            //'parent_item_colon'  => 'Parent:',
            'not_found'          => 'No class found.',
            'not_found_in_trash' => 'No class found in Trash.',
        ),     // Frontend
        'has_archive'        => false,
        'public'             => true,
        'publicly_queryable' => true,     // Admin
        'capability_type' => 'post',
        'menu_icon'     => 'dashicons-format-aside',
        'menu_position' => 10,
        'query_var'     => true,
        'show_in_menu'  => true,
        'show_ui'       => true,
        'taxonomies'          => array( 'category' ),
        'supports'      => array(
            'title',
            'author',
            'editor', // store timetable
            'comments',
        ),
    ) );
}
add_action('admin_menu', 'fgc_quiz_create_menu');
function fgc_quiz_create_menu() {
    /*add_submenu_page(
        'edit.php?post_type='.FGC_QUIZ_POST_TYPE,
        'Danh sách bài tập nghe', // page title
        'Bài tập nghe', // menu title 
        'manage_options', // roles and capabiliyt needed
        'list-exerise-listen',
        'listExerciseListen' // replace with your own function
    );*/
    
    /*add_submenu_page(
        'edit.php?post_type='.FGC_QUIZ_POST_TYPE,
        'Danh sách bài tập nói', /*page title
        'Bài tập nói', // menu title
        'manage_options', // roles and capabiliyt needed
        'list-exerise-speak',
        'listExerciseListen' // replace with your own function
    );*/
    add_submenu_page( 'edit.php?post_type='.FGC_QUIZ_POST_TYPE, "View point", "View point", 'manage_options',  'view-point', 'view_point');
    add_submenu_page( 'edit.php?post_type='.FGC_QUIZ_POST_TYPE, "Setting", "Setting", 'manage_options',  'setting', 'fgc_quiz_setting');
}
function listExerciseListen() {

}
function view_point() {
    global $post,$wp_query,$wpdb;
    $post_id = isset($_GET['post_id']) ? (int) $_GET['post_id'] : null;
    if(!$post_id) exit('No post id to view point');
    $list = $wpdb->get_results("SELECT *, COUNT(*) as number FROM ".FGC_QUIZ_TABLE_POINT." WHERE post_id = '$post_id' GROUP BY(user_id) ORDER BY time DESC", ARRAY_A);
    echo '<h1>View Point</h1>';
    ?>
    <table class="wp-list-table widefat fixed striped posts" style="width:60%">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-author">Name student</th>
                <th scope="col" id="count" class="manage-column column-author">Post Title</th>
                <th scope="col" id="action" class="manage-column column-author">Point</th>
                <th scope="col" id="action" class="manage-column column-author">Number submit</th>
                <th scope="col" id="action" class="manage-column column-author">Time</th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php
            if(!empty($list)) foreach ( $list as $item ) {
                $user = get_userdata( $item['user_id'] );
                $post = get_post( $item['user_id'] );
                echo '<tr>';
                echo '<td>' . $user->user_nicename . '</td>';
                echo '<td>' .$post->post_title . '</td>';
                echo '<td> '.$item['point'] .' </td>';
                echo '<td> '.$item['number'] .' </td>';
                echo '<td> '.$item['time'] .' </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <?php
    
}
function fgc_quiz_setting() {
    ?>
    <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
        Cho phép gửi
    </form>
    <?php
}

/*add_filter( 'views_edit-exercise', 'so_13813805_add_button_to_views' );
function so_13813805_add_button_to_views( $views ) {
    $views['my-button'] = '<button id="update-from-provider" type="button"  title="Update from Provider" style="margin:5px">Update from Provider</button>';
    return $views;
}*/
add_filter( 'gettext', 'change_publish_button', 10, 2 );

function change_publish_button( $translation, $text ) {
    if ('exercise' == get_post_type())
        if ( $text == 'Publish' )
            return 'Đăng bài tập';
    return $translation;
}

add_action('add_meta_boxes','register_meta_box_info_exercise'); // 1
function register_meta_box_info_exercise() { // 1
        if(get_post_type() == 'exercise') 
            add_meta_box( 'songuoilambai', 'Thống kê', 'print_box_info_exercise');
    }
function print_box_info_exercise($post) {
    global $wpdb;
    $query = $wpdb->get_results("SELECT * FROM ".FGC_QUIZ_TABLE_POINT." WHERE post_id = '{$post->ID}' GROUP BY(user_id)", ARRAY_A);
    echo 'Số người làm bài: '.count($query);
}

add_action('add_meta_boxes','register_meta_box_fgc_quiz_setting'); // 1
function register_meta_box_fgc_quiz_setting() { // 1
        if(get_post_type() == 'exercise') 
            add_meta_box( 'fgc-setting', 'Setting', 'print_box_fgc_quiz_setting');
    }
function print_box_fgc_quiz_setting($post) {
    $number_submit = (int) get_post_meta($post->ID,'_number_submit',true);
    if($number_submit < 1) $number_submit = 1;
    echo '<input type="number" name="number-submit" value="'.$number_submit.'" style="width: 50px;" /> Số lần gửi bài cho phép.';
}

add_action('save_post','save_post_meta_fgc_quiz_setting');
function save_post_meta_fgc_quiz_setting($post_id) {
    $number_submit = isset($_POST['number-submit']) ? (int) $_POST['number-submit'] : 0;
    if($number_submit) {
        update_post_meta( $post_id, '_number_submit', $number_submit);
    } else delete_post_meta($post_id, '_number_submit');
}

add_action('add_meta_boxes','register_meta_box_select_quiz'); // 1
function register_meta_box_select_quiz() { // 1
        //if(get_post_type() == 'exercise') 
            add_meta_box( 'list-quiz', 'Import quiz', 'print_box_select_quiz',array('exercise','post'),'advanced','high');
    }
function print_box_select_quiz($post) {
    global $wpdb;
    $list_quiz = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix . "wp_pro_quiz_master", ARRAY_A);
    $post_quiz_id = get_post_meta($post->ID,'_quiz_id',true);

    echo '<select name="quiz_id" onchange="insertShortcode(this.value)">
        <option value="">-- Select quiz --</option>';
    foreach ($list_quiz as $quiz) {
        echo '<option value="'.$quiz['id'].'"'.($quiz['id'] == $post_quiz_id ? ' selected' : '').'>'.$quiz['name'].'</option>';
    }
    echo '</select>';
    ?>
    <script>function insertShortcode(quiz_id) {
        if(quiz_id) {
            /*
            var textarea = jQuery('textarea[name=content]');
            var content_visual = tinymce.activeEditor.getContent();
            var content_text = textarea.html();
            content_text = content_text.replace( /\[WpProQuiz (\d+)\]/g, '');
            content_visual = content_visual.replace( /\[WpProQuiz (\d+)\]/g, '');
            textarea.html(content_text+'[WpProQuiz '+ quiz_id +']');
            */
            var content = jQuery('textarea[name=content]').html();
            content = content.replace( /\[WpProQuiz (\d+)\]/g,  '[WpProQuiz '+ quiz_id +']');

            window.parent.send_to_editor('[WpProQuiz '+ quiz_id +']');
            window.parent.tb_remove();
            return;
            if( typeof tinymce != "undefined" ) {
                var editor = tinymce.get( 'content' );
                if( editor && editor instanceof tinymce.Editor ) {
                    editor.setContent(content );
                    editor.save( { no_events: true } );
                } else {
                    jQuery('textarea#content').val( content );
                }
            }
        }
    }</script><?php
}
add_action('save_post','save_post_meta_quiz_id');
function save_post_meta_quiz_id($post_id) {
    $quiz_id = (int) $_POST['quiz_id']; // when add new
    if($quiz_id) {
        update_post_meta( $post_id, '_quiz_id', $quiz_id);
    } else delete_post_meta($post_id, '_quiz_id');
}

add_filter( 'manage_exercise_posts_columns' ,  'add_column_songuoilambai' );
add_action( 'manage_exercise_posts_custom_column' ,  'display_posts_songuoilambai', 10, 2 );

function add_column_songuoilambai( $columns ) {
        return array_merge( $columns, 
            array( 'songuoilambai' => 'Số người làm bài' ) );
    }
    function display_posts_songuoilambai($column, $post_id) {
        global $wpdb;
        if ($column == 'songuoilambai') {
             $songuoidalambai = get_post_meta($post_id,'_number_student_done',true);
             echo $songuoidalambai;
        }
    }

add_action('wp_ajax_wp_pro_quiz_admin_ajax', 'fgc_savePointAjax');

function fgc_savePointAjax() {
    global $post,$wp_query,$wpdb;
    if(isset($_REQUEST['func']) && $_REQUEST['func']=='completedQuiz') {
        ini_set("display_errors", 1);
        ini_set('html_errors', false);
        error_reporting(E_ALL);
        // chua lay dc post_id o-k> cột post_id == null no ko cho chèn
        // // anh chưa thay file .jsthay roi ma
        $post_id = isset($_POST['data']['post_id']) ? (int) $_POST['data']['post_id'] : null;
        $quiz_id = isset($_POST['data']['quizId']) ? (int) $_POST['data']['quizId'] : null;
        $point = isset($_POST['data']['results']['comp']['points']) ? (float) $_POST['data']['results']['comp']['points'] : 0;
        $user_id = get_current_user_id();
        $query = $wpdb->get_results("SELECT * FROM ".FGC_QUIZ_TABLE_POINT." WHERE post_id = '$post_id' AND user_id = '$user_id'", ARRAY_A);

        $number_submit = (int) get_post_meta($post_id,'_number_submit',true);
        if($number_submit < 1) $number_submit = 1;
        echo "number_submit: $number_submit \n";
        echo "count ".count($query);
        if(!$query || (count($query) < $number_submit)) {
            //echo "Íntall point";
            $wpdb->insert('wp_fgc_table_point', array('post_id' => $post_id, 'quiz_id' => $quiz_id, 'user_id' => $user_id,'point'=>$point)); // code nay ko chay
        }
    }
}


add_filter('post_row_actions','my_action_row', 10, 2);

function my_action_row($actions, $post){
    //check for your post type
    if ($post->post_type == FGC_QUIZ_POST_TYPE){
        $actions['view-point'] = '<a href="edit.php?post_type='.FGC_QUIZ_POST_TYPE.'&page=view-point&post_id='.$post->ID.'">View point</a>';
    }
    return $actions;
}


?>