<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
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

//~ wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
 
if (is_user_wcmp_vendor($current_user)) {
	$dashboard_page_link = get_permalink(wcmp_vendor_dashboard_page_id());
	wp_safe_redirect( $dashboard_page_link );
	exit;		
}
?>
<div class="my-account-content">
	<?php
do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">
	<div class="account-author">
		<h1><?php echo esc_html( $current_user->display_name ); ?></h1>
	</div>
	<div class="main-container">
	<?php
		/**
		 * My Account content.
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
	</div>
</div>
</div>
