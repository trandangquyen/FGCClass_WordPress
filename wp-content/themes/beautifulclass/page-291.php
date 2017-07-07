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

    <div id="primary" class="content-area ">
        <section class="content-area" style="transform: none; min-height: 256px;">
            <div class="top_site_main">
                <?php echo do_shortcode('[rev_slider alias="banner-class"]'); ?>
                <span class="overlay-top-header" style="background:rgba(0,0,0,0.5);"></span>
                <div class="page-title-wrapper">
                    <div class="banner-wrapper container"><h1>Lớp học</h1></div>
                </div>
            </div>
            <div class="breadcrumbs-wrapper">
                <div class="container">
                    <ul itemprop="breadcrumb" itemscope="" id="breadcrumbs" class="breadcrumbs">
                        <?php bcn_display_list() ?>
                    </ul>
                </div>
            </div>
            <div class="container site-content sidebar-right" style="transform: none;">
                <div class="row" style="transform: none;">
                    <main id="main" class="site-main col-sm-9 alignleft">
                        <div id="lp-archive-courses">
                            <div class="thim-course-top switch-layout-container">
                                <div class="thim-course-switch-layout switch-layout"><a href="#" class="list switchToGrid switch-active"><i
                                                class="fa fa-th-large"></i></a> <a href="#" class="grid switchToList"><i
                                                class="fa fa-list-ul"></i></a></div>
                                <div class="course-index">
                                    <span><?php $args = array(
                                            'parent'    => 291,
                                        );
                                        $latestpage = get_pages($args) ;
                                        $total_post = count($latestpage);
                                        ?>

                                        <?php if($total_post>0): ?>
                                        Đang hiển thị 1-<?php echo $total_post ?> của <?php echo $total_post ?> kết quả
                                        <?php endif;?>
                                    </span>
                                </div>
                                <div class="courses-searching">
                                    <form method="get" action="<?php echo home_url( '/' ); ?>"
                                          data-dpmaxz-eid="9"><input type="text" value="" name="s"
                                                                     placeholder="Tìm trong các lớp học"
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
                                $args = array(
                                    'post_parent' => $post->ID,
                                    'post_type' => 'page',
                                    'orderby' => 'menu_order'
                                );

                                $child_query = new WP_Query($args);
                                ?>

                                <?php while ($child_query->have_posts()) : $child_query->the_post(); ?>

                                    <div id="post-<?php echo get_the_ID(); ?>"
                                         class="course-grid-3 lpr_course lp_course type-lp_course status-publish has-post-thumbnail hentry course_category-general pmpro-has-access course">
                                        <div class="course-item">
                                            <div class="course-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    if (has_post_thumbnail()) {
                                                        the_post_thumbnail('page-thumb-mine');
                                                    }
                                                    ?>
                                                </a>
                                                <a class="course-readmore" href="<?php the_permalink(); ?>">Xem Thêm</a>
                                            </div>
                                            <div class="thim-course-content">
                                                <div class="course-author" itemscope=""
                                                     itemtype="http://schema.org/Person">
                                                    <img alt="Admin bar avatar"
                                                         src="<?php echo get_template_directory_uri(); ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg"
                                                         class="avatar avatar-40 photo" height="40" width="40">
                                                    <div class="author-contain"><label
                                                                itemprop="jobTitle">Teacher</label>
                                                        <div class="value" itemprop="name">
                                                            <a href="<?php the_permalink(); ?>"> Mr. Hải </a></div>
                                                    </div>
                                                </div>
                                                <h2 class="course-title"><a
                                                            href="<?php the_permalink(); ?>"
                                                            rel="bookmark"><?php the_title(); ?></a></h2>
                                                <div class="course-meta">
                                                    <div class="course-author" itemscope=""
                                                         itemtype="http://schema.org/Person"><img alt="Admin bar avatar"
                                                                                                  src="<?php echo get_template_directory_uri(); ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg"
                                                                                                  class="avatar avatar-40 photo"
                                                                                                  height="40"
                                                                                                  width="40">
                                                        <div class="author-contain"><label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"><a
                                                                        href="https://educationwp.thimpress.com/profile/keny/courses/">
                                                                    Mr. Hải</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="course-students"><label>Students</label>
                                                        <div class="value"><i class="fa fa-group"></i> 309</div>
                                                    </div>
                                                    <div class="course-comments-count">
                                                        <div class="value"><i class="fa fa-comment"></i><?php comments_number( 0, 1, '%' ); ?></div>
                                                    </div>
                                                    <div class="course-price" itemprop="offers">
                                                        <div class="value free-course" itemprop="price"> Free</div>
                                                        <meta itemprop="priceCurrency" content="$">
                                                    </div>
                                                </div>
                                                <div class="course-price" itemprop="offers">
                                                    <div class="value free-course" itemprop="price"> Free</div>
                                                    <meta itemprop="priceCurrency" content="$">
                                                </div>
                                                <div class="course-readmore"><a
                                                            href="https://educationwp.thimpress.com/courses/learnpress-101/">Read
                                                        More</a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>

                                <?php wp_reset_postdata(); ?>
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
                                <div class="thim-widget-courses thim-widget-courses-base"><h4 class="widget-title">
                                        Latest Courses</h4>
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
                                <div class="thim-widget-list-post thim-widget-list-post-base"><h4 class="widget-title">
                                        Latest Posts</h4>
                                    <div class="thim-list-posts sidebar">
                                        <div class="item-post post-3698 post type-post status-publish format-standard has-post-thumbnail hentry category-blog tag-course pmpro-has-access">
                                            <div class="article-image"><img width="150" height="150"
                                                                            src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-8-150x150.jpg"
                                                                            class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                            alt=""
                                                                            srcset="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-8-150x150.jpg 150w, https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-8-180x180.jpg 180w, https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-8-300x300.jpg 300w"
                                                                            sizes="(max-width: 150px) 100vw, 150px">
                                            </div>
                                            <div class="article-title-wrapper"><h5><a
                                                            href="https://educationwp.thimpress.com/online-learning-glossary/"
                                                            class="article-title">Online Learning Glossary</a></h5>
                                                <div class="article-date"><span class="day">20</span><span
                                                            class="month">Jan</span><span class="year">2016</span></div>
                                            </div>
                                        </div>
                                        <div class="item-post post-3699 post type-post status-publish format-standard has-post-thumbnail hentry category-blog tag-designer tag-seo pmpro-has-access">
                                            <div class="article-image"><img width="150" height="150"
                                                                            src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-5-150x150.jpg"
                                                                            class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                            alt=""
                                                                            srcset="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-5-150x150.jpg 150w, https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-5-180x180.jpg 180w, https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/01/blog-5-300x300.jpg 300w"
                                                                            sizes="(max-width: 150px) 100vw, 150px">
                                            </div>
                                            <div class="article-title-wrapper"><h5><a
                                                            href="https://educationwp.thimpress.com/tips-to-succeed-in-an-online-course/"
                                                            class="article-title">Tips to Succeed in an Online
                                                        Course</a></h5>
                                                <div class="article-date"><span class="day">20</span><span
                                                            class="month">Jan</span><span class="year">2016</span></div>
                                            </div>
                                        </div>
                                        <div class="item-post post-71 post type-post status-publish format-standard has-post-thumbnail hentry category-blog tag-course tag-thimpress tag-wordpress pmpro-has-access">
                                            <div class="article-image"><img width="150" height="150"
                                                                            src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2015/10/blog-3-150x150.jpg"
                                                                            class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                            alt=""
                                                                            srcset="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2015/10/blog-3-150x150.jpg 150w, https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2015/10/blog-3-180x180.jpg 180w, https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2015/10/blog-3-300x300.jpg 300w"
                                                                            sizes="(max-width: 150px) 100vw, 150px">
                                            </div>
                                            <div class="article-title-wrapper"><h5><a
                                                            href="https://educationwp.thimpress.com/introducing-dr-deniz-zeynep-2/"
                                                            class="article-title">Introducing: Dr. Deniz Zeynep</a></h5>
                                                <div class="article-date"><span class="day">20</span><span
                                                            class="month">Oct</span><span class="year">2015</span></div>
                                            </div>
                                        </div>
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
