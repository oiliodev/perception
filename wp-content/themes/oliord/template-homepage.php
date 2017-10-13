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
	
			<div class="col-md-9 clearfix">
				<div class="row">
					<div class="col-6 col-sm-3 placeholder">
					  <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail" width="200" height="200">
					  <h4>Label</h4>
					  <div class="text-muted">Something else</div>
					</div>
					<div class="col-6 col-sm-3 placeholder">
					  <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail" width="200" height="200">
					  <h4>Label</h4>
					  <span class="text-muted">Something else</span>
					</div>
					<div class="col-6 col-sm-3 placeholder">
					  <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail" width="200" height="200">
					  <h4>Label</h4>
					  <span class="text-muted">Something else</span>
					</div>
					<div class="col-6 col-sm-3 placeholder">
					  <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail" width="200" height="200">
					  <h4>Label</h4>
					  <span class="text-muted">Something else</span>
					</div>
			  </div>
				<!--<img src="<?php echo get_template_directory_uri(); ?>/images/how_work.jpg" style="width:100%">-->
			</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
