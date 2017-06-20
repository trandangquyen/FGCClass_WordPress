<?php
/**
* The template for adding News Settings in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/


$wp_customize->add_section( 'clean_education_news', array(
	'panel'    => 'clean_education_theme_options',
	'title'    => esc_html__( 'News', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'clean-education' ),
	'section'  => 'clean_education_news',
	'settings' => 'clean_education_theme_options[news_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_layout'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_layout]', array(
	'active_callback' => 'clean_education_is_news_active',
	'choices'         => clean_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Layout', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_position'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[news_position]', array(
	'active_callback' => 'clean_education_is_news_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['news_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_type]', array(
	'active_callback' => 'clean_education_is_news_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Content Type', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_headline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['news_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_headline]' , array(
	'active_callback' => 'clean_education_is_demo_news_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'Headline', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[news_subheadline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['news_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_subheadline]' , array(
	'active_callback' => 'clean_education_is_demo_news_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'clean-education' ),
	'label'           => esc_html__( 'Sub-headline', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[news_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['news_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_number]' , array(
		'active_callback' => 'clean_education_is_demo_news_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of items', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of items', 'clean-education' ),
		'section'         => 'clean_education_news',
		'settings'        => 'clean_education_theme_options[news_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'clean_education_theme_options[news_enable_title]', array(
		'default'           => $defaults['news_enable_title'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'clean_education_theme_options[news_enable_title]', array(
	'active_callback' => 'clean_education_is_page_news_active',
	'label'           => esc_html__( 'Check to Enable Title', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_show]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['news_show'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_show]', array(
	'active_callback' => 'clean_education_is_page_news_active',
	'choices'         => clean_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_show]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_hide_date]', array(
    'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'clean_education_sanitize_checkbox',
) );

$wp_customize->add_control(  'clean_education_theme_options[news_hide_date]', array(
	'active_callback' => 'clean_education_is_page_news_active',
	'label'           => esc_html__( 'Check to Hide Date', 'clean-education' ),
	'section'         => 'clean_education_news',
	'settings'        => 'clean_education_theme_options[news_hide_date]',
	'type'            => 'checkbox',
) );

for ( $i=1; $i <=  $options['news_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[news_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_news_page_'. $i, array(
		'active_callback'	=> 'clean_education_is_page_news_active',
		'label'    	=> esc_html__( 'Featured Page', 'clean-education' ) . ' ' . $i ,
		'section'  	=> 'clean_education_news',
		'settings' 	=> 'clean_education_theme_options[news_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}