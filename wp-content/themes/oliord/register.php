<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Registration
 *
 * @package storefront
 */
 
 if ( is_user_logged_in()) {
	ob_start();
    wp_redirect(site_url());
    ob_end_flush();
	exit;
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
  });
</script>

		<div class="registration login-page">
<?php wc_print_notices(); ?>		
		<h3><?php _e( 'Register', 'woocommerce' ); ?></h3>

		<form method="post" class="register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>
			
		<fieldset class="form-group">
		   <label for="reg_billing_first_name" class="name-form"><?php _e( 'Name', 'woocommerce' ); ?></label>
		   <input required type="text" class="form-control" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       </fieldset>
       
       <fieldset class="form-group">
			<label for="reg_username" class="name-form"><?php _e( 'Username', 'woocommerce' ); ?> </label>
			<input type="text" required  class="form-control" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
		</fieldset>
		
       	<fieldset class="form-group">
				<label for="reg_email" class="name-form"><?php _e( 'Email address', 'woocommerce' ); ?> </label>
				<input type="email" class="form-control" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
			</fieldset>


		<fieldset class="form-group">
			<label for="reg_password" class="name-form"><?php _e( 'Password', 'woocommerce' ); ?> </label>
			<input type="password" class="form-control" name="password" id="reg_password" />
		</fieldset>
       
	<fieldset class="form-group">
		<label for="reg_billing_address_1" class="name-form"><?php _e( 'Street address', 'woocommerce' ); ?> </label>
		<input required type="text" class="form-control" name="billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" /><br>
		<input type="text" class="form-control" name="billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" />
    </fieldset>
    
     <?php
    wp_enqueue_script( 'wc-country-select' );
    wp_enqueue_script( 'wc-state-select' );

    woocommerce_form_field( 'billing_country', array(
        'type'      => 'country',
        'class'     => array('chzn-drop'),
        'label'     => __('Country'),
        'placeholder' => __('Choose your country.'),
        'required'  => true,
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
		<input type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if ( ! empty( $_POST['billing_state'] ) ) esc_attr_e( $_POST['billing_state'] ); ?>" />
     </fieldset>    
    
      <fieldset class="form-group">
		   <label for="reg_billing_city" class="name-form"><?php _e( 'City', 'woocommerce' ); ?></label>
		   <input type="text" required  class="form-control" name="billing_city" id="billing_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
       </fieldset>
       
         <fieldset class="form-group">
		   <label for="reg_billing_postcode" class="name-form"><?php _e( 'Zip/Postal Code', 'woocommerce' ); ?></label>
		   <input type="text" required  class="form-control" name="billing_postcode" id="billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
       </fieldset>

       <fieldset class="form-group">
			<label for="reg_billing_phone" class="name-form"><?php _e( 'Mobile Number', 'woocommerce' ); ?></label>
			<input type="tel" required  class="form-control" name="billing_phone"  placeholder="e.g. +1 702 123 4567" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
       </fieldset>

		
			<?php do_action( 'woocommerce_register_form' ); ?>

			<fieldset class="form-group register-btn-top">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="btn btn-warning" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
			</fieldset>
			<fieldset class="form-group already-Sign">
			<p> Already have an account? <a href="<?php echo site_url().'/seller-login';?>">Sign in</a> </p>
			</fieldset>
			<input type="hidden" name="usertype" id="usertype" value="seller">
			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
		</div>
