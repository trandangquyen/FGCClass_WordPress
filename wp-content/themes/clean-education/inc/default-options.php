<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


/**
 * Returns the default options for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_default_theme_options() {
	$theme_data = wp_get_theme();

	$options = array(
		//Site Title an Tagline
		'move_title_tagline'                               => 0,

		//Layout
		'theme_layout'                                     => 'right-sidebar',
		'content_layout'                                   => 'excerpt-image-left',
		'single_post_image_layout'                         => 'disabled',

		//Header Image
		'enable_featured_header_image'                     => 'disabled',
		'featured_image_size'                              => 'full',
		'featured_header_image_url'                        => '',
		'featured_header_image_alt'                        => '',
		'featured_header_image_base'                       => 0,

		//Basic Color Options
		'color_scheme'                                     => 'light',
		'background_color'                                 => '#f9f9f9',
		'header_textcolor'                                 => '#111111',

		//Breadcrumb Options
		'breadcrumb_option'                                => 0,
		'breadcrumb_on_homepage'                           => 0,
		'breadcrumb_seperator'                             => '&raquo;',

		//Comment Options
		'comment_option'                                   => 'use-wordpress-setting',
		'disable_notes'                                    => 0,
		'disable_website_field'                            => 0,

		//Custom CSS
		'custom_css'                                       => '',

		//Scrollup Options
		'disable_scrollup'                                 => 0,

		//Excerpt Options
		'excerpt_length'                                   => '40',
		'excerpt_more_text'                                => esc_html__( 'Continue Reading', 'clean-education' ),

		//Homepage / Frontpage Settings
		'front_page_category'                              => '0',

		//Pagination Options
		'pagination_type'                                  => 'default',

		//Promotion Headline Options
		'promotion_headline_option'                        => 'disabled',
		'promotion_headline_type'                          => 'demo',
		'promotion_headline_show'                          => 'excerpt',
		'promotion_headline_title'                         => '',
		'promotion_headline_content'                       => '',

		//Search Options
		'search_text'                                      => esc_html__( 'Search...', 'clean-education' ),

		//Featured Content Options
		'featured_content_option'                          => 'disabled',
		'featured_content_layout'                          => 'layout-four',
		'featured_content_position'                        => 0,
		'featured_content_headline'                        => '',
		'featured_content_subheadline'                     => '',
		'featured_content_type'                            => 'demo',
		'featured_content_number'                          => '4',
		'featured_content_enable_title'                    => 1,
		'featured_content_show'                            => 'hide-content',

		// Courses Options
		'courses_option'                                   => 'disabled',
		'courses_layout'                                   => 'layout-four',
		'courses_position'                                 => 0,
		'courses_slider'                                   => 1,
		'courses_headline'                                 => '',
		'courses_subheadline'                              => '',
		'courses_type'                                     => 'demo',
		'courses_number'                                   => '8',
		'courses_enable_title'                             => 1,
		'courses_show'                                     => 'hide-content',

		// Testimonail Options
		'testimonial_option'                               => 'disabled',
		'testimonial_layout'                               => 'layout-two',
		'testimonial_position'                             => 0,
		'testimonial_slider'                               => 1,
		'testimonial_headline'                             => '',
		'testimonial_subheadline'                          => '',
		'testimonial_type'                                 => 'demo',
		'testimonial_number'                               => '4',
		'testimonial_enable_title'                         => 1,
		'testimonial_show'                                 => 'full-content',

		//Featured Slider Options
		'featured_slider_option'                           => 'disabled',
		'featured_slider_image_loader'                     => 'true',
		'featured_slider_transition_effect'                => 'fadeout',
		'featured_slider_transition_delay'                 => '4',
		'featured_slider_transition_length'                => '1',
		'featured_slider_type'                             => 'demo',
		'featured_slider_number'                           => '4',

		//Hero Content Options
		'hero_content_option'                              => 'disabled',
		'hero_content_type'                                => 'demo',
		'hero_content_number'                              => '1',
		'hero_content_enable_title'                        => 1,
		'hero_content_show'                                => 'excerpt',
		'disable_read_more'                                => 0,

		//Logo Slider
		'logo_slider_option'                               => 'disabled',
		'logo_slider_type'                                 => 'demo',
		'logo_slider_visible_items'                        => '4',
		'logo_slider_transition_delay'                     => '4',
		'logo_slider_transition_length'                    => '1',
		'logo_slider_title'                                => '',
		'logo_slider_number'                               => '5',

		//Our Professors Options
		'our_professors_option'                            => 'disabled',
		'our_professors_layout'                            => 'layout-four',
		'our_professors_position'                          => 0,
		'our_professors_headline'                          => '',
		'our_professors_subheadline'                       => '',
		'our_professors_type'                              => 'demo',
		'our_professors_number'                            => '4',
		'our_professors_enable_title'                      => 1,
		'our_professors_show'                              => 'hide-content',

		//Portfolio
		'portfolio_option'                                 => 'disabled',
		'portfolio_layout'                                 => 'layout-four',
		'portfolio_position'                               => 0,
		'portfolio_slider'                                 => 1,
		'portfolio_headline'                               => '',
		'portfolio_subheadline'                            => '',
		'portfolio_type'                                   => 'demo',
		'jetpack_portfolio_type'                           => 'individual',
		'portfolio_number'                                 => '4',

		//News Ticker
		'news_ticker_option'                               => 'disabled',
		'news_ticker_position'                             => 'below-menu',
		'news_ticker_label'                                => esc_html__( 'Breaking News', 'clean-education' ),
		'news_ticker_transition_effect'                    => 'flipVert',
		'news_ticker_number'                               => '4',

		// News Options
		'news_option'                                      => 'disabled',
		'news_layout'                                      => 'layout-four',
		'news_position'                                    => 0,
		'news_headline'                                    => esc_html__( 'Recent News', 'clean-education' ),
		'news_subheadline'                                 => '',
		'news_type'                                        => 'demo',
		'news_number'                                      => '4',
		'news_enable_title'                                => 1,
		'news_show'                                        => 'excerpt',
		'news_hide_date'                                   => 0,

		//Reset all settings
		'reset_all_settings'                               => 0,
	);

	return apply_filters( 'clean_education_default_theme_options', $options );
}


/**
 * Returns an array of color schemes registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_color_schemes() {
	$color_scheme_options = array(
		'light' => esc_html__( 'Light', 'clean-education' ),
		'dark'  => esc_html__( 'Dark', 'clean-education' ),
	);

	return apply_filters( 'clean_education_color_schemes', $color_scheme_options );
}


/**
 * Returns an array of comment options for clean_education.
 *
 * @since Clean Education 0.1
 */
