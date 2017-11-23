<?php 
add_image_size( 'member_product_small', 230,120, true );
add_image_size( 'member_product_big', 230,230, true );

add_image_size( 'rmv_expand_product', 235,230, true );
add_image_size( 'expand_product_img', 512,230, true );
add_image_size( 'you_may_like_thumb', 90,90, true );



wp_register_script( 'b2b-script', plugins_url() );
wp_enqueue_script( 'b2b-script' );
$current_url	=	site_url();
$translation_array = array( 'ajax_url' => admin_url('admin-ajax.php'), 
	'homeurl'      => preg_replace("(^https?://)", "//", get_home_url( null, "", "https" )),	
	'pluginUrl' => plugins_url('',__FILE__) , 'currentUrl'=> $current_url) ;
wp_localize_script( 'b2b-script', 'b2b_obj', $translation_array );



	//~ wp_enqueue_script( 'qrLogin_js', plugins_url( '/js/qrLogin.js', __FILE__ ), array( 'jquery' ) );
	//~ wp_localize_script( 'qrLogin_js', 'qrLoginAjaxRequest', array(
					//~ 'ajaxurl'      => admin_url( 'admin-ajax.php' ),
					//~ 'homeurl'      => preg_replace("(^https?://)", "//", get_home_url( null, "", "https" )),
					//~ 'qrLoginNonce' => wp_create_nonce( 'qrLogin-nonce' ),
					//~ 'reloadNonce'  => wp_create_nonce( 'reload-nonce' )
				//~ )



add_shortcode( 'my_products', 'bbloomer_user_products_bought' );
 
