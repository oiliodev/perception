<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package oliord
 */

//~ if(is_child( 'my-account' )){
	//~ get_header('sellerlogin'); 
//~ }else{
	//~ get_header(); 
//~ }
global $wp;
if($wp->request == 'my-account/lost-password'){
	get_header('sellerlogin');
}else{
	get_header(); 
}
?>
	<div class="container">
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div <?php if($wp->request != 'my-account/lost-password'){ 
?> class="row" <?php } ?>>
			<div  <?php if($wp->request != 'my-account/lost-password'){ 
?> class="col-sm-9" <?php } ?>>
				<?php
				if($wp->request != 'my-account/lost-password'){ ?>
					<h1 class="inner-heading"><span class="inner-title"><?php echo get_the_title(); ?></span></h1>
				<?php } ?>
				<div class="content-inner">
			<?php
				while ( have_posts() ) : the_post();

					the_content();

				endwhile; // End of the loop.
			?>
			</div>
			</div>
			<div <?php if($wp->request != 'my-account/lost-password'){ 
?> class="col-sm-3" <?php } ?>>
				<?php //echo get_sidebar(); ?>
			</div>
		</div>
	</main>
</div>
<?php
if($wp->request != 'my-account/lost-password'){ 
	get_footer();
}?>
