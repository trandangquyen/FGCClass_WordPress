<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beautifulclass
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'beautifulclass' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'beautifulclass' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'beautifulclass' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'beautifulclass' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'beautifulclass' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'beautifulclass' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'beautifulclass' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'beautifulclass' ); ?></p>
	<?php
	endif;
	?>

    <div id="gUMArea">
        <div>
            Record:
            <input type="radio" name="media" value="video" checked id="mediaVideo">Video
            <input type="radio" name="media" value="audio">audio
        </div>
        <button class="btn btn-default" id="gUMbtn">Request Stream</button>
    </div>
    <div id="btns">
        <button class="btn btn-default" id="start">Start</button>
        <button class="btn btn-default" id="stop">Stop</button>
    </div>
    <div>
        <ul class="list-unstyled" id="ul"></ul>
    </div>
    <script src="<?php echo FGC_VOICE_FODURL ?>js/voice.js"></script>

    <?php

    $comments_args = array(
        'title_reply'       => __( 'Để lại một bình luận' ),
        'title_reply_to'    => __( 'Gửi một bình luận cho %s' ),
        'cancel_reply_link' => __( 'Hủy Bình Luận' ),
        'label_submit'      => __( 'Gửi Bình Luận' ),
        'comment_field' => '<p class="comment-form-comment"><label for="comment" style="display: block; clear: both;">' . _x( 'Nội dung', 'noun' ) . '</label>
        <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
        );
	comment_form($comments_args);
	?>

</div><!-- #comments -->
