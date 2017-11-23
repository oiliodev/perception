<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Seller Login
 *
 * @package storefront
 */

//~ get_header('dealer');
//~ if ( is_user_logged_in()) {
   	//~ ob_start();
    //~ wp_redirect(site_url());
    //~ ob_end_flush();
    //~ exit;
//~ }

$qrHash = preg_replace( "/[^0-9a-zA-Z ]/", "", $_GET['qrHash'] );

if ( is_user_logged_in()) {
	ob_start();
	$table_name  = "wp_qrLogin";
	global $current_user;
	$userID = $current_user->ID;
	$user_login	=	$current_user->user_login;	
	$rows_affected = $wpdb->update( $table_name, array( 'hash' => $_REQUEST['qrHash'],'uname' => $user_login ), array( 'hash' => $_REQUEST['qrHash'] ) );	
	wp_redirect(site_url());
	ob_end_flush();
	exit;
}

get_header('sellerlogin');
?>

	
	<div class="login-page login-form">			
		<?php wc_print_notices(); ?>
		<h3><?php _e( 'Login', 'woocommerce' ); ?></h3>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<fieldset class="form-group">
				<label for="username" class="name-form"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="form-control" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
			</fieldset>
			<fieldset class="form-group">
				<label for="password" class="name-form"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="form-control" type="password" name="password" id="password" />
			</fieldset>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<fieldset class="form-group remember-field">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="btn btn-warning" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<input type="hidden" name="page" value="qr-login">
				<input type="hidden" name="qrHash" value="<?php echo $qrHash; ?>">
				
				<label class="forgot-password form-group">
				<a href="<?php echo site_url().'/forgot-password'; ?>"><?php _e( 'Forgot Your Password?', 'woocommerce' ); ?></a>
			</label>
			
			</fieldset>
			<?php if(isset($qrHash) && $qrHash != ""){
				$registration_url 	=	site_url().'/registration/?page=qr-login&qrHash='.$qrHash;
			} else {
				$registration_url 	=	site_url().'/registration';	
			?>
			<div class="login-page qr-login-form">
				<div class="qr-login"></div>
			</div>
			<?php } ?>
			
			<div class="a-divider a-divider-break"><h5>New to Olio?</h5></div>
			
			<fieldset class="form-group create-account">
				<a href="<?php echo $registration_url; ?>">Create your account</a>
			</fieldset>
			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>		
		
		
<!--
		<div class="social-login">
			<?php //do_action( 'wordpress_social_login' ); ?> 
		</div>
-->
</div>
