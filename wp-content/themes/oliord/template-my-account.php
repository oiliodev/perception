<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: My Account
 *
 */


get_header(); 
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="title-my-acco"><?php echo get_the_title(); ?></h1>
			<?php
			
				while ( have_posts() ) : the_post();

					the_content();

				endwhile; // End of the loop.
			?>
			</div>
		</div>
		</div>
	</main>
</div>
<?php
get_footer();
