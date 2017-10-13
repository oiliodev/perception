<?php
/**
 * The template for displaying search results pages.
 *
 * @package oliord
 */

get_header();
?>
<header class="page-header">
	<?php if ( have_posts() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'oliord' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	<?php else : ?>
		<h1 class="page-title"><?php _e( 'Nothing Found', 'oliord' ); ?></h1>
	<?php endif; ?>
</header>
<div class="row">
	<div class="col-sm-9">
		<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					echo '<h4><a href="'.get_the_permalink().'">'.get_the_title().'</a><h4>';
				endwhile;
			endif;
		?>
	</div>
	<div class="col-sm-3">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
