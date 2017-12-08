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
	wp_redirect(site_url().'?n='.time());
	ob_end_flush();
	exit;
}

get_header('sellerlogin');
?>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="custom-form splash-bg">
			<div class="text-center theme-logo mb-5">
				<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );							
					echo '<a href="'.get_site_url().'"><img src="'. get_template_directory_uri() .'/images/logo.png"></a>';
				?>
			</div>
			<?php wc_print_notices(); ?>
			<h4 class="text-uppercase mb-0"><?php _e( 'Login', 'woocommerce' ); ?></h4>
			<hr />
			<form class="woocommerce-form woocommerce-form-login login" method="post">	
				<?php do_action( 'woocommerce_login_form_start' ); ?>			<fieldset class="form-group">
					<label for="username" class="name-form"><?php _e( 'Name :', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="form-control" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
				</fieldset>
				<fieldset class="form-group">
					<label for="password" class="name-form"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input class="form-control" type="password" name="password" id="password" />
				</fieldset>
				<?php do_action( 'woocommerce_login_form' ); ?>
				<fieldset class="form-group remember-field">
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<input type="submit" class="btn btn-block btn-primary text-uppercase font-weight-bold mt-2 mb-4" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
					<div class="clearfix mb-2">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
						</label>
						<input type="hidden" name="page" value="qr-login">
						<input type="hidden" name="qrHash" value="<?php echo $qrHash; ?>">			
						<a class="text-primary float-right link-forgot" href="<?php echo site_url().'/forgot-password'; ?>"><?php _e( 'Forgot Your Password?', 'woocommerce' ); ?></a>
					</div>
				</fieldset>
				<?php if(isset($qrHash) && $qrHash != ""){
					$registration_url 	=	site_url().'/registration/?page=qr-login&qrHash='.$qrHash;
				} else {
					$registration_url 	=	site_url().'/registration';	
				?>
				<div class="text-center mb-4">
					<div class="qr-login"></div>
				</div>
				<hr />
				<?php } ?>			
				<div class="">
					<h5 class="text-muted mb-4">New to Olio?</h5>
					<fieldset class="form-group text-center">
						<a class="btn btn-warning btn-block btn-wd font-weight-bold text-uppercase" href="<?php echo $registration_url; ?>">create account</a>
					</fieldset>
				</div>
				<?php do_action( 'woocommerce_login_form_end' ); ?>
			</form>
			
					
<!--
		<div class="social-login">
			<?php //do_action( 'wordpress_social_login' ); ?> 
		</div>
-->

		</div>
	</div>
	<div class="col-sm-1"></div>
</div>
