<?php
/*
Plugin Name: Custom plugin for Quiz
Author: khoazero123
Description:
*/
function add_class_meta_box() {
    add_meta_box( 'class-name', 'Lớp', 'print_box_class_name','post');
}
add_action('add_meta_boxes','add_class_meta_box'); 

function print_box_class_name($post) {
    $list_classname = get_option('quiz_options_course', []);
    $classpost = get_post_meta($post->ID,'_classname',true);

    wp_nonce_field( 'save_nonce_classname', 'info_nonce_classname');
    echo '<label for="class_name">This post belong to class: </label>';
    //echo '<input type="text" name="classname" value="'.$classname.'" />';
    if ( is_admin() ) {
        echo '<select name="classname">
            <option value="">-- Select class --</option>';
            //foreach ($list_classname as $classname => $member) {
            foreach ($list_classname as $class) {
                $classname = $class['name'];
                echo '<option value="'.$classname.'"'.($classpost == $classname ? ' selected' : '').'>'.$classname.'</option>';
            }
            echo '</select>';
    }
}

function save_class_name($post_id) {
    $info_nonce = $_POST['info_nonce_classname'];
    if(!isset($_POST['info_nonce_classname'])) return;
    if(!wp_verify_nonce($_POST['info_nonce_classname'],'save_nonce_classname')) return;
    
    if(!empty($_POST['classname'])) {
        $classname = sanitize_text_field($_POST['classname']);
        update_post_meta( $post_id, '_classname', $classname);
    }
}
add_action('save_post','save_class_name');

function settingMenu() {
    $menuSlug = 'setting-quiz-site';
    add_menu_page('Site options', 'Site options', 'manage_options', $menuSlug, 'print_list_class_setting',null,2);
    add_submenu_page($menuSlug, "List class", "List class", 'manage_options', $menuSlug . '-list','print_list_class_setting');
    add_submenu_page($menuSlug, "Add class", "Add class", 'manage_options', $menuSlug . '-add','print_add_class_setting');

}
function print_list_class_setting() {
    if(isset($_GET['action']) && $_GET['action']=='delete') return quiz_delete_class();
    //if(isset($_GET['action']) && $_GET['action']=='edit') return quiz_edit_class();
    $list_classname = get_option('quiz_options_course', []);
    echo '<div class="wrap">';
    echo '<h1 class="wp-heading-inline">List class</h1><br />'; ?>
    <table class="wp-list-table widefat fixed striped posts" style="width:60%">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-author">Class name</th>
                <th scope="col" id="count" class="manage-column column-author">Members</th>
                <th scope="col" id="public" class="manage-column column-author">Public</th>
                <th scope="col" id="action" class="manage-column column-author">Action</th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php 
            //var_dump($list_classname);
            //foreach ($list_classname as $classname => $member) {
            foreach ($list_classname as $class) {
                $classname = $class['name'];
                $member = $class['members'];
                $public = $class['public'];
                echo '<tr>
                    <td>'.$classname.'</td>
                    <td> '.$member.' </td>
                    <td> '.($public===1 ? 'Public' : 'Private').' </td>
                    <td> <a href="?'.$_SERVER['QUERY_STRING'].'&action=delete&classname='.$classname.'">Delete</a> </td>
                </tr>';
            }
            ?>
        </tbody></table>
    <?php
    echo '</div>';
}
function print_add_class_setting() {
    $list_classname = get_option('quiz_options_course', []);

    echo '<div class="wrap">';
    echo '<h1 class="wp-heading-inline">Add class</h1><br />';
    if(!empty($_REQUEST['classname'])) {
        $classname = sanitize_text_field($_REQUEST['classname']);
        //$list_classname[$classname] = 0;
        $list_classname[$classname] = [
                                        'name' => $classname,
                                        'members' => 0,
                                        'public' => (isset($_POST['public']) && $_POST['public']==1) ? 1 : 0,
                                    ];
        if(empty($list_classname)) add_option('quiz_options_course', $list_classname, '', 'yes');
        else
            update_option('quiz_options_course', $list_classname);
        
        //add_action( 'admin_notices', 'sample_admin_notice__success',10,'Add class <u>'.$classname.'</u> success' );
        echo '<div id="message" class="updated notice notice-success is-dismissible"><p>Add class <u>'.$classname.'</u> success</p></div>';
    }
     ?>
        <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
            <label for="class_name">Class name: </label>
            <input type="text" name="classname" value="" placeholder="Enter class name" />
            <input type="checkbox" name="public" value="1" id="public"><label for="signup"> Any one can free to signup this class!</label><br /><br /><br />
            <input type="submit" class="button button-primary button-large" value="Add" />
        </form>
    </div>
    <?php
}
add_action('admin_menu', 'settingMenu');

function quiz_delete_class() {
    if(!empty($_GET['classname'])) {
        $list_classname = get_option('quiz_options_course', []);
        $classname = $_GET['classname'];
        if(isset($list_classname[$classname])) {
            unset($list_classname[$classname]);
            update_option('quiz_options_course', $list_classname);
            echo '<div class="notice notice-success is-dismissible"><p>Delete class <u>'.$classname.'</u> success</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
        } else echo '<div class="notice notice-error"><p>Class <u>'.$classname.'</u> no exist!</p></div>';

        
    } else echo '<div class="notice notice-error"><p>Please enter a class name to delete</p></div>';
}


/*
Show field class name in profile
 */

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) {
	$list_classname = get_option('quiz_options_course', []);
 ?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter">Class name:</label></th>
			<td>
			<?php if ( ! is_admin() ) { ?>
				<input type="text" value="<?php echo esc_attr( get_the_author_meta( '_classname', $user->ID ) ); ?>" class="regular-text" disabled /><br />
				<span class="description">Your class name.</span>
			<?php } else {
				echo '<select name="classname">
					<option value="">-- Select class --</option>';
					//foreach ($list_classname as $classname => $member) {
					foreach ($list_classname as $class) {
                        $classname = $class['name'];
                        $member = $class['members'];
						echo '<option value="'.$classname.'"'.(esc_attr(get_the_author_meta('_classname', $user->ID )) == $classname ? ' selected' : '').'>'.$classname.' ('.$member.' members)</option>';
					}
					echo '</select>';
			} ?>
			</td>
		</tr>
	</table>
<?php }

/*
Save field class name
 */

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
    if ( ! is_admin() ) return false;
    $list_classname = get_option('quiz_options_course', []);
    $classname = sanitize_text_field($_POST['classname']);
	$list_classname[$classname] = $list_classname[$classname] + 1;
	update_option('quiz_options_course', $list_classname);
	update_usermeta( $user_id, '_classname', $_POST['classname'] );
}


function sample_admin_notice__success($message=null) {
    $message = $message ? $message : 'Done!';
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php echo $message; ?></p>
    </div>
    <?php
}

function sample_admin_notice__error($message=null) {
	$class = 'notice notice-error';
    $message = $message ? $message : 'Irks! An error has occurred.';

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}
