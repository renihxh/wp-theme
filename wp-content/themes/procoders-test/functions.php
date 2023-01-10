<?php
/**
 * ProCoders Test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProCoders_Test
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function procoders_test_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ProCoders Test, use a find and replace
		* to change 'procoders-test' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'procoders-test', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'procoders-test' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'procoders_test_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'procoders_test_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function procoders_test_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'procoders_test_content_width', 640 );
}
add_action( 'after_setup_theme', 'procoders_test_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function procoders_test_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'procoders-test' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'procoders-test' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'procoders_test_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function procoders_test_scripts() {
	wp_enqueue_style( 'procoders-test-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'procoders-test-style', 'rtl', 'replace' );

	// Load jQuery
	wp_enqueue_script( 'procoders-test-jquery', get_template_directory_uri() . '/assets/jquery-3.1.0.min.js', array(), _S_VERSION, true );

	// Load swiper
	wp_enqueue_script( 'procoders-test-swiper-js', get_template_directory_uri() . '/assets/swiper/swiper-bundle.js', array(), _S_VERSION, true );
	wp_enqueue_style( 'procoders-test-swiper-css', get_template_directory_uri() .'/assets/swiper/swiper-bundle.css', array(), _S_VERSION );


	wp_enqueue_script( 'procoders-test-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );


	wp_enqueue_script( 'procoders-test-main-js', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'procoders_test_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Load block setup 
 */
require get_template_directory() . '/inc/blocks-setup.php';

/**
 * Load custom post types
 */
require get_template_directory() . '/inc/post-types-setup.php';

/**
 * Ajax load more function 
 */
require get_template_directory() . '/inc/load-more-function.php';

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'general-settings',
	));
	
}

// define the wpcf7_is_tel callback 
function custom_filter_wpcf7_is_tel( $result, $tel ) { 
  $result = preg_match( '/^\(?\+?([0-9]{1,4})?\)?[-\. ]?(\d{10})$/', $tel );
  return $result; 
}

add_filter( 'wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2 );

add_filter('wpcf7_form_tag_data_option', function($n, $options, $args) {
  if (in_array('codes', $options)){
    $codes = array(
	"+93", "+355", "+213", "+1-684", "+376", "+244", "+1-264", "+672", "+1-268", "+54", "+374", "+297", "+61", "+43", "+994", "+1-242", "+973", "+880", "+1-246", "+375", "+32", "+501", "+229", "+1-441", "+975", "+591", "+387", "+267", "+55", "+673", "+359", "+226", "+257", "+855", "+237", "+1", "+238", "+1-345", "+236", "+235", "+56", "+86", "+53", "+61", "+57", "+269", "+243", "+242", "+682", "+506", "+225", "+385", "+53", "+357", "+420'", "+45", "+253", "+1-767", "+1-809", "+1-829", "+670", "+593 ", "+20", "+503", "+240", "+291", "+372", "+251", "+500", "+298", "+679", "+358", "+33", "+594", "+689", "+241", "+220", "+995", "+49", "+233", "+350", "+30", "+299", "+1-473", "+590", "+1-671", "+502", "+224", "+245", "+592", "+509", "+504", "+852", "+36", "+354", "+91", "+62", "+98", "+964", "+353", "+972", "+39", "+1-876", "+81", "+962", "+7", "+254", "+686", "+850", "+82", "+965", "+996", "+856", "+371", "+961", "+266", "+231", "+218", "+423", "+370", "+352", "+853", "+389", "+261", "+265", "+60", "+960", "+223", "+356", "+692", "+596", "+222", "+230", "+269", "+52", "+691", "+373", "+377", "+976", "+1-664", "+212", "+258", "+95", "+264", "+674", "+977", "+31", "+599", "+687", "+64", "+505", "+227", "+234", "+683", "+672", "+1-670", "+47", "+968", "+92", "+680", "+970", "+507", "+675", "+595", "+51", "+63", "+48", "+351", "+1-787", "+1-939", "+974", "+262", "+40", "+7", "+250", "+290", "+1-869", "+1-758", "+508", "+1-784", "+685", "+378", "+239", "+966", "+221", "+248", "+232", "+65", "+421", "+386", "+677", "+252", "+27", "+34", "+94", "+249", "+597", "+268", "+46", "+41", "+963", "+886", "+992", "+255", "+66", "+690", "+676", "+1-868", "+216", "+90", "+993", "+1-649", "+688", "+256", "+380", "+971", "+44", "+1", "+598", "+998", "+678", "+418", "+58", "+84", "+1-284", "+1-340", "+681", "+967", "+260", "+263");
    return $codes;
  }
  return $n;
}, 10, 3);


add_filter('wpcf7_autop_or_not', '__return_false');
