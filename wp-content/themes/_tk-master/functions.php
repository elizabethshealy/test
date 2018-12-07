<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Store the theme's directory path and uri in constants
 */
define('THEME_DIR_PATH', get_template_directory());
define('THEME_DIR_URI', get_template_directory_uri());

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 750; /* pixels */

if (!function_exists('_tk_setup')) :
    /**
     * Set up theme defaults and register support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */
    function _tk_setup()
    {
        global $cap, $content_width;

        // Add html5 behavior for some theme elements
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        /**
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support('automatic-feed-links');

        /**
         * Enable support for Post Thumbnails on posts and pages
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        /**
         * Enable support for Post Formats
         */
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        /**
         * Setup the WordPress core custom background feature.
         */
        add_theme_support('custom-background', apply_filters('_tk_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * If you're building a theme based on _tk, use a find and replace
         * to change '_tk' to the name of your theme in all the template files
         */
        load_theme_textdomain('_tk', THEME_DIR_PATH . '/languages');

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus(array(
            'primary' => __('Header bottom menu', '_tk'),
            'secondary' => __('Footer bottom menu', '_tk'),
        ));

    }
endif; // _tk_setup
add_action('after_setup_theme', '_tk_setup');

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', '_tk'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', '_tk_widgets_init');

/**
 * Enqueue scripts and styles
 */
// include custom jQuery
function shapeSpace_include_custom_jquery()
{

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', THEME_DIR_URI . '/includes/vendor/jquery/jquery.min.js', array(), null, true);

}

add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');
function _tk_scripts()
{

    // load bootstrap css
    wp_enqueue_style('_tk-bootstrap4', THEME_DIR_URI . '/includes/vendor/bootstrap/css/bootstrap.min.css');

    // load Font Awesome css
    wp_enqueue_style('_tk-font-awesome', THEME_DIR_URI . '/includes/vendor/font-awesome/css/font-awesome.min.css', false, '4.1.0');

    // load _tk styles
    wp_enqueue_style('_tk-style', get_stylesheet_uri());

    // load custom styles
    wp_enqueue_style('_custom-style', THEME_DIR_URI . '/includes/css/custom.css');


    // load bootstrap wp js
    wp_enqueue_script('_tk-bootstrapwp4', THEME_DIR_URI . '/includes/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'));
    wp_enqueue_script('_tk-easing', THEME_DIR_URI . '/includes/js/jquery.easing.min.js', array('jquery'));
    wp_enqueue_script('_tk-custom_js', THEME_DIR_URI . '/includes/js/custom.js', array('jquery'));
    wp_enqueue_script('_tk-skip-link-focus-fix', THEME_DIR_URI . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('_tk-keyboard-image-navigation', THEME_DIR_URI . '/includes/js/keyboard-image-navigation.js', array('jquery'), '20120202');
    }

}

add_action('wp_enqueue_scripts', '_tk_scripts');


/**
 * Implement the Custom Header feature.
 */
require THEME_DIR_PATH . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require THEME_DIR_PATH . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require THEME_DIR_PATH . '/includes/extras.php';

/**
 * Customizer additions.
 */
require THEME_DIR_PATH . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require THEME_DIR_PATH . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require THEME_DIR_PATH . '/includes/bootstrap-wp-navwalker.php';

/**
 * Adds WooCommerce support
 */
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_filter('nav_menu_css_class', 'change_menu_item_css_classes', 10, 4);

function change_menu_item_css_classes($classes, $item, $args)
{
    if ($args->theme_location === 'primary') {
        $classes = ['nav-item'];
    } else {
        $classes = [];
    }

    return $classes;
}

function add_menuclass($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-link js-scroll-trigger"', $ulclass);
}

add_filter('wp_nav_menu', 'add_menuclass');

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
//
//	acf_add_options_sub_page(array(
//		'page_title' 	=> 'Footer Settings',
//		'menu_title'	=> 'Footer',
//		'parent_slug'	=> 'theme-general-settings',
//	));

}


