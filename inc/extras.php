<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package edit_theme Theme
 */

/**
 * Get enqueues
 */
require get_template_directory() . '/inc/enqueues.php';

// 
/**
 * Admin Ajax
 */
require get_template_directory() . '/inc/ajax-call.php';

/** X-Frame to sameorigin */
add_action( 'send_headers', 'send_frame_options_header', 10, 0 );

/**
 * disable srcset on frontend
 * source: https://perishablepress.com/disable-wordpress-responsive-images/ 05/05/2018
*/
add_filter('max_srcset_image_width', create_function('', 'return 1;'));

/**
 * REMOVE WP ARCHIVES AND REDIRECT TO HOME PAGE
 */
add_action('template_redirect', 'edit_theme_remove_wp_archives');
function edit_theme_remove_wp_archives(){
	if( is_category() || is_tag() || is_date() || is_author() || is_404() ) {
		wp_redirect(home_url());
    	exit();
	}
}

/**
 * CHANGE EMAIL SENDER
 */
/// EDIT!!!
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );
function wpb_sender_name( $original_email_from ) {
	return 'Custom name';
}

/**
 * change admin login logo (image, link, title)
 *  source https://codex.wordpress.org/Customizing_the_Login_Form 04/25/2018
 */
/// EDIT!!!
add_action( 'login_enqueue_scripts', 'change_login_logo' );
function change_login_logo() { 
	?> 
	<style type="text/css"> 
	body.login div#login h1 a {
	background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logos/edit_theme-logo.png'); 
	margin-top: 60px; 
	height: 58px;
	background-size: 200px;
	width: 200px;
	}
	</style>
	<?php 
}

add_filter( 'login_headerurl', 'change_login_logo_url' );
function change_login_logo_url() {
	return home_url();
}

add_filter( 'login_headertitle', 'change_login_logo_url_title' );
function change_login_logo_url_title() {
	return get_bloginfo();
}

/** Delete WoCommerce styles */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/** WooCommerce */
// add_action( 'after_setup_theme', 'edit_theme_add_woocommerce_support' );
// function edit_theme_add_woocommerce_support() {
// 	add_theme_support( 'woocommerce' );
// }

/**
 * Load OG meta to header
 */
add_action('wp_head', 'edit_theme_og_metadata');
function edit_theme_og_metadata() {
	$title = get_the_title();
	$url = get_permalink();
	$site_name = get_bloginfo();
	$description = get_the_excerpt();

	if (is_singular('product')) {
		$image = get_the_post_thumbnail_url();
	}

	if (is_singular('post')) {
		$image = get_the_post_thumbnail_url();
	}

	$title = $site_name. " - " . $title;
	
	echo "\t<meta property='og:title' content='$title' />\n";
	echo "\t<meta property='og:description' content='$description' />\n";
	echo "\t<meta property='og:type' content='article' />\n";
	echo "\t<meta property='og:url' content='$url' />\n";
	echo "\t<meta property='og:site_name' content='$site_name' />\n";
	echo "\t<meta property='og:image' content='$image' />\n";

	echo "\t<meta property='twitter:card' content='summary_large_image' />\n";
	echo "\t<meta property='twitter:title' content='$title' />\n";
	echo "\t<meta property='twitter:description' content='$description' />\n";
	echo "\t<meta property='twitter:image' content='$image' />\n";
}