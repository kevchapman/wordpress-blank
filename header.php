<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no_js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no_js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no_js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no_js" <?php language_attributes(); ?>> <!--<![endif]-->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(': ', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/_includes/css/styles.css" type="text/css" media="screen" />
	<script src="<?php bloginfo('template_url'); ?>/_includes/js/html5shiv.js"></script>
	<title><?php wp_title(': ', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	<script type="text/javascript">

	  // var _gaq = _gaq || [];
	  // _gaq.push(['_setAccount', 'UA-24752464-1']);
	  // _gaq.push(['_trackPageview']);

	  // (function() {
	  //   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	  //   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	  //   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  // })();

	</script>
</head>
<body id="<?php echo get_option('template_name'); ?>" <?php body_class(); ?>>
<div id="outline">

<header id="header" class="top">
	<div class="container">
		<div class="row">
			<div class="col7">
				<div class="gutter">
					<div class="pad">
						<a href="/" title="Back to home">Logo</a>
					</div>
				</div>
			</div>
		</div>
		<div class="gutter">
			<nav id="main" class="hoz">
				<?php wp_nav_menu( array(
					'theme_location' => 'header-menu',
					'container' => false
				) ); ?>
			</nav>
		</div>
	</div>
</header>

<!-- end of header.php -->
