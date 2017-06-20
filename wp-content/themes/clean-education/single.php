<?php
/**
 * The Template for displaying all single posts
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */



get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
			if($message=fgc_checkAccess()) echo '<h2>'.$message.'</h2>';
			else while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					/**
					 * clean_education_after_post hook
					 *
					 * @hooked clean_education_post_navigation - 10
					 */
					do_action( 'clean_education_after_post' );

					/**
					 * clean_education_comment_section hook
					 *
					 * @hooked clean_education_get_comment_section - 10
					 */
					do_action( 'clean_education_comment_section' );
				?>
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>