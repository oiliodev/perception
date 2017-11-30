<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
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

global $product;
$productId	= get_the_ID();
$stock_quantity		=	$product->get_stock_quantity();
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
<?php endif; 
$mqr	=	get_post_meta( $productId, '_wc_mmax_min'); 
if($mqr[0] > 0 ){
?>

<div class="mqr_qty">			  
    <b><?php _e( 'MQR:' ); ?></b><br /><?php echo $mqr[0]; ?>&nbsp;<?php _e( 'Piece' ); ?>
</div>


<?php } ?>
