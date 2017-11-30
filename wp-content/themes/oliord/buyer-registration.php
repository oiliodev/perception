<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Buyer Registration
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
	$password				=	trim($_POST['password']);
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
	$business_tax_id			=	sanitize_text_field($_POST['business_tax_id']);
	$membership					=	sanitize_text_field($_POST['membership']);
	
	$info = array();
	$info['first_name'] =	$billing_first_name;
  	$info['user_login'] =	sanitize_user($username) ;
  	$info['user_pass'] 	= 	sanitize_text_field($password);
	$info['user_email'] = 	sanitize_email( $email);
	$info['show_admin_bar_front']	=	 false;
	
	if($_POST['register_type'] == "Buyer"){
			$info['role'] = 'customer';
	}else{
			$info['role'] = 'dc_pending_vendor';	
	}
	
	
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
			   if ( isset( $business_tax_id ) && $business_tax_id != "" ) {
					update_user_meta( $sellerId, 'business_tax_id', sanitize_text_field( $business_tax_id));
			   }
			   if ( isset( $membership ) && $membership != "" ) {
					update_user_meta( $sellerId, 'membership', sanitize_text_field( $membership));
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
				if($_POST['register_type'] == "Buyer"){					
					$user    = get_user_by( 'login', $username );		
					$user_id = $user->ID;					
					wp_set_current_user( $user_id, $username );
					wp_set_auth_cookie( $user_id );
					do_action( 'wp_login', $username );
					wp_redirect(site_url());
				}else{
					
					if(isset($_REQUEST['qrHash']) && $_REQUEST['qrHash'] != "" ){
						$table_name  = "wp_qrLogin";
						$rows_affected = $wpdb->update( $table_name, array( 'hash' => $_REQUEST['qrHash'],'uname' => $username ), array( 'hash' => $_REQUEST['qrHash'] ) );
					}				
					wp_redirect(site_url().'/thanks-for-registration');
				}
				ob_end_flush();
				exit;
		}

}

get_header('sellerlogin');
global $woocommerce;
$qrHash = preg_replace( "/[^0-9a-zA-Z ]/", "", $_GET['qrHash'] );
?>	

<link rel='stylesheet' id='jquery-ui-css'  href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css' type='text/css' media='all' />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
jQuery(function(){
	var currentTab = 0; // Current tab is set to be the first tab (0)
	showTab(currentTab);	
});


$(document).ready(function(){
	$('.datepicker').datepicker();
    $('[data-toggle="tooltip"]').tooltip({html:true});    
});


