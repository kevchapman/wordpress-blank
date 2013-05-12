<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col7">
			<section class="main">
				<div class="gutter">
					<?php #query_posts($query_string . '&showposts=4 & cat=-3,-4'); ?>
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
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
								<footer class="footer">
									<a href="<?php the_permalink() ?>" class="btn readmore">Read More</a>
								</footer>
							</article>
						<?php endwhile; ?>		
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<section class="paging_row">
						<div class="row">
							<?php next_posts_link('&lsaquo; Older Posts'); ?>
							<?php previous_posts_link('Newer Posts &rsaquo;'); ?>
						</div>
					</section>
				</div>
			</section>
		</div>
		<div class="col3">
			<div class="gutter">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>