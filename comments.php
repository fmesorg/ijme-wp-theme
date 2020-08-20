<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
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
        $args = array('comment_notes_before' => '<div class="comment-area-message">Your email address will not be published. Required fields are marked *</div> <div class="comment-area-submessage">Please restrict your comment preferably to 800 words</div>');
    ?>
    <?php comment_form($args); ?>
    
    
    <?php if (have_comments()) : ?>
        <div class="comment-title">Comments:</div>

        <ol class="comment-list">
			<?php
				wp_list_comments( array(
                  'callback' => 'my_comments_callback',
				) );
			?>
		</ol><!-- .comment-list -->
    
    <?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p>
	<?php endif; ?>


</div><!-- .comments-area -->
