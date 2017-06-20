<?php
/**
 * The template for displaying the Featured Content
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */



if ( !function_exists( 'clean_education_courses_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook clean_education_before_content.
	*
	* @since Clean Education 0.1
	*/
	function clean_education_courses_display() {
		//clean_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = clean_education_get_theme_options();
		$enable_content = $options['courses_option'];
		$content_select = $options['courses_type'];
		$slider_select  = $options['courses_slider'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_courses' ) ) ) {
				$layouts 	 = $options['courses_layout'];
				$headline 	 = $options['courses_headline'];
				$subheadline = $options['courses_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( !empty( $layouts ) ) {
					$classes = $layouts ;
				}

				$classes .= ' ' . $content_select ;

				if ( 'demo' == $content_select ) {
					$headline    = esc_html__( 'Recent Courses', 'clean-education' );
					$subheadline = esc_html__( 'Here you can showcase the x number of Courses.', 'clean-education' );
				}

				if ( '1' == $options['courses_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="courses-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( !empty( $headline ) || !empty( $subheadline ) || !empty( $slider_select ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="courses-heading" class="section-title">'.  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>'. $subheadline .'</p>';
									}
									if ( !empty( $slider_select ) ) {
										$output .='
										<!-- prev/next links -->
										<div id="content-controls">
											<div class="content-prev"></div>
											<div class="content-next"></div>
										</div>';
									}
								$output .='</div><!-- .featured-heading-wrap -->';
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
										data-cycle-slides=".courses_slider_wrap"
										data-cycle-fx="scrollHorz"
										data-cycle-prev=".content-prev"
	        							data-cycle-next=".content-next"
										>';
								 }

								// Select content
								if ( 'demo' == $content_select ) {
									$output .= clean_education_demo_courses( $options );
								}
								elseif ( 'page' == $content_select ) {
									$output .= clean_education_post_page_category_courses( $options );
								}

								if ( $slider_select ) {
									$output .='
									</div><!-- .cycle-slideshow -->';
								}

				$output .='
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #courses-section -->';
			set_transient( 'clean_education_courses', $output, 86940 );
			}
		echo $output;
		}
	}
endif;


if ( ! function_exists( 'clean_education_courses_display_position' ) ) :
	/**
	 * Homepage Featured Content Position
	 *
	 * @action clean_education_content, clean_education_after_secondary
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_courses_display_position() {
		// Getting data from Theme Options
		$options = clean_education_get_theme_options();

		if ( $options['courses_position'] ) {
			add_action( 'clean_education_after_content', 'clean_education_courses_display', 70 );
		}
		else {
			add_action( 'clean_education_before_content', 'clean_education_courses_display', 60 );
		}
	}
endif; // clean_education_courses_display_position
add_action( 'clean_education_before', 'clean_education_courses_display_position' );


if ( ! function_exists( 'clean_education_demo_courses' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Clean Education 1.0
	 *
	 */
	function clean_education_demo_courses( $options ) {
		$output = '
		<div class="courses_slider_wrap">
			<article id="featured-post-1" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Computer Science" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses1-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Computer Science</a></h2>
					</header>
					<div class="entry-summary">
						<p>Computer science courses covering topics in artificial intelligence, cyber security and software engineering.<span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-2" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Creative Arts" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses2-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Creative Arts</a></h2>
					</header>
					<div class="entry-summary">
						<p>Creative arts courses provide you with knowledge on how the arts, entertainment, multimedia and fashion industries really work. <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-3" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Engineering" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses3-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Engineering</a></h2>
					</header>
					<div class="entry-summary">
						<p>Engineering course enables you to develop engineering knowledge, skills, imagination & experience to the highest levels.<span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>';

		if ( 'layout-four' == $options['courses_layout'] ) {
			$output .= '
			<article id="featured-post-4" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Geography" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses4-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Geography</a></h2>
					</header>
					<div class="entry-summary">
						<p>Geography course focuses on geography includes classes covering areas of specialization within the field. <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>';
		}
		$output .= '</div><!-- .courses_slider_wrap -->
		<div class="courses_slider_wrap">
			<article id="featured-post-5" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Education" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses5-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Education</a></h2>
					</header>
					<div class="entry-summary">
						<p>Education course focuses on developing critical skills to evaluate & analyse current research, theory & practice. <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-6" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Media" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses6-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Media</a></h2>
					</header>
					<div class="entry-summary">
						<p>Our media course examines the relationships between media, culture & society in an increasingly globalised world. <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-7" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Law" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses7-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Law</a></h2>
					</header>
					<div class="entry-summary">
						<p>Law is highly valued in all professions, and it\'s also the first step towards a career in the legal profession. <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>';


		if ( 'layout-four' == $options['courses_layout'] ) {
			$output .= '
			<article id="featured-post-8" class="post hentry post-demo">
				<figure class="featured-image courses-image">
					<a href="#">
						<img alt="Languages" class="wp-post-image" src="'.get_template_directory_uri() . '/images/courses8-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Languages</a></h2>
					</header>
					<div class="entry-summary">
						<p>The key to understanding another society is mastering its language. The courses are also very flexible. <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div>
				</div><!-- .entry-container -->
			</article>';
		}
		$output .= '</div><!-- .courses_slider_wrap -->';

		return $output;
	}
endif; // clean_education_demo_courses


if ( ! function_exists( 'clean_education_post_page_category_courses' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_courses( $options ) {
		global $post;

		$quantity   = $options['courses_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$type       = $options['courses_type'];
		$layouts    = 3;

		$output     = '<div class="courses_slider_wrap">';

		if ( 'layout-four' == $options['courses_layout'] ) {
			$layouts = 4;
		}

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['courses_page_' . $i] ) ? $options['courses_page_' . $i] : false;

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
					$image = get_the_post_thumbnail( $post->ID, 'clean-education-courses', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = clean_education_get_first_image( $post->ID, 'clean-education-courses', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-image courses-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image .'
						</a>
					</figure>';

				if ( $options['courses_enable_title'] || 'hide-content' != $options['courses_show'] ) {
				$output .= '
					<div class="entry-container">';
					if ( $options['courses_enable_title'] ) {
						$output .= '
							<header class="entry-header">
								<h2 class="entry-title">
									<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
								</h2>
							</header>';
					}

					if ( 'excerpt' == $options['courses_show'] ) {
						//Show Excerpt
						$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
					}
					elseif ( 'full-content' == $options['courses_show'] ) {
						//Show Content
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}
				}
				$output .= '
				</article><!-- .featured-post-'. $i .' -->';

				if ( 0 == ( $i % $layouts ) && $i < $no_of_post ) {
					//end and start courses_slider_wrap div based on logic
					$output .= '
				</div><!-- .courses_slider_wrap -->

				<div class="courses_slider_wrap">';
				}
			} //endwhile

		wp_reset_postdata();

		$output .= '</div><!-- .courses_slider_wrap -->';

		return $output;
	}
endif; // clean_education_post_page_category_courses