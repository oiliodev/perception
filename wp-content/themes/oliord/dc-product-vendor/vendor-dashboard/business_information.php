<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$user 		= 	wp_get_current_user();
$sellerId	=	$user->ID;

$membership					=	trim(get_the_author_meta( 'membership', $sellerId )) ;

$juridicial_person_name		=	get_the_author_meta( 'juridicial_person_name', $sellerId ) ; 
$juridicial_person_email	=	get_the_author_meta( 'juridicial_person_email', $sellerId ) ;
$juridicial_person_photo	=	get_the_author_meta( 'juridicial_person_photo', $sellerId ) ;
$business_tax_id					=	get_the_author_meta( 'business_tax_id', $sellerId ) ; 
$business_license					=	get_the_author_meta( 'business_license', $sellerId ) ;
$expire_business_license			=	get_the_author_meta( 'expire_business_license', $sellerId ) ;
$business_license_certified			=	get_the_author_meta( 'business_license_certified', $sellerId ) ;
$import_export_business_enterprise	=	get_the_author_meta( 'import_export_business_enterprise', $sellerId ) ;
$import_export_business_certified	=	get_the_author_meta( 'import_export_business_certified', $sellerId ) ;
$expire_import_export_business_certified	=	get_the_author_meta( 'expire_import_export_business_certified', $sellerId ) ;
$insurance									=	get_the_author_meta( 'insurance', $sellerId ) ;

