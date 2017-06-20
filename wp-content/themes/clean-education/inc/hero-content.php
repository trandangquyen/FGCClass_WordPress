<?php
/**
 * The template for displaying the Hero Content
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */



if ( !function_exists( 'clean_education_hero_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook clean_education_before_content.
*
* @since Clean Education 0.1
*/
function clean_education_hero_content_display() {
	//clean_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options        = clean_education_get_theme_options();
	$enable_content = $options['hero_content_option'];
	$content_select = $options['hero_content_type'];

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
		if ( ( !$output = get_transient( 'clean_education_hero_content' ) ) ) {
			echo '<!-- refreshing cache -->';

			$classes[] = $content_select ;

			$output ='
				<div id="hero-section" class="sections ' . implode( ' ', $classes ) . '">
					<div class="wrapper">';
						// Select content
						if ( 'demo' == $content_select ) {
							$output .= clean_education_demo_hero_content();
						}
						elseif ( 'page' == $content_select ) {
							$output .= clean_education_post_page_category_hero_content( $options );
						}

				$output .='
					</div><!-- .wrapper -->
				</div><!-- #hero-section -->';

			set_transient( 'clean_education_hero_content', $output, 86940 );
		}
	echo $output;
	}
}
endif;
add_action( 'clean_education_before_content', 'clean_education_hero_content_display', 20 );


if ( ! function_exists( 'clean_education_demo_hero_content' ) ) :
/**
 * This function to display hero posts content
 *
 * @get the data value from customizer options
 *
 * @since Clean Education 0.1
 *
 */
function clean_education_demo_hero_content() {
	return '
	<article class="post-11 page type-page status-publish has-post-thumbnail hentry" id="post-11">
		<figure class="featured-image">
	    	<a href="#" rel="bookmark">
	        	<img width="600" height="400" alt="" class="wp-post-image" src="'.get_template_directory_uri() . '/images/about-600x400.jpg">
	        </a>
		</figure>
		<div class="entry-container">
			<header class="entry-header">
				<h2 class="entry-title section-title"><a href="#">Welcome to Our University</a></h2>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<p>A university is an institution of higher education and research which grants academic degrees in various subjects. Universities typically provide undergraduate education and postgraduate education. The word university is derived from the Latin universitas magistrorum et scholarium, which roughly means community of teachers and scholars. A national university is generally a university created or run by a national state. <span class="readmore"><a href="#">Read More ...</a></span></p>
			</div><!-- .entry-summary -->
		</div><!-- .entry-container -->
	</article>';
}
endif; // clean_education_demo_hero_content


if ( ! function_exists( 'clean_education_post_page_category_hero_content' ) ) :
/**
 * This function to display hero posts content
 *
 * @param $options: clean_education_theme_options from customizer
 *
 * @since Clean Education 0.1
 */
function clean_education_post_page_category_hero_content( $options ) {
	global $post;

	$quantity   = $options['hero_content_number'];
	$no_of_post = 0; // for number of posts
	$post_list  = array();// list of valid post/page ids
	$output     = '';

	$args = array(
		'post_type'           => 'page',
		'orderby'             => 'post__in',
		'ignore_sticky_posts' => 1 // ignore sticky posts
	);

	//Get valid number of posts
	for( $i = 1; $i <= $quantity; $i++ ){
		$post_id = isset( $options['hero_content_page_' . $i] ) ? $options['hero_content_page_' . $i] : false;

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

	$get_hero_posts         = new WP_Query( $args );

	$i=0;
	while ( $get_hero_posts->have_posts() ) {
		$get_hero_posts->the_post();

		$i++;

		$title_attribute = the_title_attribute( array( 'before' => esc_html__( 'Permalink to:', 'clean-education' ), 'echo' => false ) );

		$output .= '
			<article id="post-' . $i . '" class="post-' . $i . ' hentry has-post-thumbnail">';

			//Default value if there is no first image
			$image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/no-featured-image-1680x720.jpg" >';

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'clean-education-featured-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
			}
			else {
				//Get the first image in page, returns false if there is no image
				$first_image = clean_education_get_first_image( $post->ID, 'clean-education-hero-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

				//Set value of image as first image if there is an image present in the page
				if ( '' != $first_image ) {
					$image = $first_image;
				}
			}

			$output .= '
				<figure class="featured-image">
					<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
					'. $image .'
					</a>
				</figure>';

			if ( $options['hero_content_enable_title'] || 'hide-content' != $options['hero_content_show'] ) {
			$output .= '
				<div class="entry-container">';

				if ( $options['hero_content_enable_title'] ) {
					$output .= '
					<header class="entry-header">
						<h2 class="entry-title section-title">
							<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
						</h2>
					</header>';
				}

				if ( 'excerpt' == $options['hero_content_show'] ) {
					//Show Excerpt
					$output .= '
					<div class="entry-summary">
						<p>' . get_the_excerpt() . '</p>
					</div><!-- .entry-content -->';
				}
				elseif ( 'full-content' == $options['hero_content_show'] ) {
					//Show Content
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
				}
			}
			$output .= '
				</div><!-- .entry-container -->
			</article><!-- .post-'. $i .' -->';
		} //endwhile

	wp_reset_postdata();

	return $output;
}
endif; // clean_education_post_page_category_hero_content