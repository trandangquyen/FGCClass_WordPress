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

    <div id="primary" class="content-area">
        <section class="content-area" style="transform: none; min-height: 328px;">
            <div class="top_site_main">
                <?php echo do_shortcode('[rev_slider alias="banner-class"]'); ?>
                <span class="overlay-top-header" style="background:rgba(0,0,0,0.5);"></span>
                <div class="page-title-wrapper">
                    <div class="banner-wrapper container"><h2><?php echo the_title();?></h2></div>
                </div>
            </div>
            <div class="breadcrumbs-wrapper">
                <div class="container">
                    <ul itemprop="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs">
                        <?php bcn_display_list(); ?>
                    </ul>

                </div>
            </div>
            <div class="container site-content sidebar-right" style="transform: none;">
                <div class="row" style="transform: none;">
                    <main id="main" class="site-main col-sm-9 alignleft">
                        <article id="post-5299"
                                 class="post-5299 lp_course type-lp_course status-publish has-post-thumbnail hentry course_category-technology course_tag-node course_tag-tutorial pmpro-has-access course">
                            <div class="entry-content">
                                <div id="lp-single-course" class="learnpress-content learn-press"><h1
                                        class="entry-title" itemprop="name"><?php echo 'Giới Thiệu '; echo the_title();?></h1>
                                    <div class="course-meta">
                                        <div class="course-author" itemscope="" itemtype="http://schema.org/Person"><img
                                                alt="Admin bar avatar"
                                                src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/learn-press-profile/7/9c081444f942cc8fe0ddf55631b584e2.jpg"
                                                class="avatar avatar-40 photo" height="40" width="40">
                                            <div class="author-contain"><label itemprop="jobTitle">Giáo viên</label>
                                                <div class="value" itemprop="name"><a
                                                        href="https://educationwp.thimpress.com/profile/keny/courses/">
                                                        Hoàng Hải </a></div>
                                            </div>
                                        </div>
                                        <div class="course-categories"><label>Danh mục</label>
                                            <div class="value"><span class="cat-links"><a
                                                        href="<?php
                                                        $parent_link = get_queried_object();
                                                        if(isset($parent_link))
                                                            echo get_page_link($parent_link->post_parent);
                                                        ?>"
                                                        rel="tag"><?php

                                                        if(isset($parent_link))
                                                            echo get_the_title($parent_link->post_parent);
                                                        ?>

                                                        </a></span></div>
                                        </div>
                                        <div class="course-review"><label>Đánh giá</label>
                                            <div class="value">
                                                <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-payment">
                                        <div class="course-price" itemprop="offers" itemscope=""
                                             itemtype="http://schema.org/Offer">
                                            <div class="value free-course" itemprop="price"> Miễn phí</div>
                                            <meta itemprop="priceCurrency" content="$">
                                        </div>
                                        <form name="purchase-course" class="purchase-course form-purchase-course"
                                              method="post" enctype="multipart/form-data" data-dpmaxz-eid="9">
                                            <button class="button purchase-button thim-enroll-course-button"
                                                    data-dpmaxz-eid="10"> Tham gia khóa học này
                                            </button>
                                            <input type="hidden" name="purchase-course" value="5299"></form>
                                    </div>
                                    <div class="course-thumbnail"><?php the_post_thumbnail( 'full' ); ?></php></div>
                                    <div class="course-summary">
                                        <div class="course-landing-summary">
                                            <script type="text/template" id="learn-press-template-curriculum-popup">
                                                <div
                                                    id="course-curriculum-popup" class="sidebar-hide">
                                                    <div id="popup-header">
                                                        <div class="courses-searching">
                                                            <input type="text" value="" name="s"
                                                                   placeholder="Search courses"
                                                                   class="thim-s form-control courses-search-input"
                                                                   autocomplete="off"/>
                                                            <input type="hidden" value="course" name="ref"/>
                                                            <button type="submit"><i class="fa fa-search"></i></button>
                                                            <span class="widget-search-close"></span>
                                                            <ul class="courses-list-search"></ul>
                                                        </div>
                                                        <a class="popup-close"><i class="fa fa-close"></i></a>
                                                    </div>
                                                    <div id="popup-main">
                                                        <div id="popup-content">
                                                            <div id="popup-content-inner">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="popup-sidebar">
                                                        <nav class="thim-font-heading learn-press-breadcrumb"
                                                             itemprop="breadcrumb"><a
                                                                href="https://educationwp.thimpress.com/courses/">Courses</a><i
                                                                class="fa-angle-right fa"></i><a
                                                                href="https://educationwp.thimpress.com/course-category/technology/">Technology</a><i
                                                                class="fa-angle-right fa"></i><span class="item-name">From Zero to Hero with Nodejs</span>
                                                        </nav>
                                                    </div>
                                                </div></script>
                                            <script type="text/template" id="learn-press-template-course-prev-item">
                                                <div
                                                    class="course-content-lesson-nav course-item-prev prev-item">
                                                    <a class="footer-control prev-item button-load-item"
                                                       data-id="{{data.id}}" href="{{data.url}}">{{data.title}}</a>
                                                </div></script>
                                            <script type="text/template" id="learn-press-template-course-next-item">
                                                <div
                                                    class="course-content-lesson-nav course-item-next next-item">
                                                    <a class="footer-control next-item button-load-item"
                                                       data-id="{{data.id}}" href="{{data.url}}">{{data.title}}</a>
                                                </div></script>
                                            <script type="text/template" id="learn-press-template-block-content">
                                                <div
                                                    id="learn-press-block-content" class="popup-block-content">
                                                    <div class="thim-box-loading-container">
                                                        <div class="cssload-container">
                                                            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
                                                        </div>
                                                    </div>
                                                </div></script>
                                        </div>
                                        <div id="course-landing">
                                            <div class="course-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="active thim-col-4"><a href="#tab-course-description"
                                                                                     data-toggle="tab"> <i
                                                                class="fa fa-bookmark"></i> <span>Giới thiệu</span>
                                                        </a></li>
                                                    <li role="presentation" class="thim-col-4"><a
                                                            href="#tab-course-curriculum" data-toggle="tab"> <i
                                                                class="fa fa-cube"></i> <span>Chương trình học</span> </a>
                                                    </li>
                                                    <li role="presentation" class="thim-col-4"><a
                                                            href="#tab-course-instructor" data-toggle="tab"> <i
                                                                class="fa fa-user"></i> <span>Giảng viên</span>
                                                        </a></li>
                                                    <li role="presentation" class="thim-col-4"><a
                                                            href="#tab-course-review" data-toggle="tab"> <i
                                                                class="fa fa-comments"></i> <span>Đánh giá</span>
                                                            <span>(<?php comments_number( 0, 1, '%' ); ?>)</span> </a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-course-description">
                                                        <div class="thim-course-content"><h4>Tổng quan về khóa học</h4>
                                                            <?php
                                                            // Start the loop.
                                                            while ( have_posts() ) : the_post();

                                                                // Include the page content template.
                                                                get_template_part( 'template-parts/content', 'page' );
                                                                // End the loop.
                                                            endwhile;
                                                            ?>
                                                            <span class="cp-load-after-post"></span></div>
                                                        <div class="thim-course-info"><h3 class="title">Chi Tiết Khóa Học</h3>
                                                            <ul>
                                                                <li class="lectures-feature"><i
                                                                        class="fa fa-files-o"></i> <span
                                                                        class="label">Bài giảng</span> <span
                                                                        class="value">
                                                                        <?php
                                                                        $args = array(
                                                                            'numberposts' => -1,
                                                                            'meta_key' => '_class_id',
                                                                            'meta_value' => 1,
                                                                        );
                                                                        $posts_array = get_posts( $args );
                                                                        $total_posts_of_class = count($posts_array);
                                                                        echo $total_posts_of_class;
                                                                        ?>
                                                                    </span></li>
                                                                <li class="quizzes-feature"><i
                                                                        class="fa fa-puzzle-piece"></i> <span
                                                                        class="label">Bài trắc nghiệm</span> <span
                                                                        class="value">1</span></li>
                                                                <li class="duration-feature"><i
                                                                        class="fa fa-clock-o"></i> <span
                                                                        class="label">Thời lượng</span> <span
                                                                        class="value">600 Giờ</span></li>
                                                                <li class="skill-feature"><i class="fa fa-level-up"></i>
                                                                    <span class="label">Trình độ kỹ năng</span> <span
                                                                        class="value">Beginner</span></li>
                                                                <li class="language-feature"><i
                                                                        class="fa fa-language"></i> <span
                                                                        class="label">Ngôn ngữ</span> <span
                                                                        class="value">English</span></li>
                                                                <li class="students-feature"><i class="fa fa-users"></i>
                                                                    <span class="label">Số học viên</span> <span
                                                                        class="value">8</span></li>
                                                                <li class="assessments-feature"><i
                                                                        class="fa fa-check-square-o"></i> <span
                                                                        class="label">Đánh giá</span> <span
                                                                        class="value">Tốt</span></li>
                                                            </ul>
                                                        </div>
                                                        <ul class="thim-social-share">
                                                            <li class="heading">Share:</li>
                                                            <li>
                                                                <div class="facebook-social"><a target="_blank"
                                                                                                class="facebook"
                                                                                                href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Feducationwp.thimpress.com%2Fcourses%2Fnode%2F"
                                                                                                title="Facebook"><i
                                                                            class="fa fa-facebook"></i></a></div>
                                                            </li>
                                                            <li>
                                                                <div class="googleplus-social"><a target="_blank"
                                                                                                  class="googleplus"
                                                                                                  href="https://plus.google.com/share?url=https%3A%2F%2Feducationwp.thimpress.com%2Fcourses%2Fnode%2F&amp;title=From%20Zero%20to%20Hero%20with%20Nodejs"
                                                                                                  title="Google Plus"
                                                                                                  onclick="javascript:window.open(this.href, &quot;&quot;, &quot;menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600&quot;);return false;"><i
                                                                            class="fa fa-google"></i></a></div>
                                                            </li>
                                                            <li>
                                                                <div class="twitter-social"><a target="_blank"
                                                                                               class="twitter"
                                                                                               href="https://twitter.com/share?url=https%3A%2F%2Feducationwp.thimpress.com%2Fcourses%2Fnode%2F&amp;text=From%20Zero%20to%20Hero%20with%20Nodejs"
                                                                                               title="Twitter"><i
                                                                            class="fa fa-twitter"></i></a></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-pane" id="tab-course-curriculum">
                                                        <div class="course-curriculum"
                                                             id="learn-press-course-curriculum">
                                                            <div class="thim-curriculum-buttons"></div>
                                                            <ul class="curriculum-sections">
                                                                <?php
                                                                $args = array(
                                                                    'numberposts' => -1,
                                                                    'meta_key' => '_class_id',
                                                                    'meta_value' => 1,
                                                                );
                                                                $posts_array = get_posts( $args );
                                                                $total_posts_of_class = count($posts_array);
                                                                ?>
                                                                <li class="section" id="section-207" data-id="207"><h4
                                                                        class="section-header"><span
                                                                            class="collapse"></span> Bài học dành cho lớp A1 <span
                                                                            class="meta"> <span
                                                                                class="step"><?php echo $total_posts_of_class; ?></span> </span></h4>
                                                                    <ul class="section-content">
                                                                        <?php foreach ( $posts_array as $key => $post ):?>
                                                                        <li class="course-lesson course-item course-item-5300 free-item preview-item viewable"
                                                                            data-type="lp_lesson">
                                                                            <div class="meta-left"><span
                                                                                    class="course-format-icon"><i
                                                                                        class="fa fa-play-circle"></i></span>
                                                                                <div class="index"><span class="label">Bài </span><?php echo $key+1; ?>
                                                                                </div>
                                                                            </div>
                                                                            <a class="lesson-title course-item-title button-load-item"
                                                                               target="_blank"
                                                                               href="<?php the_permalink(); ?>"
                                                                               data-id="5300"
                                                                               data-complete-nonce="eff02e88a7"><?php the_title(); ?></a>
                                                                            <div class="meta course-item-meta"><a
                                                                                    title="Previews"
                                                                                    class="lesson-preview button-load-item"
                                                                                    href="<?php the_permalink(); ?>"
                                                                                    data-id="5300"
                                                                                    data-complete-nonce="eff02e88a7"><i
                                                                                        class="fa fa-eye"
                                                                                        aria-hidden="true"></i></a>
                                                                                <span class="lp-icon item-status"></span>
                                                                            </div>
                                                                        </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-course-instructor">
                                                        <div class="thim-about-author">
                                                            <div class="author-wrapper">
                                                                <div class="author-avatar"><img alt="Admin bar avatar"
                                                                                                src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/learn-press-profile/7/9c081444f942cc8fe0ddf55631b584e2.jpg"
                                                                                                class="avatar avatar-110 photo"
                                                                                                height="110"
                                                                                                width="110"></div>
                                                                <div class="author-bio">
                                                                    <div class="author-top"><a class="name"
                                                                                               href="https://educationwp.thimpress.com/profile/keny/courses/">
                                                                            Mr. Hoàng Hải </a>
                                                                        <p class="job">Professor</p></div>
                                                                    <ul class="thim-author-social">
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="facebook"><i
                                                                                    class="fa fa-facebook"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="twitter"><i
                                                                                    class="fa fa-twitter"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="google-plus"><i
                                                                                    class="fa fa-google-plus"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="linkedin"><i
                                                                                    class="fa fa-linkedin"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="youtube"><i
                                                                                    class="fa fa-youtube"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="author-description"> Hoàng Hải là một giáo viên giàu kinh nghiệm, anh đã tốt nghiệm đại học Kinh Tế đầy danh tiếng với tấm bằng cử nhân xuất sắc. Hoàng hải đã có một thời gian dài học tập và làm việc với người bản xứ. Đến với giáo viên Hoàng Hải, mọi khoảng cách tiếng anh sẽ bị xóa nhòa.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="thim-about-author thim-co-instructor"
                                                             itemprop="contributor" itemscope=""
                                                             itemtype="http://schema.org/Person">
                                                            <div class="author-wrapper">
                                                                <div class="author-avatar"><img alt=""
                                                                                                src="https://secure.gravatar.com/avatar/8ec1d9237e48ab70222b14973366fdb0?s=110&amp;r=g"
                                                                                                srcset="https://secure.gravatar.com/avatar/8ec1d9237e48ab70222b14973366fdb0?s=220&amp;r=g 2x"
                                                                                                class="avatar avatar-110 photo"
                                                                                                height="110"
                                                                                                width="110"></div>
                                                                <div class="author-bio">
                                                                    <div class="author-top"><a itemprop="url"
                                                                                               class="name"
                                                                                               href="https://educationwp.thimpress.com/profile/johndoe/courses/">
                                                                            <span itemprop="name">John Doe</span> </a>
                                                                        <p class="job" itemprop="jobTitle">Bachelor</p>
                                                                    </div>
                                                                    <ul class="thim-author-social">
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="facebook"><i
                                                                                    class="fa fa-facebook"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="twitter"><i
                                                                                    class="fa fa-twitter"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="google-plus"><i
                                                                                    class="fa fa-google-plus"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="linkedin"><i
                                                                                    class="fa fa-linkedin"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="http://example.com/eduma-the-best-lms-wordpress/theme"
                                                                               class="youtube"><i
                                                                                    class="fa fa-youtube"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="author-description" itemprop="description">
                                                                    After working as a software developer and contractor
                                                                    for over 8 years for a whole bunch of companies
                                                                    including ABX, Proit, SACC and AT&amp;T in the US,
                                                                    He decided to work full-time as a private software
                                                                    trainer. He received his Ph.D. in Computer Science
                                                                    from the University of Rochester in 2001. "What I
                                                                    teach varies from beginner to advanced and from what
                                                                    I have seen, anybody can learn and grow from my
                                                                    courses".
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-course-review">
                                                        <div class="course-rating"><h3>Reviews</h3>
                                                            <?php
                                                            if(function_exists('the_ratings')) { the_ratings(); }
                                                            if ( comments_open() || get_comments_number() ) :
                                                                comments_template();
                                                            endif;

                                                            ?>
                                                        </div>
                                                        <div class="course-review">
                                                            <div id="course-reviews" class="content-review">
                                                                <ul class="course-reviews-list">
                                                                    <li>
                                                                        <div class="review-container" itemprop="review"
                                                                             itemscope=""
                                                                             itemtype="http://schema.org/Review">
                                                                            <div class="review-author"><img
                                                                                    alt="Admin bar avatar"
                                                                                    src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/learn-press-profile/7/9c081444f942cc8fe0ddf55631b584e2.jpg"
                                                                                    class="avatar avatar-70 photo"
                                                                                    height="70" width="70"></div>
                                                                            <div class="review-text"><h4
                                                                                    class="author-name"
                                                                                    itemprop="author">Keny
                                                                                    White</h4>
                                                                                <div class="review-star">
                                                                                    <div class="review-stars-rated">
                                                                                        <ul class="review-stars">
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                        </ul>
                                                                                        <ul class="review-stars filled"
                                                                                            style="width: 100%">
                                                                                            <li>
                                                                                                <span class="fa fa-star"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star"></span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="review-title">Awesome</p>
                                                                                <div class="description"
                                                                                     itemprop="reviewBody"><p>I really
                                                                                        like this course. The most
                                                                                        important thing - it is totally
                                                                                        free :D.</p></div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="thim-course-menu-landing">
                                                <div class="container">
                                                    <ul class="thim-course-landing-tab">
                                                        <li class="active"><a
                                                                href="#tab-course-description">Description</a></li>
                                                        <li><a href="#tab-course-curriculum">Curriculum</a></li>
                                                        <li><a href="#tab-course-instructor">Instructors</a></li>
                                                        <li><a href="#tab-course-review">Reviews</a></li>
                                                    </ul>
                                                    <div class="thim-course-landing-button">
                                                        <div class="course-price" itemprop="offers" itemscope=""
                                                             itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                        <form name="purchase-course"
                                                              class="purchase-course form-purchase-course" method="post"
                                                              enctype="multipart/form-data" data-dpmaxz-eid="11">
                                                            <button class="button purchase-button thim-enroll-course-button"
                                                                    data-dpmaxz-eid="12"> Take this course
                                                            </button>
                                                            <input type="hidden" name="purchase-course" value="5299">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thim-ralated-course"><h3 class="related-title">Có thể bạn sẽ thích:</h3>
                                        <div class="thim-course-grid">
                                            <?php
                                            $args = array(
                                                'sort_order' => 'asc',
                                                'sort_column' => 'post_title',
                                                'hierarchical' => 1,
                                                'exclude' => '',
                                                'include' => '',
                                                'meta_key' => '',
                                                'meta_value' => '',
                                                'authors' => '',
                                                'child_of' => 291,
                                                'parent' => -1,
                                                'exclude_tree' => '',
                                                'number' => '',
                                                'offset' => 0,
                                                'post_type' => 'page',
                                                'post_status' => 'publish'
                                            );
                                            $pages = get_pages($args);
                                            $random_keys=array_rand($pages,3);
                                            $newarray = [$pages[$random_keys[0]],$pages[$random_keys[1]],$pages[$random_keys[2]]];
                                            ?>

                                            <?php foreach ( $newarray as $page ): ?>
                                                <article class="course-grid-3 lpr_course">
                                                    <div class="course-item">
                                                        <div class="course-thumbnail"><a href="<?php echo $page->guid ?>">
                                                                <?php echo get_the_post_thumbnail($page->ID, array( 450, 450)) ; ?></a> <a
                                                                class="course-readmore"
                                                                href="<?php echo $page->guid ?>">Xem thêm</a></div>
                                                        <div class="thim-course-content">
                                                            <div class="course-author"><img alt="Admin bar avatar"
                                                                                            src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg"
                                                                                            class="avatar avatar-40 photo"
                                                                                            height="40" width="40">
                                                                <div class="author-contain">
                                                                    <div class="value"><a
                                                                            href="<?php echo $page->guid ?>">Hoàng Hải</a></div>
                                                                </div>
                                                            </div>
                                                            <h2 class="course-title"><a rel="bookmark"
                                                                                        href="https://educationwp.thimpress.com/courses/python/"><?php echo $page->post_title ?></a></h2>
                                                            <div class="course-meta">
                                                                <div class="course-students"><label>Students</label>
                                                                    <div class="value"><i class="fa fa-group"></i> 50</div>
                                                                </div>
                                                                <div class="course-comments-count">
                                                                    <div class="value"><i class="fa fa-comment"></i>1</div>
                                                                </div>
                                                                <div class="course-price" itemprop="offers" itemscope=""
                                                                     itemtype="http://schema.org/Offer">
                                                                    <div class="value" itemprop="price">Free</div>
                                                                    <meta itemprop="priceCurrency" content="$">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </main>
                    <div id="sidebar" class="widget-area col-sm-3 sticky-sidebar" role="complementary"
                         style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                        <div class="theiaStickySidebar"
                             style="padding-top: 0px; padding-bottom: 1px; position: static; top: 20px; left: 1074.6px;">
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
                                <div class="thim-widget-courses thim-widget-courses-base"><h4 class="widget-title">Các lớp học mới</h4>
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
                                        $args = array(
                                            'meta_key' => '_class_id',
                                            'meta_value' => 1,
                                            'numberposts'=> 3
                                        );
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
<?php
get_footer();
