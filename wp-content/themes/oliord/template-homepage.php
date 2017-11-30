<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header('vesion');
$unique_id = esc_attr( uniqid( 'search-form-' ) ); 
 ?>
 
	<div id="primary" class="content-area home-Member-pad">
		<main id="main" class="site-main" role="main">	
			<div class="row">
				
			<?php echo do_shortcode('[my_products]'); ?>
	
			<div class="col-xl-9 col-lg-12 col-sm-12 clearfix how-it-work-section" id="how-it-works">
<h3>How it Works</h3>
				<div class="row">
					<div class="col-lg-3 col-sm-6 placeholder mb-4">
					 <div class="icon-how-work"><!--<i class="fa fa-shopping-cart" aria-hidden="true"></i>--> <div class="how-work-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/how-it-work-ico01.png"></div></div>
					  <h4>Buy</h4>
					  <div class="text-muted">Olio helps you to reach out to multiple vendors. Thousands of products to choose from.</div>
					</div>
					<div class="col-lg-3 col-sm-6 placeholder mb-4">
					  <div class="icon-how-work"><!--<i class="fa fa-thumbs-up" aria-hidden="true"></i>--> <div class="how-work-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/how-it-work-ico02.png"></div></div>
					  <h4>Quality Check</h4>
					  <span class="text-muted">QC services are provided to buyer. Increased Satisfaction</span>
					</div>
					<div class="col-lg-3 col-sm-6 placeholder mb-4">
					  <div class="icon-how-work"><!--<i class="fa fa-video-camera" aria-hidden="true"></i>--> <div class="how-work-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/how-it-work-ico03.png"></div></div>
					  <h4>Videos Of Products</h4>
					  <span class="text-muted">Seller create videos to show buyer the quality and work done. Peace of mind and better quality</span>
					</div>
					<div class="col-lg-3 col-sm-6 placeholder mb-4">
					  <div class="icon-how-work"><!--<i class="fa fa-ambulance" aria-hidden="true"></i>--> <div class="how-work-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/how-it-work-ico04.png"></div></div>
					  <h4>Shipping</h4>
					  <span class="text-muted">Multiple shipping options. Shipping status can be tracked</span>
					</div>
			  </div>

				<!--<img src="<?php echo get_template_directory_uri(); ?>/images/how-it-work-img.jpg" style="width:100%">-->
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer('version');