<?php
/*
 *
 * Available variables:
 *      $style            - main template
 *      $pagination_style - pagination template
 *      $bg               - content
 *      $color            - content
 *      $link_color       - content
 *      $link_hover_color - content
 *      $list_hover_bg    - content
 *      $tab_bg           - tabs nav
 *      $tab_color        - tabs nav
 *      $tab_hover_bg     - tabs nav
 *      $tab_hover_color  - tabs nav
 *      $tab_active_bg    - tabs nav
 *      $tab_active_color - tabs nav
 *      $nav_bg           - pagination
 *      $nav_color        - pagination
 *		$nav_button_bg    - pagination
 *		$nav_button_color - pagination
 *      $nav_hover_bg     - pagination
 *      $nav_hover_color  - pagination
 *      $nav_active_bg    - pagination
 *      $nav_active_color - pagination
 *
 *      $widget_id
 *
 * Note: non used variables are empty ( see wptp_widget::get_presets() )
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<style type="text/css">
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li .page-numbers {
	color: <?php echo $nav_color; ?>;
	border-radius: 4px;
    border: 1px solid #<?php echo wptp_darken_color( $nav_bg, 8 ); ?>;
    text-shadow: 0 1px rgba(0,0,0,0.4);
    box-shadow: inset 0 1px 0 0 rgba(255,255,255,0.25);
    background: <?php echo $nav_bg; ?>; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(<?php echo $nav_bg; ?>, #<?php echo wptp_darken_color( $nav_bg, 5 ); ?>); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(<?php echo $nav_bg; ?>, #<?php echo wptp_darken_color( $nav_bg, 5 ); ?>); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(<?php echo $nav_bg; ?>, #<?php echo wptp_darken_color( $nav_bg, 5 ); ?>); /* For Firefox 3.6 to 15 */
    background: linear-gradient(<?php echo $nav_bg; ?>, #<?php echo wptp_darken_color( $nav_bg, 5 ); ?>); /* Standard syntax (must be last) */
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li .page-numbers.prev,
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li .page-numbers.next {
	color: <?php echo $nav_button_color; ?>;
	background: <?php echo $nav_button_bg; ?>; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(<?php echo $nav_button_bg; ?>, #<?php echo wptp_darken_color( $nav_button_bg, 5 ); ?>); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(<?php echo $nav_button_bg; ?>, #<?php echo wptp_darken_color( $nav_button_bg, 5 ); ?>); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(<?php echo $nav_button_bg; ?>, #<?php echo wptp_darken_color( $nav_button_bg, 5 ); ?>); /* For Firefox 3.6 to 15 */
    background: linear-gradient(<?php echo $nav_button_bg; ?>, #<?php echo wptp_darken_color( $nav_button_bg, 5 ); ?>); /* Standard syntax (must be last) */
	
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li a.page-numbers:hover {
	color: <?php echo $nav_hover_color; ?>;
	border: 1px solid #<?php echo wptp_darken_color( $nav_hover_bg, 8 ); ?>;
    box-shadow: inset 0 1px 0 0 rgba(255,255,255,0.45);
	background: <?php echo $nav_hover_bg; ?>; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(<?php echo $nav_hover_bg; ?>, #<?php echo wptp_darken_color( $nav_hover_bg, 5 ); ?>); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(<?php echo $nav_hover_bg; ?>, #<?php echo wptp_darken_color( $nav_hover_bg, 5 ); ?>); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(<?php echo $nav_hover_bg; ?>, #<?php echo wptp_darken_color( $nav_hover_bg, 5 ); ?>); /* For Firefox 3.6 to 15 */
    background: linear-gradient(<?php echo $nav_hover_bg; ?>, #<?php echo wptp_darken_color( $nav_hover_bg, 5 ); ?>); /* Standard syntax (must be last) */
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li .page-numbers.current {
	color: <?php echo $nav_active_color; ?>;
	border: 1px solid #<?php echo wptp_darken_color( $nav_active_bg, 8 ); ?>;
    box-shadow: inset 0 1px 0 0 rgba(255,255,255,0.45);
	background: <?php echo $nav_active_bg; ?>; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(<?php echo $nav_active_bg; ?>, #<?php echo wptp_darken_color( $nav_active_bg, 5 ); ?>); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(<?php echo $nav_active_bg; ?>, #<?php echo wptp_darken_color( $nav_active_bg, 5 ); ?>); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(<?php echo $nav_active_bg; ?>, #<?php echo wptp_darken_color( $nav_active_bg, 5 ); ?>); /* For Firefox 3.6 to 15 */
    background: linear-gradient(<?php echo $nav_active_bg; ?>, #<?php echo wptp_darken_color( $nav_active_bg, 5 ); ?>); /* Standard syntax (must be last) */
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li .fa { display: none; }
#<?php echo $widget_id; ?>_content.wptp-pagination-style-24.wptp_widget_content .wptp-pagination li { margin-right: 3px }
</style>