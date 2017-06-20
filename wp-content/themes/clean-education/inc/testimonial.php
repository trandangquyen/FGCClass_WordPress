<?php
/**
 * The template for displaying Testimonial
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */



if ( !function_exists( 'clean_education_testimonial_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook clean_education_before_content.
	*
	* @since Clean Education 0.1
	*/
	function clean_education_testimonial_display() {
		//clean_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = clean_education_get_theme_options();
		$enable_content = $options['testimonial_option'];
		$content_select = $options['testimonial_type'];
		$slider_select  = $options['testimonial_slider'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_testimonial' ) ) ) {
				$layouts 	 = $options['testimonial_layout'];
				$headline 	 = $options['testimonial_headline'];
				$subheadline = $options['testimonial_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( !empty( $layouts ) ) {
					$classes = $layouts ;
				}

				$classes .= ' ' . $content_select ;

				if ( 'demo' == $content_select ) {
					$headline    = esc_html__( 'Testimonials', 'clean-education' );
					$subheadline = esc_html__( 'Here you can showcase the x number of Testimonials.', 'clean-education' );
				}

				if ( $options['testimonial_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="testimonial-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( !empty( $headline ) || !empty( $subheadline ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="testimonial-heading" class="section-title">'.  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>'. $subheadline .'</p>';
									}
								$output .='
									<!-- prev/next links -->
									<div id="content-controls">
										<div class="content-prev"></div>
										<div class="content-next"></div>
									</div>
								</div><!-- .featured-heading-wrap -->';
							}
							$output .='
							<div class="section-content-wrap">';

								if ( $slider_select ) {
									$output .='
									<div class="cycle-slideshow"
									    data-cycle-log="false"
									    data-cycle-pause-on-hover="true"
									    data-cycle-swipe="true"
									    data-cycle-auto-height=container
										data-cycle-slides=".testimonial_slider_wrap"
										data-cycle-fx="scrollHorz"
										data-cycle-prev="#testimonial-section .content-prev"
	        							data-cycle-next="#testimonial-section .content-next"
										>';
								}

								// Select content
								if ( 'demo' == $content_select ) {
									$output .= clean_education_demo_testimonial( $options );
								}
								elseif ( 'post' == $content_select || 'jetpack-testimonial' == $content_select || 'page' == $content_select || 'category' == $content_select ) {
									$output .= clean_education_post_page_category_testimonial( $options );
								}
								elseif ( 'image' == $content_select ) {
									$output .= clean_education_image_testimonial( $options );
								}

								if ( $slider_select ) {
									$output .='
									</div><!-- .cycle-slideshow -->';
								}

				$output .='
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #testimonial-section -->';
			set_transient( 'clean_education_testimonial', $output, 86940 );
			}
		echo $output;
		}
	}
endif;


if ( ! function_exists( 'clean_education_testimonial_display_position' ) ) :
	/**
	 * Homepage Testimonial Position
	 *
	 * @action clean_education_content, clean_education_after_secondary
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_testimonial_display_position() {
		// Getting data from Theme Options
		$options = clean_education_get_theme_options();

		if ( $options['testimonial_position'] ) {
			add_action( 'clean_education_after_content', 'clean_education_testimonial_display', 100 );
		}
		else {
			add_action( 'clean_education_before_content', 'clean_education_testimonial_display', 100 );
		}
	}
endif; // clean_education_testimonial_display_position
add_action( 'clean_education_before', 'clean_education_testimonial_display_position' );


if ( ! function_exists( 'clean_education_demo_testimonial' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Clean Education 1.0
	 *
	 */
	function clean_education_demo_testimonial( $options ) {
		$output = '
		<div class="testimonial_slider_wrap">
			<article id="testimonial-post-1" class="post hentry post-demo">
				<div class="entry-container">
					<header class="entry-header">
						<figure class="testimonial-image">
							<a href="#" title="Benjamin Balazs">
								<img alt="Benjamin Balazs" class="wp-post-image" src="'.get_template_directory_uri() . '/images/testimonial1-320x320.jpg" />
							</a>
						</figure>
						<h2 class="entry-title"><a href="#">Benjamin Balazs </a></h2>
					</header>
					<div class="entry-content"><p>I would describe the university as exciting and dynamic. The best thing about being a student here is the number of additional opportunities that are available. I was initially attracted here by my supervisor, the school\'s reputation, and my career goals.</p>
					</div>
				</div><!-- .entry-container -->
			</article>';

			if ( 'layout-two' == $options['testimonial_layout'] ) {
				$output .= '
				<article id="testimonial-post-2" class="post hentry post-demo">
					<div class="entry-container">
						<header class="entry-header">
							<figure class="testimonial-image">
								<a href="#" title="Dzee Shah">
									<img alt="Dzee Shah" class="wp-post-image" src="'.get_template_directory_uri() . '/images/testimonial2-320x320.jpg" />
								</a>
							</figure>
							<h2 class="entry-title"><a href="#">Dzee Shah</a></h2>
						</header>
						<div class="entry-content"><p>The University offers a fantastic academic environment, seminars, interdisciplinary initiatives, as well as a remarkable library and sport facility. For these reasons, I would heartily recommend the university to other students.</p>
						</div>
					</div><!-- .entry-container -->
				</article>';
			}

		$output .= '</div><!-- .testimonial_slider_wrap -->
		<div class="testimonial_slider_wrap">
			<article id="testimonial-post-3" class="post hentry post-demo">
				<div class="entry-container">
					<header class="entry-header">
						<figure class="testimonial-image">
							<a href="#" title="Song Jay">
								<img alt="Song Jay" class="wp-post-image" src="'.get_template_directory_uri() . '/images/testimonial3-320x320.jpg" />
							</a>
						</figure>
						<h2 class="entry-title"><a href="#">Song Jay</a></h2>
					</header>
					<div class="entry-content"><p>I can positively say the university has made me a better person. It has helped me develop a positive attitude towards my studies and discover more about myself. Teachers are very caring and interested in students\' well-being. They make sure every class is fun and interactive.</p></div>
				</div><!-- .entry-container -->
			</article>';

			if ( 'layout-two' == $options['testimonial_layout'] ) {
				$output .= '
				<article id="testimonial-post-4" class="post hentry post-demo">
					<div class="entry-container">
						<header class="entry-header">
							<figure class="testimonial-image">
								<a href="#" title="Sophia Johns">
									<img alt="Sophia Johns" class="wp-post-image" src="'.get_template_directory_uri() . '/images/testimonial4-320x320.jpg" />
								</a>
							</figure>
							<h2 class="entry-title"><a href="#">Sophia Johns</a></h2>
						</header>
						<div class="entry-content"><p>I like the friendly atmosphere here and the fact the teachers are really close to the students. We are very supported in our studies. Some of the teachers are really kind and their way of teaching is really interesting. They are also very motivational. We are enthused by the classes.</p></div>
					</div><!-- .entry-container -->
				</article>';
			};
		$output .= '</div><!-- .courses_slider_wrap -->';

		return $output;
	}
endif; // clean_education_demo_testimonial


if ( ! function_exists( 'clean_education_post_page_category_testimonial' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_testimonial( $options ) {
		global $post;

		$quantity   = $options['testimonial_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$type       = $options['testimonial_type'];
		$layouts    = 1;

		if ( 'layout-two' == $options['testimonial_layout'] ) {
			$layouts = 2;
		}

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['testimonial_page_' . $i] ) ? $options['testimonial_page_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		if ( 0 == $no_of_post ) {
			return;
		}

		$args['post__in'] = $post_list;

		$args['posts_per_page'] = $no_of_post;
		$loop     = new WP_Query( $args );

		$i = 1;

		$output = '<div class="testimonial_slider_wrap">';

		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="testimonial-post-' . $i . '" class="post hentry ' . esc_attr( $type ) . '">
					<div class="entry-container">
						<header class="entry-header">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/no-featured-image-1680x720.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'clean-education-testimonial', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = clean_education_get_first_image( $post->ID, 'clean-education-testimonial', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
							<figure class="testimonial-image">
								<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
								'. $image .'
								</a>
							</figure>';

				if ( $options['testimonial_enable_title'] ) {
					$output .= the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>', false );
				}

				$output .= '
						</header><!-- .entry-header -->';

				if ( 'excerpt' == $options['testimonial_show'] ) {
					//Show Excerpt
					$output .= '
						<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
				}
				elseif ( 'full-content' == $options['testimonial_show'] ) {
					//Show Content
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
				}
				$output .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-'. $i .' -->';

				if ( 0 == ( $i % $layouts ) && $i < $no_of_post ) {
					//end and start testimonial_slider_wrap div based on logic
					$output .= '
				</div><!-- .testimonial_slider_wrap -->

				<div class="testimonial_slider_wrap">';
				}

				$i++;
			} //endwhile

		wp_reset_postdata();

		$output .= '</div><!-- .testimonial_slider_wrap -->';

		return $output;
	}
endif; // clean_education_post_page_category_testimonial