<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Seller Registration
 *
 * @package storefront
 */
 
 if ( is_user_logged_in()) {
	ob_start();
    wp_redirect(site_url());
    ob_end_flush();
	exit;
}

if ( isset( $_POST['seller_register_nonce'] ) && wp_verify_nonce( $_POST['seller_register_nonce'], 'seller_register' ) ) {
	
	
	$billing_first_name		=	sanitize_text_field($_POST['billing_first_name']);	
	$username				=	trim($_POST['username']);
	$password				=	$_POST['password'];
	$email					=	$_POST['email'];
	$billing_address_1			=	sanitize_text_field($_POST['billing_address_1']);	
	$billing_address_2			=	sanitize_text_field($_POST['billing_address_2']);
	$billing_country			=	$_POST['billing_country'];	
	$billing_state				=	sanitize_text_field($_POST['billing_state']);
	$billing_city				=	sanitize_text_field($_POST['billing_city']);
	$billing_postcode			=	$_POST['billing_postcode'];	
	$billing_phone				=	$_POST['billing_phone'];	
	$juridicial_person_name		=	sanitize_text_field($_POST['juridicial_person_name']);
	$juridicial_person_email	=	sanitize_text_field($_POST['juridicial_person_email']);
	
	$info = array();
	$info['first_name'] =	$billing_first_name;
  	$info['user_login'] =	sanitize_user($username) ;
  	$info['user_pass'] 	= 	sanitize_text_field($password);
	$info['user_email'] = 	sanitize_email( $email);
	$info['show_admin_bar_front']	=	 false;
	$info['role'] = 'dc_pending_vendor';
	
	
		$sellerId = wp_insert_user( $info );
		if (is_wp_error($sellerId)){
			$error  = $sellerId->get_error_codes()	;		
			if(in_array('empty_user_login', $error))
				$message = $sellerId->get_error_message('empty_user_login');
			elseif(in_array('existing_user_login',$error))
				$message = 'This username is already registered.';
			elseif(in_array('existing_user_email',$error))
				$message = 'This email address is already registered.';
		}else{
			$basedir = wp_upload_dir();
			//~ $uploads	=	$basedir['basedir'].'/vendor_documents/'.$sellerId; 
				$uploads	=	$basedir['basedir'].'/vendor_documents'; 
			
			  if ( isset( $billing_first_name ) ) {
				update_user_meta( $sellerId, 'first_name', sanitize_text_field( $billing_first_name ) );
				update_user_meta( $sellerId, 'billing_first_name', sanitize_text_field( $billing_first_name ) );
			   }
			   if ( isset( $username ) ) {
					  update_user_meta( $sellerId, 'last_name', sanitize_text_field( $username ) );
					  update_user_meta( $sellerId, 'billing_last_name', sanitize_text_field( $username ) );
			   }

			   if ( isset( $billing_phone ) ) {
					update_user_meta( $sellerId, 'billing_phone', sanitize_text_field( $billing_phone) );
			   }
			   if ( isset( $billing_address_1 ) ) {
					update_user_meta( $sellerId, 'billing_address_1', sanitize_text_field( $billing_address_1 ) );
			   }
			   if ( isset( $billing_address_2 ) && $billing_address_2 !="" ) {
					update_user_meta( $sellerId, 'billing_address_2', sanitize_text_field( $billing_address_2 ) );
			   }
			   if ( isset( $billing_country ) ) {
					update_user_meta( $sellerId, 'billing_country', sanitize_text_field( $billing_country ) );
			   }
			   if ( isset( $billing_state ) && $billing_state !="") {
					update_user_meta( $sellerId, 'billing_state', sanitize_text_field( $billing_state ) );
			   }
			   if ( isset( $billing_city )  && $billing_city !="") {
					update_user_meta( $sellerId, 'billing_city', sanitize_text_field( $billing_city ) );
			   }
			   if ( isset( $billing_postcode ) ) {
					update_user_meta( $sellerId, 'billing_postcode', sanitize_text_field( $billing_postcode));
			   }			   
			   if ( isset( $juridicial_person_name )  && $juridicial_person_name != "" ) {
					update_user_meta( $sellerId, 'juridicial_person_name', sanitize_text_field( $juridicial_person_name));
			   }			   
			   if ( isset( $juridicial_person_email ) && $juridicial_person_email != "" ) {
					update_user_meta( $sellerId, 'juridicial_person_email', sanitize_text_field( $juridicial_person_email));
			   }
			   
			   if(isset($_FILES['business_license']['name']) && $_FILES['business_license']['name'] != ""){
				  $business_license_dir	=	$uploads.'/business_license/';
				   //~ if (!file_exists($business_license_dir) == true) {					   
						//~ mkdir($business_license_dir, 0777);
					//~ }
	
					$target = $business_license_dir . basename( $_FILES['business_license']['name']) ;
					if(move_uploaded_file($_FILES['business_license']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'business_license', '/vendor_documents/'.$sellerId.'/business_license/'.basename( $_FILES['business_license']['name']));
						$val_business_license	=	'/vendor_documents/business_license/'.basename( $_FILES['business_license']['name']);
						update_user_meta( $sellerId, 'business_license', sanitize_text_field($val_business_license));
					}
			   }
			   
			   if(isset($_FILES['business_license']['name']) && $_FILES['business_license']['name'] != ""){
				  $business_license_dir	=	$uploads.'/business_license/';
				   //~ if (!file_exists($business_license_dir) == true) {					   
						//~ mkdir($business_license_dir, 0777);
					//~ }
					$target = $business_license_dir . basename( $_FILES['business_license']['name']) ;
					if(move_uploaded_file($_FILES['business_license']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'business_license', '/vendor_documents/'.$sellerId.'/business_license/'.basename( $_FILES['business_license']['name']));
						$val_business_license	=	'/vendor_documents/business_license/'.basename( $_FILES['business_license']['name']);						
						update_user_meta( $sellerId, 'business_license', sanitize_text_field($val_business_license));
					}
			   }
			   
			   if(isset($_FILES['business_license']['name']) && $_FILES['business_license']['name'] != ""){
				  $business_license_dir	=	$uploads.'/business_license/';
				   //~ if (!file_exists($business_license_dir) == true) {					   
						//~ mkdir($business_license_dir, 0777);
					//~ }
					$target = $business_license_dir . basename( $_FILES['business_license']['name']) ;
					if(move_uploaded_file($_FILES['business_license']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'business_license', '/vendor_documents/'.$sellerId.'/business_license/'.basename( $_FILES['business_license']['name']));
						$val_business_license	=	'/vendor_documents/business_license/'.basename( $_FILES['business_license']['name']);						
						update_user_meta( $sellerId, 'business_license', sanitize_text_field($val_business_license));
					}
			   }
			   
			   if(isset($_FILES['business_license']['name']) && $_FILES['business_license']['name'] != ""){
				  $business_license_dir	=	$uploads.'/business_license/';
				   //~ if (!file_exists($business_license_dir) == true) {					   
						//~ mkdir($business_license_dir, 0777);
					//~ }
	
					$target = $business_license_dir . basename( $_FILES['business_license']['name']) ;
					if(move_uploaded_file($_FILES['business_license']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'business_license', '/vendor_documents/'.$sellerId.'/business_license/'.basename( $_FILES['business_license']['name']));
						$val_business_license	=	'/vendor_documents/business_license/'.basename( $_FILES['business_license']['name']);						
						update_user_meta( $sellerId, 'business_license', sanitize_text_field($val_business_license));
					}
			   }
			   
			   
			    if(isset($_FILES['business_license_certified']['name']) && $_FILES['business_license_certified']['name'] != ""){
				  $business_license_certified_dir	=	$uploads.'/business_license_certified/';
				   //~ if (!file_exists($business_license_certified_dir) == true) {					   
						//~ mkdir($business_license_certified_dir, 0777);
					//~ }
					$target = $business_license_certified_dir . basename( $_FILES['business_license_certified']['name']) ;
					if(move_uploaded_file($_FILES['business_license_certified']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'business_license_certified', '/vendor_documents/'.$sellerId.'/business_license_certified/'.basename( $_FILES['business_license_certified']['name']));
						$val_business_license_certified	=	'/vendor_documents/business_license_certified/'.basename( $_FILES['business_license_certified']['name']);						
						update_user_meta( $sellerId, 'business_license_certified', sanitize_text_field($val_business_license_certified));
					}
			   }
			   
			     if(isset($_FILES['import_export_business_certified']['name']) && $_FILES['import_export_business_certified']['name'] != ""){
				  $import_export_business_certified_dir	=	$uploads.'/import_export_business_certified/';
				   //~ if (!file_exists($import_export_business_certified_dir) == true) {					   
						//~ mkdir($import_export_business_certified_dir, 0777);
					//~ }
	
					$target = $import_export_business_certified_dir . basename( $_FILES['import_export_business_certified']['name']) ;
					if(move_uploaded_file($_FILES['import_export_business_certified']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'import_export_business_certified', '/vendor_documents/'.$sellerId.'/import_export_business_certified/'.basename( $_FILES['import_export_business_certified']['name']));
						$val_import_export_business_certified	=	'/vendor_documents/import_export_business_certified/'.basename( $_FILES['import_export_business_certified']['name']);						
						update_user_meta( $sellerId, 'import_export_business_certified', sanitize_text_field($val_import_export_business_certified));
					}
			   }
			   
			      if(isset($_FILES['import_export_business_enterprise']['name']) && $_FILES['import_export_business_enterprise']['name'] != ""){
				  $import_export_business_enterprise_dir	=	$uploads.'/import_export_business_enterprise/';
				   //~ if (!file_exists($import_export_business_enterprise_dir) == true) {					   
						//~ mkdir($import_export_business_enterprise_dir, 0777);
					//~ }
	
					$target = $import_export_business_enterprise_dir . basename( $_FILES['import_export_business_enterprise']['name']) ;
					if(move_uploaded_file($_FILES['import_export_business_enterprise']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'import_export_business_enterprise', '/vendor_documents/'.$sellerId.'/import_export_business_enterprise/'.basename( $_FILES['import_export_business_enterprise']['name']));
						$val_import_export_business_enterprise	=	'/vendor_documents/import_export_business_enterprise/'.basename( $_FILES['import_export_business_enterprise']['name']);						
						update_user_meta( $sellerId, 'import_export_business_enterprise', sanitize_text_field($val_import_export_business_enterprise));
					}
			   }
			   
			    if(isset($_FILES['juridicial_person_photo']['name']) && $_FILES['juridicial_person_photo']['name'] != ""){
				  $juridicial_person_photo_dir	=	$uploads.'/juridicial_person_photo/';
				   //~ if (!file_exists($juridicial_person_photo_dir) == true) {					   
						//~ mkdir($juridicial_person_photo_dir, 0777);
					//~ }
	
					$target = $juridicial_person_photo_dir . basename( $_FILES['juridicial_person_photo']['name']) ;
					if(move_uploaded_file($_FILES['juridicial_person_photo']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'juridicial_person_photo', '/vendor_documents/'.$sellerId.'/juridicial_person_photo/'.basename( $_FILES['juridicial_person_photo']['name']));
						$val_juridicial_person_photo	=	'/vendor_documents/juridicial_person_photo/'.basename( $_FILES['juridicial_person_photo']['name']);						
						update_user_meta( $sellerId, 'juridicial_person_photo', sanitize_text_field($val_juridicial_person_photo));
					}
			   }
			   
			      if(isset($_FILES['insurance']['name']) && $_FILES['insurance']['name'] != ""){
				  $insurance_dir	=	$uploads.'/insurance/';
				   //~ if (!file_exists($insurance_dir) == true) {					   
						//~ mkdir($insurance_dir, 0777);
					//~ }
	
					$target = $insurance_dir . basename( $_FILES['insurance']['name']) ;
					if(move_uploaded_file($_FILES['insurance']['tmp_name'], $target)){
						//~ update_user_meta( $sellerId, 'insurance', '/vendor_documents/'.$sellerId.'/insurance/'.basename( $_FILES['insurance']['name']));
						$val_insurance	=	'/vendor_documents/insurance/'.basename( $_FILES['insurance']['name']);						
						update_user_meta( $sellerId, 'insurance', sanitize_text_field($val_insurance));
					}
			   }
			   
				ob_start();
				wp_redirect(site_url().'/thanks-for-registration');
				ob_end_flush();
				exit;
		}

}

