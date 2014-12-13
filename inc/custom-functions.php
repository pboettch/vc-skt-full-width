<?php
/**
 * @package SKT Full Width
 * Setup the WordPress core custom functions feature.
 *
*/

add_action('skt_full_width_optionsframework_custom_scripts', 'skt_full_width_optionsframework_custom_scripts');
function skt_full_width_optionsframework_custom_scripts() { ?>
	<script type="text/javascript">
    jQuery(document).ready(function() {
    
        jQuery('#example_showhidden').click(function() {
            jQuery('#section-example_text_hidden').fadeToggle(400);
        });
        
        if (jQuery('#example_showhidden:checked').val() !== undefined) {
            jQuery('#section-example_text_hidden').show();
        }
        
    });
    </script><?php
}


// hide customize and custom backgrounds page
add_action('admin_init', 'skt_full_width_remove_submenu_elements', 102);
function skt_full_width_remove_submenu_elements(){
	remove_submenu_page( 'themes.php', 'customize.php' );
	//remove_submenu_page( 'themes.php', 'custom-background' );
	remove_submenu_page( 'themes.php', 'custom-header' );
}

add_action('wp_head','hook_custom_javascript');
function hook_custom_javascript(){?>
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
    </script><?php
}

?>