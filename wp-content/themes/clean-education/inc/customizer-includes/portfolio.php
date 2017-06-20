<?php
/**
 * The template for adding Portfolio Settings in Customizer
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

$wp_customize->add_section( 'clean_education_portfolio', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Portfolio', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[portfolio_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['portfolio_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[portfolio_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Portfolio on', 'clean-education' ),
	'section'  => 'clean_education_portfolio',
	'settings' => 'clean_education_theme_options[portfolio_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[portfolio_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['portfolio_layout'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[portfolio_layout]', array(
	'active_callback' => 'clean_education_is_portfolio_active',
	'choices'         => clean_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Portfolio Layout', 'clean-education' ),
	'section'         => 'clean_education_portfolio',
	'settings'        => 'clean_education_theme_options[portfolio_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[portfolio_headline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['portfolio_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[portfolio_headline]' , array(
	'active_callback' => 'clean_education_is_portfolio_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'Headline for Portfolio', 'clean-education' ),
	'section'         => 'clean_education_portfolio',
	'settings'        => 'clean_education_theme_options[portfolio_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[portfolio_subheadline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['portfolio_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[portfolio_subheadline]' , array(
	'active_callback' => 'clean_education_is_portfolio_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'clean-education' ),
	'label'           => esc_html__( 'Sub-headline for Portfolio', 'clean-education' ),
	'section'         => 'clean_education_portfolio',
	'settings'        => 'clean_education_theme_options[portfolio_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[portfolio_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['portfolio_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[portfolio_type]', array(
	'active_callback' => 'clean_education_is_portfolio_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Portfolio Type', 'clean-education' ),
	'section'         => 'clean_education_portfolio',
	'settings'        => 'clean_education_theme_options[portfolio_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[portfolio_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['portfolio_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[portfolio_number]' , array(
	'active_callback' => 'clean_education_is_demo_portfolio_inactive',
	'description'     => esc_html__( 'Save and refresh the page if No. of Portfolio is changed', 'clean-education' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of Portfolio', 'clean-education' ),
	'section'         => 'clean_education_portfolio',
	'settings'        => 'clean_education_theme_options[portfolio_number]',
	'type'            => 'number',
	)
);

for ( $i=1; $i <=  $options['portfolio_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[portfolio_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_portfolio_page_'. $i, array(
		'active_callback' => 'clean_education_is_page_portfolio_active',
		'label'           => esc_html__( 'Featured Page', 'clean-education' ) . ' ' . $i ,
		'section'         => 'clean_education_portfolio',
		'settings'        => 'clean_education_theme_options[portfolio_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}