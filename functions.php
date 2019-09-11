<?php
/**
 * edit_theme Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package edit_theme Theme
 */

if ( ! function_exists( 'edit_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function edit_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu' ),
	) );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // edit_theme_setup
add_action( 'after_setup_theme', 'edit_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function edit_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'edit_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'edit_theme_content_width', 0 );


/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function edit_theme_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'edit_theme_minified_css', 10, 2 );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';