<?php
/**
 * The template for adding Logo Slider Options in Customizer
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

//Logo Slider
$wp_customize->add_section( 'clean_education_logo_slider', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Logo Slider', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Logo Slider on', 'clean-education' ),
	'section'  => 'clean_education_logo_slider',
	'settings' => 'clean_education_theme_options[logo_slider_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_transition_delay]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_transition_delay'],
	'sanitize_callback'	=> 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_transition_delay]' , array(
	'active_callback' => 'clean_education_is_logo_slider_active',
	'description'     => esc_html__( 'seconds(s)', 'clean-education' ),
	'input_attrs'     => array(
		'style' => 'width: 100px;',
		'min'   => 0,
		),
	'label'           => esc_html__( 'Transition Delay', 'clean-education' ),
	'section'         => 'clean_education_logo_slider',
	'settings'        => 'clean_education_theme_options[logo_slider_transition_delay]',
) );

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_transition_length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_transition_length'],
	'sanitize_callback'	=> 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_transition_length]' , array(
		'active_callback' => 'clean_education_is_logo_slider_active',
		'description'     => esc_html__( 'seconds(s)', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 100px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'Transition Length', 'clean-education' ),
		'section'         => 'clean_education_logo_slider',
		'settings'        => 'clean_education_theme_options[logo_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_type]', array(
	'active_callback' => 'clean_education_is_logo_slider_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Logo Slider Type', 'clean-education' ),
	'section'         => 'clean_education_logo_slider',
	'settings'        => 'clean_education_theme_options[logo_slider_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_title'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_title]' , array(
	'active_callback' => 'clean_education_is_demo_logo_slider_inactive',
	'label'           => esc_html__( 'Title', 'clean-education' ),
	'section'         => 'clean_education_logo_slider',
	'settings'        => 'clean_education_theme_options[logo_slider_title]',
) );

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_number'],
	'sanitize_callback'	=> 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_number]' , array(
	'active_callback' => 'clean_education_is_demo_logo_slider_inactive',
	'description'     => esc_html__( 'Save and refresh the page if No. of Slides is changed', 'clean-education' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of Items', 'clean-education' ),
	'section'         => 'clean_education_logo_slider',
	'settings'        => 'clean_education_theme_options[logo_slider_number]',
	'type'            => 'number',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_visible_items]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['logo_slider_visible_items'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[logo_slider_visible_items]', array(
	'active_callback' => 'clean_education_is_demo_logo_slider_inactive',
	'input_attrs'     => array(
	'style'           => 'width: 45px;',
		'min'  => 1,
		'max'  => 5,
		'step' => 1,
	),
	'label'           => esc_html__( 'No of visible items', 'clean-education' ),
	'section'         => 'clean_education_logo_slider',
	'settings'        => 'clean_education_theme_options[logo_slider_visible_items]',
	'type'            => 'number',
) );

//loop for featured post sliders
for ( $i=1; $i <=  $options['logo_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[logo_slider_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_logo_slider_page_'. $i, array(
		'active_callback' => 'clean_education_is_logo_page_slider_active',
		'label'           => esc_html__( 'Page', 'clean-education' ) . ' ' . $i ,
		'section'         => 'clean_education_logo_slider',
		'settings'        => 'clean_education_theme_options[logo_slider_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}