function clean_education_comment_options() {
	$options = array(
		'use-wordpress-setting' => esc_html__( 'Use WordPress Setting', 'clean-education' ),
		'disable-in-pages'      => esc_html__( 'Disable in Pages', 'clean-education' ),
		'disable-completely'    => esc_html__( 'Disable Completely', 'clean-education' ),
	);

	return apply_filters( 'clean_education_comment_options', $options );
}


/**
 * Returns an array of avaliable fonts registered for Clean Magazine.
 *
 * @since Clean Education 0.1
 */
function clean_education_avaliable_fonts() {
	$avaliable_fonts = array(
		'arial-black' => array(
			'value' => 'arial-black',
			'label' => '"Arial Black", Gadget, sans-serif',
		),
		'allan' => array(
			'value' => 'allan',
			'label' => '"Allan", sans-serif',
		),
		'allerta' => array(
			'value' => 'allerta',
			'label' => '"Allerta", sans-serif',
		),
		'amaranth' => array(
			'value' => 'amaranth',
			'label' => '"Amaranth", sans-serif',
		),
		'arial' => array(
			'value' => 'arial',
			'label' => 'Arial, Helvetica, sans-serif',
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => '"Bitter", sans-serif',
		),
		'cabin' => array(
			'value' => 'cabin',
			'label' => '"Cabin", sans-serif',
		),
		'cantarell' => array(
			'value' => 'cantarell',
			'label' => '"Cantarell", sans-serif',
		),
		'century-gothic' => array(
			'value' => 'century-gothic',
			'label' => '"Century Gothic", sans-serif',
		),
		'courier-new' => array(
			'value' => 'courier-new',
			'label' => '"Courier New", Courier, monospace',
		),
		'crimson-text' => array(
			'value' => 'crimson-text',
			'label' => '"Crimson Text", sans-serif',
		),
		'cuprum' => array(
			'value' => 'cuprum',
			'label' => '"Cuprum", sans-serif',
		),
		'dancing-script' => array(
			'value' => 'dancing-script',
			'label' => '"Dancing Script", sans-serif',
		),
		'droid-sans' => array(
			'value' => 'droid-sans',
			'label' => '"Droid Sans", sans-serif',
		),
		'droid-serif' => array(
			'value' => 'droid-serif',
			'label' => '"Droid Serif", sans-serif',
		),
		'exo' => array(
			'value' => 'exo',
			'label' => '"Exo", sans-serif',
		),
		'exo-2' => array(
			'value' => 'exo-2',
			'label' => '"Exo 2", sans-serif',
		),
		'georgia' => array(
			'value' => 'georgia',
			'label' => 'Georgia, "Times New Roman", Times, serif',
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		),
		'helvetica-neue' => array(
			'value' => 'helvetica-neue',
			'label' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
		),
		'istok-web' => array(
			'value' => 'istok-web',
			'label' => '"Istok Web", sans-serif',
		),
		'impact' => array(
			'value' => 'impact',
			'label' => 'Impact, Charcoal, sans-serif',
		),
		'inconsolata' => array(
			'value' => 'inconsolata',
			'label' => '"Inconsolata", monospace',
		),
		'josefin-sans' => array(
			'value' => 'josefin-sans',
			'label' => '"Josefin Sans", sans-serif',
		),
		'lato' => array(
			'value' => 'lato',
			'label' => '"Lato", sans-serif',
		),
		'libre-baskerville' => array(
			'value' => 'libre-baskerville',
			'label' => '"Libre Baskerville",serif'
		),
		'clean_education-sans-unicode' => array(
			'value' => 'clean_education-sans-unicode',
			'label' => '"Clean Education Sans Unicode", "Clean Education Grande", sans-serif',
		),
		'clean_education-grande' => array(
			'value' => 'clean_education-grande',
			'label' => '"Clean Education Grande", "Clean Education Sans Unicode", sans-serif',
		),
		'lobster' => array(
			'value' => 'lobster',
			'label' => '"Lobster", sans-serif',
		),
		'lora' => array(
			'value' => 'lora',
			'label' => '"Lora", serif',
		),
		'monaco' => array(
			'value' => 'monaco',
			'label' => 'Monaco, Consolas, "Clean Education Console", monospace, sans-serif',
		),
		'merriweather' => array(
			'value' => 'merriweather',
			'label' => '"Merriweather", sans-serif',
		),
		'montserrat' => array(
			'value' => 'montserrat',
			'label' => '"Montserrat", sans-serif',
		),
		'nobile' => array(
			'value' => 'nobile',
			'label' => '"Nobile", sans-serif',
		),
		'noto-serif' => array(
			'value' => 'noto-serif',
			'label' => '"Noto Serif", serif',
		),
		'neuton' => array(
			'value' => 'neuton',
			'label' => '"Neuton", serif',
		),
		'open-sans' => array(
			'value' => 'open-sans',
			'label' => '"Open Sans", sans-serif',
		),
		'oswald' => array(
			'value' => 'oswald',
			'label' => '"Oswald", sans-serif',
		),
		'palatino' => array(
			'value' => 'palatino',
			'label' => 'Palatino, "Palatino Linotype", "Book Antiqua", serif',
		),
		'patua-one' => array(
			'value' => 'patua-one',
			'label' => '"Patua One", sans-serif',
		),
		'playfair-display' => array(
			'value' => 'playfair-display',
			'label' => '"Playfair Display", sans-serif',
		),
		'pt-sans' => array(
			'value' => 'pt-sans',
			'label' => '"PT Sans", sans-serif',
		),
		'pt-serif' => array(
			'value' => 'pt-serif',
			'label' => '"PT Serif", serif',
		),
		'quattrocento' => array(
			'value' => 'quattrocento',
			'label' => '"Quattrocento", serif',
		),
		'quattrocento-sans' => array(
			'value' => 'quattrocento-sans',
			'label' => '"Quattrocento Sans", sans-serif',
		),
		'roboto' => array(
			'value' => 'roboto',
			'label' => '"Roboto", sans-serif',
		),
		'roboto-slab' => array(
			'value' => 'roboto-slab',
			'label' => '"Roboto Slab", serif',
		),
		'sans-serif' => array(
			'value' => 'sans-serif',
			'label' => 'Sans Serif, Arial',
		),
		'source-sans-pro' => array(
			'value' => 'source-sans-pro',
			'label' => '"Source Sans Pro", sans-serif',
		),
		'tahoma' => array(
			'value' => 'tahoma',
			'label' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-ms' => array(
			'value' => 'trebuchet-ms',
			'label' => '"Trebuchet MS", "Helvetica", sans-serif',
		),
		'times-new-roman' => array(
			'value' => 'times-new-roman',
			'label' => '"Times New Roman", Times, serif',
		),
		'ubuntu' => array(
			'value' => 'ubuntu',
			'label' => '"Ubuntu", sans-serif',
		),
		'varela' => array(
			'value' => 'varela',
			'label' => '"Varela", sans-serif',
		),
		'verdana' => array(
			'value' => 'verdana',
			'label' => 'Verdana, Geneva, sans-serif',
		),
		'yanone-kaffeesatz' => array(
			'value' => 'yanone-kaffeesatz',
			'label' => '"Yanone Kaffeesatz", sans-serif',
		),
	);

	return apply_filters( 'clean_magazine_avaliable_fonts', $avaliable_fonts );
}


