<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );

		//~ echo "<pre>"; print_r($_REQUEST); echo "</pre>";
if(!empty($_REQUEST)){
	$search_item	=	trim($_REQUEST['search_string']);	
	
	if(trim($_REQUEST['search_type'])	==	"Supplier"){
		
		$args = array(
			's' => $search_item,
			'role'	=> 'dc_vendor'
		);
		
		$user_query = new WP_User_Query( $args );
		
		if ( ! empty( $user_query->results ) ) {
			$ID_ARR	=	array();
			foreach ( $user_query->results as $user ) {
				$ID_ARR[]	=	$user->ID;		
			}
		}		
		$seller_ids	=	implode(',',$ID_ARR);		
	}
	
	if(trim($_REQUEST['search_type'])	==	"Product"){
		$args = array(
					'post_type' => 'product',
					'orderby' => 'date',
					'order' => 'DESC',					
					's' => $search_item,
					'post_status'    => 'publish',
					'paged' => get_query_var( 'paged' ),
				);
	}else{		
			$args = array(
					'post_type' => 'product',
					'orderby' => 'date',
					'order' => 'DESC',
					'author' => $seller_ids,
					'post_status'    => 'publish',
					'paged' => get_query_var( 'paged' )
				);
		
	}
	
	
}else{
	 $args = array(
					'post_type' => 'product',
					'orderby' => 'date',
					'order' => 'DESC',
					'post_status'    => 'publish',
					'paged' => get_query_var( 'paged' )
				);
}
//~ echo "<pre>"; print_r($args); echo "</pre>";
		wp_reset_query();
		 $wp_query = new WP_Query( $args );
		 ?>
		 
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
<div class="abc">
    <header class="woocommerce-products-header">

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			
		?>

    </header>

		

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
</div>
<div class="row">
	
	
	<div class="col-sm-8">
				<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php 

						if ( $wp_query->have_posts() ) :
						
					while ( have_posts() ) : the_post(); 
							//~ while ( $wp_query->have_posts() ) : $wp_query->the_post();
					?>

						<?php
							/**
							 * woocommerce_shop_loop hook.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );
						?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. 
						
						woocommerce_product_loop_end(); 
					/**
					 * woocommerce_after_shop_loop hook.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
					
								
				/*$total_pages = $products->max_num_pages; 

				if ($total_pages > 1){

					$current_page = max(1, get_query_var('paged'));
					
					?>
					<nav class="woocommerce-pagination">
	<?php
					echo paginate_links(array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => '/page/%#%',
						'current' => $current_page,
						'total' => $total_pages,
						'prev_text'    => __('« prev'),
						'next_text'    => __('next »'),
					)); ?>
					</nav>
					<?php
				 
				}*/
				
				
					
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
	</div>
</div>		

<div class="col-sm-4">
		<?php dynamic_sidebar('filter'); 	 ?>
	</div>					
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */		
		 //~ do_action( 'woocommerce_sidebar' );
	  	 	
	
wp_reset_postdata();					

get_footer( 'shop' ); ?>
