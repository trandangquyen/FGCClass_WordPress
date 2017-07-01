<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary-gallery" class="content-area">
    <section class="content-area" style="min-height: 305px;">
        <div class="top_site_main">
            <?php echo do_shortcode('[rev_slider alias="banner-class"]'); ?>
            <span class="overlay-top-header" style="background:rgba(0,0,0,0.5);"></span>
            <div class="page-title-wrapper">
                <div class="banner-wrapper container"><h1>Gallery</h1></div>
            </div>
        </div>
        <div class="breadcrumbs-wrapper">
            <div class="container">
                <ul itemprop="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs"
                    class="breadcrumbs">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item"
                                                                                                         href="https://educationwp.thimpress.com"
                                                                                                         title="Home"><span
                                    itemprop="name">Home</span></a></li>
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><span
                                itemprop="name" title="Gallery"> Gallery</span></li>
                </ul>
            </div>
        </div>
        <div class="container site-content">
            <div class="row">
                <main id="main" class="site-main" role="main">
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();

                        // Include the page content template.
                        get_template_part('template-parts/content', 'page');

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }

                        // End of the loop.
                    endwhile;
                    ?>

                </main><!-- .site-main -->
            </div>
        </div>
    </section>

</div><!-- .content-area -->
<?php get_footer(); ?>
