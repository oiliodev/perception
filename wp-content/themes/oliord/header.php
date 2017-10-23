<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package oliord
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<link rel='stylesheet' id='style-css'  href='http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/style.css' type='text/css' media='all' />
<!--
<script async="async" src="https://www.google.com/adsense/search/ads.js"></script>
-->

<script>
	
window.onload = function() {
   jQuery(".progress-bar-custom").loading();
	jQuery(".fa-heart").click(function(){		
		jQuery(this).css({ 'color': "red" });
	});   
};

$(function(){	
			header_sticky_eff();
	    jQuery(window).scroll(function() {
			header_sticky_eff();
	    });
	    
//~ $('.search-submit').click(function(e){
			//~ e.preventDefault();
			//~ if($('.search-field-custom').hasClass('stoggle')){				
					//~ if($('.search-field-custom').val()!=""){
						//~ $('.search-form').submit();
						//~ }else{
							//~ $('.search-field-custom').removeClass('stoggle');
						//~ }
				//~ }else{
						//~ $('.search-field-custom').addClass('stoggle');
					//~ }
			
			//~ });
	
	
  $("a[href='#top']").click(function() {
     $("html, body").animate({ scrollTop: 0 }, "slow");
     return false;
  });
 });
 
	
	function header_sticky_eff(){
		
		var header = jQuery(".navbar-fixed-top");
		var scroll = jQuery(window).scrollTop();
console.log(scroll);
		if (scroll >= 150) {			
			header.removeClass('header-sticky').addClass("header-scroll");
		} else {
			header.removeClass("header-scroll").addClass('header-sticky');
		}
		
		if (scroll < 60){
			jQuery(".navbar-fixed-top").removeClass('header-scroll');
		}

	}
</script>

<!-- other head elements from your page -->

<script type="text/javascript" charset="utf-8">
(function(g,o){g[o]=g[o]||function(){(g[o]['q']=g[o]['q']||[]).push(
  arguments)},g[o]['t']=1*new Date})(window,'_googCsa');
</script>


</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="row header-full">
				  <div class="col-sm-2">
						<div class="logo">
						<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							if ( has_custom_logo() ) {
								echo '<a href="'.get_site_url().'"><img src="'. esc_url( $logo[0] ) .'" width="100%"></a>';
							} else {
								echo '<a href="'.get_site_url().'"><h1>'. get_bloginfo( 'name' ) .'</h1></a>';
							}
						?>
						</div>
					</div>
				  <div class="col-sm-10">
				  <div class="header-right-part">
					<div class="search">		
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
							<input type="search"  id="<?php echo $unique_id; ?>" class="field-custom" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" name="s" required/>
						</form>
					</div>	
					<div class="language-drop">
						en
						<!--<ul class="languages">
							<li>English</li>
							<li>Chinese</li>
						</ul>-->
						
					</div>
	
					<div class="user-profile">					
						<?php 
							if(is_user_logged_in()) { 
								global $current_user;
								get_currentuserinfo();
								echo $current_user->user_login.' | ';
								echo '<a href="'. wp_logout_url() .'">'. __("Log Out") .'</a>';
							} else { 
								echo '<a href="'. get_permalink(get_option('woocommerce_myaccount_page_id') ) .'"><i class="fa fa-user fa-2x"></i></a>';
							}
						?>
						<ul class="profile-sign">
							<li>Sign up</li>
							<li>Logout</li>
						</ul>
					</div>
	
					<div class="product-cart">
						<i class="fa fa-shopping-cart fa-2x"></i>
						<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
								?>
							<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
								<?php echo sprintf ( _n( '%d item', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
							</a>
						<?php } ?>
					</div>
					</div>
					</div>
				</div>
			</div>

			<div class="row">
				<nav class="rdnav menu-header navbar-fixed-top header-sticky">
					<?php 
						wp_nav_menu( array(	'theme_location' => 'top-menu', 
											'menu_class' => 'nav navbar-nav') );
					?>
				</nav>
			</div>
			
			<div class="row">
				<div class="information">
					<!--<div class="col-sm-9 text-left">
						<p><?php _e( 'Information about conventions last event and up coming convention.', 'oliord' ); ?></p>
					</div>
					<div class="col-sm-3 text-left get-more-info">
						<a href="#"><?php _e( 'Get More Info', 'oliord' ); ?></a>
					</div>-->
					<img class="parentimage" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/images/banner-add.jpg" />
				</div>
			</div>
		</div>
	</header>
<!--<div class="container"> -->
<div class="gallery-hero-section">
<div class="gallery-part">
<ul>
	<li class="gallery-221 gallery-one">
		<a href="#">
			<img class="parentimage" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img01.jpg" />  
		</a> 
		 <div class="text-gallery">
		 <div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		 <div class="gallery-dcs-rft"><img class="parentimage-big" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img-big01.jpg" /> </div>
		</div> 
		 
	</li>   
	<li>
		<a href="#">     
			<img class="parentimage" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img02.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img-big02.jpg" /></div>
		</div>
		
	</li>
	<li class="gallery-221 gallery-three">   
		<a href="#">       
			<img class="parentimage" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img03.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img-big03.jpg" /></div> 
		</div>
		
	</li>
	<li class="gallery-for">  
		<a href="#">        
			<img class="parentimage" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img04.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img-big04.jpg" /></div> 
		</div>
	</li>
	<li class="gallery-five">    
		<a href="#">      
			<img class="parentimage" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img05.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="http://111.93.221.219/CMS/wp/b2b-e-commerce/wp-content/themes/oliord/slider/product-img-big05.jpg" /></div> 
		</div>
	</li>
	

</ul>

<!--</div>-->
</div>
</div>
<div class="clearfix"></div>
	<?php /*if(is_front_page()) { ?>
	<div class="home_slider">
		<div class="acc-slider">
			<div id="example2" class="accordion-slider">
				<div class="as-panels">
					<?php
						$params = array('posts_per_page' => 10,'post_type' => 'product');
						$wc_query = new WP_Query($params);
						
						if ($wc_query->have_posts()) : 
							while ($wc_query->have_posts()) : $wc_query->the_post(); 
								$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
								$url = $src[0];
								?>
								<div class="as-panel">
									<img class="as-background" src="<?php echo $url; ?>" data-retina="<?php echo $url; ?>"/>
									<a href="<?php echo get_the_permalink(); ?>" title="home-styling-perth-2803-3">
										<img class="as-background-opened" src="<?php echo $url; ?>" data-retina="<?php echo $url; ?>"/>
									</a>
								</div>
					<?php endwhile; wp_reset_postdata(); endif; ?>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<?php } */?>

	<div class="container">

	
