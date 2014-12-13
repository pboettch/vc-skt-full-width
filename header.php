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
<script src="<?php bloginfo('template_url') ; ?>/js/jquery.min.js">
</script>
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

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<?php if(is_home() || is_front_page()){ ?> 	  

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
                for ($i=1;$i<6;$i++) {
					$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
					if ($caption != ""){
						echo "<div id='primary'>";
						echo "<div id='caption_".$i."' class='nivo-html-caption'>";
						echo "<a href='".esc_url(of_get_option('slideurl'.$i, true))."'><div class='slide-title'>".of_get_option('slidetitle'.$i, true)."</div></a>";
						echo "<div class='slide-description'>".of_get_option('slidedesc'.$i, true)."</div>";
						echo "</div>";
						echo "</div>";
					} 
				}	
                ?>
            </div><!--.container-->	
		</div><!--.slider-parent-->
        <?php } else { ?>
			<div class="slider-parent" style="background-image:url(<?php bloginfo('template_url'); ?>/images/banner-welcome.jpg);"></div>
        <?php }  ?>
	<?php } elseif( is_single() ) {?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <div class="slider-parent">	
                <div class="slider-wrapper theme-default container">
					<?php if( has_post_thumbnail() ){ ?>
	                    <?php the_post_thumbnail("full"); ?>
                    <?php } else { ?>
    	                <img src="<?php bloginfo('template_url'); ?>/images/banner_img_1.jpg" />
                    <?php } ?>
                </div><!-- slider-wrapper theme-default container -->
            </div><!-- slider-parent -->
      	<?php endwhile; endif; ?>
	<?php } else { ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <div class="slider-parent">	
                <div class="slider-wrapper theme-default container">
					<?php if( has_post_thumbnail() ){ ?>
                    	<?php the_post_thumbnail("full"); ?>
                    <?php } else {?>
                    	<img src="<?php bloginfo('template_url');?>/images/banner_img.jpg" />
                    <?php } ?>
                </div><!-- slider-wrapper theme-default container -->
            </div><!-- slider-parent -->
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
      