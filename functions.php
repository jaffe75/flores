<?php
/**
 * flores functions and definitions
 *
 * @package flores
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'flores_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function flores_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on flores, use a find and replace
	 * to change 'flores' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'flores', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'flores' ),
		'tile' => __('Tile Menu', 'flores'),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'flores_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // flores_setup
add_action( 'after_setup_theme', 'flores_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function flores_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'flores' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'flores_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function flores_scripts() {
	wp_enqueue_style( 'flores-style', get_stylesheet_uri() );

	wp_enqueue_script( 'flores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'flores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'flores-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'flores_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// get rid of the admin bar on the front end when logged in


add_filter( 'show_admin_bar', '__return_false' );



// CPT - For Front page links

add_action('init', 'cptui_register_my_cpt');

function cptui_register_my_cpt() {
	register_post_type('tile-links', array(
		'label' => 'Tile Links',
		'description' => 'This is for the three links in the center of the home page',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'tile-links', 'with_front' => true),
		'query_var' => true,
		'supports' => array('title','thumbnail'),
		'labels' => array (
		  'name' => 'Tile Links',
		  'singular_name' => 'Tile Link',
		  'menu_name' => 'Tile Links',
		  'add_new' => 'Add Tile Link',
		  'add_new_item' => 'Add New Tile Link',
		  'edit' => 'Edit',
		  'edit_item' => 'Edit Tile Link',
		  'new_item' => 'New Tile Link',
		  'view' => 'View Tile Link',
		  'view_item' => 'View Tile Link',
		  'search_items' => 'Search Tile Links',
		  'not_found' => 'No Tile Links Found',
		  'not_found_in_trash' => 'No Tile Links Found in Trash',
		  'parent' => 'Parent Tile Link',
		)
) ); }


/**************************/
/* LINK FIELD
/**************************/
define( 'ACF_LITE', true );

include_once('add-ons/advanced-custom-fields/acf.php');
// Fields 
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('add-ons/acf-repeater/repeater.php');
}

// Options Page 
//include_once( 'add-ons/acf-options-page/acf-options-page.php' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_link-button',
		'title' => 'Link Button',
		'fields' => array (
			array (
				'key' => 'field_51f17428a935b',
				'label' => 'Link Name',
				'name' => 'link_name',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_51f07888ccfc1',
				'label' => 'Link',
				'name' => 'link',
				'type' => 'text',
				'instructions' => 'Enter the full link url',
				'default_value' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tile-links',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/**************************/
/* SOCIAL MEDIA FIELD
/**************************/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_social-media',
		'title' => 'Social Media',
		'fields' => array (
			array (
				'key' => 'field_51f0773131c49',
				'label' => 'Social Media',
				'name' => 'social-media',
				'type' => 'repeater',
				'instructions' => 'Add the Links for Social Media including button image',
				'sub_fields' => array (
					array (
						'key' => 'field_51f0774b31c4a',
						'label' => 'Name',
						'name' => 'name',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
					),
					array (
						'key' => 'field_51f0776231c4b',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'instructions' => 'Enter Full URL starting with HTTP',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
					),
					array (
						'key' => 'field_51f0777a31c4c',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Social Media Link',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tile-links',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}










