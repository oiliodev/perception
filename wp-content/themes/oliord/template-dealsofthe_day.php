<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Deas Of the day
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

	$price = $_REQUEST['price'];
	$discount = $_REQUEST['discount'];
	$review = $_REQUEST['review'];
	$sort = $_REQUEST['sort'];
	
	$checked_1 = "";
	$checked_2 = "";
	$checked_3 = "";
	$checked_4 = "";
	
	$deal_checked_1 = "";
	$deal_checked_2 = "";
	$deal_checked_3 = "";
	
	$review_checked_1 = "";
	$review_checked_2 = "";
	$review_checked_3 = "";
	$review_checked_4 = "";
	
	if($price == 1){
		$checked_1 = 'checked="checked"';
	}	
	if($price == 2){
		$checked_2 = 'checked="checked"';
	}
	
	if($price == 3){
		$checked_3 = 'checked="checked"';
	}
	
	if($price == 4){
		$checked_4 = 'checked="checked"';
	}
	
	
	if($discount == 10){
		$deal_checked_1 = 'checked="checked"';
	}	
	if($discount == 25){
		$deal_checked_2 = 'checked="checked"';
	}
	
	if($discount == 50){
		$deal_checked_3 = 'checked="checked"';
	}
	
	
	if($review == 1){
		$review_checked_1 = 'checked="checked"';
	}	
	if($review == 2){
		$review_checked_2 = 'checked="checked"';
	}	
	if($review == 3){
		$review_checked_3 = 'checked="checked"';
	}
	
	if($review == 4){
		$review_checked_4 = 'checked="checked"';
	}
 ?>
<div class="container">
<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		//~ do_action( 'woocommerce_before_main_content' );
	?>
<div class="row woocommerce">
	<div class="col-sm-12">		
		<?php //echo do_shortcode('[deals_of_the_day_filter]');	
?>

<div class="filter-man">
	<div class="filter align-middle">		
		<div class="drop-down">
			<select name="deal_sort" id="deal_sort" class="filter_select">
				<option value="0" field="" order="">Sort By</option>
				<option value="1" field="_sale_price" <?php if($sort == 1){ echo "selected"; } ?> order="asc">Price- Low to High</option>
				<option value="2" field="_sale_price" <?php if($sort == 2){ echo "selected"; } ?> order="desc">Price- High to Low</option>
				<option value="3" field="discount" <?php if($sort == 3){ echo "selected"; } ?> order="asc">Discount- Low to High</option>
				<option value="4" field="discount" <?php if($sort == 4){ echo "selected"; } ?> order="desc">Discount- High to Low</option>			
			</select>
		</div>
	</div>
	<div class="d-inline-block filter-button align-middle ml-2">
		<a class="click_filter_toogle" href="javascript:void(0);" onclick="click_filter()" >FILTERS</a>
	</div>
	<div class="filter-sidebar">
		<div class="click_filter">
			<div class="side-bar-filter" style="display:none;">		
				<div class="filter text-left">
					<div class="drop-down no-before">
						
						<div class="price-section">
							<label class="heading">Price</label>
							<div class="filter-row"><input type="checkbox" name="deal_price" id="filter_0" class="deal_price filter_select" <?php echo $checked_1;?> value="1" min="0" max="24">
							<label for="filter_0"> <span></span> Under $25 </label>
							</div>
							<div class="filter-row"><input type="checkbox" name="deal_price" id="filter_1" class="deal_price filter_select" <?php echo $checked_2;?> value="2" min="25" max="50"> <label for="filter_1"> <span></span> $25 to $50 </label></div>
							<div class="filter-row"><input type="checkbox" name="deal_price" id="filter_2" class="deal_price filter_select" <?php echo $checked_3;?> value="3" min="50" max="100"> <label for="filter_2"> <span></span> $50 to $100 </label>
							</div>
							<div class="filter-row"><input type="checkbox" name="deal_price" id="filter_3" class="deal_price filter_select" <?php echo $checked_4;?> value="4" min="100" max="200"> <label for="filter_3"> <span></span> $100 to $200 </label></div>
						</div>
					
						<div class="deal_discount-section">
							<label class="heading">Discount</label>
							<div class="filter-row"><input type="checkbox" name="deal_discount" id="filter_4" class="deal_discount filter_select" <?php echo $deal_checked_1;?> value="10" min_disc="10" max_disc="99"> <label for="filter_4"> <span></span> 10% off or More </label></div>
							<div class="filter-row"><input type="checkbox" name="deal_discount" id="filter_5" class="deal_discount filter_select" <?php echo $deal_checked_2;?> value="25" min_disc="25" max_disc="99"> <label for="filter_5"> <span></span> 25% off or More </label></div>
							<div class="filter-row"><input type="checkbox" name="deal_discount" id="filter_6" class="deal_discount filter_select" <?php echo $deal_checked_3;?>  value="50" min_disc="50" max_disc="99"> <label for="filter_6"> <span></span> 50% off or More </label></div>
						</div>
					
						<div class="deal_review-section">
							<label class="heading">Average Customer Review</label>
							<div class="filter-row review_for"><input type="checkbox" name="review" id="filter_7" class="review filter_select" <?php echo $review_checked_4;?> value="4" min_review="4" max_review="4.99"> <label for="filter_7"> <span></span>  </label></div>
							<div class="filter-row review_three"><input type="checkbox" name="review" id="filter_8" class="review filter_select" <?php echo $review_checked_3;?> value="3" min_review="3" max_review="3.99"> <label for="filter_8"> <span></span></label></div>
							<div class="filter-row review_tow"><input type="checkbox" name="review" id="filter_9" class="review filter_select" <?php echo $review_checked_2;?> value="2" min_review="2" max_review="2.99"> <label for="filter_9"> <span></span> </label></div>
							<div class="filter-row review_one"><input type="checkbox" name="review" id="filter_10" class="review filter_select" <?php echo $review_checked_1;?> value="1" min_review="1" max_review="1.99"> <label for="filter_10"> <span></span></label></div>
						</div>
					</div>
				</div>
				</div>
			</div> 
		</div>
	</div>
