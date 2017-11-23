<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Full Width Template
 *
 * @package storefront
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<div class="container">
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<h1><?php echo get_the_title(); ?></h1>
		<div class="row">
		<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
		?>
		</div>		
	</main>
</div>
<?php
get_footer();
?>
