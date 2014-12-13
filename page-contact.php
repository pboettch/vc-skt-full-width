<?php
//error_reporting(E_ALL ^ E_NOTICE);
/* Template name: Contact */
get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content container">
		<main id="main" class="site-main" role="main">
			<div class="blog-post">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>
                
				<?php 
				$showForm = of_get_option('contact6', true);
				if( $showForm != '1' ){
					$err = array();
					if( isset($_POST['submit']) && $_POST['submit']=='Submit' ){
						$fullname	= trim($_POST['plc_name']);
						$phone 		= trim($_POST['plc_phone']);
						$email 		= trim($_POST['plc_email']);
						$message 	= trim($_POST['plc_message']);
						$capCnf		= $_POST['captcha_confirm'];
						$capVal		= $_POST['plc_captcha'];
						
						if( empty($fullname) )
							$err['fullname'] = 'Required: Name';
						if( empty($phone) )
							$err['phone'] = 'Required: Phone';
						if(!filter_var($email, FILTER_VALIDATE_EMAIL))
							$err['email'] = "Invalid email, please correct.";
						if( $capCnf !== $capVal )
							$err['captcha'] = 'Invalid captcha';
					
						if ( count($err) == 0 ) { 
							$mms  = '';
							$mms .= 'Following enquiry has been received;<br /><br />';
							$mms .= 'Name: '.$fullname.'<br />';
							$mms .= 'Email: '.$email.'<br />';
							$mms .= 'Phone: '.$phone.'<br />';
							$mms .= ( !empty($message) ) ? 'Message: '.nl2br($message).'<br />' : '';
	
							$to  	  = get_bloginfo('admin_email');
							$subject  = 'Contact Enquiry - '.get_option('blogname');
							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: '.$fullname.'<'.$email.'>' . "\r\n";
	
							if( mail($to, $subject, $mms, $headers) ){
								echo '<script>window.location.href="'.get_permalink().'?sent=1";</script>';
							}
						}
					} 
					if( count($err) > 0 && !isset($_GET['sent']) ){
						echo '<div class="errorbox">';
						echo implode('<br>',$err);
						echo '</div>';
					}
					if( isset($_GET['sent']) && $_GET['sent'] == 1 && count($err) == 0 ){
						echo '<div class="successbox">Thank you! Your request has been recieved</div>';
					}
	
					$num1 	= rand(1,5);
					$num2 	= rand(1,5);
					$capVal = $num1 + $num2;
					?>
					<form method="post" action="" id="contactform">
						<input type="hidden" name="captcha_confirm" value="<?php echo $capVal; ?>">
						<p><input type="text" placeholder="Name*" class="inputfield" name="plc_name" value="<?php echo ( isset($fullname) ) ? $fullname : '';?>" /></p>
						<p><input type="text" placeholder="Phone Number*" class="inputfield" name="plc_phone" value="<?php echo ( isset($phone) ) ? $phone : '';?>" /></p>
						<p><input type="email" placeholder="Email Address*" class="inputfield" name="plc_email" value="<?php echo ( isset($email) ) ? $email : '';?>" /></p>
						<p><textarea placeholder="Message" name="plc_message" class="inputfield"><?php echo ( isset($message) ) ? $message : '';?></textarea></p>
						<p>Sum of <?php echo $num1.' and '.$num2.' &nbsp; ('.$num1.' + '.$num2.')';?> &nbsp; <input type="text" placeholder="captcha" name="plc_captcha" class="inputfield wd90" /></p>
						<p><input type="submit" value="Submit" name="submit"></p>
					</form>
				<?php } ?>
			</div><!-- blog-post -->
			<div id="sidebar-contact">
                <h1 class="widget-title">Contact Details</h1>
				<?php if( of_get_option('contact1', true) != '' ) {?><h3 class="company-title"><?php echo of_get_option('contact1', true); ?></h3><?php } ?>
	            <p>
				<?php echo (of_get_option('contact2', true) != '') ? of_get_option('contact2', true).'<br />' : ''; ?>
				<?php echo (of_get_option('contact3', true) != '') ? of_get_option('contact3', true).'<br />' : ''; ?>
				<?php if(of_get_option('contact4', true) != '') { ?><strong>Phone :</strong> <?php echo of_get_option('contact4', true); ?><br /><?php } ?>
				<?php if(of_get_option('contact5', true) != '') { ?><strong>Email :</strong> <?php echo of_get_option('contact5', true); ?><?php } ?>
                </p>
            </div><!-- sidebar -->
            <div class="clear"></div>
		</main><!-- main -->

<script src="<?php echo get_template_directory_uri();?>/js/modernizr.js"></script>
<script>
jQuery(document).ready(function(){
if(!Modernizr.input.placeholder){
	jQuery('[placeholder]').focus(function() {
		var input = jQuery(this);
		if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = jQuery(this);
		if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();
	jQuery('[placeholder]').parents('form').submit(function() {
		jQuery(this).find('[placeholder]').each(function() {
			var input = jQuery(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
			}
		})
	});
}
});
</script>

<?php get_footer(); ?>