/**
 * Returns an array of layout options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_layouts() {
	$layout_options = array(
		'right-sidebar'         => esc_html__( 'Content, Primary Sidebar', 'clean-education' ),
		'no-sidebar'            => esc_html__( 'No Sidebar ( Content Width )', 'clean-education' ),
	);
	return apply_filters( 'clean_education_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-left'  => esc_html__( 'Show Excerpt (Image Left)', 'clean-education' ),
		'full-content'        => esc_html__( 'Show Full Content (No Featured Image)', 'clean-education' ),
	);

	return apply_filters( 'clean_education_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since Clean Education 0.1
 */
function clean_education_enable_featured_header_image_options() {
	$options = array(
		'homepage'               => esc_html__( 'Homepage / Frontpage', 'clean-education' ),
		'exclude-home'           => esc_html__( 'Excluding Homepage', 'clean-education' ),
		'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'clean-education' ),
		'entire-site'            => esc_html__( 'Entire Site', 'clean-education' ),
		'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'clean-education' ),
		'pages-posts'            => esc_html__( 'Pages and Posts', 'clean-education' ),
		'disabled'               => esc_html__( 'Disabled', 'clean-education' ),
	);

	return apply_filters( 'clean_education_enable_featured_header_image_options', $options );
}


/**
 * Returns an array of feature image size
 *
 * @since Clean Education 0.1
 */
