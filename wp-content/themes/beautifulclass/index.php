<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beautifulclass
 */

get_header(); ?>

<div id="main-content">
                <div id="main-home-content" class="home-content home-page container" role="main">
                    <div id="pl-12" class="panel-layout">
                        <div id="pg-12-0" class="panel-grid panel-has-style">
                            <div class="siteorigin-panels-stretch thim-fix-stretched panel-row-style panel-row-style-for-12-0" data-stretch-type="full-stretched" style="margin-left: -174.6px; margin-right: -174.4px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px;">
                                <div id="pgc-12-0-0" class="panel-grid-cell" style="padding-left: 0px; padding-right: 0px;">
                                    <div id="panel-12-0-0-0" class="so-panel widget widget_text panel-first-child panel-last-child" data-index="0">
                                        <div class="textwidget">
                                        	<?php echo do_shortcode('[rev_slider alias="Test Slider Alias"]');?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-1" class="panel-grid panel-has-style">
                            <div class="thim-best-industry panel-row-style panel-row-style-for-12-1">
                                <div id="pgc-12-1-0" class="panel-grid-cell">
                                    <div id="panel-12-1-0-0" class="so-panel widget widget_icon-box panel-first-child panel-last-child" data-index="1">
                                        <div class="thim-widget-icon-box thim-widget-icon-box-base">
                                            <div class="wrapper-box-icon has_custom_image has_read_more text-left overlay " data-text-readmore="#ffb606">
                                                <div class="smicon-box iconbox-left">
                                                    <div class="boxes-icon" style="width: 135px;height: 135px;"><span class="inner-icon"><span class="icon icon-images"><img src="<?php echo get_template_directory_uri() ; ?>/images/logo-top-1.png" alt="logo-top-1" title="logo-top-1" width="61" height="52"></span></span>
                                                    </div>
                                                    <div class="content-inner" style="width: calc( 100% - 135px - 15px);">
                                                        <div class="sc-heading article_heading">
                                                            <h3 class="heading__primary">Các học viên xuất sắc</h3></div><a class="smicon-read sc-btn" target="_self" href="#" style="color: #ffb606;">View More<i class="fa fa-chevron-right"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pgc-12-1-1" class="panel-grid-cell">
                                    <div id="panel-12-1-1-0" class="so-panel widget widget_icon-box panel-first-child panel-last-child" data-index="2">
                                        <div class="thim-widget-icon-box thim-widget-icon-box-base">
                                            <div class="wrapper-box-icon has_custom_image has_read_more text-left overlay " data-text-readmore="#ffb606">
                                                <div class="smicon-box iconbox-left">
                                                    <div class="boxes-icon" style="width: 132px;height: 132px;"><span class="inner-icon"><span class="icon icon-images"><img src="<?php echo get_template_directory_uri() ; ?>/images/logo-top-2.png" alt="logo-top-2" title="logo-top-2" width="66" height="51"></span></span>
                                                    </div>
                                                    <div class="content-inner" style="width: calc( 100% - 132px - 15px);">
                                                        <div class="sc-heading article_heading">
                                                            <h3 class="heading__primary">Các lớp học Online</h3></div><a class="smicon-read sc-btn" target="_self" href="#" style="color: #ffb606;">View More<i class="fa fa-chevron-right"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pgc-12-1-2" class="panel-grid-cell">
                                    <div id="panel-12-1-2-0" class="so-panel widget widget_icon-box panel-first-child panel-last-child" data-index="3">
                                        <div class="thim-widget-icon-box thim-widget-icon-box-base">
                                            <div class="wrapper-box-icon has_custom_image has_read_more text-left overlay " data-text-readmore="#ffb606">
                                                <div class="smicon-box iconbox-left">
                                                    <div class="boxes-icon" style="width: 135px;height: 135px;"><span class="inner-icon"><span class="icon icon-images"><img src="<?php echo get_template_directory_uri() ; ?>/images/logo-top-3.png" alt="logo-top-3" title="logo-top-3" width="59" height="50"></span></span>
                                                    </div>
                                                    <div class="content-inner" style="width: calc( 100% - 135px - 15px);">
                                                        <div class="sc-heading article_heading">
                                                            <h3 class="heading__primary">Thư viện sách & giáo trình</h3></div><a class="smicon-read sc-btn" target="_self" href="#" style="color: #ffb606;">View More<i class="fa fa-chevron-right"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-2" class="panel-grid panel-no-style">
                            <div id="pgc-12-2-0" class="panel-grid-cell">
                                <div id="panel-12-2-0-0" class="so-panel widget widget_heading panel-first-child" data-index="4">
                                    <div class="thim-widget-heading thim-widget-heading-base">
                                        <div class="sc_heading text-left">
                                            <h3 class="title">Các lớp học online</h3><span class="line"></span></div>
                                    </div>
                                </div>
                                <div id="panel-12-2-0-1" class="so-panel widget widget_courses panel-last-child" data-index="5">
                                    <div class="thim-widget-courses thim-widget-courses-base">
                                        <div class="owl-carousel owl-theme thim-carousel-wrapper thim-course-carousel thim-course-grid">
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-4-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp học vỡ lòng A1</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-1-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp học cơ bản A2 - TA cơ bản</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-16-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp học nâng cao B1 - TA cho công việc</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-9-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp cao học C1 - TA cho công việc</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-4-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp vỡ lòng A - TA cơ bản</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-1-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp giao tiếp C2</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-item">
                                                <div class="course-thumbnail" style="">
                                                    <a href="#"><img src="<?php echo get_template_directory_uri() ; ?>/images/course-4-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a><a class="course-readmore" href="https://educationwp.thimpress.com/courses/learnpress-101/">Read More</a></div>
                                                <div class="thim-course-content">
                                                    <div class="course-author" itemscope="" itemtype="http://schema.org/Person"> <img alt="Admin bar avatar" src="<?php echo get_template_directory_uri() ; ?>/images/9c081444f942cc8fe0ddf55631b584e2.jpg" class="avatar avatar-40 photo" height="40" width="40">
                                                        <div class="author-contain">
                                                            <label itemprop="jobTitle">Teacher</label>
                                                            <div class="value" itemprop="name"> <a href="#"> GV: Hoàng Hải </a></div>
                                                        </div>
                                                    </div>
                                                    <h2 class="course-title"> <a href="#"> Lớp ngữ pháp A3</a></h2>
                                                    <div class="course-meta">
                                                        <div class="course-students">
                                                            <label>Students</label>
                                                            <div class="value"><i class="fa fa-group"></i> 367</div>
                                                        </div>
                                                        <div class="course-comments-count">
                                                            <div class="value"><i class="fa fa-comment"></i>3</div>
                                                        </div>
                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                            <meta itemprop="priceCurrency" content="$">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-3" class="panel-grid panel-has-style">
                            <div class="thim-bg-overlay siteorigin-panels-stretch panel-row-style panel-row-style-for-12-3">
                                <div id="pgc-12-3-0" class="panel-grid-cell">
                                    <div id="panel-12-3-0-0" class="so-panel widget widget_text panel-first-child" data-index="6">
                                        <div class="textwidget">
                                            <div class="thim-get-100s">
                                                <p class="get-100s">Nhận ngay 100 phút miễn phí <span class="thim-color">của khóa học Online</span></p>
                                                <h2>Đăng ký ngay</h2></div>
                                        </div>
                                    </div>
                                    <div id="panel-12-3-0-1" class="so-panel widget widget_countdown-box panel-last-child" data-index="7">
                                        <div class="thim-widget-countdown-box thim-widget-countdown-box-base">
                                            <div class="text-left color-white" id="coming-soon-counter5943e22bdb398">
                                                <div class="counter-group" id="myCounter">
                                                    <div class="counter-block">
                                                        <div class="counter days">
                                                            <div class="number show n1 hundreds">0</div>
                                                            <div class="number n1 tens hidden-down" style="top: 100%;">0</div>
                                                            <div class="number n1 units hidden-down" style="top: 100%;">0</div>
                                                            <div class="number hidden-up n2 hundreds">0</div>
                                                            <div class="number hidden-up n2 tens show" style="top: 0px;">6</div>
                                                            <div class="number hidden-up n2 units show" style="top: 0px;">4</div>
                                                        </div>
                                                        <div class="counter-caption">ngày</div>
                                                    </div>
                                                    <div class="counter-block">
                                                        <div class="counter hours">
                                                            <div class="number show n1 tens">0</div>
                                                            <div class="number n1 units show" style="top: 0px;">3</div>
                                                            <div class="number hidden-up n2 tens">0</div>
                                                            <div class="number hidden-up n2 units hidden-down" style="top: 100%;">4</div>
                                                        </div>
                                                        <div class="counter-caption">giờ</div>
                                                    </div>
                                                    <div class="counter-block">
                                                        <div class="counter minutes">
                                                            <div class="number n1 tens hidden-down" style="top: 100%;">0</div>
                                                            <div class="number n1 units show" style="top: 0px;">6</div>
                                                            <div class="number hidden-up n2 tens show" style="top: 0px;">5</div>
                                                            <div class="number hidden-up n2 units hidden-down" style="top: 100%;">7</div>
                                                        </div>
                                                        <div class="counter-caption">phút</div>
                                                    </div>
                                                    <div class="counter-block">
                                                        <div class="counter seconds">
                                                            <div class="number n1 tens hidden-down" style="top: 100%;">1</div>
                                                            <div class="number n1 units show" style="top: 0px;">6</div>
                                                            <div class="number hidden-up n2 tens show" style="top: 0px;">0</div>
                                                            <div class="number hidden-up n2 units hidden-down" style="top: 100%;">7</div>
                                                        </div>
                                                        <div class="counter-caption">giây</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pgc-12-3-1" class="panel-grid-cell">
                                    <div id="panel-12-3-1-0" class="so-panel widget widget_text panel-first-child panel-last-child" data-index="8">
                                        <div class="textwidget">
                                            <div class="thim-register-now-form">
                                                <h3 class="title"><span>Tạo ngay Tài Khoản để nhận ngay 100 phút miễn phí từ khóa học Online.</span></h3>
                                                <div role="form" class="wpcf7" id="wpcf7-f85-p12-o1" lang="en-US" dir="ltr">
                                                    <div class="screen-reader-response"></div>
                                                    <form action="/#wpcf7-f85-p12-o1" method="post" class="wpcf7-form" novalidate="novalidate" data-dpmaxz-eid="9">
                                                        <div style="display: none;">
                                                            <input type="hidden" name="_wpcf7" value="85">
                                                            <input type="hidden" name="_wpcf7_version" value="4.7">
                                                            <input type="hidden" name="_wpcf7_locale" value="en_US">
                                                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f85-p12-o1">
                                                            <input type="hidden" name="_wpnonce" value="1b090243d2">
                                                        </div>
                                                        <p><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Your Name *" data-dpmaxz-eid="10"></span></p>
                                                        <p><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email *" data-dpmaxz-eid="11"></span></p>
                                                        <p><span class="wpcf7-form-control-wrap phone"><input type="tel" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Phone *"></span></p>
                                                        <p>
                                                            <input type="submit" value="Get It Now" class="wpcf7-form-control wpcf7-submit" data-dpmaxz-eid="12"><span class="ajax-loader"></span></p>
                                                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-4" class="panel-grid panel-no-style">
                            <div id="pgc-12-4-0" class="panel-grid-cell">
                                <div id="panel-12-4-0-0" class="so-panel widget widget_heading panel-first-child" data-index="9">
                                    <div class="thim-widget-heading thim-widget-heading-base">
                                        <div class="sc_heading text-left">
                                            <h3 class="title">Events</h3>
                                            <p class="sub-heading" style="">Những sự kiện và hoạt động của lớp học.</p><span class="line"></span></div>
                                    </div>
                                </div>
                                <div id="panel-12-4-0-1" class="so-panel widget widget_list-event panel-last-child" data-index="10">
                                    <div class="thim-widget-list-event thim-widget-list-event-base">
                                        <div class="thim-list-event"><a class="view-all" href="#">View All</a>
                                            <div class="item-event post-2951 tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                                <div class="time-from">
                                                    <div class="date"> 25</div>
                                                    <div class="month"> June</div>
                                                </div>
                                                <div class="image"><img src="<?php echo get_template_directory_uri();?>/images/event-2-450x233.jpg" alt="event-2" title="event-2" width="450" height="233"></div>
                                                <div class="event-wrapper">
                                                    <h5 class="title"> <a href="#"> Mùa hè giáo dục 2017</a></h5>
                                                    <div class="meta">
                                                        <div class="time"> <i class="fa fa-clock-o"></i> 8:00 am - 5:00 pm</div>
                                                        <div class="location"> <i class="fa fa-map-marker"></i> Paris, French</div>
                                                    </div>
                                                    <div class="description">
                                                        <p>Học viên được đi du lịch các nước băc âu, tham gia hội trại hè cũng các bạn sinh viên nước ngoài. Khóa học giúp tăng khả năng giao tiếp</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-event post-2953 tp_event type-tp_event status-tp-event-upcoming has-post-thumbnail hentry pmpro-has-access">
                                                <div class="time-from">
                                                    <div class="date"> 04</div>
                                                    <div class="month"> July</div>
                                                </div>
                                                <div class="image"><img src="<?php echo get_template_directory_uri();?>/images/event-4-450x233.jpg" alt="event-4" title="event-4" width="450" height="233"></div>
                                                <div class="event-wrapper">
                                                    <h5 class="title"> <a href="#"> Gặp gỡ người nổi tiếng</a></h5>
                                                    <div class="meta">
                                                        <div class="time"> <i class="fa fa-clock-o"></i> 8:00 am - 5:00 pm</div>
                                                        <div class="location"> <i class="fa fa-map-marker"></i> Chicago, US</div>
                                                    </div>
                                                    <div class="description">
                                                        <p>Tham gia trò chuyện cùng David Gate, ông trùm của ngành tiếp thị & quảng cáo tại Chicago, Us</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-5" class="panel-grid panel-has-style">
                            <div class="thim-bg-overlay siteorigin-panels-stretch panel-row-style panel-row-style-for-12-5" data-stretch-type="full" style="margin-left: -174.6px; margin-right: -174.4px; padding-left: 174.6px; padding-right: 174.4px; border-left: 0px; border-right: 0px;">
                                <div id="pgc-12-5-0" class="panel-grid-cell">
                                    <div id="panel-12-5-0-0" class="so-panel widget widget_heading panel-first-child" data-index="11">
                                        <div class="panel-widget-style panel-widget-style-for-12-5-0-0">
                                            <div class="thim-widget-heading thim-widget-heading-base">
                                                <div class="sc_heading text-left">
                                                    <h3 style="color:#ffffff;" class="title">Tin tức mới nhất</h3>
                                                    <p class="sub-heading" style="color:#ffffff;">Những tin tức học tập mới nhất trên toàn thế giới</p><span style="background-color:#ffffff" class="line"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="panel-12-5-0-1" class="so-panel widget widget_carousel-post panel-last-child" data-index="12">
                                        <div class="thim-widget-carousel-post thim-widget-carousel-post-base">
                                            <div class="thim-owl-carousel-post thim-carousel-wrapper owl-carousel owl-theme">
                                                <div class="item">
                                                    <div class="image" style="">
                                                        <a href="#"> <img src="<?php echo get_template_directory_uri();?>/images/blog-8-450x267.jpg" alt="Online Learning Glossary" title="blog-8" width="450" height="267"> </a>
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <div class="author"> <span>Anthony</span></div>
                                                            <div class="date"> 20/01/2016</div>
                                                        </div>
                                                        <h4 class="title"> <a href="#">Bùa thiêng khi học tiếng anh Online</a></h4></div>
                                                </div>
                                                <div class="item">
                                                    <div class="image" style="">
                                                        <a href="#"> <img src="<?php echo get_template_directory_uri();?>/images/blog-5-450x267.jpg" alt="Tips to Succeed in an Online Course" title="blog-5" width="450" height="267"> </a>
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <div class="author"> <span>Anthony</span></div>
                                                            <div class="date"> 20/01/2016</div>
                                                        </div>
                                                        <h4 class="title"> <a href="#">Thủ thuật để học tốt một khóa học Online</a></h4></div>
                                                </div>
                                                <div class="item">
                                                    <div class="image" style="">
                                                        <a href="#"> <img src="<?php echo get_template_directory_uri();?>/images/blog-3-450x267.jpg" alt="Introducing: Dr. Deniz Zeynep" title="blog-3" width="450" height="267"> </a>
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <div class="author"> <span>Hinata Hyuga</span></div>
                                                            <div class="date"> 20/10/2015</div>
                                                        </div>
                                                        <h4 class="title"> <a href="#">Giới thiệu về: Dr. Deniz Zeynep</a></h4></div>
                                                </div>
                                                <div class="item">
                                                    <div class="image" style="">
                                                        <a href="#"> <img src="<?php echo get_template_directory_uri();?>/images/blog-2-450x267.jpg" alt="LMS WordPress plugin" title="blog-2" width="450" height="267"> </a>
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <div class="author"> <span>Hinata Hyuga</span></div>
                                                            <div class="date"> 20/10/2015</div>
                                                        </div>
                                                        <h4 class="title"> <a href="#">Giao tiếp: vấn đề không phải riêng ai</a></h4></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-6" class="panel-grid panel-no-style">
                            <div id="pgc-12-6-0" class="panel-grid-cell">
                                <div id="panel-12-6-0-0" class="so-panel widget widget_heading panel-first-child" data-index="13">
                                    <div class="thim-widget-heading thim-widget-heading-base">
                                        <div class="sc_heading text-center">
                                            <h3 class="title">Mọi người nói gì</h3>
                                            <p class="sub-heading" style="">Hãy xem mọi người đánh giá thế nào về lớp English FGC Online.</p><span class="line"></span></div>
                                    </div>
                                </div>
                                <div id="panel-12-6-0-1" class="so-panel widget widget_testimonials panel-last-child" data-index="14">
                                    <div class="thim-widget-testimonials thim-widget-testimonials-base">
                                        <div class="thim-testimonial-slider thim-content-slider" data-visible="5" data-auto="0" data-mousewheel="0">
                                            <div class="slides-wrapper">
                                                <ul class="scrollable" style="margin-top: -15px; margin-bottom: -15px; height: 130px; width: 570px;">
                                                    <li style="display: list-item; width: 110px; left: 0px; top: 10px;">
                                                        <div class="slide-content" style="margin: 15px;"> <img src="<?php echo get_template_directory_uri();?>/images/peter-100x100.jpg"> </div>
                                                    </li>
                                                    <li style="display: list-item; width: 110px; left: 110px; top: 10px;">
                                                        <div class="slide-content" style="margin: 15px;"> <img src="<?php echo get_template_directory_uri();?>/images/manuel-100x100.jpg"> </div>
                                                    </li>
                                                    <li class="mid-item" style="display: list-item; left: 220px; width: 130px;">
                                                        <div class="slide-content" style="margin: 15px;"> <img src="<?php echo get_template_directory_uri();?>/images/john-doe-100x100.jpg"> </div>
                                                    </li>
                                                    <li style="display: list-item; width: 110px; left: 350px; top: 10px;">
                                                        <div class="slide-content" style="margin: 15px;"> <img src="<?php echo get_template_directory_uri();?>/images/elsie-100x100.jpg"> </div>
                                                    </li>
                                                    <li style="display: list-item; width: 110px; left: 460px; top: 10px;">
                                                        <div class="slide-content" style="margin: 15px;"> <img src="<?php echo get_template_directory_uri();?>/images/anthony-100x100.jpg"> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="prev" class="control-nav prev" style="top: 50px; margin-top: -14px;"></a>
                                            <a href="next" class="control-nav next" style="top: 50px; margin-top: -14px;"></a>
                                            <div class="slides-content">
                                                <div class="slide-content">
                                                    <div class="content">
                                                        <h3 class="title">Peter Packer</h3>
                                                        <div class="regency">Bộ phận Front-end</div>
                                                        <div class="description">“ LearnPress WordPress LMS Plugin designed with flexible &amp; scalable eLearning system in mind. This WordPress eLearning Plugin comes up with 10+ addons (and counting) to extend the ability of this WordPress Learning Management System. This is incredible. ”</div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <div class="content">
                                                        <h3 class="title">Manuel</h3>
                                                        <div class="regency">Designer</div>
                                                        <div class="description">“ LearnPress is a comprehensive LMS solution for WordPress. This WordPress LMS Plugin can be used to easily create &amp; sell courses online. Each course curriculum can be made with lessons &amp; quizzes which can be managed with easy-to-use user interface, it never gets easier with LearnPress. ”</div>
                                                    </div>
                                                </div>
                                                <div class="slide-content current" style="opacity: 1;">
                                                    <div class="content">
                                                        <h3 class="title">John Doe</h3>
                                                        <div class="regency">Giám đốc Mỹ thuật</div>
                                                        <div class="description">“ Khóa học tiếng anh Online cùng Mr.Hoàng Hải rất thú vị. Mọi người trao đổi thực sự nhiệt tình và sôi nổi. Tôi hy vọng trong tương lai sẽ có dịp được tham gia các buổi dã ngoại nhiều hơn nữa. Các bạn sinh viên nước ngoài thật là tuyệt vời. Tôi yêu tất cả! ”</div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <div class="content">
                                                        <h3 class="title">Elsie</h3>
                                                        <div class="regency">Copyrighter</div>
                                                        <div class="description">“ You don't need a whole ecommerce system to sell your online courses. Paypal, Stripe payment methods integration can help you sell your courses out of the box. In the case you wanna use WooCommerce, this awesome WordPress LMS Plugin will serve you well too. ”</div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <div class="content">
                                                        <h3 class="title">Anthony</h3>
                                                        <div class="regency">CEO at Thimpress</div>
                                                        <div class="description">“ Education WP Theme is a comprehensive LMS solution for WordPress Theme. This beautiful theme based on LearnPress - the best WordPress LMS plugin. Education WP theme will bring you the best LMS experience ever with super friendly UX and complete eLearning features. ”</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pg-12-7" class="panel-grid panel-no-style">
                            <div id="pgc-12-7-0" class="panel-grid-cell">
                                <div id="panel-12-7-0-0" class="so-panel widget widget_text panel-first-child panel-last-child" data-index="15">
                                    <div class="textwidget">
                                        <div class="thim-newlleter-homepage">
                                            <p class="description">Đăng ký email ngay bây giờ để nhận thư mới hàng tuần cũng nhiều tài liệu của khóa học, tin tức về các lớp học mới, những bài viết thú vị và thật nhiều cuốn sách bổ ích!</p>
                                            <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-3101 mc4wp-form-basic" method="post" data-id="3101" data-name="Default sign-up form" data-dpmaxz-eid="13">
                                                <div class="mc4wp-form-fields">
                                                    <input type="email" id="mc4wp_email" name="EMAIL" placeholder="Nhập email của bạn" required="" data-dpmaxz-eid="14">
                                                    <input type="submit" value="Ghi danh" data-dpmaxz-eid="15">
                                                    <div style="display: none;">
                                                        <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" data-dpmaxz-eid="16">
                                                    </div>
                                                    <input type="hidden" name="_mc4wp_timestamp" value="1497621035">
                                                    <input type="hidden" name="_mc4wp_form_id" value="3101">
                                                    <input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1">
                                                </div>
                                                <div class="mc4wp-response"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               

<?php
// get_sidebar();
get_footer();
