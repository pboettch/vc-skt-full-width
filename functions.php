<?php
/**
 * SKT Full Width functions and definitions
 *
 * @package SKT Full Width
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function skt_full_width_string_limit_words($string, $word_limit){
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'skt_full_width_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_full_width_setup() {
	load_theme_textdomain( 'skt-full-width', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-full-width' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'E6E1C4',
		'default-image' => get_template_directory_uri().'/images/banner_bg.jpg',
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // skt_full_width_setup
add_action( 'after_setup_theme', 'skt_full_width_setup' );


function skt_full_width_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-full-width' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-full-width' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
}
add_action( 'widgets_init', 'skt_full_width_widgets_init' );

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


function skt_full_width_scripts() {
	wp_enqueue_style( 'skt_full_width-gfonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' );
	wp_enqueue_style( 'skt_full_width-fonts', '//fonts.googleapis.com/css?family=Roboto:400,300,700');
	wp_enqueue_style( 'skt_full_width-basic-style', get_stylesheet_uri() );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('sidebar-layout', true) != 1) ) {
		if (of_get_option('sidebar-layout', true) ==  'right') {
			wp_enqueue_style( 'skt_full_width-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
		}
		else {
			wp_enqueue_style( 'skt_full_width-layout', get_template_directory_uri()."/css/layouts/sidebar-content.css" );
		}	
	}
	else {
		wp_enqueue_style( 'skt_full_width-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
	}	
	
	wp_enqueue_style( 'skt_full_width-editor-style', get_template_directory_uri()."/editor-style.css", array('skt_full_width-layout') );

	wp_enqueue_style( 'skt_full_width-main-style', get_template_directory_uri()."/css/main.css", array('skt_full_width-layout') );
	
	wp_enqueue_style( 'skt_full_width-nivo-slider-default-theme', get_template_directory_uri()."/css/nivo/themes/default/default.css" );
	
	wp_enqueue_style( 'skt_full_width-nivo-slider-style', get_template_directory_uri()."/css/nivo/nivo.css" );
	
	wp_enqueue_script( 'skt_full_width-nivo-slider', get_template_directory_uri() . '/js/nivo.slider.js', array('jquery') );
	
	wp_enqueue_script( 'skt_full_width-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery') );

	wp_enqueue_script( 'skt_full_width-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery','skt_full_width-nivo-slider','skt_full_width-superfish') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_full_width_scripts' );

function skt_full_width_custom_head_codes() {
 if ( (function_exists( 'of_get_option' )) && (of_get_option('headcode1', true) != 1) ) {
	echo esc_html( of_get_option('headcode1', true) );
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>". esc_html( of_get_option('style2', true) ) ."</style>";
 }
 //Modify CSS a little if Slider is disabled. 
if ( ( of_get_option('slider_enabled') == 0 ) || ( (is_home() == false) ) )  {
			echo "<style>.main-navigation {	margin-bottom: -5px;}</style>";
			}
			
 if ( ( of_get_option('slider_enabled') == 0 ) || ( (is_front_page() == true) ) )  {
			echo "<style>.main-navigation {	margin-bottom: 15px;}</style>";
			}	
}	
add_action('wp_head', 'skt_full_width_custom_head_codes');


function skt_full_width_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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


/**
 * Load custom functions file.
 */
require get_template_directory() . '/inc/custom-functions.php';


function skt_full_width_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Prev',
		'next_text' 	=> 'Next &raquo;',
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}


function skt_full_width_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}
