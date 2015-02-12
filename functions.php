<?php

// constants

define('THEME_URI', get_stylesheet_directory_uri());

// classes

require_once 'class/TutorialsMenu.php';
require_once 'class/Segmentation.php';

// clean up wp_head output

remove_action( 'wp_head', 'wlwmanifest_link');

// remove unused menus

function remove_menus(){
	remove_menu_page( 'edit.php' ); // Posts
	remove_menu_page( 'edit.php?post_type=page' ); // Pages
	remove_menu_page( 'edit-comments.php' ); // Comments
}

add_action('admin_menu', 'remove_menus');

function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments'); // Comments link
	$wp_admin_bar->remove_menu('new-content'); // Content link
}

add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');

// initialize Segmentation

function segmentation() {	
	global $segmentation;
	$segmentation = new Segmentation();
}

add_action('init', 'segmentation');

// custom taxonomy for sections

function sections_init() {
	// codex.wordpress.org/Function_Reference/register_taxonomy#Arguments
	$args = array(
		'label' => 'Sections',
		'labels' => array('singular_name' => 'Section', 'add_new_item' => 'Add New Section'),
		'hierarchical' => true,
		'show_admin_column' => true
	);
	register_taxonomy('section', null, $args);
}

add_action('init', 'sections_init');

// custom taxonomy for spotlights

function spotlight_init() {
	// codex.wordpress.org/Function_Reference/register_taxonomy#Arguments
	$args = array(
		'label' => 'Spotlights',
		'labels' => array('singular_name' => 'Spotlight', 'add_new_item' => 'Add New Spotlight'),
		'hierarchical' => true
	);
	register_taxonomy('spotlight', null, $args);
}

add_action('init', 'spotlight_init');

// custom taxonomy for locales

function locale_init() {
	// codex.wordpress.org/Function_Reference/register_taxonomy#Arguments
	$args = array(
		'label' => 'Locales',
		'labels' => array('singular_name' => 'Locale', 'add_new_item' => 'Add New Locale'),
		'hierarchical' => true,
		'show_admin_column' => true
	);
	register_taxonomy('locale', null, $args);
}

add_action('init', 'locale_init');

// custom taxonomy for audiences

function audience_init() {
	// codex.wordpress.org/Function_Reference/register_taxonomy#Arguments
	$args = array(
		'label' => 'Audiences',
		'labels' => array('singular_name' => 'Audience', 'add_new_item' => 'Add New Audience'),
		'hierarchical' => true
	);
	register_taxonomy('audience', null, $args);
}

add_action('init', 'audience_init');

// custom post type for tutorials

function tutorial_init() {
	// codex.wordpress.org/Function_Reference/register_post_type#Arguments
	$args = array(
		'label'  => 'Tutorials',
		'labels' => array('singular_name' => 'Tutorial', 'all_items' => 'All Tutorials', 'not_found' => 'No tutorials found.'),
		'public' => true,
		'menu_position' => 5,
		'taxonomies' => array('section','locale','spotlight','audience'),
		'has_archive' => true,
		'supports' => array('title','editor','custom-fields','revisions','page-attributes')
	);
	register_post_type('tutorial', $args);
}

add_action('init', 'tutorial_init');

// enable links manager for Resources

add_filter('pre_option_link_manager_enabled', '__return_true');

// javascript

function enqueue_theme_scripts() {
	global $is_IE;
	if($is_IE) {
		wp_enqueue_script('html5_shiv','http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv-printshiv.min.js', array(), null);
	}
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-custom',THEME_URI.'/js/jquery-ui.min.js','jquery','1.11.0',true);
	wp_enqueue_script('jquery-imagelightbox',THEME_URI.'/js/jquery.imagelightbox.js','jquery','1.0',true);
	wp_enqueue_script('jquery-fitvids',THEME_URI.'/js/jquery.fitvids.js','jquery','1.1',true);
	wp_enqueue_script('custom-footer',THEME_URI.'/js/footer.js','jquery',null,true);
}

add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');

?>