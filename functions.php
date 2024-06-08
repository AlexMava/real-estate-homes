<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

/* Block editor completely disabled */
add_filter('use_block_editor_for_post', '__return_false', 99);

/**************************************/
/*                Property         */
/**************************************/
add_action('init', 'custom_cpt_property');
add_filter('post_updated_messages', 'custom_cpt_property_messages');
add_filter('enter_title_here', 'custom_cpt_property_title');
add_action('admin_head', 'custom_cpt_property_icon');

function custom_cpt_property()
{

    $labels = array(
        'name' => __('Properties', 'post type general name'),
        'singular_name' => __('Property', 'post type singular name'),
        'add_new' => __('Add New', 'property'),
        'add_new_item' => __('Add New Property'),
        'edit_item' => __('Edit Property'),
        'new_item' => __('New Property'),
        'view_item' => __('View Property'),
        'search_items' => __('Search Properties'),
        'not_found' => __('No properties found'),
        'not_found_in_trash' => __('No properties found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Properties'
    );

    $propertyargs = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'property', 'with_front' => 'false'),
        'has_archive' => 'properties',
        'hierarchical' => true,
        'menu_position' => 20,
        'supports' => array('title', 'page-attributes'),
        'taxonomies' => array('property-borough')
    );

    register_post_type('property', $propertyargs);
}

function custom_cpt_property_messages($messages)
{
    global $post, $post_ID;

    $messages['property'] = array(
        0 => '',
        1 => sprintf(__('Property updated. <a href="%s">View property</a>', 'your_text_domain'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.', 'your_text_domain'),
        3 => __('Custom field deleted.', 'your_text_domain'),
        4 => __('Property updated.', 'your_text_domain'),
        5 => isset($_GET['revision']) ? sprintf(__('Property restored to revision from %s', 'your_text_domain'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf(__('Property published. <a href="%s">View property</a>', 'your_text_domain'), esc_url(get_permalink($post_ID))),
        7 => __('Property saved.', 'your_text_domain'),
        8 => sprintf(__('Property submitted. <a target="_blank" href="%s">Preview property</a>', 'your_text_domain'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Property scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview property</a>', 'your_text_domain'),
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Property draft updated. <a target="_blank" href="%s">Preview property</a>', 'your_text_domain'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;
}

function custom_cpt_property_title($title)
{
    $screen = get_current_screen();

    if ('property' == $screen->post_type) {
        $title = 'Enter Name';
    }

    return $title;
}

// http://melchoyce.github.io/dashicons/
function custom_cpt_property_icon()
{
    echo '
	<style>
		#adminmenu #menu-posts-property div.wp-menu-image:before,
		.page-count.testimonial-count a:before { content: "\f102" !important; }
	</style>
	';
}

/**************************************/
/*                Tax for Property          */
/**************************************/
add_action( 'init', 'add_property_taxonomies', 0 );

function add_property_taxonomies() {
    $labels = array(
        'name'                       => _x( 'Boroughs', 'taxonomy general name' ),
        'singular_name'              => _x( 'Borough', 'taxonomy singular name' ),
        'search_items'               => __( 'Search Boroughs' ),
        'popular_items'              => __( 'Popular Boroughs' ),
        'all_items'                  => __( 'All Boroughs' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Borough' ),
        'update_item'                => __( 'Update Borough' ),
        'add_new_item'               => __( 'Add New Borough' ),
        'new_item_name'              => __( 'New Borough Name' ),
        'separate_items_with_commas' => __( 'Separate report boroughs with commas' ),
        'add_or_remove_items'        => __( 'Add or remove report boroughs' ),
        'choose_from_most_used'      => __( 'Choose from the most used report boroughs' ),
        'not_found'                  => __( 'No report boroughs found.' ),
        'menu_name'                  => __( 'Boroughs' ),
    );

    $reportcategoriesargs = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => false,
    );

    register_taxonomy( 'property-borough', 'property', $reportcategoriesargs );
}

include_once get_stylesheet_directory() .'/inc/shortcodes.php';