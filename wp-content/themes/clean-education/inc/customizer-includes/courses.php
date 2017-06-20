<?php
/**
* The template for adding Courses Settings in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/


$wp_customize->add_section( 'clean_education_courses', array(
	'panel'    => 'clean_education_theme_options',
	'title'    => esc_html__( 'Courses', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['courses_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Courses on', 'clean-education' ),
	'section'  => 'clean_education_courses',
	'settings' => 'clean_education_theme_options[courses_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['courses_layout'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_layout]', array(
	'active_callback' => 'clean_education_is_courses_active',
	'choices'         => clean_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Courses Layout', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['courses_position'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_position]', array(
	'active_callback' => 'clean_education_is_courses_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_slider]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['courses_slider'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_slider]', array(
	'active_callback' => 'clean_education_is_courses_active',
	'label'           => esc_html__( 'Check to Enable Slider', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_slider]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['courses_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_type]', array(
	'active_callback' => 'clean_education_is_courses_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Courses Type', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_headline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['courses_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_headline]' , array(
	'active_callback' => 'clean_education_is_demo_courses_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'Headline for Courses', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[courses_subheadline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['courses_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_subheadline]' , array(
	'active_callback' => 'clean_education_is_demo_courses_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'clean-education' ),
	'label'           => esc_html__( 'Sub-headline for Courses', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[courses_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['courses_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_number]' , array(
		'active_callback' => 'clean_education_is_demo_courses_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of Courses is changed', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Courses', 'clean-education' ),
		'section'         => 'clean_education_courses',
		'settings'        => 'clean_education_theme_options[courses_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'clean_education_theme_options[courses_enable_title]', array(
		'default'           => $defaults['courses_enable_title'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'clean_education_theme_options[courses_enable_title]', array(
	'active_callback' => 'clean_education_is_demo_courses_inactive',
	'label'           => esc_html__( 'Check to Enable Title', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[courses_show]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['courses_show'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[courses_show]', array(
	'active_callback' => 'clean_education_is_demo_courses_inactive',
	'choices'         => clean_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'clean-education' ),
	'section'         => 'clean_education_courses',
	'settings'        => 'clean_education_theme_options[courses_show]',
	'type'            => 'select',
) );

for ( $i=1; $i <=  $options['courses_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[courses_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_courses_page_'. $i, array(
		'active_callback'	=> 'clean_education_is_page_courses_active',
		'label'    	=> esc_html__( 'Featured Page', 'clean-education' ) . ' ' . $i ,
		'section'  	=> 'clean_education_courses',
		'settings' 	=> 'clean_education_theme_options[courses_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}