if(!empty($_POST)){
	
	$basedir	= 	wp_upload_dir();			
	$uploads	=	$basedir['basedir'].'/vendor_documents'; 
	
	$membership					=	sanitize_text_field($_POST['membership']);
	$juridicial_person_name		=	sanitize_text_field($_POST['juridicial_person_name']);
	$juridicial_person_email	=	sanitize_text_field($_POST['juridicial_person_email']);
	$business_tax_id			=	sanitize_text_field($_POST['business_tax_id']);
	$membership					=	sanitize_text_field($_POST['membership']);
	$expire_business_license	=	sanitize_text_field($_POST['expire_business_license']);
	$expire_import_export_business_certified	=	sanitize_text_field($_POST['expire_import_export_business_certified']);
	
	
				   
			   if ( isset( $juridicial_person_name )  && $juridicial_person_name != "" ) {
					update_user_meta( $sellerId, 'juridicial_person_name', sanitize_text_field( $juridicial_person_name));
			   }			   
			   if ( isset( $juridicial_person_email ) && $juridicial_person_email != "" ) {
					update_user_meta( $sellerId, 'juridicial_person_email', sanitize_text_field( $juridicial_person_email));
			   }
			   if ( isset( $business_tax_id ) && $business_tax_id != "" ) {
					update_user_meta( $sellerId, 'business_tax_id', sanitize_text_field( $business_tax_id));
			   }
			   if ( isset( $expire_business_license ) && $expire_business_license != "" ) {
					update_user_meta( $sellerId, 'expire_business_license', sanitize_text_field( $expire_business_license));
			   }
			   
			   if ( isset( $expire_import_export_business_certified ) && $expire_import_export_business_certified != "" ) {
					update_user_meta( $sellerId, 'expire_import_export_business_certified', sanitize_text_field( $expire_import_export_business_certified));
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
			   
			   
}

?>

<form class="woocommerce-EditAccountForm edit-account" enctype="multipart/form-data" action="" method="post">


<div class="pl-sm-3 pr-sm-3 tab" id="seller_information" style="display: block;">
          <h4 class="mt-0 normal mb-3">
            Business Information          </h4>
          <hr class="mb-4 pb-2">
          <fieldset class="business-information-radio checkbox mb-3">
          <label for="juridicial_person_name" class="d-block w-100">Select Membership :</label>
          <div class="information-radio d-inline-block position-relative mb-3">
            <input autocomplete="off" type="radio" id="Yellow-Member" <?php if($membership == "Yellow Gold Member") { echo "checked"; } ?> class="form-control membership" name="membership" value="Yellow Gold Member">
            <label for="Yellow-Member" class="text-primary font-weight-semibold cursor-pointer"><span class="mr-2 align-middle"></span>
            Yellow Gold            </label>
            <a href="#" class="d-inline-block align-middle info-tip info mr-3 tip-space" data-toggle="tooltip" title="" data-original-title="
						<ul class='list-unstyled text-left mb-0'>
							<li class='mb-1'>Free membership</li>
							<li class='mb-1'>Can showcase upto 50 products</li>
							<li class='mb-1'>Minimal fee of $39.99 after 50 products</li>
							<li class='mb-1'>Video Production unavailable</li>
							<li class='mb-1'>Paid($999) usage of online convention</li>
						</ul>"> </a> </div>
          <div class="information-radio d-inline-block position-relative mb-3">
            <input autocomplete="off" type="radio" id="Gold-Member" <?php if(trim($membership) == "White Gold Member") { echo "checked"; } ?> class="form-control membership" name="membership" value="White Gold Member">
            <label for="Gold-Member" class="text-primary font-weight-semibold cursor-pointer"><span class="mr-2 align-middle"></span>
            White Gold            </label>
            <a href="#" class="d-inline-block align-middle info-tip info mr-3 tip-space" data-toggle="tooltip" title="" data-original-title="
						   <ul class='list-unstyled text-left mb-0'>
							<li class='mb-1'>Membership fee is $2499/year</li>
							<li class='mb-1'>Free usage of online convention for a single booth for six months</li>
							<li class='mb-1'>Video production included</li>
							<li class='mb-1'>Admin support</li>
						   </ul>"> </a> </div>
          <div class="information-radio d-inline-block position-relative mb-3">
            <input autocomplete="off" type="radio" <?php if($membership == "Diamond Member") { echo "checked"; } ?> id="Diamond-Member" class="form-control membership" name="membership" value="Diamond Member">
            <label for="Diamond-Member" class="text-primary font-weight-semibold cursor-pointer"><span class="mr-2 align-middle"></span>
            Diamond            </label>
            <a href="#" class="d-inline-block align-middle info-tip info tip-space" data-toggle="tooltip" title="" data-original-title="
						<ul class='list-unstyled text-left mb-0'>
							<li class='mb-1'>Membership fee is $4999/year</li>
							<li class='mb-1'>Premium listing of products on main page</li>
							<li class='mb-1'>Free online convention booth usage for a year</li>
							<li class='mb-1'>Video production included</li>
							<li class='mb-1'>First preference to reserve online convention booth</li>
							<li class='mb-1'>Full admin support</li>
						</ul>"> </a> </div>
          </fieldset>
          <fieldset class="mb-4">
          <label for="juridicial_person_name" class="name-form">
          Juridicial Person Name :          <span class="required">*</span></label>
          <input autocomplete="off" type="text" class="form-control" required value="<?php echo $juridicial_person_name; ?>" name="juridicial_person_name" id="juridicial_person_name">
          </fieldset>
          <fieldset class="mb-4">
          <label for="juridicial_person_email" class="name-form">
          Juridicial Person Email :          <span class="required">*</span></label>
          <input autocomplete="off" type="email" class="form-control" required value="<?php echo $juridicial_person_email; ?>" name="juridicial_person_email" id="juridicial_person_email" value="">
          </fieldset>
          <fieldset class="mb-4">
          <label for="juridicial_person_photo" class="name-form">
          Juridicial Person’s Photo ID :          <span class="required">*</span></label>
          <input type="file" class="form-control" name="juridicial_person_photo" id="juridicial_person_photo">
          </fieldset>
          <fieldset class="mb-4">
          <label for="business_tax_id" class="name-form">
          Business tax id :          <span class="required">*</span></label>
          <input autocomplete="off" maxlength="18" type="text" class="form-control" name="business_tax_id" id="business_tax_id" value="<?php echo $business_tax_id; ?>">
          </fieldset>
          <fieldset class="mb-4">
          <label for="business_license" class="name-form">
          Company’s business License :          <span class="required">*</span></label>
          <input type="file" class="form-control" name="business_license" id="business_license">
          </fieldset>
          <fieldset class="mb-4">
          <label for="expire_business_license" class="name-form">
          Expiration date of license :          </label>
          <input type="text" class="form-control datepicker" value="<?php echo $expire_business_license; ?>" readonly="" name="expire_business_license" id="expire_business_license">
          </fieldset>
          <fieldset class="mb-4">
          <label for="business_license_certified" class="name-form">
          Company’s business license certified translation :          </label>
          <input type="file" class="form-control" name="business_license_certified" id="business_license_certified">
          </fieldset>
          <fieldset class="mb-4">
          <label for="import_export_business_enterprise" class="name-form">
          Import and Export Business Enterprise Qualification certificate :          </label>
          <input type="file" class="form-control" name="import_export_business_enterprise" id="import_export_business_enterprise">
          </fieldset>
          <fieldset class="mb-4">
          <label for="import_export_business_certified" class="name-form">
          Import and Export Business certified translation :          </label>
          <input type="file" class="form-control" name="import_export_business_certified" id="import_export_business_certified">
          </fieldset>
          <fieldset class="mb-4">
          <label for="expire_business_license" class="name-form">
          Expiration date of Import/Export :          </label>
          <input type="text" class="form-control datepicker" readonly="" value="<?php echo $expire_import_export_business_certified; ?>" name="expire_import_export_business_certified" id="expire_import_export_business_certified">
          </fieldset>
          <fieldset class="mb-4">
          <label for="insurance" class="name-form">
          Insurance :          </label>
          <input type="file" class="form-control" name="insurance" id="insurance">
          <div class="required text-right mt-1 mb-3 small">* Please fill up mandatory fields</div>
          </fieldset>     
          
          <button class="wcmp_orange_btn" name="save_business_info" type="submit">Save information</button>
                     
        </div>
        	
</form>


