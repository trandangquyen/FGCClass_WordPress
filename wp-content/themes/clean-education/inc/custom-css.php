<?php
/**
 * Custom CSS addition
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( ! function_exists( 'clean_education_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses set_transient , wp_head , wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_custom_css() {
		if ( ! $output = get_transient( 'clean_education_custom_css' ) ) {
			//clean_education_flush_transients();
			$options  = clean_education_get_theme_options();

			$output ='';

			$text_color = get_header_textcolor();

			if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $text_color ) {
				$output	.=  ".site-branding .site-title a { color: #".  esc_attr( $text_color ) ."; }". "\n";
			}

			//Custom CSS Option
			if ( !empty( $options['custom_css'] ) ) {
				$output	.=  $options['custom_css'] . "\n";
			}

			if ( '' != $output ){
				echo '<!-- refreshing cache -->' . "\n";

				$output = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen">' . "\n" . $output;

				$output .= '</style>' . "\n";

			}

			set_transient( 'clean_education_custom_css', htmlspecialchars_decode( $output ), 86940 );
		}

		echo $output;
	}
endif; //clean_education_custom_css
add_action( 'wp_head', 'clean_education_custom_css', 101  );