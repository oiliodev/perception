<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Seller Forgot Password
 *
 * @package storefront
 */

get_header('sellerlogin');

//~ get_header('dealer');
if ( is_user_logged_in()) {
    wp_redirect(site_url());
    exit;
}

?>
	<div class="forgot">
		<h2><?php _e( 'Forgot Password', 'woocommerce' ); ?></h2>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>

	<fieldset class="form-group">
		<label for="user_login" class="name-form"><?php _e( 'Username or email', 'woocommerce' ); ?></label>
		<input class="form-control" type="text" name="user_login" id="user_login" />
	</fieldset>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<input type="submit" class="btn btn-warning" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>" />
	</p>

	<?php wp_nonce_field( 'lost_password' ); ?>

</form>
		</div>
	
