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
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .page-numbers {
	background: <?php echo $nav_bg; ?>;
	color: <?php echo $nav_color; ?>;
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .page-numbers.prev,
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .page-numbers.next {
	background: <?php echo $nav_button_bg; ?>;
	color: <?php echo $nav_button_color; ?>;
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li a.page-numbers:hover {
	background: <?php echo $nav_hover_bg; ?>;
	color: <?php echo $nav_hover_color; ?>;
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .page-numbers.current {
	background: <?php echo $nav_active_bg; ?>;
	color: <?php echo $nav_active_color; ?>;
}
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .page-numbers.next { margin-left: 5px; }
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .page-numbers.prev { margin-right: 5px; }
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination li .fa { display: none; }
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination .wptp-number { border-left: 1px solid #e8e8e8; }
#<?php echo $widget_id; ?>_content.wptp-pagination-style-3.wptp_widget_content .wptp-pagination .wptp-number:first-child { border-left: 0; }
</style>