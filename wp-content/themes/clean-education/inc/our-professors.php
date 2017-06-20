<?php
/**
 * The template for displaying Our Professors
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */



if ( !function_exists( 'clean_education_our_professors_display' ) ) :
	/**
	* Add Our Professors
	*
	* @uses action hook clean_education_before_content.
	*
	* @since Clean Education 0.1
	*/
	function clean_education_our_professors_display() {
		//clean_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = clean_education_get_theme_options();
		$enable_content = $options['our_professors_option'];
		$content_select = $options['our_professors_type'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_our_professors' ) ) ) {
				$layouts 	 = $options['our_professors_layout'];
				$headline 	 = $options['our_professors_headline'];
				$subheadline = $options['our_professors_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( !empty( $layouts ) ) {
					$classes = $layouts ;
				}

				$classes .= ' ' . $content_select ;

				if ( 'demo' == $content_select ) {
					$headline    = esc_html__( 'Our Professors', 'clean-education' );
					$subheadline = esc_html__( 'Here you can showcase the x number of Professors.', 'clean-education' );
				}

				if ( '1' == $options['our_professors_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="our-professors-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( !empty( $headline ) || !empty( $subheadline ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="featured-heading" class="section-title">'.  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>'. $subheadline .'</p>';
									}
								$output .='</div><!-- .heading-wrap -->';
							}
							$output .='
							<div class="section-content-wrap">';
								// Select content
								if ( 'demo' == $content_select ) {
									$output .= clean_education_demo_our_professors( $options );
								}
								elseif ( 'page' == $content_select ) {
									$output .= clean_education_post_page_category_our_professors( $options );
								}

				$output .='
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #our-professors-section -->';
			set_transient( 'clean_education_our_professors', $output, 86940 );
			}
		echo $output;
		}
	}
endif;


if ( ! function_exists( 'clean_education_our_professors_display_position' ) ) :
	/**
	 * Homepage Our Professors Position
	 *
	 * @action clean_education_content, clean_education_after_secondary
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_our_professors_display_position() {
		// Getting data from Theme Options
		$options = clean_education_get_theme_options();

		if ( $options['our_professors_position'] ) {
			add_action( 'clean_education_after_content', 'clean_education_our_professors_display', 80 );
		}
		else {
			add_action( 'clean_education_before_content', 'clean_education_our_professors_display', 70 );
		}
	}
endif; // clean_education_our_professors_display_position
add_action( 'clean_education_before', 'clean_education_our_professors_display_position' );


if ( ! function_exists( 'clean_education_demo_our_professors' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Clean Education 0.1
	 *
	 */
	function clean_education_demo_our_professors( $options ) {
		$output = '
			<article id="featured-post-1" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Sam Chow" class="wp-post-image" src="'.get_template_directory_uri() . '/images/professors1-320x480.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Sam Chow</a></h2>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable Our Professors section from "Appearnace - Customize - Theme Options - Our Professors." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-2" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Peyton List" class="wp-post-image" src="'.get_template_directory_uri() . '/images/professors2-320x480.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Peyton List</a></h2>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable Our Professors section from "Appearnace - Customize - Theme Options - Our Professors." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-3" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Julie Andrews" class="wp-post-image" src="'.get_template_directory_uri() . '/images/professors3-320x480.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Julie Andrews</a></h2>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable Our Professors section from "Appearnace - Customize - Theme Options - Our Professors." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>';

		if ( 'layout-four' == $options['our_professors_layout'] ) {
			$output .= '
			<article id="featured-post-4" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Jessica Tandy" class="wp-post-image" src="'.get_template_directory_uri() . '/images/professors4-320x480.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Jessica Tandy</a></h2>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable Our Professors section from "Appearnace - Customize - Theme Options - Our Professors." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>';
		}

		return $output;
	}
endif; // clean_education_demo_our_professors


if ( ! function_exists( 'clean_education_post_page_category_our_professors' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_our_professors( $options ) {
		global $post;

		$quantity   = $options['our_professors_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$layouts    = 3;

		$output     = '';

		if ( 'layout-four' == $options['our_professors_layout'] ) {
			$layouts = 4;
		}

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['our_professors_page_' . $i] ) ? $options['our_professors_page_' . $i] : false;

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

		$loop = new WP_Query( $args );

		$i=0;
		while ( $loop->have_posts() ) {

			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( array( 'before' => esc_html__( 'Permalink to:', 'clean-education' ), 'echo' => false ) );

			$output .= '
				<article id="featured-post-' . $i . '" class="post hentry post">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/no-featured-image-1680x720.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'clean-education-featured-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = clean_education_get_first_image( $post->ID, 'clean-education-featured-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-content-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image .'
						</a>
					</figure>';

				if ( $options['our_professors_enable_title'] || 'hide-content' != $options['our_professors_show'] ) {
				$output .= '
					<div class="entry-container">';
					if ( $options['our_professors_enable_title'] ) {
						$output .= '
							<header class="entry-header">
								<h2 class="entry-title">
									<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
								</h2>
							</header>';
					}

					if ( 'excerpt' == $options['our_professors_show'] ) {
						//Show Excerpt
						$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
					}
					elseif ( 'full-content' == $options['our_professors_show'] ) {
						//Show Content
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}
				}
				$output .= '
				</article><!-- .featured-post-'. $i .' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // clean_education_post_page_category_our_professors