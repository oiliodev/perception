<?php

/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Contact to seller
 *
 */

if ( !is_user_logged_in()) {
    wp_redirect(site_url().'/seller-login'); 
    exit;
}

if(!isset($_REQUEST['product_id'])){
	ob_start();
    wp_redirect(site_url());
    ob_end_flush();
	exit;	
}
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!empty($_POST)){
	
	$product_id		=	$_REQUEST['product_id'];
	$string			=	stripslashes($_REQUEST['message']);
	$matches 		= 	extract_email_addresses( $string );
	$vendor_id 		= 	get_post_field( 'post_author', $product_id );	
	$user		 	= 	new WP_User(absint($vendor_id));
	$to				=	$user->user_email;
	
	preg_match_all('/[(]*\d{3}[)]*\s*[.\-\s]*\d{3}[.\-\s]*\d{4}/', $string, $matches_mobile);

	$matches_mobile_no 	= 	$matches_mobile[0];	
	$arr				= 	array_merge($matches_mobile_no,$matches);  
	$message			=	str_replace($arr,'******',$string);	

	$to = 'user2barbier@gmail.com';		
	$name = get_bloginfo('name');    
	$email_from	=	"admin@olio.com";
	$subject	=	"Inquiry";
	
	$headers = array('From: '.$name.' <'.$email_from.'>');
	$subject 	=	$subject;	
	$headers[] 	= 	'Content-Type: text/html; charset=UTF-8';
	wp_mail( $to, $subject, $message, $headers );
	if(wp_mail == true){
		$msg = "Successfully mail sent";
	}
	//~ }

}
get_header( 'shop' ); ?>
<script>
$(document).ready(function() {
    var text_max = 4000;
    $('#textarea_feedback').html(text_max + ' characters remaining');

    $('#textarea').keyup(function() {
        var text_length = $('#textarea').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_remaining + ' characters remaining');
    });
});    
</script>
<div class="container woocommerce detail-part">
	<?php if(isset($msg)){
			echo $msg;
		}
	?>
	<form method="post" enctype="multipart/form-data">
	<div class="contact-seller product row">
		<div class="detail-dcs col-sm-12">
			<?php 
				$product_id	= $_REQUEST['product_id'];
				$vendor_id 		= 	get_post_field( 'post_author', $product_id );
				$user		 	= 	new WP_User(absint($vendor_id));
				$membership		=	get_user_meta($vendor_id, 'membership');
				$manufacture	=	get_post_meta( $product_id, 'manufacture');
				
				$product = wc_get_product( $product_id );
			
				?>
				<div class="vendor_name" style="color:#868686;font-size:24px;font-weight:normal;vertical-align:middle"><?php echo $manufacture[0]; ?></div>
				<?php
				if($user->roles[0] == "dc_vendor"){
					echo '<div class="member_plan align-top">'.$membership[0].'</div>';
				}
			?>
			<hr class="mt-2" />
		</div>		
		<div class="col-sm-12">
			<?php 			
				$image			= 	get_the_post_thumbnail_url($product_id,'shop_thumbnail');
			?>	
			<div class="product-overlay d-inline-block align-top">
				<a href="<?php the_permalink($product_id); ?>"><img class="product-img" src="<?php echo $image;?>"></a>
			</div>
			<div class="d-inline-block pl-4">
				<h1 class="product_title entry-title"><?php echo $product->get_title(); ?></h1>
				<input class="input-text qty text form-control w-auto" step="1" min="0"  max="9999" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" type="number" style="max-width:5.625rem" />
			</div>
			<hr class="mb-4" />
		</div>
	</div>	
	<div class="form-group">
		<label class="d-block w-100">Message <span style="color:#868686;font-size:12px;">(Enter product details such as color, size, materials etc. and other specific requirements to receive an accurate quote.)</span></label>
		<div class="position-relative" style="position:relative">
			<textarea class="form-control" name="message" id="textarea" rows="8" cols="30" maxlength="4000"></textarea>
			<div id="textarea_feedback" class="position-absolute" style="color:#868686;font-size:12px;position:absolute;right:10px;bottom:10px;"></div>
		</div>
	</div>
	<div>
		<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
		<input class="btn btn-warning text-uppercase font-weight-bold h6" type="submit" value="Contact Seller" name="contact_seller">
	</div>
	</form>
</div>
<?php 
function extract_email_addresses($str){
    $emails = array();
    $str = strip_tags( $str );
    $str = preg_replace('/\s+/', ' ', $str); 
    $str = preg_replace("/[\n\r]/", "", $str); 
    $remove_chars = array (',', "<", ">", ";", "'", ". ");
    $str = str_replace( $remove_chars, ' ', $str );
    $parts = explode(' ', $str);
    if(count($parts) > 0){
        foreach($parts as $part){
            $part = trim($part);
            if( $part != '' ) {
                if( filter_var($part, FILTER_VALIDATE_EMAIL) !== false){
                    $emails[] = $part;
                }                
            }
        }
    }
    if(count($emails) > 0){
        return $emails;
    }
    else{
        return null;
    }
}
get_footer( 'shop' );
