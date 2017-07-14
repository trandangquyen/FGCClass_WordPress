<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beautifulclass
 */

get_header(); ?>

	<div id="primary" class="content-area ">
        <div class="top_site_main">
            <?php echo do_shortcode('[rev_slider alias="Banner-bai-tap"]'); ?>
            <span class="overlay-top-header" style="background:rgba(0,0,0,0.5);"></span>
            <div class="page-title-wrapper">
                <div class="banner-wrapper container"><h1>Tất cả bài tập</h1></div>
            </div>
        </div>
        <div class="breadcrumbs-wrapper">
            <div class="container">
                <ul itemprop="breadcrumb" itemscope="" id="breadcrumbs" class="breadcrumbs">
                    <?php bcn_display_list(); ?>
                </ul>
            </div>
        </div>
		<main id="main" class="site-main-category container" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-category', get_post_format() );

			endwhile;
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
    <div class="seprate-footer">

    </div>
<?php
get_footer();
