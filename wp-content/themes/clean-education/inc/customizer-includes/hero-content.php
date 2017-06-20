<?php
/**
 * The template for adding Hero Content Settings in Customizer
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

$wp_customize->add_section( 'clean_education_hero_content', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Hero Content', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[hero_content_option]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['hero_content_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[hero_content_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Hero Content on', 'clean-education' ),
	'section'  => 'clean_education_hero_content',
	'settings' => 'clean_education_theme_options[hero_content_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[hero_content_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['hero_content_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[hero_content_type]', array(
	'active_callback' => 'clean_education_is_hero_content_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Content Type', 'clean-education' ),
	'section'         => 'clean_education_hero_content',
	'settings'        => 'clean_education_theme_options[hero_content_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[hero_content_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['hero_content_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[hero_content_number]' , array(
		'active_callback' => 'clean_education_is_demo_hero_content_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of Hero Content is changed (Max no of Hero Content is 20)', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Hero Content', 'clean-education' ),
		'section'         => 'clean_education_hero_content',
		'settings'        => 'clean_education_theme_options[hero_content_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'clean_education_theme_options[hero_content_enable_title]', array(
		'default'           => $defaults['hero_content_enable_title'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'clean_education_theme_options[hero_content_enable_title]', array(
	'active_callback' => 'clean_education_is_hero_page_content_active',
	'label'           => esc_html__( 'Check to Enable Title', 'clean-education' ),
	'section'         => 'clean_education_hero_content',
	'settings'        => 'clean_education_theme_options[hero_content_enable_title]',
	'type'            => 'checkbox',
) );

for ( $i=1; $i <=  $options['hero_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[hero_content_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_hero_content_page_'. $i, array(
		'active_callback' => 'clean_education_is_hero_page_content_active',
		'label'           => esc_html__( 'Page', 'clean-education' ) . ' ' . $i ,
		'section'         => 'clean_education_hero_content',
		'settings'        => 'clean_education_theme_options[hero_content_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}