<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="flash_deals related_products product">

		<h2><?php esc_html_e( 'More Similar products from other manufacturers', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>
		
			<?php 
			//~ echo "<pre>"; print_r($related_products); echo "</pre>"; exit;
			foreach ( $related_products as $related_product ) : ?>
					<li <?php //post_class(); ?>  class="col-sm-6 col-md-4 col-lg-3">
					<div class="product-pad">
					<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); 
					?>
					</div>
					</li>
			<?php endforeach; ?>
		
		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