function clean_education_featured_image_size_options() {
	$all_sizes = clean_education_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')';
	}

	$options['full'] = esc_html__( 'Full size', 'clean-education' );

	return apply_filters( 'clean_education_featured_image_size_options', $options );
}


/**
 * Returns an array of content and slider layout options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_section_visibility_options() {
	$options = array(
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'clean-education' ),
		'entire-site' => esc_html__( 'Entire Site', 'clean-education' ),
		'disabled'    => esc_html__( 'Disabled', 'clean-education' ),
		);

	return apply_filters( 'clean_education_section_visibility_options', $options );
}


/**
 * Returns an array of feature content types registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_custom_section_types() {
	$options = array(
		'demo' => esc_html__( 'Demo', 'clean-education' ),
		'page' => esc_html__( 'Page', 'clean-education' ),
	);

	return apply_filters( 'clean_education_custom_section_types', $options );
}


/**
 * Returns an array of featured content background image positions
 *
 * @since Clean Education 0.1
 */
function clean_education_section_bg_display_positions() {
	$options = array(
		'top'    => esc_html__( 'Top', 'clean-education' ),
		'bottom' => esc_html__( 'Bottom', 'clean-education' ),
	);
	return apply_filters( 'clean_education_section_bg_display_positions', $options );
}


