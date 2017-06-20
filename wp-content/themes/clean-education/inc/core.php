<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, clean_education_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * Clean Education functions and definitions
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

if ( ! function_exists( 'clean_education_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function clean_education_content_width() {
		$content_width = 829; /* pixels */

		$GLOBALS['content_width'] = apply_filters( 'clean_education_content_width', $content_width );
	}
endif;
add_action( 'after_setup_theme', 'clean_education_content_width', 0 );


if ( ! function_exists( 'clean_education_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function clean_education_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options = clean_education_get_theme_options();

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Clean Education, use a find and replace
		 * to change 'clean-education' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'clean-education', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Add Clean Education's custom image sizes
		add_image_size( 'clean-education-slider', 1320, 566, true ); // Used for Featured slider Ratio 21:9

		add_image_size( 'clean-education-featured-content', 480, 320, true ); // used in Featured Content Options Ratio 4:3

		//Archive Images
		add_image_size( 'clean-education-featured', 829, 622, true); // used in Archive Top Ratio 4:3

		add_image_size( 'clean-education-square', 240, 240, true ); // used in Archive Left/Right Ratio 1:1

    	/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'clean-education' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		if ( 'light' == $options['color_scheme'] ) {
			$default_bg_color = clean_education_get_default_theme_options();
			$default_bg_color = $default_bg_color['background_color'];
		}
		elseif ( 'dark' == $options['color_scheme'] ) {
			$default_bg_color = clean_education_default_dark_color_options();
			$default_bg_color = $default_bg_color['background_color'];
		}

		add_theme_support( 'custom-background', apply_filters( 'clean_education_custom_background_args', array(
			'default-color' => $default_bg_color,
		) ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', clean_education_fonts_url() ) );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		* Setup Custom Logo Support for theme
		* Supported from WordPress version 4.5 onwards
		* More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		*/
		add_theme_support( 'custom-logo' );

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type	= $options['pagination_type'];

		if ( 'infinite-scroll-click' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'click',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
		elseif ( 'infinite-scroll-scroll' == $pagination_type ) {
			//Override infinite scroll disable scroll option
        	update_option('infinite_scroll', true);

        	add_theme_support( 'infinite-scroll', array(
				'type'		=> 'scroll',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
	}
endif; // clean_education_setup
add_action( 'after_setup_theme', 'clean_education_setup' );


/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Open Sans and Droid Sans by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Clean Education 0.1
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function clean_education_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Merriweather, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$merriweather = _x( 'on', 'Merriweather: on or off', 'clean-education' );

	/* Translators: If there are characters in your language that are not
	* supported by Montserrat, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'clean-education' );

	if ( 'off' !== $merriweather || 'off' !== $montserrat ) {
		$font_families = array();

		if ( 'off' !== $merriweather ) {
		$font_families[] = 'Merriweather';
		}

		if ( 'off' !== $montserrat ) {
		$font_families[] = 'Montserrat';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since Clean Education 0.1
 */
function clean_education_scripts() {
	$options = clean_education_get_theme_options();

	// Add Merriweather and Montserrat font, used in the main stylesheet.
	wp_enqueue_style( 'clean-education-fonts', clean_education_fonts_url(), array(), CLEAN_EDUCATION_THEME_VERSION );

	wp_enqueue_style( 'clean-education-style', get_stylesheet_uri() );

	wp_enqueue_script( 'clean-education-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), CLEAN_EDUCATION_THEME_VERSION, true );

	// Load the html5 shiv.
	wp_enqueue_script( 'clean-education-html5', get_template_directory_uri() . '/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'clean-education-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'clean-education-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), CLEAN_EDUCATION_THEME_VERSION, true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//For genericons
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons/genericons.css', false, '3.4.1' );

	/**
	 * Enqueue the styles for the current color scheme for Clean Education.
	 */
	if ( 'light' != $options['color_scheme'] ) {
		wp_enqueue_style( 'clean-education-dark', get_template_directory_uri() . '/css/colors/dark.css', array(), null );
	}

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.1', true );


	/**
	 * Loads up Cycle JS
	 */
	if ( 'disabled' != $options['news_ticker_option'] || 'disabled' != $options['featured_slider_option'] || $options['courses_slider'] || $options['testimonial_slider'] || 'disabled' != $options['logo_slider_option']  ) {
		wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			$options['featured_slider_transition_effect'],
			$options['news_ticker_transition_effect']
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition
		if ( in_array( 'scrollVert', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-scrollVert', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), CLEAN_EDUCATION_THEME_VERSION, true );
		}

		if ( in_array( 'flipHorz', $transition_effects ) || in_array( 'flipVert', $transition_effects ) ){
			// Flip transition plugin addition
			wp_enqueue_script( 'jquery-cycle2-flip', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), CLEAN_EDUCATION_THEME_VERSION, true );
		}

		if ( in_array( 'tileSlide', $transition_effects ) || in_array( 'tileBlind', $transition_effects ) ){
			// tile transition plugin addition
			wp_enqueue_script( 'jquery-cycle2-tile', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), CLEAN_EDUCATION_THEME_VERSION, true );
		}

		if ( in_array( 'shuffle', $transition_effects ) ){
			// Shuffle transition plugin addition
			wp_enqueue_script( 'jquery-cycle2-shuffle', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), CLEAN_EDUCATION_THEME_VERSION, true );
		}

		if ( 'disabled' != $options['logo_slider_option'] ) {
			wp_enqueue_script( 'jquery-cycle2-carousel', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.carousel.min.js', array( 'jquery-cycle2' ), CLEAN_EDUCATION_THEME_VERSION, true );
		}
	}

	/**
	 * Loads up Scroll Up script
	 */
	if ( ! $options['disable_scrollup'] ) {
		wp_enqueue_script( 'clean-education-scrollup', get_template_directory_uri() . '/js/scrollup.min.js', array( 'jquery' ), CLEAN_EDUCATION_THEME_VERSION, true  );
	}

	/**
	 * Enqueue custom script for Clean Education.
	 */
	wp_enqueue_script( 'clean-education-custom-scripts', get_template_directory_uri() . '/js/custom-scripts.min.js', array( 'jquery' ), null );

	wp_localize_script( 'clean-education-custom-scripts', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'clean-education' ),
		'collapse' => esc_html__( 'collapse child menu', 'clean-education' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'clean_education_scripts' );


/**
 * Returns the options array for Clean Education.
 * @uses  get_theme_mod
 *
 * @since Clean Education 0.1
 */
function clean_education_get_theme_options() {
	$default_options = clean_education_get_default_theme_options();

	return array_merge( $default_options , get_theme_mod( 'clean_education_theme_options', $default_options ) ) ;
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, clean_education_customize_preview (see clean_education_customizer function: clean_education_customize_preview)
 *
 * @since Clean Education 0.1
 */
function clean_education_flush_transients(){
	delete_transient( 'clean_education_hero_content' );
	delete_transient( 'clean_education_featured_content' );
	delete_transient( 'clean_education_events' );
	delete_transient( 'clean_education_our_professors' );
	delete_transient( 'clean_education_news' );
	delete_transient( 'clean_education_news_ticker' );
	delete_transient( 'clean_education_promotion_headline' );
	delete_transient( 'clean_education_portfolio' );
	delete_transient( 'clean_education_logo_slider' );
	delete_transient( 'clean_education_testimonial' );
	delete_transient( 'clean_education_courses' );
	delete_transient( 'clean_education_featured_slider' );
	delete_transient( 'clean_education_custom_css' );
	delete_transient( 'clean_education_footer_content' );
	delete_transient( 'clean_education_featured_image' );
	delete_transient( 'clean_education_social_icons' );
	delete_transient( 'clean_education_scrollup' );
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'customize_save', 'clean_education_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since Clean Education 0.1
 */
function clean_education_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'clean_education_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since Clean Education 0.1
 */
function clean_education_flush_post_transients(){
	delete_transient( 'clean_education_hero_content' );
	delete_transient( 'clean_education_featured_content' );
	delete_transient( 'clean_education_events' );
	delete_transient( 'clean_education_our_professors' );
	delete_transient( 'clean_education_news' );
	delete_transient( 'clean_education_news_ticker' );
	delete_transient( 'clean_education_promotion_headline' );
	delete_transient( 'clean_education_portfolio' );
	delete_transient( 'clean_education_logo_slider' );
	delete_transient( 'clean_education_testimonial' );
	delete_transient( 'clean_education_courses' );
	delete_transient( 'clean_education_featured_slider' );
	delete_transient( 'clean_education_featured_image' );
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'clean_education_flush_post_transients' );


if ( ! function_exists( 'clean_education_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options         = clean_education_get_theme_options();
		$pagination_type = $options['pagination_type'];

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>
	        <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>">
	        	<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'clean-education' ); ?></h3>
				<?php
				/**
				 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
				 */
				if ( 'numeric' == $pagination_type ) {
					if ( function_exists( 'wp_pagenavi' ) ) {
						wp_pagenavi();
					}
					else {
						// Previous/next page navigation.
						the_posts_pagination( array(
							'prev_text'          => esc_html__( 'Previous page', 'clean-education' ),
							'next_text'          => esc_html__( 'Next page', 'clean-education' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'clean-education' ) . ' </span>',
						) );
					}
	            }
	            else { ?>
	                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'clean-education' ) ); ?></div>
	                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'clean-education' ) ); ?></div>
	            <?php
	            } ?>
	        </nav><!-- #nav -->
		<?php
	}
endif; // clean_education_content_nav


if ( ! function_exists( 'clean_education_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'clean-education' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'clean-education' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'clean-education' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'clean-education' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( esc_html__( 'Edit', 'clean-education' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'clean-education' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // clean_education_comment()


if ( ! function_exists( 'clean_education_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'clean_education_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( 'echo=0' ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //clean_education_the_attached_image


if ( ! function_exists( 'clean_education_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_entry_meta() {
		echo '<p class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( __( '<span class="screen-reader-text">Posted on</span>', 'clean-education' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'clean-education' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'clean-education' ), esc_html__( '1 Comment', 'clean-education' ), esc_html__( '% Comments', 'clean-education' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'clean-education' ), '<span class="edit-link">', '</span>' );

		echo '</p><!-- .entry-meta -->';
	}
endif; //clean_education_entry_meta


if ( ! function_exists( 'clean_education_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-education' ) );
			if ( $categories_list && clean_education_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'clean-education' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-education' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'clean-education' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //clean_education_tag_category


if ( ! function_exists( 'clean_education_categorized_blog' ) ) :
	/**
	 * Returns true if a blog has more than 1 category
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'all_the_cool_cats', $all_the_cool_cats );
		}

		if ( '1' != $all_the_cool_cats ) {
			// This blog has more than 1 category so clean_education_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so clean_education_categorized_blog should return false
			return false;
		}
	}
endif; //clean_education_categorized_blog


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Clean Education 0.1
 */
function clean_education_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'clean_education_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Clean Education 0.1
 */
function clean_education_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'clean_education_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$options = clean_education_get_theme_options();
		$length  = $options['excerpt_length'];
		return $length;
	}
endif; //clean_education_excerpt_length
add_filter( 'excerpt_length', 'clean_education_excerpt_length' );


if ( ! function_exists( 'clean_education_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_continue_reading() {
		// Getting data from Customizer Options
		$options		=	clean_education_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return ' <span class="readmore"><a href="'. esc_url( get_permalink() ) . '">' . $more_tag_text . '</a></span>';
	}
endif; //clean_education_continue_reading
add_filter( 'excerpt_more', 'clean_education_continue_reading' );


if ( ! function_exists( 'clean_education_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with clean_education_continue_reading().
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_excerpt_more( $more ) {
		return clean_education_continue_reading();
	}
endif; //clean_education_excerpt_more
add_filter( 'excerpt_more', 'clean_education_excerpt_more' );


if ( ! function_exists( 'clean_education_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= clean_education_continue_reading();
		}
		return $output;
	}
endif; //clean_education_custom_excerpt
add_filter( 'get_the_excerpt', 'clean_education_custom_excerpt' );


if ( ! function_exists( 'clean_education_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_more_link( $more_link, $more_link_text ) {
	 	$options		=	clean_education_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //clean_education_more_link
add_filter( 'the_content_more_link', 'clean_education_more_link', 10, 2 );


if ( ! function_exists( 'clean_education_body_classes' ) ) :
	/**
	 * Adds Clean Education layout classes to the array of body classes.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_body_classes( $classes ) {
		$options = clean_education_get_theme_options();

		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		$layout = clean_education_get_theme_layout();

		switch ( $layout ) {
			case 'right-sidebar':
				$classes[] = 'two-columns content-left';
			break;

			case 'no-sidebar':
				$classes[] = 'no-sidebar content-width';
			break;
		}

		if ( "" != $options['content_layout'] ) {
			$classes[] = $options['content_layout'];
		}

		//Count number of menus avaliable and set class accordingly
		$mobile_menu_count = 1; // For primary menu

		switch ( $mobile_menu_count ) {
			case 1:
				$classes[] = 'mobile-menu-one';
				break;

			case 2:
				$classes[] = 'mobile-menu-two';
				break;

			case 3:
				$classes[] = 'mobile-menu-three';
				break;
		}

		$classes 	= apply_filters( 'clean_education_body_classes', $classes );

		return $classes;
	}
endif; //clean_education_body_classes
add_filter( 'body_class', 'clean_education_body_classes' );


if ( ! function_exists( 'clean_education_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

	    // Front page displays in Reading Settings
		$page_on_front  = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $id = $page_id;
	    }
	    elseif ( is_singular() ) {
	 		if ( is_attachment() ) {
				$id = $post->post_parent;
			}
			else {
				$id = $post->ID;
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'clean-education-layout-option', true );
		}
		else {
			$layout = 'default';
		}

		//Load options data
		$options = clean_education_get_theme_options();

		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			$layout = $options['theme_layout'];
		}

		return $layout;
	}
endif; //clean_education_get_theme_layout


if ( ! function_exists( 'clean_education_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own clean_education_archive_content_image(), and that function will be used instead.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_archive_content_image() {
		$options        = clean_education_get_theme_options();
		$featured_image = $options['content_layout'];

		if ( has_post_thumbnail() && 'excerpt-image-left' == $featured_image ) {
		?>
			<figure class="featured-image">
	            <a rel="bookmark" href="<?php the_permalink(); ?>">
	                <?php
	                	the_post_thumbnail( 'clean-education-square' );
					?>
				</a>
	        </figure>
	   	<?php
		}
	}
endif; //clean_education_archive_content_image
add_action( 'clean_education_before_entry_container', 'clean_education_archive_content_image', 10 );


if ( ! function_exists( 'clean_education_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own clean_education_single_content_image(), and that function will be used instead.
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_single_content_image() {
		global $post, $wp_query;

		// Getting data from Theme Options
	   	$options = clean_education_get_theme_options();

		$featured_image = $options['single_post_image_layout'];

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		if ( $post ) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$metabox_feat_img = get_post_meta( $parent,'clean-education-featured-image', true );
			} else {
				$metabox_feat_img = get_post_meta( $page_id,'clean-education-featured-image', true );
			}
		}

		if ( empty( $metabox_feat_img ) || ( !is_page() && !is_single() ) ) {
			$metabox_feat_img = 'default';
		}

		if ( 'disable' == $metabox_feat_img  || '' == get_the_post_thumbnail() || ( 'default' == $metabox_feat_img && 'disabled' == $featured_image ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $metabox_feat_img ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $metabox_feat_img;
				$featured_image = $metabox_feat_img;
			}

			?>
			<figure class="featured-image <?php echo esc_attr( $class ); ?>">
                <?php the_post_thumbnail( $featured_image ); ?>
	        </figure>
	   	<?php
		}
	}
endif; //clean_education_single_content_image
add_action( 'clean_education_before_post_container', 'clean_education_single_content_image', 10 );
add_action( 'clean_education_before_page_container', 'clean_education_single_content_image', 10 );


if ( ! function_exists( 'clean_education_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @display comments_template
	 * @action clean_education_comment_section
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_get_comment_section() {
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
	}
endif;
add_action( 'clean_education_comment_section', 'clean_education_get_comment_section', 10 );


/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action clean_education_footer
 *
 * @since Clean Education 0.1
 */
function clean_education_footer_content() {
	clean_education_flush_transients();
	if ( ! $output = get_transient( 'clean_education_footer_content' ) ) {
		echo '<!-- refreshing cache -->';

		$content = clean_education_get_content();

		$output =  '
    	<div id="site-generator" class="site-info two">
    		<div class="wrapper">
    			<div id="footer-left-content" class="copyright">' . $content['left'] . '</div>

    			<div id="footer-right-content" class="powered">' . $content['right'] . '</div>
			</div><!-- .wrapper -->
		</div><!-- #site-generator -->';

	    set_transient( 'clean_education_footer_content', $output, 0 );//86940
    }

    echo $output;
}
add_action( 'clean_education_footer', 'clean_education_footer_content', 100 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Clean Education 0.1
 */

function clean_education_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="wp-post-image" src="'. esc_url( $first_img ) .'">';
	}
	else {
		return false;
	}
}


if ( ! function_exists( 'clean_education_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action clean_education_footer action
	 * @uses set_transient and delete_transient
	 */
	function clean_education_scrollup() {
		//clean_education_flush_transients();
		if ( !$scrollup = get_transient( 'clean_education_scrollup' ) ) {

			// get the data value from theme options
			$options = clean_education_get_theme_options();
			echo '<!-- refreshing cache -->';

			//site stats, analytics header code
			if ( ! $options['disable_scrollup'] ) {
				$scrollup =  '<a href="#masthead" id="scrollup" class="scroll-to-top"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'clean-education' ) . '</span></a>' ;
			}

			set_transient( 'clean_education_scrollup', $scrollup, 86940 );
		}
		echo $scrollup;
	}
}
add_action( 'clean_education_after', 'clean_education_scrollup', 10 );


if ( ! function_exists( 'clean_education_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function clean_education_page_post_meta() {
		$author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );

		$output = '<span class="post-time">' . esc_html__( 'Posted on', 'clean-education' ) . ' <time class="entry-date updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></span>';
	    $output .= '<span class="post-author">' . esc_html__( 'By', 'clean-education' ) . ' <span class="author vcard"><a class="url fn n" href="' . esc_url( $author_url ) . '" title="View all posts by ' . esc_attr( get_the_author() ) . '" rel="author">' .get_the_author() . '</a></span>';

		return $output;
	}
endif; //clean_education_page_post_meta


if ( ! function_exists( 'clean_education_alter_home' ) ) :
	/**
	 * Alter the query for the main loop in homepage
	 *
	 * @action pre_get_posts action
	 */
	function clean_education_alter_home( $query ){
		if ( $query->is_main_query() && $query->is_home() ) {
			$options = clean_education_get_theme_options();

		    $cats = $options['front_page_category'];

			if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
				$query->query_vars['category__in'] = $options['front_page_category'];
			}
		}
	}
endif; //clean_education_alter_home
add_action( 'pre_get_posts','clean_education_alter_home' );


if ( ! function_exists( 'clean_education_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action clean_education_after_post
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_navigation() {
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next &rarr;', 'clean-education' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'clean-education' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( '&larr; Previous', 'clean-education' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'clean-education' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	}
endif; //clean_education_post_navigation
add_action( 'clean_education_after_post', 'clean_education_post_navigation', 10 );


/**
 * Display Multiple Select type for and array of categories
 *
 * @param  string $name  [field name]
 * @param  string $id    [field_id]
 * @param  array $selected    [selected values]
 * @param  string $label [label of the field]
 */
function clean_education_dropdown_categories( $name, $id, $selected, $label = '' ) {
	$dropdown = wp_dropdown_categories(
		array(
			'name'             => $name,
			'echo'             => 0,
			'hide_empty'       => false,
			'show_option_none' => false,
			'hierarchical'       => 1,
		)
	);

	if ( '' != $label ) {
		echo '<label for="' . $id . '">
			'. $label .'
			</label>';
	}

	$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:120px; width: 100%" ', $dropdown );

	foreach( $selected as $selected ) {
		$dropdown = str_replace( 'value="'. $selected .'"', 'value="'. $selected .'" selected="selected"', $dropdown );
	}

	echo $dropdown;

	echo '<span class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'clean-education' ) . '</span>';
}


/**
 * Return registered image sizes.
 *
 * Return a two-dimensional array of just the additionally registered image sizes, with width, height and crop sub-keys.
 *
 * @since 0.1.7
 *
 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
 *
 * @return array Two-dimensional, with width, height and crop sub-keys.
 */
function clean_education_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( $_wp_additional_image_sizes )
		return $_wp_additional_image_sizes;

	return array();
}


if ( ! function_exists( 'clean_education_get_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_get_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-education' ) );
			if ( $categories_list && clean_education_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'clean-education' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-education' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'clean-education' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'clean-education' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'clean-education' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //clean_education_get_meta


function clean_education_generate_post_array( $post_type ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   =>-1,
		)
	);

	foreach ( $posts as $post ) {
        $output[$post->ID] = $post->post_title;
    }

    return $output;
}


if ( ! function_exists( 'clean_education_get_highlight_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Clean Education 1.0
	 */
	function clean_education_get_highlight_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-education' ) );
			if ( $categories_list && clean_education_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'clean-education' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'clean-education' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'clean-education' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'clean-education' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'clean-education' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //clean_education_get_highlight_meta

/**
 * Migrate Custom CSS to WordPress core Custom CSS
 *
 * Runs if version number saved in theme_mod "custom_css_version" doesn't match current theme version.
 */
function clean_education_custom_css_migrate(){
	$ver = get_theme_mod( 'custom_css_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}

	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.

	    /**
		 * Get Theme Options Values
		 */
	    $options = clean_education_get_theme_options();

	    if ( '' != $options['custom_css'] ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $options['custom_css'] );

	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	            unset( $options['custom_css'] );
	            set_theme_mod( 'clean_education_theme_options', $options );

	            // Update to match custom_css_version so that script is not executed continously
				set_theme_mod( 'custom_css_version', '4.7' );
	        }
	    }
	}
}
add_action( 'after_setup_theme', 'clean_education_custom_css_migrate' );


/**
 * Default Options.
 */
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

/**
 * Custom Header.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';


/**
 * Structure for Clean Education
 */
require trailingslashit( get_template_directory() ) . 'inc/structure.php';


/**
 * Menus for Clean Education
 */
require trailingslashit( get_template_directory() ) . 'inc/menus.php';


/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer.php';


/**
 * Custom CSS
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-css.php';


/**
 * Load Slider file.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-slider.php';


/**
 * Load Featured Content.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-content.php';

/**
 * Load Courses.
 */
require trailingslashit( get_template_directory() ) . 'inc/courses.php';


/**
 * Load Testimonials.
 */
require trailingslashit( get_template_directory() ) . 'inc/testimonial.php';


/**
 * Load Hero Content.
 */
require trailingslashit( get_template_directory() ) . 'inc/hero-content.php';


/**
 * Load Logo Slider.
 */
require trailingslashit( get_template_directory() ) . 'inc/logo-slider.php';


/**
 * Load Portfolio.
 */
require trailingslashit( get_template_directory() ) . 'inc/portfolio.php';


/**
 * Load Promotion Headline
 */
require trailingslashit( get_template_directory() ) . 'inc/promotion-headline.php';


/**
 * Load News.
 */
require trailingslashit( get_template_directory() ) . 'inc/news.php';


/**
 * Load Our Professors
 */
require trailingslashit( get_template_directory() ) . 'inc/our-professors.php';


/**
 * Load Breadcrumb file.
 */
require trailingslashit( get_template_directory() ) . 'inc/breadcrumb.php';


/**
 * Load News Ticker.
 */
require trailingslashit( get_template_directory() ) . 'inc/news-ticker.php';


/**
 * Load Widgets and Sidebars
 */
require trailingslashit( get_template_directory() ) . 'inc/widgets/widgets.php';


/**
 * Load Social Icons
 */
require trailingslashit( get_template_directory() ) . 'inc/social-icons.php';


/**
 * Load Metaboxes
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';