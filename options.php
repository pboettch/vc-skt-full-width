<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'skt_full_width'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();
	$imagepath =  get_template_directory_uri() . '/images/';
		
	
	//Basic Settings
	
	$options[] = array(
		'name' => __('Basic Settings', 'skt_full_width'),
		'type' => 'heading');
		
		$options[] = array(
		'name' => __('Logo', 'skt_full_width'),
		'desc' => __('Upload your logo here', 'skt_full_width'),
		'id' => 'logo',
		'class' => '',
		'std'	=> get_template_directory_uri()."/images/logo.png",
		'type' => 'upload');
				
		
	$options[] = array(
		'name' => __('Copyright Text', ''),
		'desc' => __('Some Text regarding copyright of your site, you would like to display in the footer.', ''),
		'id' => 'footertext2',
		'std' => 'Full Width 2014. All Rights Reserved',
		'type' => 'text');
	
	//Layout Settings
		
	$options[] = array(
		'name' => __('Layout Settings', 'skt_full_width'),
		'type' => 'heading');	
	
	$options[] = array(
		'name' => "Header Layout",
		'desc' => "Select Layout for Posts & Pages.",
		'id' => "sidebar-layout",
		'std' => "left",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array(
		'name' => __('Custom CSS', 'skt_full_width'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'skt_full_width'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
	
	//SLIDER SETTINGS

	$options[] = array(
		'name' => __('Slider Settings', 'skt_full_width'),
		'type' => 'heading');

	/*$options[] = array(
		'name' => __('Enable Slider', 'skt_full_width'),
		'desc' => __('Check this to Enable Slider.', 'skt_full_width'),
		'id' => 'slider_enabled',
		'type' => 'checkbox',
		'std' => '' );*/
		
	$options[] = array(
		'name' => __('Slider Image 1', 'skt_full_width'),
		'desc' => __('First Slide', 'skt_full_width'),
		'id' => 'slide1',
		'class' => '',
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'skt_full_width'),
		'id' => 'slidetitle1',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt_full_width'),
		'id' => 'slidedesc1',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'skt_full_width'),
		'id' => 'slideurl1',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 2', 'skt_full_width'),
		'desc' => __('Second Slide', 'skt_full_width'),
		'class' => '',
		'id' => 'slide2',
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'skt_full_width'),
		'id' => 'slidetitle2',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt_full_width'),
		'id' => 'slidedesc2',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'skt_full_width'),
		'id' => 'slideurl2',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Slider Image 3', 'skt_full_width'),
		'desc' => __('Third Slide', 'skt_full_width'),
		'id' => 'slide3',
		'class' => '',
		'type' => 'upload');	
	
	$options[] = array(
		'desc' => __('Title', 'skt_full_width'),
		'id' => 'slidetitle3',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt_full_width'),
		'id' => 'slidedesc3',
		'std' => '',
		'type' => 'textarea');	
			
	$options[] = array(
		'desc' => __('Url', 'skt_full_width'),
		'id' => 'slideurl3',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 4', 'skt_full_width'),
		'desc' => __('Fourth Slide', 'skt_full_width'),
		'id' => 'slide4',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'skt_full_width'),
		'id' => 'slidetitle4',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt_full_width'),
		'id' => 'slidedesc4',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'skt_full_width'),
		'id' => 'slideurl4',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 5', 'skt_full_width'),
		'desc' => __('Fifth Slide', 'skt_full_width'),
		'id' => 'slide5',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'skt_full_width'),
		'id' => 'slidetitle5',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt_full_width'),
		'id' => 'slidedesc5',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'skt_full_width'),
		'id' => 'slideurl5',
		'std' => '',
		'type' => 'text');	
			
	//Social Settings
	
	$options[] = array(
		'name' => __('Social Settings', 'skt_full_width'),
		'type' => 'heading');
	
	$options[] = array(
		'desc' => __('Please set the value of following fields, as per the instructions given along. If you do not want to use an icon, just leave it blank. If some icons are showing up, even when no value is set then make sure they are completely blank, and just save the options once. They will not be shown anymore.', 'skt_full_width'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Facebook', 'skt_full_width'),
		'desc' => __('Facebook Profile or Page URL i.e. http://facebook.com/username/ ', 'skt_full_width'),
		'id' => 'facebook',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter', 'skt_full_width'),
		'desc' => __('Twitter Username', 'skt_full_width'),
		'id' => 'twitter',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Google Plus', 'skt_full_width'),
		'desc' => __('Google Plus profile url, including "http://"', 'skt_full_width'),
		'id' => 'google',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Linkedin', 'skt_full_width'),
		'desc' => __('Linkedin URL', 'skt_full_width'),
		'id' => 'linkedin',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');	

	
	// Contact Details
		$options[] = array(
		'name' => __('Contact Details', 'skt_full_width'),
		'type' => 'heading');
	
		$options[] = array(
		'desc' => __('Company Name', 'skt_full_width'),
		'id' => 'contact1',
		'std' => 'Full Width',
		'type' => 'text');	
		
		$options[] = array(
		'desc' => __('Address 1', 'skt_full_width'),
		'id' => 'contact2',
		'std' => '123 Some Street',
		'type' => 'text');	
		
		$options[] = array(
		'desc' => __('Address 2', 'skt_full_width'),
		'id' => 'contact3',
		'std' => 'California, USA',
		'type' => 'text');
		
		$options[] = array(
		'desc' => __('Phone', 'skt_full_width'),
		'id' => 'contact4',
		'std' => '100 2000 300',
		'type' => 'text');
		
		$options[] = array(
		'desc' => __('Email', 'skt_full_width'),
		'id' => 'contact5',
		'std' => 'info@example.com',
		'type' => 'text');	
		
				
	// Support					
		$options[] = array(
		'name' => __('Our Themes', 'skt_full_width'),
		'type' => 'heading');
		
	$options[] = array(
		'desc' => __('SKT Full Width WordPress theme has been Designed and Created by SKT Themes.', 'skt_full_width'),
		'type' => 'info');	
		
	 $options[] = array(
		'desc' => __('<a href="http://twitter.com/sktthemes" target="_blank"><img src="'.get_bloginfo('template_url').'/images/sktskill.jpg"></a>', 'skt_full_width'),
		'type' => 'info');	
	
	
	return $options;
}