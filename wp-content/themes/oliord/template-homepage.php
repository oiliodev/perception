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

get_header();
$unique_id = esc_attr( uniqid( 'search-form-' ) ); 
 ?>
 <style>
 
 </style>

	<div id="primary" class="content-area row home-Member-pad">
		<main id="main" class="site-main" role="main">	
			<div class="row">
				
			<?php echo do_shortcode('[my_products]'); ?>
	
			<div class="col-md-9 clearfix how-it-work-section">
<!--<h3>How it Works</h3>
				<div class="row">
					<div class="col-6 col-sm-3 placeholder">
					 <div class="icon-how-work"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
					  <h4>Buy</h4>
					  <div class="text-muted">Lorem ipsome dummy text Link Lorem Link ipsome dummy text. Lorem ipsome</div>
					</div>
					<div class="col-6 col-sm-3 placeholder">
					  <div class="icon-how-work"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>
					  <h4>Quality Check</h4>
					  <span class="text-muted">Lorem ipsome dummy text Link Lorem Link ipsome dummy text. Lorem ipsome</span>
					</div>
					<div class="col-6 col-sm-3 placeholder">
					  <div class="icon-how-work"><i class="fa fa-video-camera" aria-hidden="true"></i></div>
					  <h4>Videos Of Products</h4>
					  <span class="text-muted">Lorem ipsome dummy text Link Lorem Link ipsome dummy text. Lorem ipsome</span>
					</div>
					<div class="col-6 col-sm-3 placeholder">
					  <div class="icon-how-work"><i class="fa fa-ambulance" aria-hidden="true"></i></div>
					  <h4>Shipping</h4>
					  <span class="text-muted">Lorem ipsome dummy text Link Lorem Link ipsome dummy text. Lorem ipsome</span>
					</div>
			  </div>-->

				<img src="<?php echo get_template_directory_uri(); ?>/images/how-it-work-img.jpg" style="width:100%">
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
