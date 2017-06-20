<?php
/**
 * The template for displaying the footer
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */
?>

<?php
    /**
     * clean_education_after_content hook
     *
     * @hooked clean_education_content_sidebar_wrap_end - 10
     * @hooked clean_education_content_end - 30
     * @hooked clean_education_featured_content_display (move featured content below homepage posts) - 40
     *
     */
    do_action( 'clean_education_after_content' );
?>

<?php
    /**
     * clean_education_footer hook
     *
     * @hooked clean_education_footer_content_start - 10
     * @hooked clean_education_footer_sidebar - 20
     * @hooked clean_education_footer_menu - 30
     * @hooked clean_education_footer_social - 40
     * @hooked clean_education_get_footer_content - 100
     * @hooked clean_education_footer_content_end - 110
     * @hooked clean_education_page_end - 200
     *
     */
    do_action( 'clean_education_footer' );
?>

<?php
/**
 * clean_education_after hook
 *
 * @hooked clean_education_scrollup - 10
 * @hooked clean_education_mobile_menus- 20
 *
 */
do_action( 'clean_education_after' );?>

<?php wp_footer(); ?>

</body>
</html>