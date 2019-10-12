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
		'main_menu' => 'Menu principal',
		'footer_menu' => 'Menu du pied de page',
	) );
}
add_action( 'after_setup_theme', 'hacklab_register_nav_menus' );

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
