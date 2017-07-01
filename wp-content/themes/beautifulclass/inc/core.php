<?php

/**
 * Core functions and definitions
 * @package Catch Themes
 * @subpackage Beautiful Class
 * @since Beautiful Class
 */

function beautifulclass_bottom_nav() {
    global $wp_query, $post;
    /**/
    if(is_single()){
        $previous = (is_attachment())? get_post($post->post_parent) : get_adjacent_post(false,'',true);
        $next = get_adjacent_post(false,'', false);
        
        if(!$next && !$previous){
            return;
        }
    }
    /* Không hiển thị nếu chỉ có 1 trang duy nhất*/
    if($wp_query->max_num_page<2 && (is_home()|| is_archive()|| is_search())){
        return;
    }
    
}


/* Tạo mới 1 sidebar*/

add_action( 'widgets_init', 'login_custom_sidebar' );
function login_custom_sidebar() {
    register_sidebar( array(
        'name' => __( 'Social Login', 'beautifulclass' ),
        'id' => 'sidebar-2',
        'description' => __( 'Widget hiển thị Social Login.', 'beautifulclass' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}

/* Tạo trang Registration*/
