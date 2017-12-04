<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$productId	= get_the_ID();
$mqr	=	get_post_meta( $productId, '_wc_mmax_min'); 
if(!isset($mqr[0])){
		$mqr[0]	=	1;
}
if(!is_page( array( 'wishlist'))) { 
?>
<p class="stock <?php echo esc_attr( $class ); ?>">
<?php //echo _e('MQR:', 'woocommerce').str_replace('in stock','',wp_kses_post( $availability ));  echo _e('Pieces', 'woocommerce');?>
    <?php _e( 'MQR:' ); echo $mqr[0]; ?>&nbsp;<?php _e( 'Piece' ); ?>
</p>
<?php } ?>
