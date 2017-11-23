<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$productId =$post->ID;		
$deals_of_the_day	=	get_post_meta( $productId, 'deals_of_the_day'); 	
?>
<?php if($deals_of_the_day[0] == '1') {
	$discount		=	get_post_meta( $productId, 'discount'); 
?>
		<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( $discount[0].'&nbsp;%OFF', 'woocommerce' ) . '</span>', $post, $product ); ?>

<?php }

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
