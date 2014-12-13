<?php
/**
 * SKT Full Width functions and definitions
 *
 * @package SKT Full Width
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
  function string_limit_words($string, $word_limit)
{
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


	load_theme_textdomain( 'skt_full_width', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt_full_width' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'E6E1C4',
		'default-image' => '',
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // skt_full_width_setup
add_action( 'after_setup_theme', 'skt_full_width_setup' );

function skt_full_width_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'skt_full_width' ),
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

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

function skt_full_width_scripts() {
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
	
	wp_enqueue_style( 'skt_full_width-main-style', get_template_directory_uri()."/css/main.css", array('skt_full_width-fonts','skt_full_width-layout') );
	
	wp_enqueue_script( 'skt_full_width-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'skt_full_width-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_style( 'skt_full_width-nivo-slider-default-theme', get_template_directory_uri()."/css/nivo/themes/default/default.css" );
	
	wp_enqueue_style( 'skt_full_width-nivo-slider-style', get_template_directory_uri()."/css/nivo/nivo.css" );
	
	wp_enqueue_script('skt_full_width-timeago', get_template_directory_uri() . '/js/jquery.timeago.js', array('jquery') );
	
	wp_enqueue_script( 'skt_full_width-nivo-slider', get_template_directory_uri() . '/js/nivo.slider.js', array('jquery') );
	
	wp_enqueue_script( 'skt_full_width-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery') );

	
	wp_enqueue_script( 'skt_full_width-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery','skt_full_width-nivo-slider','skt_full_width-timeago','skt_full_width-superfish') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'skt_full_width-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_full_width_scripts' );

function skt_full_width_custom_head_codes() {
 if ( (function_exists( 'of_get_option' )) && (of_get_option('headcode1', true) != 1) ) {
	echo of_get_option('headcode1', true);
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
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






/* PORTFOLIO SECTION WITH PRETTYPHOTO */
add_action("admin_init", "admin_init");
function admin_init(){
	add_meta_box("video_file_url-meta", "Video File URL", "video_file_url", "portfolio", "normal", "low"); 
}

function video_file_url () {
	global $post;  
	$custom     = get_post_custom($post->ID);  
	$video_file_url  = isset ( $custom["video_file_url"][0] ) ? $custom["video_file_url"][0] : '';  ?> 
	<style>
	.amount_input { margin:0; padding:6px; width:80%; }
	</style>
	<table width="100%"> 
		<tr><td width="110">Video File URL : </td><td colspan="2"><input class="amount_input" type="text" name="video_file_url"  value="<?php echo $video_file_url; ?>"  /></td></tr> 
		<tr><td></td><td><strong>YouTube video url:</strong></td><td>http://www.youtube.com/watch?v=qqXi8WmQ_WM</td></tr> 
		<tr><td></td><td width="120"><strong>Vimeo video url:</strong></td><td>http://vimeo.com/8245346</td></tr> 
	</table>
	<?php
}

add_action('save_post', 'save_details');
function save_details(){
	global $post; 
	if ( isset($_POST["video_file_url"]) ) {
		update_post_meta($post->ID, "video_file_url", $_POST["video_file_url"]);
	} 
}

function portfolio_gallery_register() {

	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio Item',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Portfolio Item',
		'edit_item' => 'Edit Portfolio Item',
		'new_item' => 'New Portfolio Item',
		'view_item' => 'View Portfolio Item',
		'search_items' => 'Search Portfolio',
		'not_found' =>  'Nothing found',
		'not_found_in_trash' => 'Nothing found in Trash',
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => null,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail')
	); 
	
	register_post_type( 'portfolio' , $args );
	flush_rewrite_rules();
}
add_action('init', 'portfolio_gallery_register');

register_taxonomy("portfoliocategory", array("portfolio"), array("hierarchical" => true, "label" => "Portfolio Category", "singular_label" => "Portfolio", "rewrite" => true));

add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
function portfolio_edit_columns($columns){
	$columns = array(
		"cb" => '<input type="checkbox" />',
		"title" => "Portfolio Title",
		"pcategory" => "Portfolio Category",
		"view" => "Image",
		"date" => "Date",
	);
	return $columns;
}
function portfolio_custom_columns($column){
	global $post;
	switch ($column) {
		case "pcategory":
			echo get_the_term_list($post->ID, 'portfoliocategory', '', ', ','');
		break;
		case "view":
			the_post_thumbnail('thumbnail');
		break;
		case "date":
		// $custom = get_post_custom();
		// echo $custom["year_completed"][0];
		break;
	}
}


