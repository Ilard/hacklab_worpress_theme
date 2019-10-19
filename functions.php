<?php

/*
 * Scripts
 */
function hacklab_enqueue_admin_scripts() {
    $handle = "hacklab-scripts";
    $src = get_template_directory_uri() . "/dist/scripts.admin.min.js";
    $deps = "jquery";
    $ver = null;
    $in_footer = true;
    wp_enqueue_script($handle, $src);
}
add_action('admin_enqueue_scripts', 'hacklab_enqueue_admin_scripts', $priority = 10, $accepted_args = 0);

function hacklab_enqueue_front_scripts() {
    $handle = "hacklab-scripts";
    $src = get_template_directory_uri() . "/dist/scripts.min.js";
    $deps = "jquery";
    $ver = null;
    $in_footer = true;
    wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
}
add_action('wp_enqueue_script', 'hacklab_enqueue_front_scripts', $priority = 10, $accepted_args = 0);

/*
 *  Menus
 */
function hacklab_register_nav_menus() {
	register_nav_menus(array(
		'main_menu' => 'Emplacement menu principal',
		'footer_menu' => 'Emplacement menu du pied de page',
	) );
}
add_action('after_setup_theme', 'hacklab_register_nav_menus');

/*
 * Images sizes
 */
 add_image_size("project-teaser", 350, 200, true);
 add_image_size("event-teaser", 350, 200, true);
 add_image_size("article-teaser", 350, 200, true);

/*
 * Settings page
 */
 require_once "settings/settings.php";

/*
 *  Thumbnails
 */
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

/*
 *  Post types
 */
require_once "types/projects.php";

/*
 *  MIME types
 */
 /* Autoriser les fichiers SVG */
function hacklab_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'hacklab_mime_types');

/*
 * Excerpt
 */
 function hacklab_excerpt_length($length) {
     return 30;
 }
 add_filter('excerpt_length', 'hacklab_excerpt_length', 10);

 function hacklab_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'hacklab_excerpt_more', 10);
