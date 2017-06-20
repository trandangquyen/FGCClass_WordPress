<?php
/**
* The template for adding Testimonial Settings in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/


$wp_customize->add_section( 'clean_education_testimonial', array(
	'panel'    => 'clean_education_theme_options',
	'title'    => esc_html__( 'Testimonial', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['testimonial_option'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_option]', array(
	'choices'  => clean_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Testimonial on', 'clean-education' ),
	'section'  => 'clean_education_testimonial',
	'settings' => 'clean_education_theme_options[testimonial_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['testimonial_layout'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_layout]', array(
	'active_callback' => 'clean_education_is_testimonial_active',
	'choices'         => clean_education_testimonial_layout_options(),
	'label'           => esc_html__( 'Select Testimonial Layout', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['testimonial_position'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_position]', array(
	'active_callback' => 'clean_education_is_testimonial_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_slider]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['testimonial_slider'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_slider]', array(
	'active_callback' => 'clean_education_is_testimonial_active',
	'label'           => esc_html__( 'Check to Enable Slider', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_slider]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_type]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['testimonial_type'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_type]', array(
	'active_callback' => 'clean_education_is_testimonial_active',
	'choices'         => clean_education_custom_section_types(),
	'label'           => esc_html__( 'Select Content Type', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_headline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['testimonial_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_headline]' , array(
	'active_callback' => 'clean_education_is_demo_testimonial_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'clean-education' ),
	'label'           => esc_html__( 'Headline for Testimonial', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_subheadline]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['testimonial_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_subheadline]' , array(
	'active_callback' => 'clean_education_is_demo_testimonial_inactive',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'clean-education' ),
	'label'           => esc_html__( 'Sub-headline for Testimonial', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_number]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['testimonial_number'],
	'sanitize_callback' => 'clean_education_sanitize_number_range',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_number]' , array(
		'active_callback' => 'clean_education_is_demo_testimonial_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of Testimonial is changed', 'clean-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Testimonial', 'clean-education' ),
		'section'         => 'clean_education_testimonial',
		'settings'        => 'clean_education_theme_options[testimonial_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_enable_title]', array(
		'default'           => $defaults['testimonial_enable_title'],
		'sanitize_callback' => 'clean_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'clean_education_theme_options[testimonial_enable_title]', array(
	'active_callback' => 'clean_education_is_demo_testimonial_inactive',
	'label'           => esc_html__( 'Check to Enable Title', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[testimonial_show]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['testimonial_show'],
	'sanitize_callback' => 'clean_education_sanitize_select',
) );

$wp_customize->add_control( 'clean_education_theme_options[testimonial_show]', array(
	'active_callback' => 'clean_education_is_demo_testimonial_inactive',
	'choices'         => clean_education_testimonial_content_show(),
	'label'           => esc_html__( 'Display Content', 'clean-education' ),
	'section'         => 'clean_education_testimonial',
	'settings'        => 'clean_education_theme_options[testimonial_show]',
	'type'            => 'select',
) );

for ( $i=1; $i <=  $options['testimonial_number'] ; $i++ ) {
	$wp_customize->add_setting( 'clean_education_theme_options[testimonial_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'clean_education_sanitize_page',
	) );

	$wp_customize->add_control( 'clean_education_testimonial_page_'. $i, array(
		'active_callback'	=> 'clean_education_is_page_testimonial_active',
		'label'    	=> esc_html__( 'Featured Page', 'clean-education' ) . ' ' . $i ,
		'section'  	=> 'clean_education_testimonial',
		'settings' 	=> 'clean_education_theme_options[testimonial_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}