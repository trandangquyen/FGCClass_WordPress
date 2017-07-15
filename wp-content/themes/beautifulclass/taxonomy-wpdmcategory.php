
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beautifulclass
 */

get_header(); ?>
<?php
$categories = get_categories(array(
    'taxonomy' => 'wpdmcategory',
));
if(!empty($categories))
    $category_id = $categories[0]->slug;
else $category_id = '';

?>
<div id="primary" class="content-area ">
    <section class="content-area" style="transform: none; min-height: 256px;">
        <div class="top_site_main">
            <?php echo do_shortcode('[rev_slider alias="banner-class"]'); ?>
            <span class="overlay-top-header" style="background:rgba(0,0,0,0.5);"></span>
            <div class="page-title-wrapper">
                <div class="banner-wrapper container"><h1>Thư viện sách</h1></div>
            </div>
        </div>
        <div class="breadcrumbs-wrapper">
            <div class="container">
                <ul itemprop="breadcrumb" itemscope="" id="breadcrumbs" class="breadcrumbs">
                    <?php bcn_display_list();
                    //var_dump($categories);
                    ?>
                </ul>
            </div>
        </div>
        <div id="<?php echo $category_id; ?>" class="container site-content sidebar-right" style="transform: none;">
            <div class="row" style="transform: none;">
                <main id="main" class="site-main col-sm-9 alignleft">
                    <div id="lp-download-courses">
                        <div class="thim-course-top switch-layout-container">
                            <div class="thim-course-switch-layout switch-layout"><a href="#" class="list switchToGrid switch-active"><i
                                        class="fa fa-th-large"></i></a> <a href="#" class="grid switchToList"><i
                                        class="fa fa-list-ul"></i></a></div>
                            <div class="course-index">
                                    <span>
                                        <?php
                                        $category = get_category(25);
                                        $total_post = $category->category_count;
                                        ?>

                                        <?php if($total_post>0): ?>
                                            Đang hiển thị 1-<?php echo $total_post ?> của <?php echo $total_post ?> kết quả
                                        <?php endif;?>
                                    </span>
                            </div>
                            <div class="courses-searching">
                                <form method="get" action="<?php echo home_url( '/' ); ?>"
                                      data-dpmaxz-eid="9"><input type="text" value="" name="s"
                                                                 placeholder="Tìm trong danh mục"
                                                                 class="form-control course-search-filter"
                                                                 autocomplete="off" data-dpmaxz-eid="10"> <input
                                        type="hidden" value="course" name="ref">
                                    <button type="submit" data-dpmaxz-eid="11"><i class="fa fa-search"></i></button>
                                    <span class="widget-search-close"></span>
                                </form>
                                <ul class="courses-list-search list-unstyled"></ul>
                            </div>
                        </div>
                        <div id="thim-course-archive" class="thim-course-grid" data-cookie="grid-layout">

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
                                    get_template_part( 'template-parts/post/content-attach', get_post_format() );

                                endwhile;

                                the_posts_navigation();

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif; ?>
                        </div>
                    </div>
                </main>
                <div id="sidebar" class="widget-area col-sm-3 sticky-sidebar" role="complementary"
                     style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar"
                         style="padding-top: 0px; padding-bottom: 1px; position: static;">
                        <?php
                        get_sidebar();
                        ?>
                        <?php
                        $args = array(
                            'parent'    => 291,
                            'sort_order' => 'DESC','number' => 3,
                        );
                        $latestpage = get_pages($args) ;
                        ?>
                        <aside id="courses-7" class="widget widget_courses">
                            <div class="thim-widget-courses thim-widget-courses-base"><h4 class="widget-title">Các khóa học mới</h4>
                                <div class="thim-course-list-sidebar">
                                    <?php foreach ($latestpage as $page): ?>
                                        <div class="lpr_course has-post-thumbnail">
                                            <div class="course-thumbnail"><?php echo get_the_post_thumbnail($page->ID, 'thumbnail') ; ?></div>
                                            <div class="thim-course-content"><h3 class="course-title"><a
                                                        href="<?php echo $page->guid ?>"><?php echo $page->post_title ?></a></h3>
                                                <div class="course-price" itemprop="offers" itemscope=""
                                                     itemtype="http://schema.org/Offer">
                                                    <div class="value free-course" itemprop="price"> Free</div>
                                                    <meta itemprop="priceCurrency" content="$">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </aside>
                        <aside id="single-images-7" class="widget widget_single-images">
                            <div class="thim-widget-single-images thim-widget-single-images-base">
                                <div class="single-image text-left"><a href="#"><img
                                            src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2015/12/ad.jpg"
                                            width="330" height="359" alt=""></a></div>
                            </div>
                        </aside>
                        <aside id="list-post-9" class="widget widget_list-post">
                            <div class="thim-widget-list-post thim-widget-list-post-base"><h4 class="widget-title">Bài học mới</h4>
                                <div class="thim-list-posts sidebar">
                                    <?php
                                    global $post;
                                    $args = array('category' => 22,'numberposts'=> 3 );
                                    $new_posts = get_posts( $args );
                                    foreach ($new_posts as $lastest_post):
                                        ?>
                                        <div class="item-post post-3698 post type-post status-publish format-standard has-post-thumbnail hentry category-blog tag-course pmpro-has-access">
                                            <div class="article-image"> <?php echo get_the_post_thumbnail( $lastest_post->ID, 'thumbnail' ); ?>
                                            </div>
                                            <div class="article-title-wrapper"><h5><a
                                                        href="<?php echo $lastest_post->guid?>"
                                                        class="article-title"><?php echo $lastest_post->post_title ?></a></h5>
                                                <div class="article-date"><?php echo $lastest_post->post_date ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- #primary -->
<div class="sidebar container">
    <?php
    get_sidebar();
    ?>
</div>
<?php
get_footer();