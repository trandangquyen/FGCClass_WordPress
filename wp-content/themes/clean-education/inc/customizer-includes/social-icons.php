<?php
/**
* The template for Social Links in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/

$wp_customize->add_section( 'clean_education_social_links', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Social Links', 'clean-education' ),
) );

$icons = clean_education_get_social_icons_list();

foreach ( $icons as $key => $value ){
	if ( 'skype_link' == $key ){
		$wp_customize->add_setting( 'clean_education_theme_options['. $key .']', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback' => 'esc_attr',
			) );

		$wp_customize->add_control( 'clean_education_theme_options['. $key .']', array(
			'description'	=> esc_html__( 'Skype link can be of formats:<br>callto://+{number}<br> skype:{username}?{action}. More Information in readme file', 'clean-education' ),
			'label'    		=> $value['label'],
			'section'  		=> 'clean_education_social_links',
			'settings' 		=> 'clean_education_theme_options['. $key .']',
			'type'	   		=> 'url',
		) );
	}
	else {
		if ( 'email_link' == $key ){
			$wp_customize->add_setting( 'clean_education_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_email',
				) );
		}
		elseif ( 'handset_link' == $key || 'phone_link' == $key ){
			$wp_customize->add_setting( 'clean_education_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_text_field',
				) );
		}
		else {
			$wp_customize->add_setting( 'clean_education_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'esc_url_raw',
				) );
		}

		$wp_customize->add_control( 'clean_education_theme_options['. $key .']', array(
			'label'    => $value['label'],
			'section'  => 'clean_education_social_links',
			'settings' => 'clean_education_theme_options['. $key .']',
			'type'	   => 'url',
		) );
	}
}