$(window).load(function() {
  $(".loader").fadeOut("slow");
})
</script>
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<!-- Circles which indicates the steps of the form: -->
		<div class="clearfix registration_progress">			
			<span class="first_step finish">
				<label class="d-block text-uppercase font-weight-semibold">&nbsp;</label>
			</span>			
			<span class="step step1">
				<label class="d-block text-uppercase font-weight-semibold">register type</label>
			</span>
			<span class="step step2">
				<label class="d-block text-uppercase font-weight-semibold">user info</label>
			</span>
			<span class="step step3">
				<label class="d-block text-uppercase font-weight-semibold">Contact info</label>
			</span>
			<span id="seller_step">
				<label class="d-block text-uppercase font-weight-semibold">Business info</label>
			</span>
		</div>
	</div>
	<div class="col-lg-1"></div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-1"></div>
	<div class="col-lg-6 col-md-10">
		<div class="custom-form">
			<div class="mt-3">
				<div class="text-center theme-logo mb-5">
		<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );							
			echo '<a href="'.get_site_url().'"><img src="'. get_template_directory_uri() .'/images/logo.png"></a>';
		?>
	</div>
			</div>
			<?php wc_print_notices(); ?>
			<?php 
			if($message != ""){ ?>
				<h6 class="woocommerce-error"><?php echo $message; ?></h6>
			<?php 	}  else { ?>
			<h6 class="woocommerce-error" style="display:none;"></h6>
			<?php } ?>
			<form method="post" enctype="multipart/form-data" id="regForm" class="register">
			<!-- One "tab" for each step in the form: -->
			<div class="tab">
				<fieldset class="form-group">
					<div class="d-block text-center checkbox pl-sm-3 pr-sm-3">
						<h4 class="mt-0 normal mb-4"><?php _e( 'Register Type', 'woocommerce' ); ?></h4>
						<hr />
						<div class="mt-4 mb-4">
						   <input type="radio" class="register_type" name="register_type" id="buyer" <?php if ( isset( $_POST['register_type'] ) && $_POST['register_type'] == "Buyer" ) { echo "checked"; } else { echo "checked"; } ?> value="Buyer" /><label for="buyer" class="text-primary font-weight-semibold mr-5 cursor-pointer"> <span class="mr-2 align-middle"></span> Buyer </label>
						   <input type="radio" class="register_type" name="register_type"  id="seller" <?php if ( isset( $_POST['register_type'] ) && $_POST['register_type'] == "Seller" ) { echo "checked"; } ?> value="Seller" /> <label for="seller" class="text-primary font-weight-semibold cursor-pointer"> <span class="mr-2 align-middle"></span> Seller </label>
						</div>
						<hr />
					</div>
			   	</fieldset>       
			   <?php if(isset($qrHash) && $qrHash != "" ) { ?>
				<input type="hidden" name="page" value="qr-login">
				<input type="hidden" name="qrHash" value="<?php echo $qrHash; ?>">
				<?php } ?>
			</div>  
			
			<div class="tab pl-sm-3 pr-sm-3 user-info-tab">
				<h4 class="mt-0 normal mb-3"><?php _e( 'User Information', 'woocommerce' ); ?></h4>
				<hr class="mb-4 pb-2" />
				<fieldset class="mb-4">
				   <label for="reg_billing_first_name" class="name-form"><?php _e( 'Name :', 'woocommerce' ); ?> <span class="required">*</span></label>
				   <input type="text" class="form-control" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
			   </fieldset>			   
			   <fieldset class="mb-4">
					<label for="reg_username" class="name-form"><?php _e( 'Username :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="form-control" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
				</fieldset>				
				<fieldset class="mb-4">
						<label for="reg_email" class="name-form"><?php _e( 'Email :', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="email" class="form-control" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
				</fieldset>			
				<fieldset class="mb-4">
					<label for="reg_password" class="name-form"><?php _e( 'Password :', 'woocommerce' ); ?></label>
					<div class="position-relative">
						<input type="password" class="form-control" name="password" id="reg_password" />
						<a href="#" class="position-absolute info-tip text-left" data-toggle="tooltip" title="Password length must be greater than or equal to 8 & use one or more uppercase,lowercase, numeric & special characters"></a>
					</div>
				</fieldset>				
				<fieldset class="mb-4">
					<label for="reg_password" class="name-form"><?php _e( 'Confirm Password :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="form-control" name="confirm_password" id="confirm_password" />
					<div class="required text-right mt-1 mb-3 small">* Please fill up mandatory fields</div>
				</fieldset>
			</div>			
			<div class="tab pl-sm-3 pr-sm-3">
				<h4 class="mt-0 normal mb-3"><?php _e( 'Contact Information', 'woocommerce' ); ?></h4>
				<hr class="mb-4 pb-2" />			
				<fieldset class="mb-4">
					<label for="reg_billing_address_1" class="name-form"><?php _e( 'Street Address :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input  type="text" class="form-control mb-2" name="billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />
					<input type="text" class="form-control" name="billing_address_2" id="billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" />
				</fieldset>			
			 <?php
			wp_enqueue_script( 'wc-country-select' );
			wp_enqueue_script( 'wc-state-select' );
			
			woocommerce_form_field( 'billing_country', array(
				'type'      => 'country',
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
				<label for="billing_state" class="name-form"><?php _e( 'State/Province :', 'woocommerce' ); ?></label>
				<input type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if ( ! empty( $_POST['billing_state'] ) ) esc_attr_e( $_POST['billing_state'] ); ?>" />
			 </fieldset>   
			
			  <fieldset class="mb-4">
				   <label for="reg_billing_city" class="name-form"><?php _e( 'City :', 'woocommerce' ); ?></label>
				   <input type="text" class="form-control" name="billing_city" id="billing_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
			   </fieldset>			   
				 <fieldset class="mb-4">
				   <label for="reg_billing_postcode" class="name-form"><?php _e( 'Zip/Postal Code :', 'woocommerce' ); ?></label>
				   <input type="text" class="form-control" name="billing_postcode" id="billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
			   </fieldset>			
			   <fieldset class="mb-4">
					<label for="reg_billing_phone" class="name-form"><?php _e( 'Mobile Number :', 'woocommerce' ); ?></label>
					<input type="tel" maxlength="14" class="form-control" name="billing_phone"  placeholder="e.g. +1 702 123 4567" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
			   </fieldset>
			   
			   <fieldset class="form-group buyer clearfix pt-3 mb-4"></fieldset>			   
			</div>
			
			
			<div class="seller_information pl-sm-3 pr-sm-3" id="seller_information">
				<h4 class="mt-0 normal mb-3"><?php _e( 'Business Information', 'woocommerce' ); ?></h4>
				<hr class="mb-4 pb-2" />
				<fieldset class="business-information-radio checkbox mb-3">
					<label for="juridicial_person_name" class="d-block w-100">Select Membership :</label>
					<div class="information-radio d-inline-block position-relative mb-3">
						<input autocomplete="off" type="radio" id="Yellow-Member" class="form-control membership" name="membership" value="Yellow Gold Member" />
						<label for="Yellow-Member" class="text-primary font-weight-semibold cursor-pointer"><span class="mr-2 align-middle"></span><?php _e( 'Yellow Gold', 'woocommerce' ); ?></label>
						<a href="#" class="d-inline-block align-middle info-tip info mr-3 tip-space" data-toggle="tooltip" title="
						<ul class='list-unstyled text-left mb-0'>
							<li class='mb-1'>Free membership</li>
							<li class='mb-1'>Can showcase upto 50 products</li>
							<li class='mb-1'>Minimal fee of $39.99 after 50 products</li>
							<li class='mb-1'>Video Production unavailable</li>
							<li class='mb-1'>Paid($999) usage of online convention</li>
						</ul>">
						</a>
					</div>	
					<div class="information-radio d-inline-block position-relative mb-3">
						<input autocomplete="off" type="radio" checked id="Gold-Member" class="form-control membership" name="membership" value="White Gold Member" />
						<label for="Gold-Member" class="text-primary font-weight-semibold cursor-pointer"><span class="mr-2 align-middle"></span><?php _e( 'White Gold', 'woocommerce' ); ?></label>
						<a href="#" class="d-inline-block align-middle info-tip info mr-3 tip-space" data-toggle="tooltip" title="
						   <ul class='list-unstyled text-left mb-0'>
							<li class='mb-1'>Membership fee is $2499/year</li>
							<li class='mb-1'>Free usage of online convention for a single booth for six months</li>
							<li class='mb-1'>Video production included</li>
							<li class='mb-1'>Admin support</li>
						   </ul>">
						</a>
					</div>
					<div class="information-radio d-inline-block position-relative mb-3">
						<input autocomplete="off" type="radio" id="Diamond-Member" class="form-control membership" name="membership" value="Diamond Member" />
						<label for="Diamond-Member" class="text-primary font-weight-semibold cursor-pointer"><span class="mr-2 align-middle"></span><?php _e( 'Diamond', 'woocommerce' ); ?></label>
						<a href="#" class="d-inline-block align-middle info-tip info tip-space" data-toggle="tooltip" title="
						<ul class='list-unstyled text-left mb-0'>
							<li class='mb-1'>Membership fee is $4999/year</li>
							<li class='mb-1'>Premium listing of products on main page</li>
							<li class='mb-1'>Free online convention booth usage for a year</li>
							<li class='mb-1'>Video production included</li>
							<li class='mb-1'>First preference to reserve online convention booth</li>
							<li class='mb-1'>Full admin support</li>
						</ul>">
						</a>
					</div>				
				</fieldset>		
				<fieldset class="mb-4">
				<label for="juridicial_person_name" class="name-form"><?php _e( 'Juridicial Person Name :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input autocomplete="off" type="text" class="form-control" name="juridicial_person_name" id="juridicial_person_name" value="<?php if ( ! empty( $_POST['juridicial_person_name'] ) ) esc_attr_e( $_POST['juridicial_person_name'] ); ?>" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="juridicial_person_email" class="name-form"><?php _e( 'Juridicial Person Email :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input autocomplete="off" type="email" class="form-control" name="juridicial_person_email" id="juridicial_person_email" value="<?php if ( ! empty( $_POST['juridicial_person_email'] ) ) esc_attr_e( $_POST['juridicial_person_email'] ); ?>" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="juridicial_person_photo" class="name-form"><?php _e( 'Juridicial Person’s Photo ID :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="file" class="form-control" name="juridicial_person_photo" id="juridicial_person_photo" />
				</fieldset>		
				<fieldset class="mb-4">
				   <label for="business_tax_id" class="name-form"><?php _e( 'Business tax id :', 'woocommerce' ); ?> <span class="required">*</span></label>
				   <input autocomplete="off" maxlength="18" type="text" class="form-control" name="business_tax_id" id="business_tax_id" value="<?php if ( ! empty( $_POST['business_tax_id'] ) ) esc_attr_e( $_POST['business_tax_id'] ); ?>" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="business_license" class="name-form"><?php _e( 'Company’s business License :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="file" class="form-control" name="business_license" id="business_license" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="expire_business_license" class="name-form"><?php _e( 'Expiration date of license :', 'woocommerce' ); ?></label>
					<input type="text" class="form-control datepicker" readonly name="expire_business_license" id="expire_business_license" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="business_license_certified" class="name-form"><?php _e( 'Company’s business license certified translation :', 'woocommerce' ); ?></label>
					<input type="file" class="form-control" name="business_license_certified" id="business_license_certified" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="import_export_business_enterprise" class="name-form"><?php _e( 'Import and Export Business Enterprise Qualification certificate :', 'woocommerce' ); ?></label>
					<input type="file" class="form-control" name="import_export_business_enterprise" id="import_export_business_enterprise" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="import_export_business_certified" class="name-form"><?php _e( 'Import and Export Business certified translation :', 'woocommerce' ); ?></label>
					<input type="file" class="form-control" name="import_export_business_certified" id="import_export_business_certified" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="expire_business_license" class="name-form"><?php _e( 'Expiration date of Import/Export :', 'woocommerce' ); ?></label>
					<input type="text" class="form-control datepicker" readonly name="expire_import_export_business_certified" id="expire_import_export_business_certified" />
				</fieldset>		
				<fieldset class="mb-4">
				<label for="insurance" class="name-form"><?php _e( 'Insurance :', 'woocommerce' ); ?></label>
					<input type="file" class="form-control" name="insurance" id="insurance" />
					<div class="required text-right mt-1 mb-3 small">* Please fill up mandatory fields</div>
				</fieldset>
				<fieldset class="mb-4">
				   <label class="name-form">
						<input class="mt-1 mb-4 mr-3 float-left" name="seller_agreement" id="seller_agreement" value="forever" type="checkbox" /> <span class="d-block"><?php _e( 'I have read and accepted the <a target="_blank" href="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/images/olio_businessSolutionAgreement.pdf">terms and conditions</a> of the Olio business solution Agreement', 'woocommerce' ); ?></span>
					</label>
				</fieldset>		
				<fieldset class="form-group seller">       
			   </fieldset>
			</div>
			<div class="text-center mt-4 mb-4 mb-sm-4 pb-sm-4">
				<?php wp_nonce_field( 'seller_register', 'seller_register_nonce' ); ?>		
				<button type="button" id="prevBtn" class="btn btn-outline-primary text-uppercase font-weight-bold mr-sm-2" onclick="nextPrev(-1)">Previous</button>
				<button type="button" id="nextBtn" class="btn btn-outline-primary text-uppercase font-weight-bold pl-4 pr-4 ml-sm-2"  onclick="nextPrev(1)">Next</button>
			</div>			
			</form>
			<div class="loader"></div>
		</div>
	</div>
	<div class="col-lg-3 col-md-1"></div>
</div>
