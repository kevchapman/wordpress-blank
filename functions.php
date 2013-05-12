<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */ 

register_sidebar(array(
	'before_widget' => '<section class="widget">',
	'after_widget' => '</section>',
	'before_title' => "<h3>",
	'after_title' => "</h3>"
));

function register_my_menu() {
	register_nav_menu('header-menu',__( 'Main Nav' ));
}
add_action( 'init', 'register_my_menu' );

 ?>