/**
 * Returns an array of featured content background repeat options
 *
 * @since Clean Education 0.1
 */
function clean_education_section_bg_repeat_options() {
	 $options = array(
		'no-repeat' => esc_html__( 'No repeat', 'clean-education' ),
		'tile'      => esc_html__( 'Tile', 'clean-education' ),
	);
	return apply_filters( 'clean_education_section_bg_repeat_options', $options );
}


/**
 * Returns an array of featured content background attachment options
 *
 * @since Clean Education 0.1
 */
function clean_education_section_bg_attachment_options() {
	$options = array(
		'scroll' => esc_html__( 'Scroll', 'clean-education' ),
		'fixed'  => esc_html__( 'Fixed', 'clean-education' ),
	);
	return apply_filters( 'clean_education_section_bg_attachment_options', $options );
}


/**
 * Returns an array of featured content options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_featured_content_layout_options() {
	$options = array(
		'layout-two'   => esc_html__( '2 columns', 'clean-education' ),
		'layout-three' => esc_html__( '3 columns', 'clean-education' ),
		'layout-four'  => esc_html__( '4 columns', 'clean-education' ),
	);

	return apply_filters( 'clean_education_featured_content_layout_options', $options );
}


/**
 * Returns an array of featured content show registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_featured_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'clean-education' ),
		'full-content' => esc_html__( 'Show Full Content', 'clean-education' ),
		'hide-content' => esc_html__( 'Hide Content', 'clean-education' ),
	);

	return apply_filters( 'clean_education_featured_content_show', $options );
}


/**
 * Returns an array of testimonial content show registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_testimonial_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'clean-education' ),
		'full-content' => esc_html__( 'Show Full Content', 'clean-education' ),
	);

	return apply_filters( 'clean_education_testimonial_content_show', $options );
}


/**
 * Returns an array of testimonial layout options registered.
 *
 * @since Clean Education 0.1
 */
