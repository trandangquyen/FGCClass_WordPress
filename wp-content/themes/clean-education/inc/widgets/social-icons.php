<?php
/**
 * Social Icons Widget
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 1.0
 */


/**
 * Adds clean_educationSocialIcons widget.
 *
 * @since Catch Responsive 1.0
 */
class clean_education_social_icons_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'clean_education_social_icons', // Base ID
			'CT: Social Icons', // Name
			array( 'description' => esc_html__( 'Use this widget to add Social Icons Menu as a widget. ', 'clean-education' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		echo clean_education_get_social_icons();

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = '';

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title (optional):', 'clean-education' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

//From Codex: https://codex.wordpress.org/Widgets_API
add_action('widgets_init',
	create_function('', 'return register_widget("clean_education_social_icons_widget");')
);