// load prettyphoto mixitup script and style files
function prettyPhoto_mixItUp_scripts(){
	wp_enqueue_style( 'skt_full_width-mixit-portfolio-style', get_template_directory_uri()."/mixit/template.css" );
	wp_enqueue_style( 'skt_full_width-prettyPhoto-portfolio-style', get_template_directory_uri()."/mixit/prettyPhoto.css" );
	wp_enqueue_script('skt_full_width-mixitupJs', get_template_directory_uri() . '/mixit/jquery.mixitup.min.js', array('jquery') );
	wp_enqueue_script('skt_full_width-prettyPhotoJs', get_template_directory_uri() . '/mixit/jquery.prettyPhoto.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'prettyPhoto_mixItUp_scripts' );

// load prettyphoto mixitup javascript
function skt_full_width_prettyphoto_mixitup_scripts() { ?>
    <!-- prettyBox script // -->
    <script type="text/javascript">  
        jQuery(function(){
            jQuery('#Grid').mixitup(); 					
        });
    </script>
    <script type="text/javascript">
    jQuery(function(){jQuery(".gallery:not(.slideshow) a[rel^='prettyPhoto']").prettyPhoto();
    jQuery(".gallery.slideshow a[rel^='prettyPhoto']").prettyPhoto({slideshow:5000, autoplay_slideshow:true});	});
    </script>
    <!-- Google Maps Code -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">
    function initialize() {
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    }
    </script><?php
}
add_action('wp_footer', 'skt_full_width_prettyphoto_mixitup_scripts');

//[portfolio show=3]
function portfolio_func( $atts ) {
	extract( shortcode_atts( array(
		'show' => -1,
		'tags' => 'true'
	), $atts ) );
	$pfStr = '';

	if($tags == 'true'){
		$pfStr .= '<div class="controls"><ul>';
		$categories = get_categories( array('taxonomy' => 'portfoliocategory') );
		foreach ($categories as $category) {
			$pfStr .= '<li data-filter="category_'.$category->term_id.'" class="filter">'.$category->cat_name.'</li>';
		}
		$pfStr .= '<li data-filter="all" class="filter active">All</li></ul></div>';
		
		$pfStr .= '<br style="clear:both;" />';
	}

	$pfStr .= '<ul id="Grid">';
	query_posts('post_type=portfolio&posts_per_page='.$show); 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		$videoUrl = get_post_meta( get_the_ID(), 'video_file_url', true);
		$imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

		if( $imgSrc[0] != '' ){
			$imgSrcMedium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
			$imgThumb = $imgSrcMedium[0];
			$imgUrl = $imgSrc[0];
		}elseif ( get_video_image_src($videoUrl) != '' && $imgSrc[0]=='' ) {
			$imgThumb = get_video_image_src($videoUrl);
		}else{
			$imgThumb = get_template_directory_uri().'/images/img_404.png';
		}
		
		if( $imgSrc[0] != '' || $videoUrl != '' ){
			$terms = wp_get_post_terms( get_the_ID(), 'portfoliocategory');
			$categoryId = ( count($terms) > 0 ) ? $terms[0]->term_id : '';
			$pfStr .= '<li data-cat="'.$categoryId.'" class="mix category_'.$categoryId.' mix_all">';
			$pfStr .= '<div id="custom_content" class="img-box gallery clearfix">';
			$pfStr .= '<a title="'.get_the_title().'" class="img-box" rel="prettyPhoto[mixed]" href="';
			$pfStr .= ($videoUrl != '') ? $videoUrl : $imgUrl ;
			$pfStr .= '">';
			$pfStr .= ($videoUrl != '') ? '<div class="mix-hover-video blur-box"></div>' : '<div class="mix-hover-image blur-box"></div>' ;
			$pfStr .= '<img src="'.$imgThumb.'" />';
			$pfStr .= '</a>';
			$pfStr .= '</div>';
			$pfStr .= '<div class="mix-details">'.get_the_title().'</div>';
			$pfStr .= '</li>';
		}
	endwhile; else: 
		$pfStr .= '<p>Sorry, portfolio is empty.</p>';
	endif; 
	wp_reset_query();
	$pfStr .= '<li class="gap"></li>';
	$pfStr .= '<div class="clear"></div>';
	$pfStr .= '</ul>';

	return $pfStr;
}
add_shortcode( 'portfolio', 'portfolio_func' );


// hide customize and custom backgrounds page 
add_action('admin_init', 'remove_submenu_elements', 102);
function remove_submenu_elements(){
	remove_submenu_page( 'themes.php', 'customize.php' );
	remove_submenu_page( 'themes.php', 'custom-background' );
	remove_submenu_page( 'themes.php', 'custom-header' );
}


// get video iamge url
function get_video_image_src($url){
    if (strpos( $url,"?v=") !== false) { 			// yotube
        $cntid = substr($url, strpos($url, "?v=") + 3, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"youtu.be/") !== false) {
        $cntid = substr($url, strpos($url, "youtu.be/") + 9, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"embed/") !== false) {
        $cntid = substr($url, strpos($url, "embed/") + 6, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"?vi=") !== false) {
        $cntid =  substr($url, strpos($url, "?vi=") + 4, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"youtube.com/v/") !== false) {
        $cntid =  substr($url, strpos($url, "youtube.com/v/") + 14, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"youtube.com/vi/") !== false) {
        $cntid =  substr($url, strpos($url, "youtube.com/vi/") + 15, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"youtube.com/vi/") !== false) {
        $cntid =  substr($url, strpos($url, "youtube.com/vi/") + 15, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    } elseif(strpos( $url,"youtu.be/") !== false) {
        $cntid =  substr($url, strpos($url, "youtu.be/") + 9, 11);
		$imgUrl = 'http://img.youtube.com/vi/'.$cntid.'/hqdefault.jpg';
    }/*elseif(strpos( $url,"vimeo.com/video/") !== false) {		// vimeo
        $cntid =  substr($url, strpos($url, "vimeo.com/video/") + 16, 8);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$cntid.".php"));
		$imgUrl = $hash[0]['thumbnail_large'];
    }elseif(strpos( $url,"vimeo.com/") !== false) {		// vimeo
        $cntid =  substr($url, strpos($url, "vimeo.com/") + 10, 8);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$cntid.".php"));
		$imgUrl = $hash[0]['thumbnail_large'];
    }*/
	if( isset($imgUrl) )
		return $imgUrl;
	else
		return false;
}


function custom_blogpost_pagination( $wp_query ){
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




function get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}