function clean_education_testimonial_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'clean-education' ),
		'layout-two'   => esc_html__( '2 columns', 'clean-education' ),
	);

	return apply_filters( 'clean_education_testimonial_layout_options', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Clean Education 0.1
 */
function clean_education_featured_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'clean-education' ),
		'fadeout'    => esc_html__( 'Fade Out', 'clean-education' ),
		'none'       => esc_html__( 'None', 'clean-education' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'clean-education' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'clean-education' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'clean-education' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'clean-education' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'clean-education' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'clean-education' ),
		'shuffle'    => esc_html__( 'Shuffle', 'clean-education' ),
	);

	return apply_filters( 'clean_education_featured_slider_transition_effects', $options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Clean Education 0.1
 */
function clean_education_featured_slider_image_loader() {
	$options = array(
		'true'  => esc_html__( 'True', 'clean-education' ),
		'wait'  => esc_html__( 'Wait', 'clean-education' ),
		'false' => esc_html__( 'False', 'clean-education' ),
	);

	return apply_filters( 'clean_education_color_schemes', $options );
}


/**
 * Returns an array of color schemes registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_pagination_types() {
	$options = array(
		'default'                => esc_html__( 'Default(Older Posts/Newer Posts)', 'clean-education' ),
		'numeric'                => esc_html__( 'Numeric', 'clean-education' ),
		'infinite-scroll-click'  => esc_html__( 'Infinite Scroll (Click)', 'clean-education' ),
		'infinite-scroll-scroll' => esc_html__( 'Infinite Scroll (Scroll)', 'clean-education' ),
	);

	return apply_filters( 'clean_education_get_pagination_types', $options );
}


/**
 * Returns an array of news ticker positions registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_news_ticker_positions() {
	$options = array(
		'below-menu'    => esc_html__( 'Below Menu', 'clean-education' ),
		'above-content' => esc_html__( 'Above Content', 'clean-education' ),
	);

	return apply_filters( 'clean_education_news_ticker_positions', $options );
}

/**
 * Returns an array of content featured image size.
 *
 * @since Clean Education 0.1
 */
function clean_education_single_post_image_layout_options() {
	$all_sizes = clean_education_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')';
	}

	$options['disabled'] = esc_html__( 'Disabled', 'clean-education' );
	$options['full']     = esc_html__( 'Full size', 'clean-education' );

	return apply_filters( 'clean_education_single_post_image_layout_options', $options );
}


