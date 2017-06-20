<?php
/**
 * The template for displaying the News Ticker
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

if ( !function_exists( 'clean_education_news_ticker_display' ) ) :
	/**
	* Add News Ticker
	*
	* @uses action hook clean_education_before_content.
	*
	* @since Clean Education 0.1
	*/
	function clean_education_news_ticker_display() {
		//clean_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = clean_education_get_theme_options();
		$enable_content = $options['news_ticker_option'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_news_ticker' ) ) ) {

				$headline = $options['news_ticker_label'];

				echo '<!-- refreshing cache -->';

				$output ='
					<div id="news-ticker" class="page">
						<div class="wrapper">';
							if ( !empty( $headline ) ) {
								$output .='<h2 class="news-ticker-label">'. $headline .'</h2>';
							}
							$output .='

							<div class="new-ticket-content">
								<div class="news-ticker-slider cycle-slideshow"
								    data-cycle-log="false"
								    data-cycle-pause-on-hover="true"
								    data-cycle-swipe="true"
								    data-cycle-auto-height=container
									data-cycle-slides="> h2"
									data-cycle-fx="'. esc_attr( $options['news_ticker_transition_effect'] ) .'"
									>';

									$output .= clean_education_page_post_category_ticker( $options );

					$output .='
								</div><!-- .news-ticker-slider -->
							</div><!-- .new-ticket-content -->
						</div><!-- .wrapper -->
					</div><!-- #news-ticker -->';
				set_transient( 'clean_education_news_ticker', $output, 86940 );

			}

			echo $output;
		}
	}
endif;


if ( ! function_exists( 'clean_education_news_ticker_display_position' ) ) :
	/**
	 * News Ticker Position
	 *
	 * @action clean_education_content, clean_education_after_secondary
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_news_ticker_display_position() {
		// Getting data from Theme Options
		$options  = clean_education_get_theme_options();
		$position = $options['news_ticker_position'];

		if ( 'below-menu' == $position ) {
			add_action( 'clean_education_after_header', 'clean_education_news_ticker_display', 50 );
		} else {
			add_action( 'clean_education_before_content', 'clean_education_news_ticker_display', 110 );
		}
	}
endif; // clean_education_news_ticker_display_position
add_action( 'clean_education_before', 'clean_education_news_ticker_display_position' );


if ( ! function_exists( 'clean_education_page_post_category_ticker' ) ) :
	/**
	 * Display page/post/category news ticker
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_page_post_category_ticker( $options ) {
		global $post;

		$quantity   = $options['news_ticker_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['news_ticker_page_' . $i] ) ? $options['news_ticker_page_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		if ( 0 != $no_of_post ) {
			$args['post__in'] = $post_list;
		}

		$args['posts_per_page'] = $no_of_post;

		$get_posts = new WP_Query( $args );

		$i = 0;

		while ( $get_posts->have_posts() ) {
			$get_posts->the_post();

			$i++;

			if ( $i == 1 ) {
				$classes = 'page post-'.$post->ID.' news-ticker-title displayblock';
			} else {
				$classes = 'page post-'.$post->ID.' news-ticker-title displaynone';
			}

			$output .= '
			<h2 class="' . esc_attr( $classes ) . '">
				<a href="'. esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
			</h2>';
		} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // clean_education_page_post_category_ticker