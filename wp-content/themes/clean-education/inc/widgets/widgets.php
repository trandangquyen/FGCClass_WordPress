<?php
/**
 * Add Custom Sidebars and Widgets
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 1.0
 */

/**
 * Register widgetized area
 *
 * @since Clean Education 1.0
 */
function clean_education_widgets_init() {
	//Primary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'clean-education' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the primary sidebar if you are using a two column site layout option.', 'clean-education' ),
	) );

	$footer_no = 3; //Number of footer sidebars

	for( $i=1; $i <= $footer_no; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Area %d', 'clean-education' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'description'	=> sprintf( esc_html__( 'Footer %d widget area.', 'clean-education' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'clean_education_widgets_init' );

/**
 * Loads up Necessary JS Scripts for widgets
 *
 * @since Clean Education 1.0
 */
function clean_education_widgets_scripts( $hook) {
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_style( 'clean-education-widgets-styles', get_template_directory_uri() . '/css/widgets.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'clean_education_widgets_scripts' );

// Load Featured Post Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/featured-posts.php';

// Load social icons
include trailingslashit( get_template_directory() ) . 'inc/widgets/social-icons.php';

// Load Instagram Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/instagram.php';