function bbloomer_user_products_bought() {
	
global $product, $woocommerce, $woocommerce_loop;
$current_user = wp_get_current_user();

$metakey_array = array(
	array('key' => 'deals_of_the_day','value' => '1','compare' => '!=')
);

$args = array(
    'post_type'         => 'product',
    'post_status'       => 'publish',
    'posts_per_page'	=> 12,
    'post_author'	 	=> 1,
    'meta_query' => array(
		'relation' => 'AND',
		$metakey_array
	)
);
$wc_query = new WP_Query($args); 
?>

 <div class="col-sm-9 dimond_members">
	 <h3>
		<?php 
		if( is_page( array( 'deals-of-the-day') )){
			_e( 'Member producs display (Dimond members)' ); 
		}else{
		_e( 'Premium Products' ); 
		} ?>
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
				
				$rating_count		=	75;
				$review_count		=	55;
				$average			=	30;
				
				//~ $image 				= 	get_the_post_thumbnail_url($product_id,'medium');
				if($i == 1 || $i == 4 || $i == 6  || $i == 7){
					$image	= 	get_the_post_thumbnail_url($product_id,'member_product_big');
					
				}else{
					$image 	= 	get_the_post_thumbnail_url($product_id,'member_product_small');
				}
			
			//~ the_post_thumbnail( 'postbox-thumb', array( 'width' => 100, 'height' => 100 ) )
				global $wpdb;
				$user_id = get_current_user_id();
				$results = $wpdb->get_results( 'SELECT prod_id FROM wp_yith_wcwl WHERE user_id ='.$user_id);
				foreach ($results as $prod_id) {
					$prod_ids[] = $prod_id->prod_id;
				}
				$prod_ids = array_unique($prod_ids);
				if(in_array(get_the_ID(), $prod_ids)){
					$class = "wishlist_added";
				}else{ $class = "";}
	
     ?>	
      <div class="col-sm-3 right-space product_<?php echo $i; ?>">
		<div class="dimond-products">
			<div class="product-overlay">
				<a href="<?php the_permalink(); ?>">
					<img class="product-img" src="<?php echo $image;?>">					
				</a>
				<?php if( is_page( array( 'deals-of-the-day') )){ ?>
				<span class="offer">50% off</span>
				<?php } ?>
			</div>
			<div class="product-content">
          <h3>
               <?php the_title(); ?>              
          </h3>     
          <div class="col-md-12 clearfix">
          <div class="dimaond_product_price">
			  
			  <?php 
			 if( is_page( array( 'deals-of-the-day') )){
				echo "$34";
				echo "<span>$70</span>"; 
			 }else{
			  echo $product->get_price_html(); ?><?php _e( 'Per Piece' ); 
			}
			  ?>
			  </div>
          <div class="view-details"><a href="<?php the_permalink(); ?>"><?php _e( 'View Details' ); ?></a></div>
          </div>
          <div class="col-md-12 clearfix">	
		  <div class="progress-bar-l">
		            <div class="dimaond_product_qty">			  
			  <b>MQR:</b><br /><?php echo $stock_quantity; ?>&nbsp;<?php _e( 'Piece' ); ?>			  
			</div>
			</div>

				<div class="progress-bar-r">	
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo $rating_count; ?>" data-duration="1000" data-color="#fff,#0e7c05" ></div>
					</div>
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo $review_count; ?>" data-duration="1000" data-color="#fff,#ff6a1f"></div>
					</div>
					<div class="progress-bar-rate">
						<div class="progress-bar-custom position" data-percent="<?php echo $average; ?>" data-duration="1000" data-color="#fff,#d11d05"></div>
					</div>
					<div class="progress-bar-rate">
						<div class="<?php echo $class;?> progress-bar-custom position heart" data-percent="<?php echo '75'; ?>" data-type="heart" data-duration="1000" data-color="#fff,#00a99d" data-id="<?php echo get_the_ID(); ?>">
							<?php //echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
						</div>
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
	<script type="text/javascript">		

	</script>
</div>

<div class="col-sm-3">
<div class="home-add-banner">
   <?php // _e( 'Google Adsens1', 'oliord' ); ?>
<div id='afscontainer1'><div id='afscontainer2'><img src="<?php echo get_template_directory_uri(); ?>/images/g adv.jpg"></div></div>

<?php  //_e( 'Google Adsens2', 'oliord' ); ?>

  <div id='afscontainer2'><img src="<?php echo get_template_directory_uri(); ?>/images/g adv.jpg"></div>
</div>
<div class="col-sm-12" ><a href="#top" class="pull-right back-to-top"><i class="fa fa-angle-double-up"></i></a></div>
<div class="col-sm-12 pull-right" style="margin-top: 14px;"><a class="pull-right shair-ico" href="#"><i class="fa fa-commenting" aria-hidden="true"></i></a></div>
</div>


<?php

}


/*** background logo****/
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Olio';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo_old.png);
		/*height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }*/
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
/*** background logo****/



add_shortcode( 'deals_count_down', 'deals_count_down_fun' );
 
