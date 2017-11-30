<?php

//~ add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
//~ add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );



//~ add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 10 );
//~ remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 5 );
//~ add_action( 'custom_product_title', 'woocommerce_template_loop_product_title', 10 );

//~ function custom_product_title(){
	//~ echo '<h2 class="woocommerce-loop-product__title">132' . get_the_title() . '</h2>';
//~ }


//~ function test(){
	//~ echo '<a href="' . esc_url( get_the_permalink() ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
//~ }

//~ function test2() {
	//~ echo '</a>';
//~ }

//~ add_action( 'test', 'woocommerce_template_loop_product_link_open', 10 );
//~ add_action( 'test2', 'woocommerce_template_loop_product_link_close', 5 );

//~ remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 10 );
//~ apply_filters( 'woocommerce_template_loop_product_title', 'custom_product_title',10 );

//~ function custom_product_title(){
	//~ echo '<div>';
	//~ echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
	//~ echo '</div>'; 
//~ }

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


function woocommerce_template_loop_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ){	
	global $product;
	$productId	= get_the_ID();
	//~ $rating				=	$product->get_rating_count($productId);	
	//~ $rating_count		=	(( $rating / 5 ) * 100 );
	//~ $review_count		=	(($product->get_review_count($productId) / 5 ) * 100);
	//~ $average			=	(($product->get_average_rating($productId)/ 5 ) * 100);
	
	
	$rating_count	= $product->rating_counts['5'] / 5 * 100; //70	
	$review_count	= $product->rating_counts['3'] / 5 * 100;	//50
	$average	 	= $product->rating_counts['1'] / 5 * 100;	//10
				
	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );	
	
	$image	= 	get_the_post_thumbnail_url($productId,'rmv_expand_product');
	$image_exp	= 	get_the_post_thumbnail_url($productId,'expand_product_img');
	
	
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
	<div class="first_div">
	
	<div class="custom_rating">
					<div class="progress-bar-r">	
						<div class="progress-bar-rate first">
							<div class="progress-bar-custom position" data-percent="<?php echo $rating_count; ?>" data-duration="1000" data-color="#fff,#0e7c05" ></div>
						</div>
						<div class="progress-bar-rate first">
							<div class="progress-bar-custom position" data-percent="<?php echo $review_count; ?>" data-duration="1000" data-color="#fff,#ff6a1f"></div>
						</div>
						<div class="progress-bar-rate first">
							<div class="progress-bar-custom position" data-percent="<?php echo $average; ?>" data-duration="1000" data-color="#fff,#d11d05"></div>
						</div>
						<div class="progress-bar-rate">
							<div class="<?php echo $class;?> progress-bar-custom position heart" data-percent="<?php echo '75'; ?>" data-type="heart" data-duration="1000" data-color="#fff,#00a99d" data-id="<?php echo get_the_ID(); ?>">
								<?php //echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
							</div>
						</div>
				</div>
				</div>					
				<a href="<?php the_permalink(); ?>">
					<?php //echo $product ? $product->get_image( $image_size ) : ''; ?>
					<img data-exp="<?php echo $image_exp;?>" class="product-img" src="<?php echo $image;?>">	
					<img class="image_exp" src="<?php echo $image_exp;?>">				
				</a>	
	</div>
	<?php
}

//SET TEXT IN DISCOUNT
/*add_filter('woocommerce_sale_flash', 'my_custom_sale_flash', 10, 3);
function my_custom_sale_flash($text, $post, $_product)
{
	 global $product, $post;
    //~ echo "<pre>"; print_r($post->ID); exit;
    //~ $productId = get_the_ID();
    $productId =$post->ID;
		
	$deals_of_the_day	=	get_post_meta( $productId, 'deals_of_the_day'); 	
	if($deals_of_the_day[0] == '1') {
			$discount		=	get_post_meta( $productId, 'discount'); 
		echo '<span class="onsale">'.$discount[0].'%<span class="sale_text">OFF</span></span>';
	}    
}*/



add_action( 'save_post', 'wpse_110037_new_posts' );
function wpse_110037_new_posts($post_id){
    $post_type = get_post_type($post_id);
    $deals_of_the_day	=	get_post_meta( $post_id, 'deals_of_the_day'); 
    
    if($post_type == 'product' && $deals_of_the_day[0] == '1') {
			$discount		=	get_post_meta( $post_id, 'discount');  	
			$_price			=	get_post_meta( $post_id, '_price');
			$actual_price	= 	$_price[0]; 			
			$selling_price	= 	$actual_price - ($actual_price * ($discount[0] / 100));
			
			update_post_meta($post_id,'deal_of_day_price', $selling_price);
			//~ update_post_meta($post_id,'_sale_price', $actual_price);			
			
			//~ update_post_meta($post_id,'before_sale_actual_price', $actual_price);
			//~ update_post_meta($post_id,'_sale_price', $selling_price);			
    }
  
}