register_sidebar(array(
    'name' => 'Footer Sidebar 1',
    'id' => 'footer-sidebar-1',
    'description' => 'Appears in the footer area',
    'before_widget' => '<div class="col-md-4">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));
register_sidebar(array(
    'name' => 'Footer Sidebar 2',
    'id' => 'footer-sidebar-2',
    'description' => 'Appears in the footer area',
    'before_widget' => '<div class="col-md-4">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));
register_sidebar(array(
    'name' => 'Footer Sidebar 3',
    'id' => 'footer-sidebar-3',
    'description' => 'Appears in the footer area',
    'before_widget' => '<div class="col-md-4">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));


add_action('init', 'register_post_types');
function register_post_types()
{
    register_post_type('conversations', array(
        'label' => null,
        'labels' => array(
            'name' => 'Conversations',
            'singular_name' => 'Conversation',
            'add_new' => 'Add  Conversations',
            'add_new_item' => 'Add new  Conversations',
            'edit_item' => 'Edit Conversation',
            'new_item' => 'New Conversation',
            'view_item' => 'View Conversation',
            'search_items' => 'Search  Conversation',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'parent_item_colon' => '',
            'menu_name' => 'Conversations',
        ),
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ));
}

add_action('template_redirect', 'redirect_post_type_single');
function redirect_post_type_single()
{
    if (!is_singular('conversations'))
        return;
    wp_redirect(home_url());
    exit;
}


add_action('init', 'register_post_types_bios');
function register_post_types_bios()
{
    register_post_type('bios', array(
        'label' => null,
        'labels' => array(
            'name' => 'Bios',
            'singular_name' => 'Bio',
            'add_new' => 'Add  Bio',
            'add_new_item' => 'Add new  Bio',
            'edit_item' => 'Edit Bio',
            'new_item' => 'New Bio',
            'view_item' => 'View Bio',
            'search_items' => 'Search  Bio',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'parent_item_colon' => '',
            'menu_name' => 'Bios',
        ),
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ));
}


add_filter('the_content', 'remove_autop_for_bios', 0);

function remove_autop_for_bios($content)
{
    global $post;

    // Check for single page and image post type and remove
    if ($post->post_type == 'bios')
        remove_filter('the_content', 'wpautop');
    remove_filter('the_excerpt', 'wpautop');

    return $content;
}

add_action('template_redirect', 'redirect_bios');
function redirect_bios()
{
    if (!is_singular('bios'))
        return;
    wp_redirect(home_url());
    exit;
}

/*---------------------------Start Share Your Voice------------------------------------------*/
add_action('init', 'register_post_types_share_your_voice');
function register_post_types_share_your_voice()
{
    register_post_type('share_your_voice', array(
        'label' => null,
        'labels' => array(
            'name' => 'Share Your Voice',
            'singular_name' => 'Share Your Voice',
            'add_new' => 'Add',
            'add_new_item' => 'Add new',
            'edit_item' => 'Edit',
            'new_item' => 'New',
            'view_item' => 'View',
            'search_items' => 'Search',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'parent_item_colon' => '',
            'menu_name' => 'Share Your Voice',
        ),
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive' => true,
        'rewrite' => true,
        'query_var' => true,
    ));
}

/*---------------------------End Share Your Voice------------------------------------------*/
/*---------------------------Start Question of the Week------------------------------------------*/
add_action('init', 'register_post_types_question_of_the_week');
function register_post_types_question_of_the_week()
{
    register_post_type('question_of_the_week', array(
        'label' => null,
        'labels' => array(
            'name' => 'Question of the Week',
            'singular_name' => 'Question of the Week',
            'add_new' => 'Add Question',
            'add_new_item' => 'Add new',
            'edit_item' => 'Edit',
            'new_item' => 'New',
            'view_item' => 'View',
            'search_items' => 'Search',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'parent_item_colon' => '',
            'menu_name' => 'Question of the Week',
        ),
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive' => true,
        'rewrite' => true,
        'query_var' => true,
    ));
}

/*---------------------------End Question of the Week------------------------------------------*/
/*---------------------------Start Reach Roundup------------------------------------------*/
add_action('init', 'register_post_types_reach_roundup');
function register_post_types_reach_roundup()
{
    register_post_type('reach_roundup', array(
        'label' => null,
        'labels' => array(
            'name' => 'Reach Roundup',
            'singular_name' => 'Reach Roundup',
            'add_new' => 'Add Reach Roundup',
            'add_new_item' => 'Add new',
            'edit_item' => 'Edit',
            'new_item' => 'New',
            'view_item' => 'View',
            'search_items' => 'Search',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'parent_item_colon' => '',
            'menu_name' => 'Reach Roundup',
        ),
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive' => true,
        'rewrite' => true,
        'query_var' => true,
    ));
}

/*---------------------------End Reach Roundup------------------------------------------*/
/*---------------------------Option Page ACF--------------------------------------------*/
if (function_exists('acf_add_options_page')) {

    acf_add_options_page();

}
/*---------------------------End Option Page ACF--------------------------------------------*/