<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header();
?>

<section class="sub_header">
	<div class="container">
		<div class="row">
			<div class="col7">
				<div class="gutter">
					<div class="pad intro">
					<?php if (have_posts()) : ?>
						<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
						<?php /* If this is a category archive */ if (is_category()) { ?>
						<h1 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
						<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
						<h1 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
						<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
						<?php /* If this is an author archive */ } elseif (is_author()) { ?>
						<h1 class="pagetitle">Author Archive</h1>
						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<h1 class="pagetitle">Blog Archives</h1>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col3">
		</div>
	</div>
</section>
<section class="main">
	<div class="container">
		<div class="row">
			<div class="col7">
				<div class="gutter">
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
							<?php else :

								if ( is_category() ) { // If this is a category archive
									printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
								} else if ( is_date() ) { // If this is a date archive
									echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
								} else if ( is_author() ) { // If this is a category archive
									$userdata = get_userdatabylogin(get_query_var('author_name'));
									printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
								} else {
									echo("<h2 class='center'>No posts found.</h2>");
								}
								get_search_form();

							endif; ?>	
					<?php endif; ?>
					<section class="paging_row">
						<div class="row">
							<?php next_posts_link('&lsaquo; Older Posts'); ?>
							<?php previous_posts_link('Newer Posts &rsaquo;'); ?>
						</div>
					</section>
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
<?php get_footer(); ?>