/**
 * Returns an array of hero content types registered for parallaxframe.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_category_list() {
	$cats    = get_categories();

	foreach ( $cats as $cat ) {
		$options[$cat->term_id] = $cat->name;
	}

	return apply_filters( 'clean_educationget_category_list', $options );
}


/**
 * Returns list of social icons currently supported
 *
 * @since Clean Education 0.1
*/
/**
 * Returns list of social icons currently supported
 *
 * @since Clean Education 0.1
*/
function clean_education_get_social_icons_list() {
	$options = array(
		'facebook_link'		=> array(
			'genericon_class' 	=> 'facebook-alt',
			'label' 			=> esc_html__( 'Facebook', 'clean-education' )
			),
		'twitter_link'		=> array(
			'genericon_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'clean-education' )
			),
		'googleplus_link'	=> array(
			'genericon_class' 	=> 'googleplus-alt',
			'label' 			=> esc_html__( 'Googleplus', 'clean-education' )
			),
		'email_link'		=> array(
			'genericon_class' 	=> 'mail',
			'label' 			=> esc_html__( 'Email', 'clean-education' )
			),
		'feed_link'			=> array(
			'genericon_class' 	=> 'feed',
			'label' 			=> esc_html__( 'Feed', 'clean-education' )
			),
		'wordpress_link'	=> array(
			'genericon_class' 	=> 'wordpress',
			'label' 			=> esc_html__( 'WordPress', 'clean-education' )
			),
		'github_link'		=> array(
			'genericon_class' 	=> 'github',
			'label' 			=> esc_html__( 'GitHub', 'clean-education' )
			),
		'linkedin_link'		=> array(
			'genericon_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'clean-education' )
			),
		'pinterest_link'	=> array(
			'genericon_class' 	=> 'pinterest',
			'label' 			=> esc_html__( 'Pinterest', 'clean-education' )
			),
		'flickr_link'		=> array(
			'genericon_class' 	=> 'flickr',
			'label' 			=> esc_html__( 'Flickr', 'clean-education' )
			),
		'vimeo_link'		=> array(
			'genericon_class' 	=> 'vimeo',
			'label' 			=> esc_html__( 'Vimeo', 'clean-education' )
			),
		'youtube_link'		=> array(
			'genericon_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'clean-education' )
			),
		'tumblr_link'		=> array(
			'genericon_class' 	=> 'tumblr',
			'label' 			=> esc_html__( 'Tumblr', 'clean-education' )
			),
		'instagram_link'	=> array(
			'genericon_class' 	=> 'instagram',
			'label' 			=> esc_html__( 'Instagram', 'clean-education' )
			),
		'polldaddy_link'	=> array(
			'genericon_class' 	=> 'polldaddy',
			'label' 			=> esc_html__( 'PollDaddy', 'clean-education' )
			),
		'codepen_link'		=> array(
			'genericon_class' 	=> 'codepen',
			'label' 			=> esc_html__( 'CodePen', 'clean-education' )
			),
		'path_link'			=> array(
			'genericon_class' 	=> 'path',
			'label' 			=> esc_html__( 'Path', 'clean-education' )
			),
		'dribbble_link'		=> array(
			'genericon_class' 	=> 'dribbble',
			'label' 			=> esc_html__( 'Dribbble', 'clean-education' )
			),
		'skype_link'		=> array(
			'genericon_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'clean-education' )
			),
		'digg_link'			=> array(
			'genericon_class' 	=> 'digg',
			'label' 			=> esc_html__( 'Digg', 'clean-education' )
			),
		'reddit_link'		=> array(
			'genericon_class' 	=> 'reddit',
			'label' 			=> esc_html__( 'Reddit', 'clean-education' )
			),
		'stumbleupon_link'	=> array(
			'genericon_class' 	=> 'stumbleupon',
			'label' 			=> esc_html__( 'Stumbleupon', 'clean-education' )
			),
		'pocket_link'		=> array(
			'genericon_class' 	=> 'pocket',
			'label' 			=> esc_html__( 'Pocket', 'clean-education' ),
			),
		'dropbox_link'		=> array(
			'genericon_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'clean-education' ),
			),
		'spotify_link'		=> array(
			'genericon_class' 	=> 'spotify',
			'label' 			=> esc_html__( 'Spotify', 'clean-education' ),
			),
		'foursquare_link'	=> array(
			'genericon_class' 	=> 'foursquare',
			'label' 			=> esc_html__( 'Foursquare', 'clean-education' ),
			),
		'twitch_link'		=> array(
			'genericon_class' 	=> 'twitch',
			'label' 			=> esc_html__( 'Twitch', 'clean-education' ),
			),
		'website_link'		=> array(
			'genericon_class' 	=> 'website',
			'label' 			=> esc_html__( 'Website', 'clean-education' ),
			),
		'phone_link'		=> array(
			'genericon_class' 	=> 'phone',
			'label' 			=> esc_html__( 'Phone', 'clean-education' ),
			),
		'handset_link'		=> array(
			'genericon_class' 	=> 'handset',
			'label' 			=> esc_html__( 'Handset', 'clean-education' ),
			),
		'cart_link'			=> array(
			'genericon_class' 	=> 'cart',
			'label' 			=> esc_html__( 'Cart', 'clean-education' ),
			),
		'cloud_link'		=> array(
			'genericon_class' 	=> 'cloud',
			'label' 			=> esc_html__( 'Cloud', 'clean-education' ),
			),
		'link_link'		=> array(
			'genericon_class' 	=> 'link',
			'label' 			=> esc_html__( 'Link', 'clean-education' ),
			),
	);

	return apply_filters( 'clean_education_social_icons_list', $options );
}


