<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package oliord
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/intlTelInput.css">
<script src="<?php echo get_template_directory_uri();?>/assets/js/intlTelInput.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/js/owl.carousel.js"></script>		
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/owl.carousel.css" />	
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets//css/owl.theme.css"  />	
	<script src="<?php echo get_template_directory_uri();?>/assets/js/custom.js"></script> 

<script>
$(function(){
jQuery('.country_to_state').on('change',function(){
	contry = jQuery(this).val();
	var data = {
		action: 'change_state',
		contry: contry
	};
	jQuery.post('<?php echo admin_url('admin-ajax.php');?>', data, function(response) {
		jQuery(".billing_state").html(response);
	});	
});
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	
		 <?php if(is_page( array( 'forgot-password'))) { ?><div class="container">
			<div class="row">
				<div class="seller-login-logo">
						<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );							
							echo '<a href="'.get_site_url().'"><img src="'. get_template_directory_uri() .'/images/logo.png"></a>';
						?>
				</div>
			</div>

		</div><?php } ?>
	
	
<!--<div class="container"> -->

<div class="clearfix"></div>	
<div class="container">

	
