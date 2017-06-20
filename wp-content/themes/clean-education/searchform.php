<?php
/**
 * The template for displaying search forms
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */
?>

<?php $options 	= clean_education_get_theme_options(); // Get options ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'clean-education' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options['search_text'] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'clean-education' ); ?>">
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'clean-education' ); ?></span></button>
</form>