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
<script>
/*$('.search-submit').click(function(e){
			e.preventDefault();
			if($('.search-field').hasClass('stoggle')){
					if($('.search-field').val()!=""){
						$('.search-form').submit();
						}else{
								$('.search-field').removeClass('stoggle');
							}
				}else{
						$('.search-field').addClass('stoggle');
					}
			
			});*/
</script>

<style> 
.search-form {
	position: relative;
}

.search-form .search-submit {
	bottom: 3px;
	padding: 0.5em 1em;
	position: absolute;
	right: 3px;
	top: 3px;
}

.search-form .search-submit .icon {
	height: 24px;
	top: -2px;
	width: 24px;
}
</style>


	<div id="primary" class="content-area container home-Member-pad">
		<main id="main" class="site-main" role="main">	
			<div class="row">
				
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<input type="search"  id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required/>

</form>
				
			<?php echo do_shortcode('[my_products]'); ?>
	
			<div class="col-md-12">
				<img src="<?php echo get_template_directory_uri(); ?>/images/how_work.jpg" style="width:100%">
			</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
