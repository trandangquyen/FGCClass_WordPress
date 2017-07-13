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
                            <div role="tabpanel" class="tab-pane fade" id="tab-happening">
                                <?php
                                $args = array(
                                    'post_type' => 'events',
                                    'numberposts' => -1,
                                    'meta_key'         => 'event-post',
                                );
                                $posts_array = get_posts( $args );
                                foreach ( $posts_array as $post ):
                                    if (get_post_meta( $post->ID, 'event-post', true ) == 'happening'):
                                ?>

                                <div class="item-event post-<?php $post->ID ?> tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                    <div class="time-from">
                                        <div class="date"><?php  echo get_the_date( 'd' ) ?></div>
                                        <div class="month"><?php  echo get_the_date( 'F' ) ?></div>
                                    </div>
                                    <div class="image"><?php the_post_thumbnail( 'post-thumb-wide' ); ?></div>
                                    <div class="event-wrapper"><h5 class="title"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>
                                        <div class="meta">
                                            <div class="time"><i class="fa fa-clock-o"></i> 8:00 am - 5:00 pm</div>
                                            <div class="location"><i class="fa fa-map-marker"></i> Venice, Italy</div>
                                        </div>
                                        <div class="description"><p><?php if(has_excerpt() == true) echo excerpt(22); else echo content($post->post_content,22)  ; ?></p>
                                        </div>
                                    </div>
                                </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-upcoming">
                                <?php
                                $args = array(
                                    'post_type' => 'events',
                                    'numberposts' => -1,
                                    'meta_key'         => 'event-post',
                                );
                                $posts_array = get_posts( $args );
                                foreach ( $posts_array as $post ):
                                    if (get_post_meta( $post->ID, 'event-post', true ) == 'upcoming'):
                                        ?>

                                        <div class="item-event post-<?php $post->ID ?> tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                            <div class="time-from">
                                                <div class="date"><?php  echo get_the_date( 'd' ) ?></div>
                                                <div class="month"><?php  echo get_the_date( 'F' ) ?></div>
                                            </div>
                                            <div class="image"><?php the_post_thumbnail( 'post-thumb-wide' ); ?></div>
                                            <div class="event-wrapper"><h5 class="title"><a
                                                            href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>
                                                <div class="meta">
                                                    <div class="time"><i class="fa fa-clock-o"></i> 8:00 am - 5:00 pm</div>
                                                    <div class="location"><i class="fa fa-map-marker"></i> Venice, Italy</div>
                                                </div>
                                                <div class="description"><p><?php if(has_excerpt() == true) echo excerpt(22); else echo content($post->post_content,22)  ; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade active in" id="tab-expired">
                                <?php
                                $args = array(
                                    'post_type' => 'events',
                                    'numberposts' => -1,
                                );
                                $posts_array = get_posts( $args );
                                foreach ( $posts_array as $post ):
                                    $key_meta_post = get_post_meta( $post->ID, 'event-post', true );
                                    if ($key_meta_post == 'expired' || $key_meta_post == false):
                                        ?>

                                        <div class="item-event post-<?php $post->ID ?> tp_event type-tp_event status-tp-event-happenning has-post-thumbnail hentry pmpro-has-access">
                                            <div class="time-from">
                                                <div class="date"><?php  echo get_the_date( 'd' ) ?></div>
                                                <div class="month"><?php  echo get_the_date( 'F' ) ?></div>
                                            </div>
                                            <div class="image"><?php the_post_thumbnail( 'post-thumb-wide' ); ?></div>
                                            <div class="event-wrapper"><h5 class="title"><a
                                                            href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>
                                                <div class="meta">
                                                    <div class="time"><i class="fa fa-clock-o"></i> 8:00 am - 5:00 pm</div>
                                                    <div class="location"><i class="fa fa-map-marker"></i> Venice, Italy</div>
                                                </div>
                                                <div class="description"><p><?php if(has_excerpt() == true) echo excerpt(22); else echo content($post->post_content,22)  ; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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