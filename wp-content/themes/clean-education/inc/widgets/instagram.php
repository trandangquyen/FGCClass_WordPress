<?php
/**
 * Newsletter Widget
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 1.0
 */


class clean_education_instagram_widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since Clean Education 1.0
	 */
	function __construct() {
		$this->defaults = array(
			'title'    => esc_html__( 'Instagram', 'clean-education' ),
			'username' => '',
			'layout'   => 'one-column',
			'number'   => 6,
			'size'     => 'thumbnail',
			'target'   => 0,
			'link'     => esc_html__( 'View on Instagram', 'clean-education' ),
		);

		$widget_ops = array(
			'classname'   => 'ct-instagram ctninstagram ctfeaturedpostpageimage',
			'description' => esc_html__( 'Displays your latest Instagram photos', 'clean-education' ),
		);

		$control_ops = array(
			'id_base' => 'ct-instagram',
		);

		parent::__construct(
			'ct-instagram', // Base ID
			__( 'CT: Instagram', 'clean-education' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'clean-education' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php esc_html_e( 'Username', 'clean-education' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php esc_html_e( 'Layout', 'clean-education' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" class="widefat">
				<?php
					$post_type_choices = array(
						'one-column'		=> esc_html__( '1 Column', 'clean-education' ),
						'two-columns'		=> esc_html__( '2 Columns', 'clean-education' ),
						'three-columns'		=> esc_html__( '3 Columns', 'clean-education' ),
						'four-columns'		=> esc_html__( '4 Columns', 'clean-education' ),
						'five-columns'		=> esc_html__( '5 Columns', 'clean-education' ),
						'six-columns'		=> esc_html__( '6 Columns', 'clean-education' ),
						'seven-columns'		=> esc_html__( '7 Columns', 'clean-education' ),
						'eight-columns'		=> esc_html__( '7 Columns', 'clean-education' ),
					);

				foreach ( $post_type_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['layout'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of photos', 'clean-education' ); ?>:</label>
			<input type="number" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo absint( $instance['number'] ); ?>" class="small-text" min="1" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php esc_html_e( 'Instagram Image Size', 'clean-education' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat">
				<?php
					$post_type_choices = array(
						'thumbnail' => esc_html__( 'Thumbnail', 'clean-education' ),
						'small'     => esc_html__( 'Small', 'clean-education' ),
						'large'     => esc_html__( 'Large', 'clean-education' ),
						'original'  => esc_html__( 'Original', 'clean-education' ),
					);

				foreach ( $post_type_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['size'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		 <p>
        	<input class="checkbox" type="checkbox" <?php checked( $instance['target'], true ) ?> id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>" />
        	<label for="<?php echo $this->get_field_id('target' ); ?>"><?php esc_html_e( 'Check to Open Link in new Tab/Window', 'clean-education' ); ?></label><br />
        </p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'clean-education' ); ?>:
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['link'] ); ?>" /></label></p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['username'] = sanitize_text_field( $new_instance['username'] );
		$instance['layout']   = sanitize_key( $new_instance['layout'] );
		$instance['number']   = absint( $new_instance['number'] );
		$instance['size']     = sanitize_key( $new_instance['size'] );
		$instance['target']   = clean_education_sanitize_checkbox( $new_instance['target'] );
		$instance['link']     = strip_tags( $new_instance['link'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $args['before_widget'];

		// Set up the author bio
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
		}

		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$number   = empty( $instance['number'] ) ? 9 : $instance['number'];
		$size     = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$link     = empty( $instance['link'] ) ? '' : $instance['link'];

		$target = '_self';

		if ( $instance['target'] ) {
			$target = '_blank';
		}

		if ( '' != $username ) {

			$media_array = $this->scrape_instagram( $username, $number );

			if ( is_wp_error( $media_array ) ) {

				echo wp_kses_post( $media_array->get_error_message() );

			}
			else {
				// filter for images only?
				if ( $images_only = apply_filters( 'clean_education_images_only', FALSE ) ) {
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				}
				?>

				<ul class="<?php echo esc_attr( $instance['layout'] ); ?>">
				<?php
					foreach ( $media_array as $item ) {
						echo '
						<li class="hentry">
							<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'">
								<img src="'. esc_url( $item[$size] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"/>
							</a>
						</li>';
					}
				?>
				</ul>
			<?php
			}
		}

		$linkclass = apply_filters( 'clean_education_link_class', 'clear' );

		if ( '' != $link ) {
			?>
			<p class="<?php echo esc_attr( $linkclass ); ?>">
				<a class="genericon genericon-instagram" href="//instagram.com/<?php echo esc_attr( trim( $username ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><span><?php echo wp_kses_post( $link ); ?></span></a>
			</p>
			<?php
		}

		echo $args['after_widget'];
	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 9 ) {
		$username = strtolower( $username );
		$username = str_replace( '@', '', $username );

		if ( false === ( $instagram = get_transient( 'instagram-a3-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'clean-education' ) );
			}

			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'clean-education' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'clean-education' ) );
			}

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
			}
			else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'clean-education' ) );
			}

			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'clean-education' ) );
			}

			$instagram = array();

			foreach ( $images as $image ) {

				$image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
				$image['display_src']   = preg_replace( '/^https?\:/i', '', $image['display_src'] );

				// handle both types of CDN url
				if ( (strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
					$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
					$image['small']     = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
				}
				else {
					$urlparts  = wp_parse_url( $image['thumbnail_src'] );
					$pathparts = explode( '/', $urlparts['path'] );

					array_splice( $pathparts, 3, 0, array( 's160x160' ) );

					$image['thumbnail'] = '//' . $urlparts['host'] . implode('/', $pathparts);
					$pathparts[3]       = 's320x320';
					$image['small']     = '//' . $urlparts['host'] . implode('/', $pathparts);
				}

				$image['large'] = $image['thumbnail_src'];

				if ( $image['is_video'] == true ) {
					$type = 'video';
				}
				else {
					$type = 'image';
				}

				$caption = esc_html__( 'Instagram Image', 'clean-education' );
				if ( ! empty( $image['caption'] ) ) {
					$caption = $image['caption'];
				}

				$instagram[] = array(
					'description'   => $caption,
					'link'		  	=> '//instagram.com/p/' . $image['code'],
					'time'		  	=> $image['date'],
					'comments'	  	=> $image['comments']['count'],
					'likes'		 	=> $image['likes']['count'],
					'thumbnail'	 	=> $image['thumbnail'],
					'small'			=> $image['small'],
					'large'			=> $image['large'],
					'original'		=> $image['display_src'],
					'type'		  	=> $type
				);
			}



			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				set_transient( 'instagram-a3-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'clean_education_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {
			return array_slice( $instagram, 0, $slice );
		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'clean-education' ) );

		}
	}

	function images_only( $media_item ) {
		if ( $media_item['type'] == 'image' ) {
			return true;
		}

		return false;
	}
}

//From Codex: https://codex.wordpress.org/Widgets_API
add_action('widgets_init',
	create_function('', 'return register_widget("clean_education_instagram_widget");')
);