/*******Product Description Page*********/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_favourite_product', 15 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
function woocommerce_favourite_product(){
	global $product;
	$productId	= get_the_ID();	
	
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
	
	
<div class="custom_rating">
	<div class="progress-bar-r">
		<div class="progress-bar-rate">
			<div class="<?php echo $class;?> progress-bar-custom position heart" data-percent="<?php echo '75'; ?>" data-type="heart" data-duration="1000" data-color="#fff,#00a99d" data-id="<?php echo get_the_ID(); ?>">
				<?php //echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
			</div>
		</div>
	</div>
</div>
<?php
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) { 
    unset( $tabs['policies'] ); 			
    unset( $tabs['singleproductmultivendor'] );
    unset($tabs['description']);   
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'sb_woo_move_description_tab', 98);
function sb_woo_move_description_tab($tabs) {
	$tabs['company_profile']['priority'] = 5;
	$tabs['reviews']['priority'] = 6;
    $tabs['description']['priority'] = 7;   
    $tabs['other_vendor']['priority'] = 8;   
    $tabs['faq']['priority'] = 9;   
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
	
	$tabs['description'] = array(
		'title' 	=> __( 'Product Specification', 'woocommerce' ),
		'priority' 	=> 7,
		'callback' 	=> 'woo_specification_tab_content'
	);
	
	return $tabs;

}