get_header('sellerlogin');
//~ get_header('dealer');

global $woocommerce;
?>	
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/intlTelInput.css">
<script src="<?php echo get_template_directory_uri();?>/assets/js/intlTelInput.js"></script> 
<script>
	$(function(){
      $("#reg_billing_phone").intlTelInput();
      
      	jQuery("#seller_reg_form").on("submit",function(e){
		var form = jQuery('#seller_reg_form');
		
		if($("#seller_agreement"). prop("checked") == false){
				
				jQuery(".woocommerce-error").html('Please check terms and conditions of the Olio business.');
				jQuery("#seller_agreement").focus();				
				$(".woocommerce-error").show();
				jQuery('html,body').animate({
						scrollTop: jQuery(".woocommerce-error").offset().top},'slow'
				);
				
				return false;
		}else {
			return true;
		}
	});
	
	$("#back_first_form").click(function(){
		$(".secound_stpes_div").hide(1000);
		$(".first_steps_div").show(1000);
	});
    
      $("#secound_stpes").click(function(){
		  var err = 0;
			if(jQuery("#reg_billing_first_name").val()	==	""){				
				jQuery(".woocommerce-error").html('Please enter name.');
				jQuery("#reg_billing_first_name").focus();		
				var err = 1;
			}else if(jQuery("#reg_username").val()	==	""){				
				jQuery(".woocommerce-error").html('Please enter username.');
				jQuery("#reg_username").focus();
				var err = 1;
			}else if(jQuery("#reg_email").val()	==	""){
				jQuery(".woocommerce-error").html('Please enter email address.');
				jQuery("#reg_email").focus();		
				var err = 1;
			}else if(jQuery("#reg_password").val()	==	""){				
				jQuery(".woocommerce-error").html('Please enter password.');				
				jQuery("#reg_password").focus();		
				var err = 1;
			}else if(jQuery("#billing_address_1").val()	==	""){
				jQuery(".woocommerce-error").html('Please enter address.');
				jQuery("#billing_address_1").focus();		
				var err = 1;
			}else if(jQuery("#billing_country").val()	==	""){
				jQuery(".woocommerce-error").html('Please select country.');
				jQuery("#billing_country").focus();
				var err = 1;
			}else if(jQuery("#billing_city").val()	==	""){
				jQuery(".woocommerce-error").html('Please enter city.');
				jQuery("#billing_city").focus()
				var err = 1;;		
			}else if(jQuery("#billing_postcode").val()	==	""){
				jQuery(".woocommerce-error").html('Please enter postcode.');
				jQuery("#billing_postcode").focus();		
				var err = 1;
			}else if(jQuery("#reg_billing_phone").val()	==	""){
				jQuery(".woocommerce-error").html('Please enter phone number.');
				jQuery("#reg_billing_phone").focus();
				var err = 1;
			}
			if(err == 1){
				$(".woocommerce-error").show();
				jQuery('html,body').animate({
						scrollTop: jQuery(".woocommerce-error").offset().top},'slow'
				);
			}else{
				$(".woocommerce-error").hide();
				$(".secound_stpes_div").show(1000);
				$(".first_steps_div").hide(1000);
			}
	});
  });
