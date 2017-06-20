<?php
/**
* The template for adding News Ticker Settings in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/

$wp_customize->add_section( 'clean_education_news_ticker_settings', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'News Ticker', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_ticker_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_ticker_option]', array(
	'choices'  	=> clean_education_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable News Ticker on', 'clean-education' ),
	'section'  	=> 'clean_education_news_ticker_settings',
	'settings' 	=> 'clean_education_theme_options[news_ticker_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_ticker_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_position'],
	'sanitize_callback'	=> 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_ticker_position]', array(
	'active_callback'	=> 'clean_education_is_news_ticker_active',
	'choices'  	=> clean_education_news_ticker_positions(),
	'label'    	=> esc_html__( 'News Ticker Position', 'clean-education' ),
	'section'  	=> 'clean_education_news_ticker_settings',
	'settings' 	=> 'clean_education_theme_options[news_ticker_position]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[news_ticker_transition_effect]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_transition_effect'],
	'sanitize_callback'	=> 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_ticker_transition_effect]' , array(
	'active_callback' => 'clean_education_is_news_ticker_active',
	'choices'         => clean_education_featured_slider_transition_effects(),
	'label'           => esc_html__( 'Transition Effect', 'clean-education' ),
	'section'         => 'clean_education_news_ticker_settings',
	'settings'        => 'clean_education_theme_options[news_ticker_transition_effect]',
	'type'            => 'select',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[news_ticker_label]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_label'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_ticker_label]' , array(
	'active_callback' => 'clean_education_is_news_ticker_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'News Ticker Label', 'clean-education' ),
	'section'         => 'clean_education_news_ticker_settings',
	'settings'        => 'clean_education_theme_options[news_ticker_label]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[news_ticker_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_number'],
	'sanitize_callback'	=> 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[news_ticker_number]' , array(
		'active_callback' => 'clean_education_is_news_ticker_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of News Ticker is changed', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of News Ticker', 'clean-education' ),
		'section'         => 'clean_education_news_ticker_settings',
		'settings'        => 'clean_education_theme_options[news_ticker_number]',
		'type'            => 'number',
		'transport'       => 'postMessage'
	)
);

for ( $i=1; $i <=  $options['news_ticker_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[news_ticker_page_'. $i .']', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_news_ticker_page_'. $i .'', array(
		'active_callback' => 'clean_education_is_news_ticker_active',
		'label'           => esc_html__( 'Page', 'clean-education' ) . ' ' . $i ,
		'section'         => 'clean_education_news_ticker_settings',
		'settings'        => 'clean_education_theme_options[news_ticker_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}