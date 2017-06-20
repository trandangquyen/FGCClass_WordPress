<?php
/**
 * The template for displaying the News
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */



if ( !function_exists( 'clean_education_news_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook clean_education_before_content.
	*
	* @since Clean Education 0.1
	*/
	function clean_education_news_display() {
		//clean_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = clean_education_get_theme_options();
		$enable_content = $options['news_option'];
		$content_select = $options['news_type'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_news' ) ) ) {
				$layouts 	 = $options['news_layout'];
				$headline 	 = $options['news_headline'];
				$subheadline = $options['news_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( !empty( $layouts ) ) {
					$classes = $layouts ;
				}

				$classes .= ' ' . $content_select ;

				if ( 'demo' == $content_select ) {
					$headline    = esc_html__( 'Recent News', 'clean-education' );
					$subheadline = esc_html__( 'Here you can showcase the x number of News.', 'clean-education' );
				}

				if ( $options['news_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="news-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( !empty( $headline ) || !empty( $subheadline ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="news-heading" class="section-title">'.  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>'. $subheadline .'</p>';
									}
								$output .='</div><!-- .featured-heading-wrap -->';
							}
							$output .='
							<div class="section-content-wrap">';
								// Select content
								if ( 'demo' == $content_select ) {
									$output .= clean_education_demo_news( $options );
								}
								elseif ( 'page' == $content_select ) {
									$output .= clean_education_post_page_category_news( $options );
								}

				$output .='
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #news-section -->';
			set_transient( 'clean_education_news', $output, 86940 );
			}
		echo $output;
		}
	}
endif;


if ( ! function_exists( 'clean_education_news_display_position' ) ) :
	/**
	 * Homepage news Position
	 *
	 * @action clean_education_content, clean_education_after_secondary
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_news_display_position() {
		// Getting data from Theme Options
		$options = clean_education_get_theme_options();

		if ( $options['news_position'] ) {
			add_action( 'clean_education_after_content', 'clean_education_news_display', 90 );
		}
		else {
			add_action( 'clean_education_before_content', 'clean_education_news_display', 80 );
		}
	}
endif; // clean_education_news_display_position
add_action( 'clean_education_before', 'clean_education_news_display_position' );


if ( ! function_exists( 'clean_education_demo_news' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Clean Education 0.1
	 *
	 */
	function clean_education_demo_news( $options ) {
		$output = '
			<article id="news-post-1" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Dashboard" class="wp-post-image" src="'.get_template_directory_uri() . '/images/news1-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Dashboard</a></h2>
						<p class="entry-meta"><span class="posted-on"><span class="screen-reader-text">Posted on</span><a href="#" rel="bookmark"><time class="entry-date published" datetime="2016-10-04T01:56:30+00:00">October 4, 2016</time><time class="updated" datetime="2016-10-05T16:45:33+00:00">October 5, 2016</time></a></a></span></p>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable News section from "Appearnace - Customize - Theme Options - News." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>

			<article id="news-post-2" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Designs" class="wp-post-image" src="'.get_template_directory_uri() . '/images/news2-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Designs</a></h2>
						<p class="entry-meta"><span class="posted-on"><span class="screen-reader-text">Posted on</span><a href="#" rel="bookmark"><time class="entry-date published" datetime="2016-10-02T01:56:30+00:00">October 2, 2016</time><time class="updated" datetime="2016-10-04T16:45:33+00:00">October 4, 2016</time></a></span></p>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable News section from "Appearnace - Customize - Theme Options - News." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>

			<article id="news-post-3" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Music" class="wp-post-image" src="'.get_template_directory_uri() . '/images/news3-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Music</a></h2>
						<p class="entry-meta"><span class="posted-on"><span class="screen-reader-text">Posted on</span><a href="#" rel="bookmark"><time class="entry-date published" datetime="2016-09-29T01:56:30+00:00">September 29, 2016</time><time class="updated" datetime="2016-09-30T16:45:33+00:00">September 30, 2016</time></a></span></p>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable News section from "Appearnace - Customize - Theme Options - News." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>';

		if ( 'layout-four' == $options['news_layout'] ) {
			$output .= '
			<article id="news-post-4" class="post hentry post-demo">
				<figure class="featured-content-image">
					<a href="#">
						<img alt="Bike" class="wp-post-image" src="'.get_template_directory_uri() . '/images/news4-480x320.jpg" />
					</a>
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title"><a href="#">Bike</a></h2>
						<p class="entry-meta"><span class="posted-on"><span class="screen-reader-text">Posted on</span><a href="#" rel="bookmark"><time class="entry-date published" datetime="2016-09-10T01:56:30+00:00">September 10, 2016</time><time class="updated" datetime="2016-09-20T16:45:33+00:00">September 20, 2016</time></a></span></p>
					</header>
					<div class="entry-summary">
						<p>You can edit/enable/disable News section from "Appearnace - Customize - Theme Options - News." <span class="readmore"><a href="#">Read More ...</a></span></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>';
		}

		return $output;
	}
endif; // clean_education_demo_news


if ( ! function_exists( 'clean_education_post_page_category_news' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_news( $options ) {
		global $post;

		$quantity   = $options['news_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$type       = $options['news_type'];
		$output     = '';

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['news_page_' . $i] ) ? $options['news_page_' . $i] : false;

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
					$image = get_the_post_thumbnail( $post->ID, 'clean-education-news', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = clean_education_get_first_image( $post->ID, 'clean-education-news', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

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

				if ( $options['news_enable_title'] || 'hide-content' != $options['news_show'] ) {
				$output .= '
					<div class="entry-container">';
					if ( $options['news_enable_title'] || !$options['news_hide_date'] ) {
						$output .= '
							<header class="entry-header">';

						if ( $options['news_enable_title'] ) {
							$output .= '
								<h2 class="entry-title">
									' . the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a>', false ) . '
								</h2>';
						}

						if ( !$options['news_hide_date'] ) {
							$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

							if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
								$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
							}

							$time_string = sprintf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_attr( get_the_modified_date( 'c' ) ),
								esc_html( get_the_modified_date() )
							);
							$date = sprintf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>', sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'clean-education' ) ),
								esc_url( get_permalink() ),
								$time_string
							);

							$output .=  '
								<p class="entry-meta">' . $date . '</p>';
						}

						$output .= '
							</header>';
					}

					if ( 'excerpt' == $options['news_show'] ) {
						//Show Excerpt
						$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
					}
					elseif ( 'full-content' == $options['news_show'] ) {
						//Show Content
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}
				}
				$output .= '
					</div><!-- .entry-container -->';

				$output .= '
				</article><!-- .featured-post-'. $i .' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // clean_education_post_page_category_news