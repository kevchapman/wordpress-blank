<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
<?php query_posts($query_string . '&showposts=3 & cat=-3,-4'); ?>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<?php $postId = get_the_ID(); ?>
<section class="main">
	<div class="container">
		<div class="row">
			<div class="col7">
				<div class="gutter">
					<article class="post">
						<header class="header">
							<div class="row">
								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<div class="comments_icon">
									<?php comments_popup_link('0', '1', '%', 'comments-link', ''); ?>
								</div>
							</div>
							<div class="meta">posted on: <?php echo get_the_date(); ?> in: <span class="categories"><?php the_category(' '); ?></span></div>
						</header>
						<div class="body">
							<?php the_content(''); ?>
						</div>
					</article>
				</div>
			</div>
			<div class="col3">
				<div class="gutter">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="bottom">
	<div class="container">
		<div class="row">
			<div class="col7">
				<div class="gutter">
					<?php if(comments_open($postId)): ?>
					<?php comments_template(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile; ?>
<?php #wp_reset_query(); ?>		
<?php endif; ?>
<?php get_footer(); ?>
