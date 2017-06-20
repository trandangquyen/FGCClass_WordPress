<?php
/**
 * The template for displaying the Promotion Headline
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( !function_exists( 'clean_education_promotion_headline_display' ) ) :
	/**
	* Add Promotion Headline.
	*
	* @uses action hook clean_education_before_content
	*
	* @since Clean Education 0.1
	*/
	function clean_education_promotion_headline_display() {
		//clean_education_flush_transients();
		global $wp_query;

		$options        = clean_education_get_theme_options();
		$enable_content = $options['promotion_headline_option'];
		$content_select = $options['promotion_headline_type'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_promotion_headline' ) ) ) {
				echo '<!-- refreshing cache -->';

				$classes[] = $content_select ;

				$output ='
					<div id="promotion-section" class="sections ' . implode( ' ', $classes ) . '">
						<div class="wrapper">';
							// Select content
							if ( 'demo' == $content_select ) {
								$output .= clean_education_demo_promotion_headline();
							}
							elseif ( 'page' == $content_select ) {
								$output .= clean_education_post_page_category_promotion_headline( $options );
							}
					$output .='
						</div><!-- .wrapper -->
					</div><!-- #promotion-section -->';

				set_transient( 'clean_education_promotion_headline', $output, 86940 );
			}
		echo $output;
		}
	}
endif;
add_action( 'clean_education_before_content', 'clean_education_promotion_headline_display', 50 );


if ( ! function_exists( 'clean_education_demo_promotion_headline' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Clean Education 0.1
	 *
	 */
	function clean_education_demo_promotion_headline() {
		return '
		<h2 class="section-title">'
			. esc_html__( 'Clean Education WordPress Theme', 'clean-education' ) .
		'</h2>

		<p>' . esc_html__( 'This is promotion headline', 'clean-education' ) . '<span class="promotion-buttons"><span class="readmore button-one"><a class="more-link" href="#" target="_blank">' . esc_html__( 'Buy Now', 'clean-education' ) . '</a></span><span class="readmore button-two"><a class="more-link" href="#" target="_blank">' . esc_html__( 'View More', 'clean-education' ) . '</a></span></span></p>';
	}
endif; // clean_education_demo_promotion_headline


if ( ! function_exists( 'clean_education_post_page_category_promotion_headline' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_promotion_headline( $options ) {
		global $post;

		$more_text = $options['excerpt_more_text'];
		$output    = '';

		$args = array(
			'post_type'           => 'page',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => 1,
			'p' => absint( $options['promotion_headline_page'] ),
		);

		$get_posts = new WP_Query( $args );
		while ( $get_posts->have_posts() ) {
			$get_posts->the_post();

			$content_show = $options['promotion_headline_show'];
			$content      ='';

			if ( 'excerpt' == $content_show ) {
				$content = get_the_excerpt();
			} elseif ( 'full-content' == $content_show ) {
				$content = apply_filters( 'the_content', get_the_content() );

				$content = str_replace( ']]>', ']]&gt;', $content );

			} else {
				$content = '<span class="readmore"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( $more_text ) . '</a></span>';
			}

			if ( '' != $content ) {
				$content = '<p>' . $content . '</p>';
			}

			$output .= the_title( '<h2 class="section-title ' . esc_attr( $post->ID ) . '">','</h2>', false ) . $content;
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // clean_education_post_page_category_promotion_headline