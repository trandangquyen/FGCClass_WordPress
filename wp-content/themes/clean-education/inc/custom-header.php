<?php
/**
 * Implement Custom Header functionality
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( ! function_exists( 'clean_education_custom_header' ) ) :
/**
 * Implementation of the Custom Header feature
 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function clean_education_custom_header() {

		$options 	= clean_education_get_theme_options();

		if ( 'light' == $options['color_scheme'] ) {
			$default_header_color = clean_education_get_default_theme_options();
			$default_header_color = $default_header_color['header_textcolor'];
		}
		elseif ( 'dark' == $options['color_scheme'] ) {
			$default_header_color = clean_education_default_dark_color_options();
			$default_header_color = $default_header_color['header_textcolor'];
		}

		$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => $default_header_color,

		// Header image default
		'default-image'			=> get_template_directory_uri() . '/images/buddha.jpg',

		// Set height and width, with a maximum value for the width.
		'height'                 => 400,
		'width'                  => 1200,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,
	);

	$args = apply_filters( 'custom-header', $args );

	// Add support for custom header
	add_theme_support( 'custom-header', $args );

	}
endif; // clean_education_custom_header
add_action( 'after_setup_theme', 'clean_education_custom_header' );


if ( ! function_exists( 'clean_education_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses clean_education_get_theme_options , get_header_textcolor, get_bloginfo, display_header_text
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @action
	 *
	 * @since Clean Education 1.0
	 */
	function clean_education_site_branding() {
		$options = clean_education_get_theme_options();

		$class = $class_header= '';

		if ( ! display_header_text() ) {
			$class_header = 'class="screen-reader-text"';
			$class        = ' screen-reader-text';
		}

		$header_text = '<div id="site-header" ' . $class_header . '>';
			if ( is_front_page() && is_home() ) : 
				$header_text .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';
			else :
				$header_text .= '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></p>';
			endif;
			$header_text .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>
		</div><!-- #site-header -->';


		$output = '<div class="site-branding' . $class . '">' . $header_text . '</div><!-- #site-branding-->';

		if ( has_custom_logo() ) {
			if ( $options['move_title_tagline'] ) {
				$output = '<div class="site-branding logo-right">' . $header_text . '<div id="site-logo">'. get_custom_logo() . '</div><!-- #site-logo --></div><!-- .site-branding.logo-right -->';
			}
			else {
				$output = '<div class="site-branding logo-left">' . '<div id="site-logo">'. get_custom_logo() . '</div><!-- #site-logo -->' . $header_text . '</div><!-- .site-branding.logo-left -->';
			}
		}

		echo $output ;
	}
endif; // clean_education_site_branding
add_action( 'clean_education_header', 'clean_education_site_branding', 50 );


