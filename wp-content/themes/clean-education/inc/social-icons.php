<?php
/**
 * The template for displaying Social Icons
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( ! function_exists( 'clean_education_get_social_icons' ) ) :
/**
 * Generate social icons.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_social_icons(){
	if ( ( !$output = get_transient( 'clean_education_social_icons' ) ) ) {
		$output	= '';

		$options = clean_education_get_theme_options(); // Get options

		//Pre defined Social Icons Link Start
		$pre_def_social_icons =	clean_education_get_social_icons_list();

		foreach ( $pre_def_social_icons as $key => $item ) {
			if ( isset( $options[ $key ] ) && '' != $options[ $key ] ) {
				$value = $options[ $key ];

				if ( 'email_link' == $key  ) {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr__( 'Email', 'clean-education') . '" href="mailto:'. antispambot( sanitize_email( $value ) ) .'"><span class="screen-reader-text">'. esc_html__( 'Email', 'clean-education') . '</span> </a>';
				}
				elseif ( 'skype_link' == $key  ) {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="'. esc_attr( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ). '</span> </a>';
				}
				elseif ( 'phone_link' == $key || 'handset_link' == $key ) {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="tel:' . preg_replace( '/\s+/', '', esc_attr( $value ) ) . '"><span class="screen-reader-text">'. esc_attr( $item['label'] ) . '</span> </a>';
				}
				else {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) .'" href="'. esc_url( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ) .'</span> </a>';
				}
			}
		}
		//Pre defined Social Icons Link End

		set_transient( 'clean_education_social_icons', $output, 86940 );
	}

	return $output;
} // clean_education_get_social_icons
endif;