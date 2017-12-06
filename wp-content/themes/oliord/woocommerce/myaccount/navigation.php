<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

do_action( 'woocommerce_before_account_navigation' );

global $current_user;
$attachment_url =  get_the_author_meta( 'cupp_upload_meta', $current_user->ID ) ; 
if($attachment_url != ''){
	$image_id	= get_attachment_id( $attachment_url ); 
	$attachment_url = wp_get_attachment_image_src($image_id, 'user_profile_img');
	$attachment_url	=	$attachment_url[0];
}else{	
	$attachment_url	=	"http://0.gravatar.com/avatar/c5deb4c7d055944eb080d7295a1edd2b?s=335&d=mm&r=g";
}
?>

<nav class="woocommerce-MyAccount-navigation">
	<span><img src="<?php echo $attachment_url; ?>"></span>
	<ul>		
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; 
		/*
		$current_user = wp_get_current_user();
		if (is_user_wcmp_vendor($current_user)) {
            $dashboard_page_link = wcmp_vendor_dashboard_page_id() ? get_permalink(wcmp_vendor_dashboard_page_id()) : '#';
            echo apply_filters('wcmp_vendor_goto_dashboard', '<a href="' . $dashboard_page_link . '">' . __('Dashboard', 'dc-woocommerce-multi-vendor') . '</a>');
        }*/
        
		?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>

