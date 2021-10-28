<?php

	add_action( 'after_setup_theme', 'cron_fn_setup', 50 );

	function cron_fn_setup(){

			// REGISTER THEME MENU
			if(function_exists('register_nav_menus')){
				register_nav_menus(array('main_menu' 	=> esc_html__('Main Menu','cron')));
				register_nav_menus(array('mobile_menu' 	=> esc_html__('Mobile Menu','cron')));
			}

			// This theme styles the visual editor with editor-style.css to match the theme style.
			add_action( 'wp_enqueue_scripts', 'cron_fn_scripts', 100 ); 
			add_action( 'wp_enqueue_scripts', 'cron_fn_styles', 100 );
			add_action( 'wp_enqueue_scripts', 'cron_fn_inline_styles', 150 );
			add_action( 'admin_enqueue_scripts', 'cron_fn_admin_scripts' );
		
			// Actions
			add_action( 'tgmpa_register', 'cron_fn_register_required_plugins' );
		
			// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
			add_theme_support( 'post-formats', array('video','audio','gallery','image','link','quote') );
		
			// This theme uses post thumbnails
			add_theme_support( 'post-thumbnails' );
		
			set_post_thumbnail_size( 300, 300, true ); 									// Normal post thumbnails
		
			add_image_size( 'cron_fn_thumb-1000-1000', 1000, 1000, true);				// Portfolio Categories
			add_image_size( 'cron_fn_thumb-1000-9999', 1000, 9999, false);				// Portfolio Page
			add_image_size( 'cron_fn_thumb-300-300', 300, 300, true);					// Clients, Commentary
		
			//Load Translation Text Domain
			load_theme_textdomain( 'cron', get_template_directory() . '/languages' );
		
			// Firing Title Tag Function
			cron_fn_theme_slug_setup();
		
			add_filter(	'widget_tag_cloud_args', 'cron_fn_tag_cloud_args');
		
			if ( ! isset( $content_width ) ) $content_width = 1170;
		
			// Add default posts and comments RSS feed links to head
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'wp_list_comments' );
		
			add_editor_style() ;
			
			// for ajax
			add_action( 'wp_ajax_nopriv_cron_fn_ajax_service_list', 'cron_fn_ajax_service_list' );
			add_action( 'wp_ajax_cron_fn_ajax_service_list', 'cron_fn_ajax_service_list' );
			
			define('CRON_THEME_URL', get_template_directory_uri());
		/* ------------------------------------------------------------------------ */
		/*  Inlcudes
		/* ------------------------------------------------------------------------ */
			include_once( get_template_directory().'/inc/cron_fn_functions.php'); 		// Custom Functions
			include_once( get_template_directory().'/inc/cron_fn_googlefonts.php'); 	// Google Fonts Init
			include_once( get_template_directory().'/inc/cron_fn_css.php'); 			// Inline CSS
			include_once( get_template_directory().'/inc/cron_fn_sidebars.php'); 		// Widget Area
			include_once( get_template_directory().'/inc/cron_fn_pagination.php'); 		// Pagination
//			include_once( get_template_directory().'/config/config-woo/config.php'); 			// WooCommerce		
			include_once( get_template_directory().'/inc/widgets/widget-business-hours.php');	// Load Widgets
			include_once( get_template_directory().'/inc/widgets/widget-estimate.php');			// Load Widgets
			include_once( get_template_directory().'/inc/widgets/widget-brochure.php');			// Load Widgets
			
	}




