<?php
/**
 * The template for displaying Portfolio
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( !function_exists( 'clean_education_portfolio_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook clean_education_before_content.
	*
	* @since Clean Education 0.1
	*/
	function clean_education_portfolio_display() {
		//clean_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = clean_education_get_theme_options();
		$enable_content = $options['portfolio_option'];
		$content_select = $options['portfolio_type'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'clean_education_portfolio' ) ) ) {
				$layouts 	 = $options['portfolio_layout'];
				$headline 	 = $options['portfolio_headline'];
				$subheadline = $options['portfolio_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( !empty( $layouts ) ) {
					$classes = $layouts ;
				}

				$classes .= ' ' . $content_select;

				if ( 'demo' == $content_select  ) {
					$headline 		= esc_html__( 'Portfolio', 'clean-education' );
					$subheadline 	= esc_html__( 'Here you can showcase the x number of Portfolios.', 'clean-education' );
				}

				$output ='
				<div id="portfolio-section" class="sections ' . $classes . '">
					<div class="wrapper">';
					if ( !empty( $headline ) || !empty( $subheadline ) ) {
						$output .='
						<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 class="section-title">'.  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>'. $subheadline .'</p>';
									}
								$output .='
						</div><!-- .section-heading-wrap -->';
						}

						$output .='<div class="section-content-wrap">';
							// Select portfolio
							if ( 'demo' == $content_select ) {
								$output .= clean_education_demo_portfolio();
							}
							elseif ( 'page' == $content_select ) {
								$output .= clean_education_post_page_category_portfolio( $options );
							}

				$output .='
						</div><!-- .portfolio-content-wrap -->
					</div><!-- .wrapper -->
				</div><!-- .portfolio-section -->';

				set_transient( 'clean_education_portfolio', $output, 86940 );
			}

			echo $output;
		}
	} //clean_education_portfolio_display
endif;
add_action( 'clean_education_before_content', 'clean_education_portfolio_display', 60 );


if ( ! function_exists( 'clean_education_demo_portfolio' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since parallaxframe 1.0
	 *
	 */
	function clean_education_demo_portfolio() {
		return '
		<article id="portfolio-post-1" class="post hentry post-demo">
			<a title="Robotics" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Robotics" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio1-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Robotics</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		<article id="portfolio-post-2" class="post hentry post-demo">
			<a title="Aeronautics" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Aeronautics" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio2-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Aeronautics</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		<article id="portfolio-post-3" class="post hentry post-demo">
			<a title="Mechanical" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Mechanical" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio3-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Mechanical</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		<article id="portfolio-post-4" class="post hentry post-demo">
			<a title="Pharmaceutical" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Pharmaceutical" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio4-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Pharmaceutical</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		<article id="portfolio-post-5" class="post hentry post-demo">
			<a title="Mobility" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Mobility" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio5-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Mobility</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		<article id="portfolio-post-6" class="post hentry post-demo">
			<a title="Environment" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Environment" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio6-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Environment</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		</article>
		<article id="portfolio-post-7" class="post hentry post-demo">
			<a title="Media" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Media" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio7-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Media</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>
		<article id="portfolio-post-7" class="post hentry post-demo">
			<a title="Bioengineering" href="#">
				<figure class="portfolio-content-image featured-image">
					<img alt="Bioengineering" class="wp-post-image" src="'.get_template_directory_uri() . '/images/portfolio8-480x320.jpg" />
				</figure>
				<div class="entry-container caption">
					<header class="entry-header vcenter">
						<h2 class="entry-title">Bioengineering</h2>
						<span class="readmore">Read More ...</span>
					</header><!-- .vcenter -->
				</div><!-- .entry-container.caption -->
			</a>
		</article>';
	}
endif; // clean_education_demo_portfolio


if ( ! function_exists( 'clean_education_post_page_category_portfolio' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: clean_education_theme_options from customizer
	 *
	 * @since Clean Education 0.1
	 */
	function clean_education_post_page_category_portfolio( $options ) {
		global $post;

		$quantity   = $options['portfolio_number'];
		$no_of_post = $quantity;
		$post_list  = array();// list of valid post/page ids
		$no_of_post = 0;


		$output     = '<div class="portfolio_slider_wrap">';

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['portfolio_page_' . $i] ) ? $options['portfolio_page_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;

		$args['posts_per_page'] = $no_of_post;

		if ( 0 == $no_of_post ) {
			return;
		}

		$loop = new WP_Query( $args );

		$i=0;
		while ( $loop->have_posts() ) {

			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( array( 'before' => esc_html__( 'Permalink to:', 'clean-education' ), 'echo' => false ) );

			$output .= '
				<article id="portfolio-post-' . $i . '" class="post hentry page">
					<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">';

			//Default value if there is no first image
			$image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/no-featured-image-1680x720.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'clean-education-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = clean_education_get_first_image( $post->ID, 'clean-education-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

			$output .= '
						<figure class="portfolio-content-image featured-image">
							'. $image .'
						</figure>

						<div class="entry-container caption">
							<header class="entry-header vcenter">
								<h2 class="entry-title">
								' . esc_html( the_title( '' ,'', false ) ) . '
								<span class="readmore">' . esc_html( $options['excerpt_more_text'] ) . '</span>
							</header><!-- .entry-header.vcenter -->
						</div><!-- .entry-container.caption -->
					</a>';
			$output .= '
				</article><!-- .post-'. $i .' -->';
		} //endwhile

		$output .= '</div><!-- .portfolio_slider_wrap -->';

		wp_reset_postdata();

		return $output;
	}
endif; // clean_education_post_page_category_portfolio