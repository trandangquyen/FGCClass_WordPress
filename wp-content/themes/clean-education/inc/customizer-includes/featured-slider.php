<?php
/**
* The template for adding Featured Slider Options in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/

$wp_customize->add_section( 'clean_education_featured_slider', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Featured Slider', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_option]', array(
	'choices'   => clean_education_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable Slider on', 'clean-education' ),
	'section'  	=> 'clean_education_featured_slider',
	'settings' 	=> 'clean_education_theme_options[featured_slider_option]',
	'type'    	=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_transition_effect]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_transition_effect'],
	'sanitize_callback'	=> 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_transition_effect]' , array(
	'active_callback'	=> 'clean_education_is_slider_active',
	'choices'  			=> clean_education_featured_slider_transition_effects(),
	'label'				=> esc_html__( 'Transition Effect', 'clean-education' ),
	'section'  			=> 'clean_education_featured_slider',
	'settings'			=> 'clean_education_theme_options[featured_slider_transition_effect]',
	'type'				=> 'select',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_transition_delay]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_transition_delay'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_transition_delay]' , array(
	'active_callback'	=> 'clean_education_is_slider_active',
	'description'		=> esc_html__( 'seconds(s)', 'clean-education' ),
	'input_attrs' 		=> array(
			            	'style' => 'width: 40px;',
			            	'min'   => 0,
			        	),
	'label'    			=> esc_html__( 'Transition Delay', 'clean-education' ),
	'section'  			=> 'clean_education_featured_slider',
	'settings' 			=> 'clean_education_theme_options[featured_slider_transition_delay]',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_transition_length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_transition_length'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_transition_length]' , array(
	'active_callback'	=> 'clean_education_is_slider_active',
	'description'		=> esc_html__( 'seconds(s)', 'clean-education' ),
	'input_attrs' 		=> array(
				            'style' => 'width: 40px;',
				            'min'   => 0,
			            	),
	'label'    			=> esc_html__( 'Transition Length', 'clean-education' ),
	'section'  			=> 'clean_education_featured_slider',
	'settings' 			=> 'clean_education_theme_options[featured_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_image_loader]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_image_loader'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_image_loader]', array(
	'active_callback'	=> 'clean_education_is_slider_active',
	'choices'   		=> clean_education_featured_slider_image_loader(),
	'label'    			=> esc_html__( 'Image Loader', 'clean-education' ),
	'section'  			=> 'clean_education_featured_slider',
	'settings' 			=> 'clean_education_theme_options[featured_slider_image_loader]',
	'type'    			=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_type'],
	'sanitize_callback'	=> 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_type]', array(
	'active_callback'	=> 'clean_education_is_slider_active',
	'choices'  			=> clean_education_custom_section_types(),
	'label'    			=> esc_html__( 'Select Slider Type', 'clean-education' ),
	'section'  			=> 'clean_education_featured_slider',
	'settings' 			=> 'clean_education_theme_options[featured_slider_type]',
	'type'	  			=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_number'],
	'sanitize_callback'	=> 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[featured_slider_number]' , array(
	'active_callback'	=> 'clean_education_is_demo_slider_inactive',
	'description'		=> esc_html__( 'Save and refresh the page if No. of Slides is changed', 'clean-education' ),
	'input_attrs' 		=> array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'    			=> esc_html__( 'No of Slides', 'clean-education' ),
	'section'  			=> 'clean_education_featured_slider',
	'settings' 			=> 'clean_education_theme_options[featured_slider_number]',
	'type'	   			=> 'number',
	)
);

for ( $i=1; $i <=  $options['featured_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[featured_slider_page_'. $i .']', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_theme_options[featured_slider_page_'. $i .']', array(
		'active_callback' => 'clean_education_is_page_slider_active',
		'label'           => esc_html__( 'Featured Page', 'clean-education' ) . ' # ' . $i ,
		'section'         => 'clean_education_featured_slider',
		'settings'        => 'clean_education_theme_options[featured_slider_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}