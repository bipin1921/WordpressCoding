<?php 
/*Linking CSS and JS Files*/

function crb_scriptingfiles(){
	wp_enqueue_style('bootstrap.min',get_template_directory_uri().'/plugins/bootstrap/bootstrap.min.css',array(),null,'all');
	wp_enqueue_style('slick',get_template_directory_uri().'/plugins/slick/slick.css',array(),null,'all');
	wp_enqueue_style('themify-icons',get_template_directory_uri().'/plugins/themify-icons/themify-icons.css',array(),null,'all');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css',array(),'1.1','all');
	wp_enqueue_style('favicon',get_template_directory_uri().'/images/favicon.ico',array(),null,'all');
	
	wp_enqueue_script('jquery.min',get_theme_file_uri('/plugins/jQuery/jquery.min.js'),array('jquery'),true);
	wp_enqueue_script('bootstrap.min',get_theme_file_uri('/plugins/bootstrap/bootstrap.min.js'),array('jquery'),true);
	wp_enqueue_script('slick.min',get_theme_file_uri('/plugins/slick/slick.min.js'),array('jquery'),true);
	wp_enqueue_script('shuffle.min',get_theme_file_uri('/plugins/shuffle/shuffle.min.js'),array('jquery'),true);
	wp_enqueue_script('script',get_theme_file_uri('/js/script.js'),array('jquery'),true);
}
add_action('wp_enqueue_scripts','crb_scriptingfiles');

/* Enable Menus */
add_theme_support('menus');

/* Registering Feature Image*/
add_theme_support('post-thumbnails');

/* Registering Menus*/
register_nav_menus(
	array(
		'top-nav' => __('Primary Menu','theme'),
	)
);
?>
