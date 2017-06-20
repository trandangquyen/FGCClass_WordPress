<?php
/**
 * The template for displaying the Slider
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( !function_exists( 'clean_education_featured_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook clean_education_before_content.
 *
 * @since Clean Education 0.1
 */
function clean_education_featured_slider() {
	//clean_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options 		= clean_education_get_theme_options();
	$enableslider 	= $options['featured_slider_option'];
	$sliderselect 	= $options['featured_slider_type'];

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	if ( 'entire-site' == $enableslider  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enableslider ) ) {
		if ( ( !$output = get_transient( 'clean_education_featured_slider' ) ) ) {
			echo '<!-- refreshing cache -->';

			$output = '
				<div id="slider-section" class="sections">
					<div class="wrapper">
						<div class="cycle-slideshow"
						    data-cycle-log="false"
						    data-cycle-pause-on-hover="true"
						    data-cycle-swipe="true"
						    data-cycle-auto-height=container
						    data-cycle-fx="'. esc_attr( $options['featured_slider_transition_effect'] ) .'"
							data-cycle-speed="'. esc_attr( $options['featured_slider_transition_length'] ) * 1000 .'"
							data-cycle-timeout="'. esc_attr( $options['featured_slider_transition_delay'] ) * 1000 .'"
							data-cycle-loader="'. esc_attr( $options['featured_slider_image_loader'] ) .'"
							data-cycle-slides="> article"
							>

						    <!-- prev/next links -->
						    <div class="cycle-prev"></div>
						    <div class="cycle-next"></div>

						    <!-- empty element for pager links -->
	    					<div class="cycle-pager"></div>';

							// Select Slider
							if ( 'demo' == $sliderselect ) {
								$output .=  clean_education_demo_slider();
							} elseif ( 'page' == $sliderselect ) {
								$output .=  clean_education_post_page_category_slider( $options );
							}

			$output .= '
						</div><!-- .cycle-slideshow -->
					</div><!-- .wrapper -->
				</div><!-- #slider-section -->';

			set_transient( 'clean_education_featured_slider', $output, 86940 );
		}
		echo $output;
	}
}
endif;
add_action( 'clean_education_before_content', 'clean_education_featured_slider', 10 );


if ( ! function_exists( 'clean_education_demo_slider' ) ) :
	/**
	 * This function to display featured posts slider
	 *
	 * @get the data value from customizer options
	 *
	 * @since Clean Education 0.1
	 *
	 */
	function clean_education_demo_slider() {
		return '
		<article class="post demo-image-1 hentry slides displayblock">
			<figure class="slider-image">
				<a title="Slider Image 1" href="'. esc_url( home_url( '/' ) ) .'">
					<img src="'.get_template_directory_uri().'/images/slider1-1320x566.jpg" class="wp-post-image" alt="Slider Image 1" title="Slider Image 1">
				</a>
			</figure>
			<div class="entry-container clear">
				<header class="entry-header">
					<h2 class="entry-title">
						<a title="Slider Image 1" href="#"><span>Clean WordPress Theme</span></a>
					</h2>
				</header>
				<div class="entry-summary">
					<p>Simple, Clean and Responsive theme focused on Corporate and Blog Websites.Download now and make your website look beautiful everywhere. <span class="readmore"><a href="#">Read More ...</a></span></p>
				</div>
			</div>
		</article><!-- .slides -->

		<article class="post demo-image-2 hentry slides displaynone">
			<figure class="slider-image">
				<a title="Slider Image 2" href="'. esc_url( home_url( '/' ) ) .'">
					<img src="'. get_template_directory_uri() . '/images/slider2-1320x566.jpg" class="wp-post-image" alt="Slider Image 2" title="Slider Image 2">
				</a>
			</figure>
			<div class="entry-container clear">
				<header class="entry-header">
					<h2 class="entry-title">
						<a title="Slider Image 2" href="#"><span>Awesome Support</span></a>
					</h2>
				</header>
				<div class="entry-summary">
					<p>We have a great line of support team and support forum. You do not need to worry about how to use the theme, just refer to our Support section <span class="readmore"><a href="#">Read More ...</a></span></p>
				</div>
			</div>
		</article><!-- .slides -->';
	}
endif; // clean_education_demo_slider


if ( ! function_exists( 'clean_education_post_page_category_slider' ) ) :
	/**
	 * This function to display featured post, page or category slider
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_slider( $options ) {
		global $post;

		$quantity   = $options['featured_slider_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$type       = $options['featured_slider_type'];
		$output     = '';

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['featured_slider_page_' . $i] ) ? $options['featured_slider_page_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;


		if ( 0 == $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;
		$loop     = new WP_Query( $args );

		$i=0;
		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );
			$excerpt         = get_the_excerpt();

			$classes = 'post post-'.$post->ID.' hentry slides displaynone';
			if ( 0 === $i++ ) {
				$classes = 'post post-'.$post->ID.' hentry slides displayblock';
			}

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'clean-education-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class'	=> 'attached-post-image' ) );
			} else {
				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/no-featured-image-1680x720.jpg" >';

				//Get the first image in page, returns false if there is no image
				$first_image = clean_education_get_first_image( $post->ID, 'clean-education-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class' => 'attached-post-image' ) );

				//Set value of image as first image if there is an image present in the page
				if ( '' != $first_image ) {
					$image = $first_image;
				}
			}

			$output .= '
			<article class="'.$classes.'">
				<figure class="slider-image">
					<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'. $image .'</a>
				</figure><!-- .slider-image -->
				<div class="entry-container clear">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'.the_title( '<span>','</span>', false ).'</a>
						</h2>

						<div class="screen-reader-text">'. clean_education_page_post_meta().'
						</div>
					</header>';

			if ( '' != $excerpt ) {
				$output .= '
					<div class="entry-summary">
						<p>'. $excerpt.'</p>
					</div>';
			}

			$output .= '
				</div><!-- .entry-container -->
			</article><!-- .slides -->';
		} // endwhile.

		wp_reset_postdata();

		return $output;
	}
endif; // clean_education_post_page_category_slider