</div>	
	<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$metakey_array = array(
						array('key' => 'deals_of_the_day','value' => '1','compare' => '='),						
						array('key' => 'deals_end_date','value' => date('Ymd'),'compare' => '>=')
					);
	
	if(isset($_REQUEST['price']) && $_REQUEST['price'] != 0){
		
		$price = $_REQUEST['price'];
		$min_price = $_REQUEST['min_price'];
		$max_price = $_REQUEST['max_price'];
		
		$price_array = array(
			'key' => '_sale_price',
			'value' => array($min_price, $max_price),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		);			
		array_push($metakey_array,$price_array);
	}
	
	
	if(isset($_REQUEST['discount']) && $_REQUEST['discount'] != 0){
		
		$discount = $_REQUEST['discount'];
		$min_disc = $_REQUEST['min_disc'];
		$max_disc = $_REQUEST['max_disc'];
		
		$discount_array = array(
			'key' => 'discount',
			'value' => array($min_disc, $max_disc),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		);			
		array_push($metakey_array,$discount_array);
	}
	
	if(isset($_REQUEST['review']) && $_REQUEST['review'] != 0){
		
		$review = $_REQUEST['review'];
		$min_review = $_REQUEST['min_review'];
		$max_review = $_REQUEST['max_review'];
		
		$review_array = array(
			'key' => '_wc_average_rating',
			'value' => array($min_review, $max_review),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		);			
		array_push($metakey_array,$review_array);
	}
	
	
	
	 $current = date("Y-m-d");
	 $args = array(
					'post_type' => 'product',					
					'post_status'    => 'publish',					
					'posts_per_page' => 9,
					'meta_query' => array(
						'relation' => 'AND',						
						$metakey_array				
					),
					'paged' => $paged
				);	
		
		if(isset($_REQUEST['sort']) && $_REQUEST['sort'] != 0){
			$sort = $_REQUEST['sort'];
			$field = $_REQUEST['field'];
			$order = $_REQUEST['order'];	
			
			$args['meta_key'] = $field;
			$args['orderby'] = 'meta_value_num';
			$args['order'] = $order;
		}else{
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		}
		
		/*echo "<pre>";
		print_r($args);*/
		
		     $loop = new WP_Query( $args );
		 if ( $loop->have_posts() ) : ?>
			<div class="col-sm-12 catlog_products">
			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				//~ do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
				<?php $i = 1;
				$coun_Arr	=	array(3,4,8,12); ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); 
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
						$classes =	"product";
						if(in_array($i,$coun_Arr)){
							$classes =	"product expand";						
						}
					?>
						<li class="<?php echo $classes; ?>" >
							<div class="product-pad">
								<?php wc_get_template_part( 'content', 'product' ); ?>
							</div>
						</li>					
					<?php
					if(($i%3) == 0 && $i < 9){
					echo '</ul><ul class="products row">';
				}
				$i++;
				endwhile; // end of the loop. ?>
			<?php woocommerce_product_loop_end(); ?>
			<div class="pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $loop->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( '<', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( '>', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>
	
		</div>	

	
<?php 
 echo do_shortcode('[deals_count_down]'); 
?> 

	<?php /****************/ ?>


			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
		<?php
			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			//~ do_action( 'woocommerce_sidebar' );
			
		?>



<?php /****************/ ?>
</div>

<?php get_footer( 'shop' ); ?>
