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

?>