function deals_count_down_fun() {
	
global $product, $woocommerce, $woocommerce_loop,$wpdb;

$cur_date 	= date('H'); 

$metakey_array = array(
	array('key' => 'deals_of_the_day','value' => '1','compare' => '='),						
	//~ array('key' => 'deals_end_date','value' => date('Ymd'),'compare' => '>=')
);

//~ $urs_array = array(
	//~ 'key' => 'hours',
	//~ 'value' => $cur_date,
	//~ 'compare' => '>=',
	//~ 'type' => 'NUMERIC'
//~ );	

//~ array_push($metakey_array,$urs_array);		

$args = array(
		'post_type' => 'product',					
		'post_status'    => 'publish',					
		'posts_per_page' => 4,
		'meta_query' => array(
			'relation' => 'AND',						
			$metakey_array				
		)
	);	
	
$products = new WP_Query( $args ); 

$arr_ProductId	=	array();
if ( $products->have_posts() ) {
	while ( $products->have_posts() ) : $products->the_post(); 	
		$arr_ProductId[]	= get_the_ID();
	endwhile;
}

$product_ids = implode(",",$arr_ProductId);
//~ $sql_hours = $wpdb->get_row( $wpdb->prepare( "SELECT min(meta_value) as hours FROM wp_postmeta WHERE meta_key LIKE 'hours' and meta_value > HOUR(NOW()) ORDER BY meta_value  ASC" ) );

$sql_hours = $wpdb->get_row( $wpdb->prepare( "SELECT meta_value as hours FROM wp_postmeta WHERE meta_key LIKE 'hours' and post_id in ($product_ids) ORDER BY `wp_postmeta`.`meta_value`  DESC limit 0, 1" ) );


$get_hour	=	$sql_hours->hours;	

$get_hour	=	21;



//~ echo "<pre>"; print_r($products); exit;

$cur_date 	= date('H:i:s'); 
$date 		= date($get_hour.':00:00');
 
$exp_date = strtotime($date);
$now = strtotime($cur_date);

//~ if ($now < $exp_date) {
?>
<script>
// Count down milliseconds = server_end - server_now = client_end - client_now
var server_end = <?php echo $exp_date; ?> * 1000;
var server_now = <?php echo $now; ?> * 1000;
var client_now = new Date().getTime();

var end = server_end - server_now + client_now; // this is the real end time

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour *24
var timer;

function showRemaining()
{
    var now = new Date();
    var distance = end - now;
    if (distance < 0 ) {
       clearInterval( timer );
       document.getElementById('countdown').innerHTML = 'EXPIRED!';
       location.reload();
       return;
    }
    var days = Math.floor(distance / _day);
    var hours = Math.floor( (distance % _day ) / _hour );
    var minutes = Math.floor( (distance % _hour) / _minute );
    var seconds = Math.floor( (distance % _minute) / _second );

    var countdown = document.getElementById('countdown');
    countdown.innerHTML = '';
    if (days) {
        countdown.innerHTML += 'Days: ' + days + '<br />';
    }
    countdown.innerHTML += hours+ ':&nbsp;'+minutes + ':&nbsp;'+seconds;
    
}

timer = setInterval(showRemaining, 1000);
</script>

<div class="flash_deals woocommerce col-sm-12">	
	<h3><span><?php esc_html_e( 'Flash Deals', 'woocommerce' ); ?></span></h3>
	<div id="countdown"></div>
		<ul class="row product">
		<?php 
		if ( $products->have_posts() ) {
		while ( $products->have_posts() ) : $products->the_post(); 
		?>		
				<li class="col-lg-3 col-md-4 col-sm-6 form-group">
					<div class="product-pad form-group">
						<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					</div>
				</li>
		<?php endwhile; 
		}else{// end of the loop.  ?>
			<li>No records found</li>
	<?php	}
		?>
		</ul>
</div>	

<?php 
}



add_shortcode( 'you_may_like', 'you_may_like_product_fun' );
 
function you_may_like_product_fun() {
	
global $product, $woocommerce, $woocommerce_loop, $wpdb;;
$current_user = wp_get_current_user();

//~ $metakey_array = array(
	//~ array('key' => 'deals_of_the_day','value' => '1','compare' => '!=')
//~ );

$args = array(
    'post_type'         => 'product',
    'post_status'       => 'publish',
    'posts_per_page'	=> 5,
    //~ 'meta_query' => array(
		//~ 'relation' => 'AND',
		//~ $metakey_array
	//~ )
);
$wc_query = new WP_Query($args); 
$results = $wpdb->get_results( 'SELECT * FROM wp_yith_wcwl ORDER BY ID DESC LIMIT 0 , 4');

?>
<div class="detail-r">
	<h3 class="you-may-like"><?php _e( 'You May Like' ); ?></h3>
	<div class="dimond-products-list">
		<?php 
		foreach ($results as $prod_id) {
			$wc_query->the_post();
			$product_id			= 	$prod_id->prod_id;

			$product		= 	wc_get_product( $product_id );				
			$image			= 	get_the_post_thumbnail_url($product_id,'you_may_like_thumb');

			?>	
				<div class="you_may_like_sidebar">
					<div class="product-overlay">
						<a href="<?php the_permalink($product_id); ?>"><img class="product-img" src="<?php echo $image;?>"></a>
					</div>
					<div class="product-content">
						<h3><?php the_title(); ?></h3>     
							
								<div class="dimaond_product_price">			  
								<?php echo $product->get_price_html(); ?>
								</div>        
								
									<div class="progress-bar-l">
										<div class="dimaond_product_qty">			  
											<b>MQR:</b><?php echo $stock_quantity; ?>&nbsp;<?php _e( 'Piece' ); ?>			  
										</div>
									</div>												
						</div>	  
					</div>
			<?php
		} ?>
	</div>
</div>
<?php
}



