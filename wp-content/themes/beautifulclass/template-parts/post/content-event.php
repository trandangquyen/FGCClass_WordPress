<?php
global $wpdb;
$event_id = $_GET['event_id'];
$post_event = $wpdb->get_results(
    "
        SELECT *
        FROM wp_events_post
        WHERE wp_events_post.id = $event_id
        "
);
//var_dump($post_event); exit;
foreach ( $post_event as $key => $result ):
?>

<div class="col-xs-12 col-sm-12">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="event-wrapper" style="border-bottom: 1px solid #eee;">
            <h1 class="title"><?php echo $result->event_post_title; ?></h1>
            <div class="meta">
                <div class="time"> <i class="fa fa-clock-o"></i><?php echo $result->event_post_start.' - '.$result->event_post_end; ?></div>
                <div class="location"> <i class="fa fa-map-marker"></i><?php echo $result->event_post_location; ?></div>
            </div>
        </div>
        <div class="event-content">
            <?php echo $result->event_post_content; ?>
        </div>
    </article><!-- #post-## -->
</div>
<?php endforeach; ?>



