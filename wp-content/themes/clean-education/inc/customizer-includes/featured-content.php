<?php
/**
* The template for adding Featured Content Settings in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/


$wp_customize->add_section( 'clean_education_featured_content', array(
	'panel'    => 'clean_education_theme_options',
	'title'    => esc_html__( 'Featured Content', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Featured Content on', 'clean-education' ),
	'section'  => 'clean_education_featured_content',
	'settings' => 'clean_education_theme_options[featured_content_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_layout'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_layout]', array(
	'active_callback' => 'clean_education_is_featured_content_active',
	'choices'         => clean_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Featured Content Layout', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_position'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_position]', array(
	'active_callback' => 'clean_education_is_featured_content_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['featured_content_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_type]', array(
	'active_callback' => 'clean_education_is_featured_content_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Content Type', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_headline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['featured_content_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_headline]' , array(
	'active_callback' => 'clean_education_is_demo_featured_content_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'Headline for Featured Content', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_subheadline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['featured_content_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_subheadline]' , array(
	'active_callback' => 'clean_education_is_demo_featured_content_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'clean-education' ),
	'label'           => esc_html__( 'Sub-headline for Featured Content', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['featured_content_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_number]' , array(
		'active_callback' => 'clean_education_is_demo_featured_content_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of items', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of items', 'clean-education' ),
		'section'         => 'clean_education_featured_content',
		'settings'        => 'clean_education_theme_options[featured_content_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_enable_title]', array(
		'default'           => $defaults['featured_content_enable_title'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'clean_education_theme_options[featured_content_enable_title]', array(
	'active_callback' => 'clean_education_is_demo_featured_content_inactive',
	'label'           => esc_html__( 'Check to Enable Title', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_content_show]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['featured_content_show'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_content_show]', array(
	'active_callback' => 'clean_education_is_demo_featured_content_inactive',
	'choices'         => clean_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'clean-education' ),
	'section'         => 'clean_education_featured_content',
	'settings'        => 'clean_education_theme_options[featured_content_show]',
	'type'            => 'select',
) );

for ( $i=1; $i <=  $options['featured_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[featured_content_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_featured_content_page_'. $i, array(
		'active_callback'	=> 'clean_education_is_featured_page_content_active',
		'label'    	=> esc_html__( 'Featured Page', 'clean-education' ) . ' ' . $i ,
		'section'  	=> 'clean_education_featured_content',
		'settings' 	=> 'clean_education_theme_options[featured_content_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}