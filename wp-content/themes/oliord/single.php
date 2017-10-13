<?php
/**
 * The template for displaying all single posts.
 *
 * @package oliord
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<h1><?php echo get_the_title(); ?></h1>
		<div class="col-sm-9">
		<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
		?>
		</div>
		<div class="col-sm-3">
			<?php echo get_sidebar(); ?>
		</div>
	</main>
</div>
<?php
get_footer();
