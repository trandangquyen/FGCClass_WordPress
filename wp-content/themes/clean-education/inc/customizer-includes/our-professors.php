<?php
/**
* The template for adding Our Professors Settings in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/


$wp_customize->add_section( 'clean_education_our_professors', array(
	'panel'    => 'clean_education_theme_options',
	'title'    => esc_html__( 'Our Professors', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['our_professors_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'clean-education' ),
	'section'  => 'clean_education_our_professors',
	'settings' => 'clean_education_theme_options[our_professors_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['our_professors_layout'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_layout]', array(
	'active_callback' => 'clean_education_is_our_professors_active',
	'choices'         => clean_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Layout', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['our_professors_position'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_position]', array(
	'active_callback' => 'clean_education_is_our_professors_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['our_professors_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_type]', array(
	'active_callback' => 'clean_education_is_our_professors_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Content Type', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_headline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['our_professors_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_headline]' , array(
	'active_callback' => 'clean_education_is_demo_our_professors_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'Headline', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_subheadline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['our_professors_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_subheadline]' , array(
	'active_callback' => 'clean_education_is_demo_our_professors_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'clean-education' ),
	'label'           => esc_html__( 'Sub-headline', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['our_professors_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_number]' , array(
		'active_callback' => 'clean_education_is_demo_our_professors_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of items', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of items', 'clean-education' ),
		'section'         => 'clean_education_our_professors',
		'settings'        => 'clean_education_theme_options[our_professors_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_enable_title]', array(
		'default'           => $defaults['our_professors_enable_title'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'clean_education_theme_options[our_professors_enable_title]', array(
	'active_callback' => 'clean_education_is_demo_our_professors_inactive',
	'label'           => esc_html__( 'Check to Enable Title', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[our_professors_show]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['our_professors_show'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[our_professors_show]', array(
	'active_callback' => 'clean_education_is_demo_our_professors_inactive',
	'choices'         => clean_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'clean-education' ),
	'section'         => 'clean_education_our_professors',
	'settings'        => 'clean_education_theme_options[our_professors_show]',
	'type'            => 'select',
) );

for ( $i=1; $i <=  $options['our_professors_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[our_professors_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_our_professors_page_'. $i, array(
		'active_callback'	=> 'clean_education_is_page_our_professors_active',
		'label'    	=> esc_html__( 'Featured Page', 'clean-education' ) . ' ' . $i ,
		'section'  	=> 'clean_education_our_professors',
		'settings' 	=> 'clean_education_theme_options[our_professors_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}