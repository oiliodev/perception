<?php 

add_shortcode( 'my_products', 'bbloomer_user_products_bought' );
 
function bbloomer_user_products_bought() {
	
global $product, $woocommerce, $woocommerce_loop;
$current_user = wp_get_current_user();
$args = array(
    'post_type'         => 'product',
    'post_status'       => 'publish',
    'posts_per_page'	=> 9,
    'post_author'	 	=> 1
);
$wc_query = new WP_Query($args);
?>
<style>
.dimond_members > h3 {
    font-size: 14pt;
    font-weight: bold;
    padding: 10px 0;
}

.dimond-products {
    border: 1px solid gray;
    border-radius: 10px;
    display: inline-block;
    margin: 0;
}
.right-space {
       padding-bottom: 10px;
    padding-right: 0;
}
.product-content {
    border: 1px solid gray;
    border-radius: 10px;
    display: inline-block;
    padding: 10px 0;
}
.dimond-products .product-img{
	width:100%;
	border-top-left-radius: 10px; 
	border-top-right-radius: 10px;
	height: 170px;
}
.progress-bar-rate {
     padding-left: 0;
    width: 35px;
}

.product-content > h3 {
    font-size: 12pt;
    margin: 6px;
    padding: 0;
}
</style>
 <div class="col-sm-8 dimond_members">
	 <h3>
		Member producs display (Dimond members)
	</h3>
	<div class="dimond-products-list row">
     <?php if ($wc_query->have_posts()) : ?>
     <?php while ($wc_query->have_posts()) :
                $wc_query->the_post();
                $product_id			= 	get_the_ID();                 
                $product		 	= 	wc_get_product( $product_id );
                $stock_quantity		=	$product->get_stock_quantity();
				$rating_count		=	$product->get_rating_count();
				$review_count		=	$product->get_review_count();
				$average			=	$product->get_average_rating();
				$image 				= 	get_the_post_thumbnail_url($product_id,'medium');
     ?>
      <div class="col-sm-4 right-space">
		<div class="dimond-products">
			<div>
				<img class="product-img" src="<?php echo $image;?>">
			</div>
			<div class="product-content">
          <h3>
               <?php the_title(); ?>              
          </h3>     
          <div class="col-md-12">
          <div class="dimaond_product_price col-md-4"><?php echo $product->get_price_html().'<br><span>Per Pieces</span>'; ?></div>
          <div class="dimaond_product_qty col-md-4">
			  <?php //if(isset($stock_quantity)){ ?>
			  <b>MQR:</b><?php echo $stock_quantity; ?> Pieces
			  <?php //} ?>
			</div>
          <div class="col-md-4 view-details"><a href="<?php the_permalink(); ?>">View Details</a></div>
          </div>
          <div class="col-md-12">	
			<div class="col-md-4 progress-bar-rate">
				<div class="progress-bar position" data-percent="<?php echo $rating_count; ?>" data-duration="1000"></div>
			</div>
			<div class="col-md-4 progress-bar-rate">
				<div class="progress-bar position" data-percent="<?php echo $review_count; ?>" data-duration="1000" data-color="#ccc,yellow"></div>
			</div>
			<div class="col-md-4 progress-bar-rate">
				<div class="progress-bar position" data-percent="<?php echo $average; ?>" data-duration="1000" data-color="#a456b1,#12b321"></div>
			</div>
			</div>	  
		</div>	  
     </div>
     </div>
     <?php endwhile; ?>
     <?php wp_reset_postdata(); ?>
     <?php else:  ?>
     <div class="col-sm-12">
          <?php _e( 'No Products' ); ?>
     </div>
     <?php endif; ?>
     </div>

</div>
<!--
<div class="col-sm-4">
   <?php _e( 'Google Adsens1', 'oliord' ); ?>
<div id='afscontainer1'></div>

<script type="text/javascript" charset="utf-8">

  var pageOptions = {
    "pubId": "pub-9616389000213823", // Make sure this the correct client ID!
    "query": "hotels",
    "adPage": 1
  };

  var adblock1 = {
    "container": "afscontainer1",
    "width": "700",
    "number": 2
  };

  _googCsa('ads', pageOptions, adblock1);

</script>

Google Adsens2

  <div id='afscontainer2'></div>

<script type="text/javascript" charset="utf-8">

  var pageOptions = {
    "pubId": "pub-9616389000213823", // Make sure this the correct client ID!
    "query": "hotels",
    "adPage": 1
  };

  var adblock1 = {
    "container": "afscontainer2",
    "width": "700",
    "number": 2
  };

  _googCsa('ads', pageOptions, adblock1);

</script>
   

<div class="col-sm-12" ><a href="#top" class="pull-right"><img style="width: 50px;" src="<?php echo get_template_directory_uri(); ?>/images/top.png"></a></div>
<div class="col-sm-12 pull-right" style="margin-top: 14px;"><a class="pull-right" href="#"><img style="width: 50px;" src="<?php echo get_template_directory_uri(); ?>/images/chat.png"></a></div>
</div>
-->

<?php

}

?>
