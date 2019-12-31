<?php
/*
 * Styles
 */
 function hacklab_enqueue_styles() {
     wp_enqueue_style("hacklab-styles", get_template_directory_uri() . "/dist/main.min.css");
 }
 add_action("wp_enqueue_scripts", "hacklab_enqueue_styles", $priority = 10, $accepted_args = 0);

/*
 * Scripts
 */
function hacklab_enqueue_admin_scripts() {
    $handle = "hacklab-scripts";
    $src = get_template_directory_uri() . "/dist/scripts.admin.min.js";
    $deps = array("jquery");
    $ver = null;
    $in_footer = true;
    wp_enqueue_script($handle, $src);
}
add_action("admin_enqueue_scripts", "hacklab_enqueue_admin_scripts", $priority = 10, $accepted_args = 0);

function hacklab_enqueue_front_scripts() {
    $handle = "hacklab-scripts";
    $src = get_template_directory_uri() . "/dist/scripts.min.js";
    $deps = array("jquery");
    $ver = null;
    $in_footer = true;
    wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
}
add_action("wp_enqueue_scripts", "hacklab_enqueue_front_scripts", $priority = 10, $accepted_args = 0);

/*
 * Vendors
 */
 function hacklab_enqueue_leaflet_style() {
     wp_enqueue_style("hacklab-leaflet-styles", "https://unpkg.com/leaflet@1.5.1/dist/leaflet.css");
     wp_style_add_data("hacklab-leaflet-styles", "integrity", "sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==");
     wp_style_add_data("hacklab-leaflet-styles", "crossorigin", "");
 }
 add_action("wp_enqueue_scripts", "hacklab_enqueue_leaflet_style", $priority = 10, $accepted_args = 0);

function hacklab_enqueue_leaflet_scripts() {
    $handle = "hacklab-leaflet";
    $src = "https://unpkg.com/leaflet@1.5.1/dist/leaflet.js";
    $deps = null;
    $ver = null;
    $in_footer = false;
    wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
}
add_action("wp_enqueue_scripts", "hacklab_enqueue_leaflet_scripts", $priority = 10, $accepted_args = 0);

function hacklab_enqueue_leaflet_datas() {
    wp_script_add_data("hacklab-leaflet", "integrity", "sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==");
    wp_script_add_data("hacklab-leaflet", "crossorigin", "");
}
add_action("wp_enqueue_script", "hacklab_enqueue_leaflet_datas", $priority = 10, $accepted_args = 0);

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
 add_image_size("blog-teaser", 350, 200, true);

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
