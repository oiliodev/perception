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



	<div id="primary" class="content-area container home-Member-pad">
		<main id="main" class="site-main" role="main">	
			<div class="row">

				
			<?php echo do_shortcode('[my_products]'); ?>
	
			<div class="col-md-12">
				<img src="<?php echo get_template_directory_uri(); ?>/images/how_work.jpg" style="width:100%">
			</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