function woo_specification_tab_content(){
	global $product,$wp_query;	
	
	$product_id = $wp_query->post->ID;
	$product = wc_get_product( $product_id );
	//~ echo "<pre>"; print_r($wp_query); echo "</pre>";
	// The new tab content
	$manufacture			=	get_post_meta( $product_id, 'manufacture');
	$place_of_origin		=	get_post_meta( $product_id, 'place_of_origin');
	$material				=	get_post_meta( $product_id, 'material');
	$warranty				=	get_post_meta( $product_id, 'warranty');
	$washable				=	get_post_meta( $product_id, 'washable');
	$product_certification	=	get_post_meta( $product_id, 'product_certification');
	$packagining_details	=	get_post_meta( $product_id, 'packagining_details');
	$delivery_time			=	get_post_meta( $product_id, 'delivery_time');
	
	$term_list = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids'));
	
	$category	="";
	if(!empty($term_list)){
		$category_name	=	array();	
		foreach($term_list as $val){
			$term	=	get_term_by('id', $val, 'product_cat');
			$category_name[]	=	$term->name;
		}
		$category	=	implode(", ",$category_name);
	}
	
	?>
	
<div class="Specifications-row">
<h3>Specifications</h3>

<div class="Specifications-l">

<div class="form-group">
<span class="name-Specifications">Product Name:</span>
<div class="name-Specifications-dcs"><?php echo $product->get_title(); ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Category:</span>
<div class="name-Specifications-dcs"><?php echo $category; ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Color: </span>
<div class="name-Specifications-dcs">Navy Blue</div>
</div>

<div class="form-group">
<span class="name-Specifications">Size:</span>
52 Inch
</div>

<div class="form-group">
<span class="name-Specifications">Manufacturer:</span>
<div class="name-Specifications-dcs"><?php echo $manufacture[0]; ?></div></div>

</div>


<div class="Specifications-r">

<div class="form-group">
<span class="name-Specifications">Place of Origin:</span>
<div class="name-Specifications-dcs"><?php echo $place_of_origin[0]; ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Material:</span>
<div class="name-Specifications-dcs"><?php echo $material[0]; ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Warranty: </span>
<div class="name-Specifications-dcs"><?php echo $warranty[0]; ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Washable:</span>
<div class="name-Specifications-dcs"><?php echo $washable[0]; ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Product Certifications:</span>
<div class="name-Specifications-dcs"><?php echo $product_certification[0]; ?></div></div>

</div>



</div>





<div class="Specifications-row">
<h3>Packaging & Delivery</h3>
<div class="Specifications-l">

<div class="form-group">
<span class="name-Specifications">Packaging Details:</span>
<div class="name-Specifications-dcs"><?php echo $packagining_details[0]; ?></div>
</div>

<div class="form-group">
<span class="name-Specifications">Delivery Time:</span>
<div class="name-Specifications-dcs"><?php echo $delivery_time[0]; ?></div>
</div>
</div>



</div>

<?php
	
}

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {	
	// Adds the new tab	
	global $product, $wp_query;
	$product_id	 	= $wp_query->post->ID;	
	$product = wc_get_product( $product_id );
	
    $check_product_review_count = $product->get_review_count();
    if ( $check_product_review_count == 0 ) {
        $tabs['reviews']['title'] = 'Reviews';
    } else {
        $tabs['reviews']['title'] = 'Reviews('.$check_product_review_count.')';
    }
    
	
	$tabs['company_profile'] = array(
		'title' 	=> __( 'Company Profile', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_company_profile_tab_content'
	);

	return $tabs;

}
function woo_company_profile_tab_content() {
	// The new tab content

	global $product, $wp_query;
	$product_id	 	= $wp_query->post->ID;	
	$manufacture	=	get_post_meta( $product_id, 'manufacture');	
	
	$videos	=	get_post_meta( $product_id, 'wo_di_video_product_videos');	
	$product_videos	=	json_decode($videos[0]);
	
?>
	<div class="Specifications-row">
<h3 class="Silkwear-Fabrics-tittle"><?php echo $manufacture[0]; ?></h3>
<div class="Specifications-l">
<div class="form-group">
<span class="name-Specifications">Business Type:</span>
<div class="name-Specifications-dcs">Manufacturer</div>
</div>
<div class="form-group">
<span class="name-Specifications">Main Products:</span>
<div class="name-Specifications-dcs">Cloths, Tops, Gowns,Nightwear, </div>
Sportswear
</div>
<div class="form-group">
<span class="name-Specifications">Total Annual Revenue</span>
<div class="name-Specifications-dcs">Total Annual Revenue</div>
</div>
<div class="form-group">
<span class="name-Specifications">Location:</span>
<div class="name-Specifications-dcs">Zhejiang, China (Mainland)	</div>
</div>
<div class="form-group">
<span class="name-Specifications">Total Employees:</span>
<div class="name-Specifications-dcs">51 - 100 People</div> </div>
</div>

<div class="Specifications-r">
<div class="form-group">
<span class="name-Specifications">Response Time :</span>
<div class="name-Specifications-dcs">3 Hours</div>
</div>
<div class="form-group">
<span class="name-Specifications">Response Rate:</span>
<div class="name-Specifications-dcs">85 %</div>
</div>
<div class="form-group">
<span class="name-Specifications">Stock: </span>
<div class="name-Specifications-dcs">10,000 Pieces / Year</div>
</div>
<div class="form-group">
<span class="name-Specifications">Year Established:</span>
<div class="name-Specifications-dcs">2006</div>
</div>
<div class="form-group">
<span class="name-Specifications">Product Certifications:</span>
<div class="name-Specifications-dcs">CE,CE,CE,CE</div></div>
</div>

</div>

<div class="Specifications-row">
<h3 class="company-reviews">Company video & photos</h3>
<ul class="company-video">
	<?php if(!empty($product_videos)){
		foreach($product_videos as $val){
			//~ echo "<pre>"; print_r($val); exit;
		 ?>
			<li><?php 
			if($val->type == "Embedded"){
				echo $val->embebido; 
			}
			?>			
			</li>			
		<?php 
		}
	} else { ?>
<li><img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/images/company-video-01.jpg" /></li>
<li><img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/images/company-video-02.jpg" /></li>
<li><img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/images/company-video-03.jpg" /></li>
<li><img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/images/company-video-04.jpg" /></li>
<li><img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/images/company-video-05.jpg" /></li>
<?php } ?>
</ul>
<div class="clearfix"></div>
<div class="commentlist_secton company-reviews-part">
<h3 class="company-reviews">Company Reviews <span>(10)</span></h3>	
<ol class="commentlist">
<li>
	<div class="comment_container">
		<div class="comment-text">
			<div class="description"><p>1st star rating</p>
</div><div class="star-rating"><span style="width:20%">Rated <strong class="rating">1</strong> out of 5</span></div>
	<p class="meta">
		<strong class="woocommerce-review__author">admin</strong> <span class="woocommerce-review__dash">&ndash;</span> <time class="woocommerce-review__published-date" datetime="2017-11-15T02:44:59+00:00">November 15, 2017</time>
	</p>
		</div>
	</div>
</li>
</ol>
</div>
</div>


	<?php
}


add_filter( 'woocommerce_product_tabs', 'woo_faq_tab' );
function woo_faq_tab( $tabs ) {
	
	// Adds the new tab
	
	$tabs['faq'] = array(
		'title' 	=> __( 'F.A.Q', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_faq_tab_content'
	);

	return $tabs;

}
function woo_faq_tab_content() {
	global $product, $wp_query;	
	$current_page_id = $wp_query->post->ID;
	$faq	=	get_post_meta( $current_page_id, 'faq');	
	echo $faq[0];
	
	/*<div class="faq-row"><h4>Q1- Are you a manufacturer?</h4><p>Yes, we are a certified manufacturer and have been involved in this industry from last 10 years.</p></div><div class="faq-row"><h4>Q2-Could you send us samples?</h4><p>Yes.</p><p>- Stock sample is free of cost and new partners can pay the shipping (express) fee.</p><p>- If the sample is not in the stock, we can produce it for you as per your requirement. New partners need to pay the sample fee, which can be deducted from the bulk order. The shipping fee can be paid at the destination.</p></div><div class="faq-row"><h4>Q3-Can we have some inspection done to insure the quality of products?</h4><p>Yes, Olio provides you with different quality check(QC) options. You can select any one or can have your own.</p></div><div class="faq-row"><h4>Q4- Which kind of payments do you accept?</h4><p>We accept VISA, MasterCard, debit card with our very secure payment gateway.(TBD)</p></div><div class="faq-row"><h4>Q5- Can you do bulk orders?</h4><p>Yes. We have the capacity to manufacture more than 25000 pieces in a month.(TBD)</p></div><div class="faq-row"><h4>Q6-What are the shipping options and how much time it will take?</h4><p>Redirect them to the shipping page</p></div>*/
}

add_filter( 'woocommerce_product_tabs', 'woo_other_vendor_tab' );
function woo_other_vendor_tab( $tabs ) {
	
	// Adds the new tab
	
	$tabs['other_vendor'] = array(
		'title' 	=> __( 'Other Vendors', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_other_vendor_tab_content'
	);

	return $tabs;

}
function woo_other_vendor_tab_content() {
	// The new tab content
	//echo '<h2>Under Construction</h2>';	
	echo do_shortcode('[others_vendor]');
}



/***product detail page tab section*/
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
remove_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10 );

add_action( 'woocommerce_review_meta', 'woocommerce_review_display_rating', 9 );
add_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
add_action( 'woocommerce_review_meta', 'woocommerce_review_display_comment_text', 8 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerce_output_related_products', 8 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary_custom', 'woocommerce_upsell_display', 12 );
/****/



/*******Product Description Page*********/




/*************Modified cart itmes count in header*************/
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	
			
	if(! is_page_template('product-slider-page.php') ) { 
    
	?>
			<div class="product-cart count_cart_item float-left">						
			<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					?>
				<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
				<span>
					<?php echo sprintf ( _n( '%d item', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
					</span>
				</a>
			<?php } ?>
			</div>
	<?php }
	
	$fragments['.count_cart_item'] = ob_get_clean();
	return $fragments;
}
/*************Modified cart itmes count in header*************/


function do_anything() {
    //do stuff
    global $wpdb,$current_user;
    if(isset($_REQUEST['qrHash']) && $_REQUEST['qrHash'] != "" ){
		$table_name  = "wp_qrLogin";
		$user_login	=	$_REQUEST['username'];
		$rows_affected = $wpdb->update( $table_name, array( 'hash' => $_REQUEST['qrHash'],'uname' => $user_login ), array( 'hash' => $_REQUEST['qrHash'] ) );
	}
}
add_action('wp_login', 'do_anything');


add_filter('woocommerce_login_redirect', 'wpse125952_redirect_to_request', 50, 3); 
function wpse125952_redirect_to_request($redirect_to, $requested_redirect_to, $user){
//is there a user to check?
       //~ if ($requested_redirect_to == admin_url()) {
           //~ if (isset($user->roles) && is_array($user->roles)) {
               //check for admins
               //~ if (in_array('dc_vendor', $user->roles)) {
                   // redirect them to the default place
                   //~ $redirect_to = get_permalink(wcmp_vendor_dashboard_page_id());
               //~ }
           //~ }
       //~ }
       
ob_start();	
$redirect_to	=	site_url();
ob_end_flush();
return $redirect_to;
}


?>
