<?php
/**
 * Active callbacks for Theme/Customzer Options
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( ! function_exists( 'clean_education_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Clean Education 0.1
	*/
	function clean_education_is_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[featured_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_slider_inactive' ) ) :
	/**
	* Return true if demo slider is inactive
	*
	* @since Clean Education 0.1
	*/
	function clean_education_is_demo_slider_inactive( $control ) {
		$enable	= clean_education_is_slider_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[featured_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && ! ( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* @since Clean Education 0.1
	*/
	function clean_education_is_page_slider_active( $control ) {
		$enable	= clean_education_is_slider_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[featured_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;

if ( ! function_exists( 'clean_education_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_featured_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[featured_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_featured_content_inactive' ) ) :
	/**
	* Return true if demo featured content is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_featured_content_inactive( $control ) {
		$enable	= clean_education_is_featured_content_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[featured_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_featured_page_content_active' ) ) :
	/**
	* Return true if page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_featured_page_content_active( $control ) {
		$enable	= clean_education_is_featured_content_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[featured_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_courses_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_courses_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[courses_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_courses_inactive' ) ) :
	/**
	* Return true if demo featured content is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_courses_inactive( $control ) {
		$enable	= clean_education_is_courses_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[courses_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_courses_active' ) ) :
	/**
	* Return true if page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_page_courses_active( $control ) {
		$enable	= clean_education_is_courses_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[courses_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_testimonial_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[testimonial_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_testimonial_inactive' ) ) :
	/**
	* Return true if demo testimonial is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_testimonial_inactive( $control ) {
		$enable	= clean_education_is_testimonial_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[testimonial_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_testimonial_active' ) ) :
	/**
	* Return true if page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_page_testimonial_active( $control ) {
		$enable	= clean_education_is_testimonial_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[testimonial_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_hero_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[hero_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_hero_content_inactive' ) ) :
	/**
	* Return true if demo hero content is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_hero_content_inactive( $control ) {
		$enable	= clean_education_is_hero_content_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[hero_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_hero_page_content_active' ) ) :
	/**
	* Return true if hero page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_hero_page_content_active( $control ) {
		$enable	= clean_education_is_hero_content_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[hero_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_logo_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[logo_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of logo_slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_logo_slider_inactive' ) ) :
	/**
	* Return true if demo logo_slider is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_logo_slider_inactive( $control ) {
		$enable	= clean_education_is_logo_slider_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[logo_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_logo_page_slider_active' ) ) :
	/**
	* Return true if hero page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_logo_page_slider_active( $control ) {
		$enable	= clean_education_is_logo_slider_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[logo_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_portfolio_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[portfolio_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_portfolio_inactive' ) ) :
	/**
	* Return true if demo header highlight content is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_portfolio_inactive( $control ) {
		$enable	= clean_education_is_portfolio_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[portfolio_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_portfolio_active' ) ) :
	/**
	* Return true if page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_page_portfolio_active( $control ) {
		$enable	= clean_education_is_portfolio_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[portfolio_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_promotion_headline_active' ) ) :
	/**
	* Return true if promotion_headline is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_promotion_headline_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[promotion_headline_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_promotion_headline_inactive' ) ) :
	/**
	* Return true if demo header highlight content is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_promotion_headline_inactive( $control ) {
		$enable	= clean_education_is_promotion_headline_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[promotion_headline_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_promotion_headline_active' ) ) :
	/**
	* Return true if page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_page_promotion_headline_active( $control ) {
		$enable	= clean_education_is_promotion_headline_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[promotion_headline_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;

if ( ! function_exists( 'clean_education_is_news_ticker_active' ) ) :
	/**
	* Return true if news ticker is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_news_ticker_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[news_ticker_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_news_active' ) ) :
	/**
	* Return true if news is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_news_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[news_option]' )->value();

		//return true only if previwed page on customizer matches the type of news option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_news_inactive' ) ) :
	/**
	* Return true if demo news is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_news_inactive( $control ) {
		$enable	= clean_education_is_news_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[news_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_news_active' ) ) :
	/**
	* Return true if page news is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_page_news_active( $control ) {
		$enable	= clean_education_is_news_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[news_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;


if ( ! function_exists( 'clean_education_is_our_professors_active' ) ) :
	/**
	* Return true if our professors is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_our_professors_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'clean_education_theme_options[our_professors_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_demo_our_professors_inactive' ) ) :
	/**
	* Return true if demo our professors is inactive
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_demo_our_professors_inactive( $control ) {
		$enable	= clean_education_is_our_professors_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[our_professors_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && !( 'demo' == $type ) );
	}
endif;


if ( ! function_exists( 'clean_education_is_page_our_professors_active' ) ) :
	/**
	* Return true if page content is active
	*
	* @since  Clean Education 0.1
	*/
	function clean_education_is_page_our_professors_active( $control ) {
		$enable	= clean_education_is_our_professors_active( $control );

		$type 	= $control->manager->get_setting( 'clean_education_theme_options[our_professors_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( $enable && 'page' == $type );
	}
endif;