/* ----------------------------------------------------------------------------------- */
/*  ENQUEUE STYLES AND SCRIPTS
/* ----------------------------------------------------------------------------------- */
	function cron_fn_scripts() {
		wp_enqueue_script('modernizr-custom', get_template_directory_uri() . '/framework/js/modernizr-custom.js', array('jquery'), '1.0', FALSE);
		wp_enqueue_script('ie8', get_template_directory_uri() . '/framework/js/ie8.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/framework/js/theia-sticky-sidebar.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/framework/js/isotope.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('justified', get_template_directory_uri() . '/framework/js/justified.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('nicescroll', get_template_directory_uri() . '/framework/js/nicescroll.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('lightgallery', get_template_directory_uri() . '/framework/js/lightgallery.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/framework/js/owl-carousel.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('cron-fn-init', get_template_directory_uri() . '/framework/js/init.js', array('jquery'), '1.0', TRUE);
		wp_localize_script( 'cron-fn-init', 'fn_ajax_object', array( 'fn_ajax_url' => admin_url( 'admin-ajax.php' )) );
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		
		wp_script_add_data( 'ie8', 'conditional', 'lt IE 10' );
	}
	
	function cron_fn_admin_scripts() {
		wp_enqueue_script('widget-upload', get_template_directory_uri() . '/framework/js/widget-upload.js', array('jquery'), '1.0', FALSE);
		wp_enqueue_script('cron-fn-meta-sortable', get_template_directory_uri() . '/framework/js/meta-sortable.js', array('jquery'), '1.0', FALSE);
		wp_enqueue_style('cron-fn-meta-sortable', get_template_directory_uri().'/framework/css/meta-sortable.css', array(), '1.0', 'all');
		
		wp_enqueue_style('cron-fn-admin-style', get_template_directory_uri().'/framework/css/admin-style.css', array(), '1.0', 'all');
	}

	function cron_fn_styles(){
		wp_enqueue_style( 'cron-fn-font-url', cron_fn_font_url(), array(), null );
		wp_enqueue_style('cron-fn-base', get_template_directory_uri().'/framework/css/base.css', array(), '1.0', 'all');
		wp_enqueue_style('cron-fn-skeleton', get_template_directory_uri().'/framework/css/skeleton.css', array(), '1.0', 'all');
		wp_enqueue_style('fontello', get_template_directory_uri().'/framework/css/fontello.css', array(), '1.0', 'all');
		wp_enqueue_style('justified', get_template_directory_uri().'/framework/css/justified.css', array(), '1.0', 'all');
		wp_enqueue_style('lightgallery', get_template_directory_uri().'/framework/css/lightgallery.css', array(), '1.0', 'all');
		wp_enqueue_style('owl-carousel', get_template_directory_uri().'/framework/css/owl-carousel.css', array(), '1.0', 'all');
		wp_enqueue_style('owl-theme-default', get_template_directory_uri().'/framework/css/owl-theme-default.css', array(), '1.0', 'all');
		wp_enqueue_style('cron-fn-stylesheet', get_stylesheet_uri(), array(), '1', 'all' ); // Main Stylesheet
	}




/* ----------------------------------------------------------------------------------- */
/*  Title tag: works WordPress v4.1 and above
/* ----------------------------------------------------------------------------------- */
	function cron_fn_theme_slug_setup() {
		add_theme_support( 'title-tag' );
	}
/* ----------------------------------------------------------------------------------- */
/*  Tagcloud widget
/* ----------------------------------------------------------------------------------- */
	
	function cron_fn_tag_cloud_args($args)
	{
		//return value "smallest=13&largest=13&number=40&orderby=name&unit=px";
		
		$my_args = array('smallest' => 14, 'largest' => 14, 'unit'=>'px', 'orderby'=>'count', 'order'=>'DESC' );
		$args = wp_parse_args( $args, $my_args );
		return $args;
	}

	
/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/

require_once get_template_directory().'/plugin/class-tgm-plugin-activation.php';

function cron_fn_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Cron Core', // The plugin name.
			'slug'               => 'cron-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugin/cron-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Redux Framework', // The plugin name.
			'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
			'source'             => 'https://github.com/reduxframework/redux-framework/archive/master.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://github.com/reduxframework/redux-framework.git', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Elementor', // The plugin name.
			'slug'               => 'elementor', // The plugin slug (typically the folder name).
			'source'             => 'https://downloads.wordpress.org/plugin/elementor.3.1.1.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://downloads.wordpress.org/plugin/elementor.3.1.1.zip', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'cron',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}



?>