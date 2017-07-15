<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beautifulclass
 */

?>
<div class="col-xs-12 col-sm-4 col-md-3">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php beautifulclass_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php
            endif; ?>
        </header><!-- .entry-header -->
        <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( ); ?>
                </a>
                <a class="course-readmore" href="<?php the_permalink(); ?>">Xem Bài</a>
            </div><!-- .post-thumbnail -->
        <?php endif; ?>
    </article><!-- #post-## -->
</div>



