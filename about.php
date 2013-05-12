<?php
/*
Template Name: About
*/
update_option('template_name','about');

get_header(); ?>

<div class="color-overflow-top">
	<div id="page-head">
		<div class="inner">
			<h1>About Me</h1>
			<p class="post-meta"><?php edit_post_link('Edit'); ?></p>
		</div>
	</div>
</div>

	<div id="content" role="main">
	
		<div id="main">
			<div class="pad no-color no-pad-top">
				<?php if (have_posts()) : ?>
			
					<?php while (have_posts()) : the_post(); ?>
					<?php the_content('Read the rest of this entry &raquo;'); ?>					
					<?php endwhile; ?>
			
				<?php endif; ?>
			</div>
		</div> <!-- #main -->

<div id="side">
	<div id="tab-box">
		<div class="tabs">
			<a id="tab-item1" class="active" href="#item1">Hand Coding</a>
			<a id="tab-item2" href="#item2">Favourite Software</a>
		</div>
		<ul id="item2">
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/mac.gif" />Mac</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/coda.gif" alt="coda" />Coda</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/textmate.gif" alt="textMate" />TextMate</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/transmit.gif" alt="transmit" />Transmit</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/illustrator.gif" alt="illustrator" />Illustrator</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/photoshop.gif" alt="photoshop" />Photoshop</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/dreamweaver.gif" alt="Dreamweaver" />Dreamweaver</li>
			<li class="last"><img src="<?php bloginfo('template_url') ?>/images/icons/flash.gif" alt="flash" />Flash</li>
		</ul>
		<ul id="item1">
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />XHTML</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />CSS</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />PHP</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />mySQL</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />JavaScript</li>
			<li><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />jQuery</li>
			<li class="last"><img src="<?php bloginfo('template_url') ?>/images/icons/code.gif" />ActionScript</li>
		</ul>
	</div>
</div>

<hr />

	</div> <!-- #content -->
	
<div class="color-overflow-bot">	
	<div id="footer-block">
		<div class="inner">
			
		</div>
	</div>
</div>
		
<?php get_footer(); ?>
