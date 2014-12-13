<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT Full Width
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<script>
jQuery(document).ready(function() {
	jQuery("#header-bottom-shape").click(function(){
		if ( jQuery( "#site-nav" ).is( ":hidden" ) ) {
			jQuery( "#site-nav" ).slideDown("slow");
		} else {
			jQuery( "#site-nav" ).slideUp("slow");
		}
		jQuery( this ).toggleClass('showDown');
	});
	jQuery( "#site-nav li:last" ).addClass("noBottomBorder");
	jQuery( "#site-nav li:parent" ).find('ul.sub-menu').parent().addClass("haschild");
});
</script>
</head>

<body <?php body_class(); ?>>
<?php 
$front_page = get_option('page_on_front');
$post_page = get_option('page_for_posts');
?>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<?php if( (is_front_page() || is_home()) && ($front_page == 0 && $post_page == 0) ){ ?>
		<?php
		$slAr = array();
        for ($i=1;$i<6;$i++) {
			if ( of_get_option('slide'.$i, true) != "" ) {
				$imgUrl = of_get_option('slide'.$i, true);
				if ( strlen($imgUrl) > 3 ) $slAr[] = of_get_option('slide'.$i, true);
			}
		}
		if( count($slAr) > 0 ){
		?>
		<div class="slider-parent">	
            <div class="slider-wrapper theme-default container"> 
                <div class="ribbon"></div>    
                <div id="slider" class="nivoSlider">
                    <?php
                    $slider_flag = false;
                    for ($i=1;$i<6;$i++) {
                        $caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
                        if ( of_get_option('slide'.$i, true) != "" ) {
                            echo "<div class='slide' style='background-image:url(".of_get_option('slide'.$i, true).");'><a href='".esc_url(of_get_option('slideurl'.$i, true))."'><img src='".of_get_option('slide'.$i, true)."' title='".$caption."' height='100%' width='100%'></a></div>"; 
                            $slider_flag = true;
                        }
                    }
                    ?>  
                </div><!--#slider-->
                <?php 
				echo "<div id='primary'>";
                for ($i=1;$i<6;$i++) {
					$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
					if ($caption != ""){
						echo "<div id='caption_".$i."' class='nivo-html-caption'>";
						echo "<div class='slide-title'><span>".of_get_option('slidetitle'.$i, true)."</span></div>";
						echo "<div class='slide-description'><span>".of_get_option('slidedesc'.$i, true)."</span></div>";
						if( of_get_option('slideurl'.$i, true) != '' ){
							echo "<div class='slide-readmore'><span><a href='".esc_url(of_get_option('slideurl'.$i, true))."'>Read More</a></span> <img src='".get_template_directory_uri()."/images/menu_sub_icon.png' /></div>";
						}
						echo "</div>";
					} 
				}	
				echo "</div>";
                ?>
            </div><!--.container-->	
		</div><!--.slider-parent-->
        <?php } else { ?>
			<div class="slider-parent" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/banner-welcome.jpg);"></div>
        <?php }  ?>
	<?php } elseif( is_single() ) {?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php if( has_post_thumbnail() ){
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                $imgUrl = $large_image_url[0];
            } else { 
                $imgUrl = get_template_directory_uri().'/images/banner_img.jpg';
            } ?>
            <div class="slider-parent"  style="background-image:url(<?php echo $imgUrl; ?>);"></div><!-- slider-parent -->
      	<?php endwhile; endif; ?>
	<?php } else { ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php if( has_post_thumbnail() ){
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                $imgUrl = $large_image_url[0];
            } else { 
                $imgUrl = get_template_directory_uri().'/images/banner_img.jpg';
            } ?>
            <div class="slider-parent"  style="background-image:url(<?php echo $imgUrl; ?>);"></div><!-- slider-parent -->
        <?php endwhile; endif; ?>
	<?php }   ?>

    <div id="wrapper">
    <div id="secondary" class="widget-area" role="complementary">
     <div class="header">
            <div class="logo">
               <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo of_get_option('logo', true); ?>" /></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2><br />
            </div>
      
        <div id="site-nav">
        <h1 class="menu-toggle"><?php _e( 'Menu', 'skt_full_width' ); ?></h1>
						<div class="screen-reader-text skip-link"><a href="#content"><?php _e( 'Skip to content', 'skt_full_width' ); ?></a></div>
	        <?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '', 'menu_class' => '') ); ?>
        </div><!-- site-nav -->
        	<div class="header-bottom">
            	 <div id="header-bottom-shape">
                    </div><!-- header-bottom-shape2 -->
             </div><!-- header-bottom -->
            
    </div><!-- header -->
   </div><!-- secondary -->
      