<?php
/**
 * The main template for implementing Theme/Customzer Options
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

/**
 * Implements Clean Education theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Clean Education 0.1
 */
function clean_education_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = clean_education_get_theme_options();

	$defaults = clean_education_get_default_theme_options();

	$wp_customize->add_setting( 'clean_education_theme_options[move_title_tagline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'clean_education_theme_options[move_title_tagline]', array(
		'label'    => esc_html__( 'Check to move Site Title and Tagline before logo', 'clean-education' ),
		'section'  => 'title_tagline',
		'settings' => 'clean_education_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'clean_education_theme_options[color_scheme]', array(
		'capability' 		=> 'edit_theme_options',
		'default'    		=> $defaults['color_scheme'],
		'sanitize_callback'	=> 'clean_education_sanitize_select',
	) );

	$wp_customize->add_control( 'clean_education_theme_options[color_scheme]', array(
		'choices'  => clean_education_color_schemes(),
		'label'    => esc_html__( 'Color Scheme', 'clean-education' ),
		'section'  => 'colors',
		'settings' => 'clean_education_theme_options[color_scheme]',
		'type'     => 'radio',
	) );

	$include_array = array(
		'custom-controls',
		'courses',
		'featured-content',
		'featured-slider',
		'header-options',
		'hero-content',
		'logo-slider',
		'news',
		'news-ticker',
		'our-professors',
		'portfolio',
		'promotion-headline',
		'testimonial',
		'social-icons',
		'theme-options',
	);

	foreach ( $include_array as $value ) {
		require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/' . $value .  '.php';
	}

	// Reset all settings to default
	$wp_customize->add_section( 'clean_education_reset_all_settings', array(
		'description'	=> esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'clean-education' ),
		'priority' 		=> 700,
		'title'    		=> esc_html__( 'Reset all settings', 'clean-education' ),
	) );

	$wp_customize->add_setting( 'clean_education_theme_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'clean_education_theme_options[reset_all_settings]', array(
		'label'    => esc_html__( 'Check to reset all settings to default', 'clean-education' ),
		'section'  => 'clean_education_reset_all_settings',
		'settings' => 'clean_education_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end

	//Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' => 999,
		'title'    => esc_html__( 'Important Links', 'clean-education' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'clean_education_sanitize_important_link',
	) );

	$wp_customize->add_control( new clean_education_important_links( $wp_customize, 'important_links', array(
		'label'    => esc_html__( 'Important Links', 'clean-education' ),
		'section'  => 'important_links',
		'settings' => 'important_links',
		'type'     => 'important_links',
    ) ) );
    //Important Links End
}
add_action( 'customize_register', 'clean_education_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for Clean Education.
 * And flushes out all transient data on preview
 *
 * @since Clean Education 0.1
 */
function clean_education_customize_preview() {
	wp_enqueue_script( 'clean_education_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients on preview
	clean_education_flush_transients();
}
add_action( 'customize_preview_init', 'clean_education_customize_preview' );


/**
 * Custom scripts and styles on customize.php for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_customize_scripts() {
	wp_enqueue_script( 'clean_education_customizer_custom', get_template_directory_uri() . '/js/customizer-custom-scripts.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$clean_education_data = array(
		'clean_education_color_list' => clean_education_color_list(),
		'reset_message'              => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'clean-education' ),
		'portfolio_message'          => esc_html__( 'To use this featured, please make sure Jetpack plugin and its Custom Content Type Portfolio is activated', 'clean-education' ),
		'testimonial_message'        => esc_html__( 'To use this featured, please make sure Jetpack plugin and its Custom Content Type Testimonial is activated', 'clean-education' )
	);

	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'clean_education_customizer_custom', 'clean_education_data', $clean_education_data );
}
add_action( 'customize_controls_enqueue_scripts', 'clean_education_customize_scripts');


/**
 * Returns list of color keys of array with default values for each color scheme as index
 *
 * @since Clean Education 2.1
 */
function clean_education_color_list() {
	// Get default color scheme values
	$default 		= clean_education_get_default_theme_options();
	// Get default dark color scheme valies
	$default_dark 	= clean_education_default_dark_color_options();

	$color_list['background_color']['light'] = $default['background_color'];
	$color_list['background_color']['dark']  = $default_dark['background_color'];

	$color_list['header_textcolor']['light'] = $default['header_textcolor'];
	$color_list['header_textcolor']['dark']  = $default_dark['header_textcolor'];

	return $color_list;
}


function clean_education_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'clean_education_') && 'clean_education_reset_all_settings' != $section_key && 'clean_education_important_links' != $section_key && 'clean_education_menu_options' != $section_key ) {
    		$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority	= $priority++;
	}
}
add_action( 'customize_register', 'clean_education_sort_sections_list' );

/**
 * Function to reset date with respect to condition
 */
function clean_education_reset_data() {
	$options  = clean_education_get_theme_options();
    if ( $options['reset_all_settings'] ) {
    	remove_theme_mods();

        // Flush out all transients	on reset
        clean_education_flush_transients();

        return;
    }
}
add_action( 'customize_save_after', 'clean_education_reset_data' );


//Active callbacks for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/active-callbacks.php';

//Sanitize functions for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/sanitize-functions.php';

//Add Upgrade To Pro button
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/upgrade-button/class-customize.php';