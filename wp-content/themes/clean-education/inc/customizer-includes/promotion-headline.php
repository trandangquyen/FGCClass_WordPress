<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/

$wp_customize->add_section( 'clean_education_promotion_headline', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Promotion Headline', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[promotion_headline_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['promotion_headline_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[promotion_headline_option]', array(
	'choices'  	=> clean_education_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable on', 'clean-education' ),
	'section'  	=> 'clean_education_promotion_headline',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[promotion_headline_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['promotion_headline_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[promotion_headline_type]', array(
	'active_callback' => 'clean_education_is_promotion_headline_active',
	'choices'  	=> clean_education_custom_section_types(),
	'label'    	=> esc_html__( 'Type', 'clean-education' ),
	'section'  	=> 'clean_education_promotion_headline',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[promotion_headline_show]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['promotion_headline_show'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[promotion_headline_show]', array(
	'active_callback' => 'clean_education_is_page_promotion_headline_active',
	'choices'         => clean_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'clean-education' ),
	'section'         => 'clean_education_promotion_headline',
	'type'            => 'select',
) );

//page content
$wp_customize->add_setting( 'clean_education_theme_options[promotion_headline_page]', array(
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'clean_education_sanitize_page',
) );

$wp_customize->add_control( 'clean_education_theme_options[promotion_headline_page]', array(
	'active_callback' => 'clean_education_is_page_promotion_headline_active',
	'label'           => esc_html__( 'Select Page', 'clean-education' ),
	'section'         => 'clean_education_promotion_headline',
	'type'            => 'dropdown-pages',
) );