add_shortcode( 'top_sell_item', 'top_sell_item_fun' );
 
function top_sell_item_fun() {
	
global $product, $woocommerce, $woocommerce_loop, $wpdb;;
//~ $args = array(
    //~ 'post_type' => 'product',
    //~ 'meta_key' => 'total_sales',
    //~ 'orderby' => 'meta_value_num',
    //~ 'posts_per_page' => 1,
//~ );
 //~ 
//~ $loop = new WP_Query( $args );

$wc_query = new WP_Query($args); 
$results = $wpdb->get_results( 'SELECT * FROM wp_yith_wcwl ORDER BY ID DESC LIMIT 0 , 5');

?>
<div class="detail-r">
	<h3 class="you-may-like"><?php _e( 'Customer who bought items in your cart also bought' ); ?></h3>
	<div class="dimond-products-list">
		<?php 
		foreach ($results as $prod_id) {
			$wc_query->the_post();
			$product_id			= 	$prod_id->prod_id;

			$product		= 	wc_get_product( $product_id );				
			$image			= 	get_the_post_thumbnail_url($product_id,'you_may_like_thumb');

			?>	
				<div class="you_may_like_sidebar">
					<div class="product-overlay">
						<a href="<?php the_permalink($product_id); ?>"><img class="product-img" src="<?php echo $image;?>"></a>
					</div>
					<div class="product-content">
						<h3><?php the_title(); ?></h3>     
							
								<div class="dimaond_product_price">			  
								<?php echo $product->get_price_html(); ?>
								</div>        
								
									<div class="progress-bar-l">
										<div class="dimaond_product_qty">			  
											<b>MQR:</b><?php echo $stock_quantity; ?>&nbsp;<?php _e( 'Piece' ); ?>			  
										</div>
									</div>												
						</div>	  
					</div>
			<?php
		} ?>
	</div>
</div>
<?php
}


add_shortcode( 'others_vendor', 'others_vendor_fun' );
 
function others_vendor_fun() {
	
global $product, $woocommerce, $woocommerce_loop,$wpdb;

$product_id		= $product->get_id();
$vendor_id 		= 	get_post_field( 'post_author', $product_id );

$args = array(
		'post_type' => 'product',					
		'post_status'    => 'publish',					
		'posts_per_page' => 4,
		'author__not_in' => array( $vendor_id )
	);	

$products = new WP_Query( $args ); 

?>

<div class="flash_deals woocommerce col-sm-12 other_vendor">	
	<h3><span><?php esc_html_e( 'Products from other Vendors', 'woocommerce' ); ?></span></h3>
		<ul class="row">
		<?php 
		if ( $products->have_posts() ) { 
		while ( $products->have_posts() ) : $products->the_post(); ?>		
				<li class="col-lg-3 col-md-4 col-sm-6 form-group">
					<div class="product-pad form-group">
						<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					</div>
				</li>
		<?php endwhile; 
		}else{// end of the loop.  ?>
			<li>No records found</li>
	<?php	}
		?>
		</ul>
</div>	

<?php 
}

function cw_change_product_price_display( $price ) {
	if( is_page( array( 'deals-of-the-day') )){
		return $price;
	}else{
		$price_r	=	$price;
		$price =  str_replace( '</span></ins>', ' Per Piece </span></ins>', $price_r );
		return $price;
	}
}
	add_filter( 'woocommerce_get_price_html', 'cw_change_product_price_display' );
	add_filter( 'woocommerce_cart_item_price', 'cw_change_product_price_display' );
?>
