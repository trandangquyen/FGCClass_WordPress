<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Catch Themes
* @subpackage Clean Education
* @since Clean Education 0.1
*/

$wp_customize->add_panel( 'clean_education_theme_options', array(
	'priority' => 200,
	'title'    => esc_html__( 'Theme Options', 'clean-education' ),
) );

// Breadcrumb Option
$wp_customize->add_section( 'clean_education_breadcrumb_options', array(
	'description' => esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'clean-education' ),
	'panel'       => 'clean_education_theme_options',
	'title'       => esc_html__( 'Breadcrumb Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[breadcrumb_option]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['breadcrumb_option'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[breadcrumb_option]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb', 'clean-education' ),
	'section'  => 'clean_education_breadcrumb_options',
	'settings' => 'clean_education_theme_options[breadcrumb_option]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[breadcrumb_on_homepage]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['breadcrumb_on_homepage'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'clean_education_theme_options[breadcrumb_on_homepage]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb on Homepage', 'clean-education' ),
	'section'  => 'clean_education_breadcrumb_options',
	'settings' => 'clean_education_theme_options[breadcrumb_on_homepage]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'clean_education_theme_options[breadcrumb_seperator]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['breadcrumb_seperator'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'clean_education_theme_options[breadcrumb_seperator]', array(
	'input_attrs' => array(
		'style'       => 'width: 40px;'
	),
	'label'       => esc_html__( 'Separator between Breadcrumbs', 'clean-education' ),
	'section'     => 'clean_education_breadcrumb_options',
	'settings'    => 'clean_education_theme_options[breadcrumb_seperator]',
	'type'        => 'text'
	)
);
// Breadcrumb Option End


/**
 * Do not show Custom CSS option from WordPress 4.7 onwards
 * @remove when WP 5.0 is released
 */
if ( !function_exists( 'wp_update_custom_css_post' ) ) {
	// Custom CSS Option
	$wp_customize->add_section( 'clean_education_custom_css', array(
		'description' => esc_html__( 'Custom/Inline CSS', 'clean-education'),
		'panel'       => 'clean_education_theme_options',
		'title'       => esc_html__( 'Custom CSS Options', 'clean-education' ),
	) );

	$wp_customize->add_setting( 'clean_education_theme_options[custom_css]', array(
		'capability'        => 'edit_theme_options',
		'default'           => $defaults['custom_css'],
		'sanitize_callback' => 'clean_education_sanitize_custom_css',
	) );

	$wp_customize->add_control( 'clean_education_theme_options[custom_css]', array(
		'label'    => esc_html__( 'Enter Custom CSS', 'clean-education' ),
		'section'  => 'clean_education_custom_css',
		'settings' => 'clean_education_theme_options[custom_css]',
		'type'     => 'textarea',
	) );
	// Custom CSS End
}

// Excerpt Options
$wp_customize->add_section( 'clean_education_excerpt_options', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Excerpt Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[excerpt_length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['excerpt_length'],
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'clean_education_theme_options[excerpt_length]', array(
	'description' => esc_html__('Excerpt length. Default is 40 words', 'clean-education'),
	'input_attrs' => array(
        'min'   => 10,
        'max'   => 200,
        'step'  => 5,
        'style' => 'width: 60px;'
        ),
    'label'    => esc_html__( 'Excerpt Length (words)', 'clean-education' ),
	'section'  => 'clean_education_excerpt_options',
	'settings' => 'clean_education_theme_options[excerpt_length]',
	'type'	   => 'number',
	)
);

$wp_customize->add_setting( 'clean_education_theme_options[excerpt_more_text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['excerpt_more_text'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'clean_education_theme_options[excerpt_more_text]', array(
	'label'    => esc_html__( 'Read More Text', 'clean-education' ),
	'section'  => 'clean_education_excerpt_options',
	'settings' => 'clean_education_theme_options[excerpt_more_text]',
	'type'	   => 'text',
) );
// Excerpt Options End

//Homepage / Frontpage Options
$wp_customize->add_section( 'clean_education_homepage_options', array(
	'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'clean-education' ),
	'panel'       => 'clean_education_theme_options',
	'title'       => esc_html__( 'Homepage / Frontpage Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[front_page_category]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['front_page_category'],
	'sanitize_callback'	=> 'clean_education_sanitize_category_list',
) );

$wp_customize->add_control( new clean_education_customize_dropdown_categories_control( $wp_customize, 'clean_education_theme_options[front_page_category]', array(
	'label'    => esc_html__( 'Select Categories', 'clean-education' ),
	'name'     => 'clean_education_theme_options[front_page_category]',
	'section'  => 'clean_education_homepage_options',
	'settings' => 'clean_education_theme_options[front_page_category]',
	'type'     => 'dropdown-categories',
) ) );
//Homepage / Frontpage Settings End

// Layout Options
$wp_customize->add_section( 'clean_education_layout', array(
	'capability' => 'edit_theme_options',
	'panel'      => 'clean_education_theme_options',
	'title'      => esc_html__( 'Layout Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[theme_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['theme_layout'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_control( 'clean_education_theme_options[theme_layout]', array(
	'choices'	=> clean_education_layouts(),
	'label'		=> esc_html__( 'Default Layout', 'clean-education' ),
	'section'	=> 'clean_education_layout',
	'settings'   => 'clean_education_theme_options[theme_layout]',
	'type'		=> 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[content_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['content_layout'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_setting( 'clean_education_theme_options[content_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['content_layout'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_control( 'clean_education_theme_options[content_layout]', array(
	'choices'   => clean_education_get_archive_content_layout(),
	'label'		=> esc_html__( 'Archive Content Layout', 'clean-education' ),
	'section'   => 'clean_education_layout',
	'settings'  => 'clean_education_theme_options[content_layout]',
	'type'      => 'select',
) );

$wp_customize->add_setting( 'clean_education_theme_options[single_post_image_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['single_post_image_layout'],
	'sanitize_callback' => 'sanitize_key',
) );


$wp_customize->add_control( 'clean_education_theme_options[single_post_image_layout]', array(
		'label'		=> esc_html__( 'Single Page/Post Image ', 'clean-education' ),
		'section'   => 'clean_education_layout',
        'settings'  => 'clean_education_theme_options[single_post_image_layout]',
        'type'	  	=> 'select',
		'choices'  	=> clean_education_single_post_image_layout_options(),
) );
// Layout Options End

// Pagination Options
$pagination_type	= $options['pagination_type'];

$nav_desc = sprintf(
	wp_kses(
		__( '<a target="_blank" href="%1$s">WP-PageNavi Plugin</a> is recommended for Numeric Option(But will work without it).<br/>Infinite Scroll Options requires <a target="_blank" href="%2$s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'clean-education' ),
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br'=> array()
		)
	),
	esc_url( 'https://wordpress.org/plugins/wp-pagenavi' ),
	esc_url( 'https://wordpress.org/plugins/jetpack/' )
);

/**
* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
*/
if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) ) {
	if ( ! (class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
		$nav_desc = sprintf(
			wp_kses(
				__( 'Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'clean-education' ),
				array(
					'a' => array(
						'href' => array(),
						'target' => array()
					)
				)
			),
			esc_url( 'https://wordpress.org/plugins/jetpack/' )
		);
	}
	else {
		$nav_desc = '';
	}
}

$wp_customize->add_section( 'clean_education_pagination_options', array(
	'description' => $nav_desc,
	'panel'       => 'clean_education_theme_options',
	'title'       => esc_html__( 'Pagination Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[pagination_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['pagination_type'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_control( 'clean_education_pagination_options', array(
	'choices'  => clean_education_get_pagination_types(),
	'label'    => esc_html__( 'Pagination type', 'clean-education' ),
	'section'  => 'clean_education_pagination_options',
	'settings' => 'clean_education_theme_options[pagination_type]',
	'type'	   => 'select',
) );
// Pagination Options End

// Scrollup
$wp_customize->add_section( 'clean_education_scrollup', array(
	'panel' => 'clean_education_theme_options',
	'title' => esc_html__( 'Scrollup Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[disable_scrollup]', array(
	'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['disable_scrollup'],
	'sanitize_callback' => 'clean_education_sanitize_checkbox',
) );

$wp_customize->add_control( 'clean_education_theme_options[disable_scrollup]', array(
	'label'		=> esc_html__( 'Check to disable Scroll Up', 'clean-education' ),
	'section'   => 'clean_education_scrollup',
    'settings'  => 'clean_education_theme_options[disable_scrollup]',
	'type'		=> 'checkbox',
) );
// Scrollup End

// Search Options
$wp_customize->add_section( 'clean_education_search_options', array(
	'description' => esc_html__( 'Change default placeholder text in Search.', 'clean-education'),
	'panel'       => 'clean_education_theme_options',
	'title'       => esc_html__( 'Search Options', 'clean-education' ),
) );

$wp_customize->add_setting( 'clean_education_theme_options[search_text]', array(
	'capability'        => 'edit_theme_options',
	'default'			=> $defaults['search_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'clean_education_theme_options[search_text]', array(
	'label'		=> esc_html__( 'Default Display Text in Search', 'clean-education' ),
	'section'   => 'clean_education_search_options',
    'settings'  => 'clean_education_theme_options[search_text]',
	'type'		=> 'text',
) );
// Search Options End