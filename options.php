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
 * If you are making your theme translatable, you should replace 'skt-full-width'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();
	$imagepath =  get_template_directory_uri() . '/images/';
		
	
	//Basic Settings
	
	$options[] = array(
		'name' => __('Basic Settings', 'skt-full-width'),
		'type' => 'heading');
		
		$options[] = array(
		'name' => __('Logo', 'skt-full-width'),
		'desc' => __('Upload your logo here', 'skt-full-width'),
		'id' => 'logo',
		'class' => '',
		'std'	=> get_template_directory_uri()."/images/logo.png",
		'type' => 'upload');
				
		
	$options[] = array(
		'name' => __('Copyright Text', 'skt-full-width'),
		'desc' => __('Some Text regarding copyright of your site, you would like to display in the footer.', 'skt-full-width'),
		'id' => 'footertext2',
		'std' => 'Full Width 2014. All Rights Reserved',
		'type' => 'text');
	
	//Layout Settings
		
	$options[] = array(
		'name' => __('Layout Settings', 'skt-full-width'),
		'type' => 'heading');	
	
	$options[] = array(
		'name' => "Header Layout",
		'desc' => "Select Layout for Menu position.",
		'id' => "sidebar-layout",
		'std' => "left",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array(
		'name' => __('Custom CSS', 'skt-full-width'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'skt-full-width'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
	
	//SLIDER SETTINGS

	$options[] = array(
		'name' => __('Homepage Slider', 'skt-full-width'),
		'type' => 'heading');

	/*$options[] = array(
		'name' => __('Enable Slider', 'skt-full-width'),
		'desc' => __('Check this to Enable Slider.', 'skt-full-width'),
		'id' => 'slider_enabled',
		'type' => 'checkbox',
		'std' => '' );*/
		
	$options[] = array(
		'name' => __('Slider Image 1', 'skt-full-width'),
		'desc' => __('First Slide', 'skt-full-width'),
		'id' => 'slide1',
		'class' => '',
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'skt-full-width'),
		'id' => 'slidetitle1',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-full-width'),
		'id' => 'slidedesc1',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'skt-full-width'),
		'id' => 'slideurl1',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 2', 'skt-full-width'),
		'desc' => __('Second Slide', 'skt-full-width'),
		'class' => '',
		'id' => 'slide2',
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'skt-full-width'),
		'id' => 'slidetitle2',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-full-width'),
		'id' => 'slidedesc2',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'skt-full-width'),
		'id' => 'slideurl2',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Slider Image 3', 'skt-full-width'),
		'desc' => __('Third Slide', 'skt-full-width'),
		'id' => 'slide3',
		'class' => '',
		'type' => 'upload');	
	
	$options[] = array(
		'desc' => __('Title', 'skt-full-width'),
		'id' => 'slidetitle3',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-full-width'),
		'id' => 'slidedesc3',
		'std' => '',
		'type' => 'textarea');	
			
	$options[] = array(
		'desc' => __('Url', 'skt-full-width'),
		'id' => 'slideurl3',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 4', 'skt-full-width'),
		'desc' => __('Fourth Slide', 'skt-full-width'),
		'id' => 'slide4',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'skt-full-width'),
		'id' => 'slidetitle4',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-full-width'),
		'id' => 'slidedesc4',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'skt-full-width'),
		'id' => 'slideurl4',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 5', 'skt-full-width'),
		'desc' => __('Fifth Slide', 'skt-full-width'),
		'id' => 'slide5',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'skt-full-width'),
		'id' => 'slidetitle5',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-full-width'),
		'id' => 'slidedesc5',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'skt-full-width'),
		'id' => 'slideurl5',
		'std' => '',
		'type' => 'text');	
			
	//Social Settings
	
	$options[] = array(
		'name' => __('Social Settings', 'skt-full-width'),
		'type' => 'heading');
	
	$options[] = array(
		'desc' => __('Please set the value of following fields, as per the instructions given along. If you do not want to use an icon, just leave it blank. If some icons are showing up, even when no value is set then make sure they are completely blank, and just save the options once. They will not be shown anymore.', 'skt-full-width'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Facebook', 'skt-full-width'),
		'desc' => __('Facebook Profile or Page URL i.e. http://facebook.com/username/ ', 'skt-full-width'),
		'id' => 'facebook',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter', 'skt-full-width'),
		'desc' => __('Twitter Username', 'skt-full-width'),
		'id' => 'twitter',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Google Plus', 'skt-full-width'),
		'desc' => __('Google Plus profile url, including "http://"', 'skt-full-width'),
		'id' => 'google',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Linkedin', 'skt-full-width'),
		'desc' => __('Linkedin URL', 'skt-full-width'),
		'id' => 'linkedin',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');	

	
	// Contact Details
		$options[] = array(
		'name' => __('Contact Details for footer', 'skt-full-width'),
		'type' => 'heading');
	
		$options[] = array(
		'desc' => __('Company Name', 'skt-full-width'),
		'id' => 'contact1',
		'std' => 'Full Width',
		'type' => 'text');	
		
		$options[] = array(
		'desc' => __('Address 1', 'skt-full-width'),
		'id' => 'contact2',
		'std' => '123 Some Street',
		'type' => 'text');	
		
		$options[] = array(
		'desc' => __('Address 2', 'skt-full-width'),
		'id' => 'contact3',
		'std' => 'California, USA',
		'type' => 'text');
		
		$options[] = array(
		'desc' => __('Phone', 'skt-full-width'),
		'id' => 'contact4',
		'std' => '100 2000 300',
		'type' => 'text');
		
		$options[] = array(
		'desc' => __('Email', 'skt-full-width'),
		'id' => 'contact5',
		'std' => 'info@example.com',
		'type' => 'text');	

	// Support					
		$options[] = array(
		'name' => __('Our Themes', 'skt-full-width'),
		'type' => 'heading');
		
	$options[] = array(
		'desc' => __('SKT Full Width WordPress theme has been Designed and Created by SKT Themes.', 'skt-full-width'),
		'type' => 'info');	
		
	 $options[] = array(
		'desc' => __('<a href="'.SKT_THEME_URL.'" target="_blank"><img src="'.get_template_directory_uri().'/images/sktskill.jpg"></a>', 'skt-full-width'),
		'type' => 'info');	
	
	
	return $options;
}