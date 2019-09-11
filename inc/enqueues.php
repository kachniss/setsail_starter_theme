<?php

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'edit_theme_scripts', 0 );
function edit_theme_scripts() {

	// FONT AWESOME
	wp_enqueue_style( 'edit_theme_font_awesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );


	if (is_front_page()) {
		wp_enqueue_style( 'edit_theme_style', get_stylesheet_uri() . 'front_page.min.css', array(), filemtime( get_stylesheet_directory() . '/build/css/front_page.min.css' ));
	} else {
		wp_enqueue_style( 'edit_theme_style', get_stylesheet_uri() . 'style.min.css', array(), filemtime( get_stylesheet_directory() . '/build/css/style.min.css' ));
	}


	/**
	 * SCRIPT ENQUEUES
	 */
	wp_dequeue_script('jquery');
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', false, null);
	wp_enqueue_script('jquery');


	if (is_front_page()) {
		wp_enqueue_script( 'edit_theme_main', get_template_directory_uri() . '/build/js/front.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/build/js/front.min.js' ), true );
	} else {
		wp_enqueue_script( 'edit_theme_main', get_template_directory_uri() . '/build/js/scripts.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/build/js/scripts.min.js' ), true );
	}


	/**
	 * DEQUEUE
	 */
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

add_action( 'wp_print_scripts', 'edit_theme_dequeue_scripts', 9999 );
function edit_theme_dequeue_scripts () {
	wp_dequeue_script('');
	wp_deregister_script('');
}

add_action( 'wp_print_styles', 'edit_theme_dequeue_styles', 9999 );
function edit_theme_dequeue_styles () {
	wp_dequeue_style('');
	wp_deregister_style('');	
	
}

/**
 * DEREGISTER WP-EMBED.MIN.JS
 */
add_action( 'wp_footer', 'my_deregister_scripts' );
function my_deregister_scripts(){
	wp_deregister_script( 'wp-embed' );
}

// function inspect_scripts() {
// 	global $wp_scripts;
// 	echo 'Scripts';
// 	echo '<pre>';
// 	echo print_r($wp_scripts->queue);
// 	echo '</pre>';	
// }
// add_action( 'wp_print_scripts', 'inspect_scripts', 9999 );

// function inspect_styles() {
// 	global $wp_styles;
// 	echo 'Styles';
// 	echo '<pre>';
// 	echo print_r($wp_styles->queue);
// 	echo '</pre>';
// }
// add_action( 'wp_print_styles', 'inspect_styles', 9999 );