/**
 * Returns an array of metabox layout options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'clean-education-layout-option',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'clean-education' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'clean-education-layout-option',
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'clean-education' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'clean-education-layout-option',
			'value' => 'no-sidebar',
			'label' => esc_html__( 'No Sidebar ( Content Width )', 'clean-education' ),
		),
	);
	return apply_filters( 'clean_education_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_metabox_header_featured_image_options() {
	$options = array(
		'default' => array(
			'id'		=> 'clean-education-header-image',
			'value' 	=> 'default',
			'label' 	=> esc_html__( 'Default', 'clean-education' ),
		),
		'enable' => array(
			'id'		=> 'clean-education-header-image',
			'value' 	=> 'enable',
			'label' 	=> esc_html__( 'Enable', 'clean-education' ),
		),
		'disable' => array(
			'id'		=> 'clean-education-header-image',
			'value' 	=> 'disable',
			'label' 	=> esc_html__( 'Disable', 'clean-education' )
		)
	);
	return apply_filters( 'header_featured_image_options', $options );
}


/**
 * Returns an array of metabox featured image options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_metabox_featured_image_options() {
	$options['default'] = array(
		'id'	=> 'clean-education-featured-image',
		'value' => 'default',
		'label' => esc_html__( 'Default', 'clean-education' ),
	);

	$all_sizes = clean_education_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = array(
			'id'	=> 'clean-education-featured-image',
			'value' => $key,
			'label' => esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')'
		);

	}

	$options['full'] = array(
		'id'	=> 'clean-education-featured-image',
		'value'	=> 'full',
		'label' => esc_html__( 'Full Image', 'clean-education' ),
	);

	$options['disabled'] = array(
		'id' 	=> 'clean-education-featured-image',
		'value' => 'disabled',
		'label' => esc_html__( 'Disable Image', 'clean-education' )
	);

	return apply_filters( 'clean_education_metabox_featured_image_options', $options );
}


/**
 * Returns an array of metabox featured image options registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_background_sections() {
	$options = array(
		'courses' => array(
			'selector'    => '#courses-section',
			'title'       => esc_html__( 'Courses Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure Courses Section is enabled for these options to take effect', 'clean-education' ),
		),
		'featured_content' => array(
			'selector'    => '#featured-section',
			'title'       => esc_html__( 'Featured Content Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure Featured Content Section is enabled for these options to take effect', 'clean-education' ),
		),
		'testimonial' => array(
			'selector'    => '#testimonial-section',
			'title'       => esc_html__( 'Testimonial Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure Testimonial Section is enabled for these options to take effect', 'clean-education' ),
		),
		'logo_slider' => array(
			'selector'    => '#logo-section',
			'title'       => esc_html__( 'Logo Slider Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure Logo Slider is enabled for these options to take effect', 'clean-education' ),
		),
		'news' => array(
			'selector'    => '#news-section',
			'title'       => esc_html__( 'News Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure News Section is enabled for these options to take effect', 'clean-education' ),
		),
		'events' => array(
			'selector'    => '#events-section',
			'title'       => esc_html__( 'Events Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure Events Section is enabled for these options to take effect', 'clean-education' ),
		),
		'our_professors' => array(
			'selector'    => '#our-professors',
			'title'       => esc_html__( 'Our Professors Background Settings', 'clean-education' ),
			'description' => esc_html__( 'Make sure Our Professors Section is enabled for these options to take effect', 'clean-education' ),
		),
		'footer_sidebar_area' => array(
			'selector'    => '#supplementary',
			'title'       => esc_html__( 'Footer Sidebar Area Background Settings', 'clean-education' ),
		),

	);

	return apply_filters( 'clean_education_get_background_sections', $options );
}


/**
 * Returns clean_education_contents registered for Clean Education.
 *
 * @since Clean Education 0.1
 */
function clean_education_get_content() {
	$theme_data = wp_get_theme();

	$content['left'] 	= sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', '1: Year, 2: Site Title with home URL', 'clean-education' ), date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

	//$content['right']	= esc_attr( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'clean-education' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_attr( $theme_data->get( 'Author' ) ) .'</a>';
	$redirect = get_permalink();
	if ( ! is_user_logged_in() ) {
		$link = '<a href="' . esc_url( wp_login_url($redirect) ) . '">' . __('Log in or Register') . '</a>';
	} else
		$link = '<a href="' . esc_url( wp_logout_url($redirect) ) . '">' . __('Log out') . '</a>';


	$content['right']	= $link;

	return apply_filters( 'clean_education_get_content', $content );
}


/**
 * Returns the default options for Clean Education dark theme.
 *
 * @since Clean Education 0.1
 */
function clean_education_default_dark_color_options() {
	$options = array(
		'background_color'                                 => '#333333',
		'header_textcolor'                                 => '#dddddd',
	);

	return apply_filters( 'clean_education_default_dark_color_options', $options );
}