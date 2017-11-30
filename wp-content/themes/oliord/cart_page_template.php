<?php
/**
  * The template for displaying the homepage.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 *  Template name: Cart Page
 * 
 * @package oliord
 */

//~ if(is_child( 'my-account' )){
	//~ get_header('sellerlogin'); 
//~ }else{
	//~ get_header(); 
//~ }
global $wp;


get_header();

?>
	<div class="container">
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="inner-heading"><span class="inner-title"><?php echo get_the_title(); ?></span></h1>
			</div>
		</div>
		<div class="row Cart-page">
			<div class="col-lg-9 form-group">
				<div class="content-inner">
					<?php
						while ( have_posts() ) : the_post();		
							the_content();		
						endwhile; // End of the loop.
					?>
				</div>
			</div>
			<div class="col-lg-3 mb-lg-0 mb-5">
				<?php echo do_shortcode('[top_sell_item]');	?>
			</div>
		</div>
	</main>
</div>
<?php
	get_footer();
?>
