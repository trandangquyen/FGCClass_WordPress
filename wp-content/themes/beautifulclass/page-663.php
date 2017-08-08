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
$categories = get_the_category();
if (!empty($categories))
    $category_id = $categories[0]->slug;
else $category_id = '';

?>
    <div id="primary" class="content-area ">
        <section class="content-area" style="transform: none; min-height: 256px;">
            <div class="top_site_main">
                <?php echo do_shortcode('[rev_slider alias="banner-class"]'); ?>
                <span class="overlay-top-header" style="background:rgba(0,0,0,0.5);"></span>
                <div class="page-title-wrapper">
                    <div class="banner-wrapper container"><h1>Sự kiện hàng tháng</h1></div>
                </div>
            </div>
            <div class="breadcrumbs-wrapper">
                <div class="container">
                    <ul itemprop="breadcrumb" itemscope="" id="breadcrumbs" class="breadcrumbs">
                        <?php bcn_display_list() ?>
                    </ul>
                </div>
            </div>
            <div class="container site-content">
                <div class="row">
                    <main id="main" class="site-main col-sm-12 full-width">
                        <div class="list-tab-event">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-happening" data-toggle="tab">Đang diễn ra</a></li>
                                <li class=""><a href="#tab-upcoming" data-toggle="tab">Sắp diễn ra</a></li>
                                <li class=""><a href="#tab-expired" data-toggle="tab">Đã kết thúc</a></li>
                            </ul>
                            <div class="tab-content thim-list-event">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab-happening">
                                    <?php
                                    global $wpdb;
                                    $results = $wpdb->get_results(
                                        "
                                                SELECT *
                                                FROM wp_events_post
                                                WHERE wp_events_post.event_post_status = 'happening'
                                                "
                                    );
                                    foreach ( $results as $key => $result ):
                                        $current_attachment_id = $result->attachment_id;
                                        ?>

                                            <div class="item-event post-<?php $post->ID ?> tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                                <div class="time-from">
                                                    <div class="date"><?php  echo get_the_date( 'd' ) ?></div>
                                                    <div class="month"><?php  echo get_the_date( 'F' ) ?></div>
                                                </div>
                                                <div class="image"><?php echo wp_get_attachment_image( $current_attachment_id, 'post-thumb-wide' ) ;?></div>
                                                <div class="event-wrapper"><h5 class="title"><a href="event-detail/?event_id=<?php echo $result->id ?>"> <?php echo $result->event_post_title; ?></a></h5>
                                                    <div class="meta">
                                                        <div class="time"><i class="fa fa-clock-o"></i><?php echo $result->event_post_start.' - '.$result->event_post_end; ?></div>
                                                        <div class="location"><i class="fa fa-map-marker"></i><?php echo $result->event_post_location; ?></div>
                                                    </div>
                                                    <div class="description"><p><?php if(has_excerpt() == true) echo excerpt(22); else echo content($post->post_content,22)  ; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endforeach; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab-upcoming">
                                    <?php
                                    global $wpdb;
                                    $results = $wpdb->get_results(
                                        "
                                                SELECT *
                                                FROM wp_events_post
                                                WHERE wp_events_post.event_post_status = 'upcoming'
                                                "
                                    );
                                    foreach ( $results as $key => $result ):
                                        $current_attachment_id = $result->attachment_id;
                                        ?>

                                        <div class="item-event post-<?php $post->ID ?> tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                            <div class="time-from">
                                                <div class="date"><?php  echo get_the_date( 'd' ) ?></div>
                                                <div class="month"><?php  echo get_the_date( 'F' ) ?></div>
                                            </div>
                                            <div class="image"><?php echo wp_get_attachment_image( $current_attachment_id, 'post-thumb-wide' ) ;?></div>
                                            <div class="event-wrapper"><h5 class="title"><a href="event-detail/?event_id=<?php echo $result->id ?>"> <?php echo $result->event_post_title; ?></a></h5>
                                                <div class="meta">
                                                    <div class="time"><i class="fa fa-clock-o"></i><?php echo $result->event_post_start.' - '.$result->event_post_end; ?></div>
                                                    <div class="location"><i class="fa fa-map-marker"></i><?php echo $result->event_post_location; ?></div>
                                                </div>
                                                <div class="description"><p><?php if(has_excerpt() == true) echo excerpt(22); else echo content($post->post_content,22)  ; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab-expired">
                                    <?php
                                    global $wpdb;
                                    $results = $wpdb->get_results(
                                        "
                                                SELECT *
                                                FROM wp_events_post
                                                WHERE wp_events_post.event_post_status = 'expired'
                                                "
                                    );
                                    foreach ( $results as $key => $result ):
                                        $current_attachment_id = $result->attachment_id;
                                        ?>

                                        <div class="item-event post-<?php $post->ID ?> tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                            <div class="time-from">
                                                <div class="date"><?php  echo get_the_date( 'd' ) ?></div>
                                                <div class="month"><?php  echo get_the_date( 'F' ) ?></div>
                                            </div>
                                            <div class="image"><?php echo wp_get_attachment_image( $current_attachment_id, 'post-thumb-wide' ) ;?></div>
                                            <div class="event-wrapper"><h5 class="title"><a href="event-detail/?event_id=<?php echo $result->id ?>"> <?php echo $result->event_post_title; ?></a></h5>
                                                <div class="meta">
                                                    <div class="time"><i class="fa fa-clock-o"></i><?php echo $result->event_post_start.' - '.$result->event_post_end; ?></div>
                                                    <div class="location"><i class="fa fa-map-marker"></i><?php echo $result->event_post_location; ?></div>
                                                </div>
                                                <div class="description"><p><?php if(has_excerpt() == true) echo excerpt(22); else echo content($post->post_content,22)  ; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </section>
    </div><!-- #primary -->
<?php
get_footer();