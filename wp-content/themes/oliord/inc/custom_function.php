<?php 
add_image_size( 'member_product_small', 230,120, true );
add_image_size( 'member_product_big', 230,230, true );

add_shortcode( 'my_products', 'bbloomer_user_products_bought' );
 
function bbloomer_user_products_bought() {
	
global $product, $woocommerce, $woocommerce_loop;
$current_user = wp_get_current_user();
$args = array(
    'post_type'         => 'product',
    'post_status'       => 'publish',
    'posts_per_page'	=> 12,
    'post_author'	 	=> 1
);
$wc_query = new WP_Query($args); 
?>
 <div class="col-sm-9 dimond_members">
	 <h3>
		<?php _e( 'Member producs display (Dimond members)' ); ?>
	</h3>
	<div class="dimond-products-list row">
     <?php if ($wc_query->have_posts()) : ?>
     <?php 
     $i =1;
     while ($wc_query->have_posts()) :
                $wc_query->the_post();
                $product_id			= 	get_the_ID();                 
                $product		 	= 	wc_get_product( $product_id );
                $stock_quantity		=	$product->get_stock_quantity();
				$rating_count		=	$product->get_rating_count();
				$review_count		=	$product->get_review_count();
				$average			=	$product->get_average_rating();
				//~ $image 				= 	get_the_post_thumbnail_url($product_id,'medium');
				if($i == 1 || $i == 4 || $i == 6  || $i == 7){
					$image	= 	get_the_post_thumbnail_url($product_id,'member_product_big');
					
				}else{
					$image 	= 	get_the_post_thumbnail_url($product_id,'member_product_small');
				}
			
			//~ the_post_thumbnail( 'postbox-thumb', array( 'width' => 100, 'height' => 100 ) )
     ?>
      <div class="col-sm-3 right-space product_<?php echo $i; ?>">
		<div class="dimond-products">
			<div>
				<img class="product-img" src="<?php echo $image;?>">
			</div>
			<div class="product-content">
          <h3>
			  <?php echo $i; ?>
               <?php the_title(); ?>              
          </h3>     
          <div class="col-md-12 clearfix">
          <div class="dimaond_product_price"><?php echo $product->get_price_html(); ?><?php _e( 'Per Pieces' ); ?></div>
          <div class="dimaond_product_qty">
			  <?php //if(isset($stock_quantity)){ ?>
			  <b>MQR:</b><?php echo $stock_quantity; ?>&nbsp;<?php _e( 'Pieces' ); ?>
			  <?php //} ?>
			</div>
          <div class="view-details"><a href="<?php the_permalink(); ?>"><?php _e( 'View Details' ); ?></a></div>
          </div>
          <div class="col-md-12 clearfix">	
				<div class="progress-bar-l">	
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo $rating_count; ?>" data-duration="1000"></div>
					</div>
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo $review_count; ?>" data-duration="1000" data-color="#ccc,yellow"></div>
					</div>
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo $average; ?>" data-duration="1000" data-color="#a456b1,#12b321"></div>
					</div>
				</div>
				<div class="progress-bar-r">	
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo '75'; ?>" data-type="heart" data-duration="1000" data-color="#a456b1,#12b321"></div>
					</div>
					<div class="progress-bar75">
					75%
					</div>
				</div>	
				
			</div>	  
		</div>	  
     </div>
     </div>
     <?php 
     $i++;
     endwhile; ?>
     <?php wp_reset_postdata(); ?>
     <?php else:  ?>
     <div class="col-sm-12">
          <?php _e( 'No Products' ); ?>
     </div>
     <?php endif; ?>
     </div>

</div>

<div class="col-sm-3">
   <?php // _e( 'Google Adsens1', 'oliord' ); ?>
<div id='afscontainer1'><div id='afscontainer2'><img src="<?php echo get_template_directory_uri(); ?>/images/g adv.jpg"></div></div>

<?php  //_e( 'Google Adsens2', 'oliord' ); ?>

  <div id='afscontainer2'><img src="<?php echo get_template_directory_uri(); ?>/images/g adv.jpg"></div>

<div class="col-sm-12" ><a href="#top" class="pull-right"><img style="width: 50px;" src="<?php echo get_template_directory_uri(); ?>/images/top.png"></a></div>
<div class="col-sm-12 pull-right" style="margin-top: 14px;"><a class="pull-right" href="#"><img style="width: 50px;" src="<?php echo get_template_directory_uri(); ?>/images/chat.png"></a></div>
</div>


<?php

}

?>