</script>

		<div class="registration login-page">
<?php wc_print_notices(); ?>		
		<h3><?php _e( 'Seller Register', 'woocommerce' ); ?></h3>
		<?php 
		if($message != ""){ ?>
			<h6 class="woocommerce-error"><?php echo $message; ?></h6>
		<?php 	}  else { ?>
		<h6 class="woocommerce-error" style="display:none;"></h6>
		<?php } ?>
		<form method="post" enctype="multipart/form-data" id="seller_reg_form" class="register">
		<div class="first_steps_div">
		<fieldset class="form-group">
		   <label for="reg_billing_first_name" class="name-form"><?php _e( 'Name', 'woocommerce' ); ?></label>
		   <input type="text" autocomplete="off" class="form-control" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       </fieldset>
       
       <fieldset class="form-group">
			<label for="reg_username" class="name-form"><?php _e( 'Username', 'woocommerce' ); ?> </label>
			<input type="text" autocomplete="off" class="form-control" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
		</fieldset>
		
       	<fieldset class="form-group">
				<label for="reg_email" class="name-form"><?php _e( 'Email address', 'woocommerce' ); ?> </label>
				<input type="email" autocomplete="off" class="form-control" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
			</fieldset>


		<fieldset class="form-group">
			<label for="reg_password" class="name-form"><?php _e( 'Password', 'woocommerce' ); ?> </label>
			<input type="password" autocomplete="off" class="form-control" name="password" id="reg_password" />
		</fieldset>
       
	<fieldset class="form-group">
		<label for="reg_billing_address_1" class="name-form"><?php _e( 'Street address', 'woocommerce' ); ?> </label>
		<input autocomplete="off" type="text" class="form-control" name="billing_address_1" id="billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" /><br>
		<input type="text" class="form-control" name="billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" />
    </fieldset>
    
     <?php
    wp_enqueue_script( 'wc-country-select' );
    wp_enqueue_script( 'wc-state-select' );

    woocommerce_form_field( 'billing_country', array(
        'type'      => 'country',
        'id'      => 'billing_country',
        'class'     => array('chzn-drop'),
        'label'     => __('Country'),
        'placeholder' => __('Choose your country.'),
        'clear'     => true
    ));
  
  global $woocommerce;
    $countries_obj   = new WC_Countries();
    $countries   = $countries_obj->__get('countries');
    $default_country = $countries_obj->get_base_country();
    $default_county_states = $countries_obj->get_states( $default_country );
    ?>
     <fieldset class="form-group billing_state" >
		<label for="billing_state" class="name-form"><?php _e( 'State/Province', 'woocommerce' ); ?></label>
		<input autocomplete="off" type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if ( ! empty( $_POST['billing_state'] ) ) esc_attr_e( $_POST['billing_state'] ); ?>" />
     </fieldset>    
    
      <fieldset class="form-group">
		   <label for="reg_billing_city" class="name-form"><?php _e( 'City', 'woocommerce' ); ?></label>
		   <input autocomplete="off" type="text" class="form-control" name="billing_city" id="billing_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
       </fieldset>
       
         <fieldset class="form-group">
		   <label for="reg_billing_postcode" class="name-form"><?php _e( 'Zip/Postal Code', 'woocommerce' ); ?></label>
		   <input autocomplete="off" type="text" class="form-control" name="billing_postcode" id="billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
       </fieldset>

       <fieldset class="form-group">
			<label for="reg_billing_phone" class="name-form"><?php _e( 'Mobile Number', 'woocommerce' ); ?></label>
			<input autocomplete="off" type="tel" class="form-control" name="billing_phone"  placeholder="e.g. +1 702 123 4567" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
       </fieldset>
       
       <fieldset class="form-group register-btn-top">		
			<input type="button" class="btn btn-warning" id="secound_stpes" value="<?php esc_attr_e( 'Next', 'woocommerce' ); ?>" />
		</fieldset>
			
	</div>	
	
	<div class="secound_stpes_div" style="display:none;">	
		
		 <fieldset class="form-group">
		   <label for="juridicial_person_name" class="name-form"><?php _e( 'Juridicial Person Name', 'woocommerce' ); ?></label>
		   <input autocomplete="off" type="text" class="form-control" name="juridicial_person_name" id="juridicial_person_name" value="<?php if ( ! empty( $_POST['juridicial_person_name'] ) ) esc_attr_e( $_POST['juridicial_person_name'] ); ?>" />
       </fieldset>
       
         <fieldset class="form-group">
		   <label for="juridicial_person_email" class="name-form"><?php _e( 'Juridicial Person Email', 'woocommerce' ); ?></label>
		   <input autocomplete="off" type="email" class="form-control" name="juridicial_person_email" id="juridicial_person_email" value="<?php if ( ! empty( $_POST['juridicial_person_email'] ) ) esc_attr_e( $_POST['juridicial_person_email'] ); ?>" />
       </fieldset>

       <fieldset class="form-group">
			<label for="business_license" class="name-form"><?php _e( 'Company’s business License', 'woocommerce' ); ?></label>
			<input type="file" class="form-control" name="business_license" id="business_license" />
       </fieldset>
       
        <fieldset class="form-group">
			<label for="business_license_certified" class="name-form"><?php _e( 'Company’s business license certified translation', 'woocommerce' ); ?></label>
			<input type="file" class="form-control" name="business_license_certified" id="business_license_certified" />
       </fieldset>
       
        <fieldset class="form-group">
			<label for="juridicial_person_photo" class="name-form"><?php _e( 'Juridicial Person’s Photo ID', 'woocommerce' ); ?></label>
			<input type="file" class="form-control" name="juridicial_person_photo" id="juridicial_person_photo" />
       </fieldset>
       
        <fieldset class="form-group">
			<label for="import_export_business_enterprise" class="name-form"><?php _e( 'Import and Export Business Enterprise Qualification certificate', 'woocommerce' ); ?></label>
			<input type="file" class="form-control" name="import_export_business_enterprise" id="import_export_business_enterprise" />
       </fieldset>
       
        <fieldset class="form-group">
			<label for="import_export_business_certified" class="name-form"><?php _e( 'Import and Export Business certified translation', 'woocommerce' ); ?></label>
			<input type="file" class="form-control" name="import_export_business_certified" id="import_export_business_certified" />
       </fieldset>
       
       <fieldset class="form-group">
			<label for="insurance" class="name-form"><?php _e( 'Insurance', 'woocommerce' ); ?></label>
			<input type="file" class="form-control" name="insurance" id="insurance" />
       </fieldset>
       
       <fieldset class="form-group">
       <label class="name-form">
			<input class="form-group" name="seller_agreement" id="seller_agreement" value="forever" type="checkbox"> <span><?php _e( 'I have read and accepted the terms and conditions of the Olio business solution Agreement', 'woocommerce' ); ?></span>
		</label>
		</fieldset>
				
		<fieldset  class="col-sm-4" style="float: left;">
			<?php wp_nonce_field( 'seller_register', 'seller_register_nonce' ); ?>
			<input type="submit" class="btn btn-warning" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
		</fieldset>
		<fieldset class="col-sm-4">			
			<input type="button" class="btn btn-warning" id="back_first_form" value="<?php esc_attr_e( 'Back', 'woocommerce' ); ?>" />
		</fieldset>
	</div>
			
	<fieldset class="form-group already-Sign">
			<p> Already have an account? <a href="<?php echo site_url().'/seller-login';?>">Sign in</a> </p>
	</fieldset>
			<input type="hidden" name="action" value="seller_register_account">			
			<input type="hidden" name="usertype" id="usertype" value="seller">			

		</form>
		</div>
