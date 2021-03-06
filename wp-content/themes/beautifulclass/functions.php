<?php
/**
 * beautifulclass functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package beautifulclass
 */

if ( ! function_exists( 'beautifulclass_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beautifulclass_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on beautifulclass, use a find and replace
	 * to change 'beautifulclass' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'beautifulclass', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'beautifulclass' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'beautifulclass_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'beautifulclass_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beautifulclass_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'beautifulclass_content_width', 640 );
}
add_action( 'after_setup_theme', 'beautifulclass_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beautifulclass_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'beautifulclass' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'beautifulclass' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'beautifulclass_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function beautifulclass_scripts() {
	wp_enqueue_style( 'beautifulclass-style', get_stylesheet_uri() );
	wp_enqueue_style( 'beautifulclass-global', get_template_directory_uri() . '/css/global.css', array( 'beautifulclass-style' ), 'v1' );
	wp_enqueue_style( 'beautifulclass-flexslider', get_template_directory_uri() . '/css/flexslider.css', array( 'beautifulclass-style' ), 'v1' );
	wp_enqueue_style( 'beautifulclass-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( 'beautifulclass-style' ), 'v1' );
	wp_enqueue_style( 'beautifulclass-owl.carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array( 'beautifulclass-style' ), 'v1' );
	wp_enqueue_style( 'beautifulclass-owl.theme.default', get_template_directory_uri() . '/css/owl.theme.default.min.css', array( 'beautifulclass-style' ), 'v1' );
	wp_enqueue_style( 'beautifulclass-index', get_template_directory_uri() . '/css/index.css', array( 'beautifulclass-style' ), 'v1' );
	wp_enqueue_style( 'beautifulclass-themcustom', get_template_directory_uri() . '/css/theme-custom.css', array( 'beautifulclass-style' ), 'v1' );

	wp_enqueue_script( 'beautifulclass-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'beautifulclass-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_enqueue_script( 'beautifulclass-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), 'v1', true );
	wp_enqueue_script( 'beautifulclass-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), 'v1', true );
	wp_enqueue_script( 'beautifulclass-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), 'v1', true );
	wp_enqueue_script( 'beautifulclass-homepage', get_template_directory_uri() . '/js/homepage.js', array(), 'v1', true );
}
add_action( 'wp_enqueue_scripts', 'beautifulclass_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/custom-quotes-page.php';

// Functions that customed by user

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'post-thumb', 300, 300, array( 'center', 'center' ) );

}
function wpdocs_setup_theme_thumb() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 300, 300,array( 'center', 'center')  );
}
add_action( 'after_setup_theme', 'wpdocs_setup_theme_thumb' );

function wpdocs_theme_thumb_wide() {
    add_image_size( 'post-thumb-wide', 450, 233, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'wpdocs_theme_thumb_wide' );

// function to limit excerpt;
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}
// function to limit content;
function content($post_content,$limit) {
    $content = explode(' ', $post_content , $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('`<[^>]*>`','',$content);
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}