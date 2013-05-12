<div id="comment_section">
<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
if ( post_password_required() ) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>
<header>
	<div class="group">
		<h2 id="comments"><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments')); ?></h2>
		<?php if ( comments_open() ) : ?>
			<a href="#postcomment" title="<?php _e("Leave a comment"); ?>">Leave a comment</a>
		<?php endif; ?>
	</div>
</header>
<?php if ( have_comments() ) : ?>
<ol id="comments-list">
<?php foreach ($comments as $comment) : ?>
	<li <?php comment_class('radius'); ?> id="comment-<?php comment_ID() ?>">
	<p class="comments-meta"><?php echo get_avatar( $comment, 32 ); ?><strong><?php comment_author_link() ?></strong> said on <small><?php comment_date() ?> @ <?php comment_time() ?></small></p>
	<?php comment_text() ?>
	<!-- <p class="comment-meta clear"><cite><?php comment_type(_x('Comment', 'noun'), __('Trackback'), __('Pingback')); ?> <?php _e('by'); ?> <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></cite> <?php edit_comment_link(__("Edit This"), ' |'); ?></p> -->
	</li>
<?php endforeach; ?>
</ol>
<?php else : // If there are no comments yet ?>
	<!-- <div class="pad"><p><?php _e('No comments yet.'); ?></p></div> -->
<?php endif; ?>

<!-- <p><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?>
<?php if ( pings_open() ) : ?>
	<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a>
<?php endif; ?>
</p> -->

<?php if( comments_open() ) : ?>


<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() ) );?></p>
<?php else : ?>

<section class="comment_form">
	<h2 id="postcomment"><?php _e('Leave a comment'); ?></h2>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php if ( is_user_logged_in() ) : ?>
	<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>

	<?php else : ?>

	<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" />
	<label for="author"><small><?php _e('Name'); ?> <?php if ($req) _e('(required)'); ?></small></label></p>

	<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" />
	<label for="email"><small><?php _e('Mail (will not be published)');?> <?php if ($req) _e('(required)'); ?></small></label></p>

	<!-- <p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
	<label for="url"><small><?php _e('Website'); ?></small></label></p> -->

	<?php endif; ?>

	<!--<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p>-->

	<p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>
	<p class="txtright">
		<input name="submit" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e('Submit Comment'); ?>" />
	</p>
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	<?php do_action('comment_form', $post->ID); ?>
	</form>
</section>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>
<?php endif; ?>
</div>