if ( ! function_exists( 'clean_education_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own clean_education_featured_image(), and that function will be used instead.
	 *
	 * @since Clean Education 1.0
	 */
	function clean_education_featured_image() {
		$options      = clean_education_get_theme_options();
		$header_image = get_header_image();

		//Support Random Header Image
		if ( is_random_header_image() ) {
			delete_transient( 'clean_education_featured_image' );
		}

		if ( !$output = get_transient( 'clean_education_featured_image' ) ) {

			echo '<!-- refreshing cache -->';

			if ( '' != $header_image  ) {

				// Header Image Link and Target
				if ( !empty( $options['featured_header_image_url'] ) ) {
					//support for qtranslate custom link
					if ( function_exists( 'qtrans_convertURL' ) ) {
						$link = qtrans_convertURL($options['featured_header_image_url']);
					}
					else {
						$link = esc_url( $options['featured_header_image_url'] );
					}
					//Checking Link Target
					if ( !empty( $options['featured_header_image_base'] ) )  {
						$target = '_blank';
					}
					else {
						$target = '_self';
					}
				}
				else {
					$link = '';
					$target = '';
				}

				$alt_title = $options['featured_header_image_alt'];

				// Header Image
				$feat_image = '<img class="wp-post-image" alt="' . esc_attr( $alt_title ) . '" src="' . esc_url(  $header_image ) . '" />';

				$output = '<div id="header-featured-image">
					<div class="wrapper">';

				// Header Image Link
				if ( !empty( $options['featured_header_image_url'] ) ) {
					$output .= '<a title="' . esc_attr( $alt_title ) . '" href="'. esc_url( $link ) . '" target="' . $target . '">' . $feat_image . '</a>';
				} else {
					// if empty featured_header_image on theme options, display default
					$output .= $feat_image;
				}

				$output .= '</div><!-- .wrapper -->
				</div><!-- #header-featured-image -->';
			}

			set_transient( 'clean_education_featured_image', $output, 86940 );
		}

		echo $output;

	} // clean_education_featured_image
endif;


if ( ! function_exists( 'clean_education_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own clean_education_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Clean Education 1.0
	 */
	function clean_education_featured_page_post_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		$page_for_posts = get_option('page_for_posts');

		if ( is_home() && $page_for_posts == $page_id ) {
			$header_page_id = $page_id;
		}
		else {
			$header_page_id = $post->ID;
		}

		if ( has_post_thumbnail( $header_page_id ) ) {
			$options           = clean_education_get_theme_options();
			$header_image_url  = $options['featured_header_image_url'];
			$header_image_base = $options['featured_header_image_base'];
			$header_image_alt  = $options['featured_header_image_alt'];
			$header_image_size = $options['featured_image_size'];

			if ( '' != $header_image_url ) {
				$target = '_self';

				//support for qtranslate custom link
				if ( function_exists( 'qtrans_convertURL' ) ) {
					$header_image_url = qtrans_convertURL( $header_image_url );
				}

				//Checking Link Target
				if ( $header_image_base ) {
					$target = '_blank';
				}
			}

			$feat_image = get_the_post_thumbnail( $post->ID, $header_image_size, array( 'id' => 'main-feat-img', 'alt' => $header_image_alt ) );

			$output = '<div id="header-featured-image" class =' . esc_attr( $header_image_size ) . '>';

			// Header Image Link
			if ( '' != $header_image_url ) {
				$output .= '<a title="'. esc_attr( $header_image_alt ).'" href="'. esc_url( $header_image_url ) .'" target="' . $target . '">' . $feat_image . '</a>';
			} else {
				// if empty featured_header_image on theme options, display default
				$output .= $feat_image;
			}

			$output .= '</div><!-- #header-featured-image -->';

			echo $output;
		}
		else {
			clean_education_featured_image();
		}
	} // clean_education_featured_page_post_image
endif;


if ( ! function_exists( 'clean_education_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own clean_education_featured_page_post_image(), and that function will be used instead.
	 *
	 * @since Clean Education 1.0
	 */
	function clean_education_featured_overall_image() {
		global $post, $wp_query;
		$options = clean_education_get_theme_options();
		$enable  = $options['enable_featured_header_image'];

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_page() || is_single() ) {
			//Individual Page/Post Image Setting
			$metabox_feat_img = get_post_meta( $post->ID, 'clean-education-header-image', true );

			if ( 'disable' == $metabox_feat_img || ( 'default' == $metabox_feat_img && 'disabled' == $enable ) ) {
				echo '<!-- Page/Post Disable Header Image -->';
				return;
			} elseif ( 'enable' == $metabox_feat_img && 'disabled' == $enable ) {
				clean_education_featured_page_post_image();
			}
		}

		// Get Page ID outside Loop
		$page_id        = $wp_query->get_queried_object_id();
		$page_for_posts = get_option('page_for_posts');

		// Check Homepage
		if ( 'homepage' == $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				clean_education_featured_image();
			}
		} elseif ( 'exclude-home' == $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			} else {
				clean_education_featured_image();
			}
		} elseif ( 'exclude-home-page-post' == $enable  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			} elseif ( is_page() || is_single() ) {
				clean_education_featured_page_post_image();
			} else {
				clean_education_featured_image();
			}
		} elseif ( 'entire-site' == $enable ) {
			clean_education_featured_image();
		} elseif ( 'entire-site-page-post' == $enable ) {
			if ( is_page() || is_single() ) {
				clean_education_featured_page_post_image();
			} else {
				clean_education_featured_image();
			}
		} elseif ( 'pages-posts' == $enable ) {
			if ( is_page() || is_single() ) {
				clean_education_featured_page_post_image();
			}
		} else {
			echo '<!-- Disable Header Image -->';
		}
	} // clean_education_featured_overall_image
endif;
add_action( 'clean_education_after_header', 'clean_education_featured_overall_image', 60 );