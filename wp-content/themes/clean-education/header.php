<?php
/**
 * The default template for displaying header
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

	/**
	 * clean_education_doctype hook
	 *
	 * @hooked clean_education_doctype -  10
	 *
	 */
	do_action( 'clean_education_doctype' );?>

<head>
<?php
	/**
	 * clean_education_before_wp_head hook
	 *
	 * @hooked clean_education_head -  10
	 *
	 */
	do_action( 'clean_education_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
     * clean_education_before_header hook
     *
     */
    do_action( 'clean_education_before' );

	/**
	 * clean_education_header hook
	 *
	 * @hooked clean_education_page_start -  10
	 * @hooked clean_education_header_start- 20
	 * @hooked clean_education_mobile_header_nav_anchor - 30
	 * @hooked clean_education_mobile_secondary_nav_anchor - 40
	 * @hooked clean_education_site_branding - 50
	 * @hooked clean_education_primary_menu - 60
	 * @hooked clean_education_header_end - 100
	 *
	 */
	do_action( 'clean_education_header' );

	/**
     * clean_education_after_header hook
     *
     * @hooked clean_education_secondary_menu - 20
	 * @hooked clean_education_add_breadcrumb - 40
	 * @hooked clean_education_news_ticker_display (below menu) - 50
	 * @hooked clean_education_featured_overall_image - 60
     */
	do_action( 'clean_education_after_header' );

	/**
	 * clean_education_before_content hook
	 *
	 * @hooked clean_education_featured_slider - 10
	 * @hooked clean_education_hero_content_display - 20
	 * @hooked clean_education_featured_content_display (move featured content above homepage posts - default option) - 30
	 * @hooked clean_education_promotion_headline - 40
	 * @hooked clean_education_portfolio_display - 50
	 * @hooked clean_education_courses_display (move courses above homepage posts - default option) - 60
	 * @hooked clean_education_our_professors_display - 70
	 * @hooked clean_education_news_display - 80
	 * @hooked clean_education_testimonial_display - 100
	 * @hooked clean_education_news_ticker_display (above content) - 110
	 */
	do_action( 'clean_education_before_content' );

	/**
     * clean_education_content hook
     *
     *  @hooked clean_education_content_start - 10
     *  @hooked clean_education_add_breadcrumb - 20
     *  @hooked clean_education_content_sidebar_wrap_start - 40
     *
     */
	do_action( 'clean_education_content' );