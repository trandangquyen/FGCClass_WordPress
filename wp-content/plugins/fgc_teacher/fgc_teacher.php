<?php
/**
Plugin Name: FGC Manager Teacher
Plugin URI: http://fgc.com
Description: This plugin was created to help teachers who want to manage list member, test score... 
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
        add_action( 'init', array( $this, 'codex_exercises_init'));
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
        add_submenu_page('edit.php?post_type=exercises',
         __('Bài nghe','bai-nghe'), 
         __('Bài nghe','bai-nghe'),
          'manage_options', 'bai-nghe',
           array($this,'fgc_get_contents_category_listen')
        );
        add_submenu_page('edit.php?post_type=exercises',
         __('Bài đọc','bai-doc'), 
         __('Bài đọc','bai-doc'),
          'manage_options', 'bai-doc',
           array($this,'fgc_get_contents_category_read')
        );
        add_submenu_page('edit.php?post_type=exercises',
         __('Bài nói','bai-noi'), 
         __('Bài nói','bai-noi'),
          'manage_options', 'bai-noi',
           array($this,'fgc_get_contents_category_talk')
        );
        add_submenu_page('edit.php?post_type=exercises',
         __('Bài viết','bai-viet'), 
         __('Bài viết','bai-viet'),
          'manage_options', 'bai-viet',
           array($this,'fgc_get_contents_category_write')
        );
    }
    function fgc_get_contents_category_listen(){
       // $_REQUEST['category_name'] = 'bai-nghe';
        //unset($_REQUEST['page']);

        $_SERVER['REQUEST_URI'] = str_replace('&page','&category_name',$_SERVER['REQUEST_URI']);
        $_SERVER['QUERY_STRING'] = str_replace('&page','&category_name',$_SERVER['QUERY_STRING']);
        $typenow = 'exercises';
        // add_action('admin_init', array($this,'set_post_type'));

        include 'edit.php';
    }
    function fgc_get_contents_category_read(){
    	?><script>window.location = "<?php echo admin_url('edit.php?category_name=bai-doc&post_type=exercises'); ?>";</script><?php 
    }
    function fgc_get_contents_category_talk(){
    	?><script>window.location = "<?php echo admin_url('edit.php?category_name=bai-noi&post_type=exercises'); ?>";</script><?php 
    }
    function fgc_get_contents_category_write(){
      //  $_REQUEST['category_name'] = 'bai-viet';
        //unset($_REQUEST['page']);
        //$_SERVER['REQUEST_URI'] = '/FGCClass_WordPress/wp-admin/edit.php?post_type=exercises&category_name=bai-viet';
       $typenow = 'exercises';
       // add_action('admin_init', array($this,'set_post_type'));

    	include 'edit.php';

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
    function codex_exercises_init(){
    	$labels = array(
		'name'               => _x( 'Exercises', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Exercise', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Quản lý bài tập', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Exercise', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Thêm mới', 'Exercise', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Exercise', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Exercise', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Exercise', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Exercise', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Tất cả bài tập', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search exercises', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent exercises:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No exercises found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No exercises found in Trash.', 'your-plugin-textdomain' )
		);
		$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'Exercise' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'          => array( 'category' )
		);

		register_post_type( 'exercises', $args );
    }
}
$fgc_manager = new FGC_Manager();