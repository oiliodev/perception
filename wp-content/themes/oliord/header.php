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
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/intlTelInput.css">
<script src="<?php echo get_template_directory_uri();?>/assets/js/intlTelInput.js"></script> 
<script src="<?php echo get_template_directory_uri();?>/assets/js/custom.js"></script> 

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header class="site-header navbar-fixed-top header-sticky" role="banner">
	<div class="header-top-part">
	<div class="container">
	<div class="row">
				  <div class="col-sm-3 col-md-3 col-lg-2">
						<div class="logo">
						<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );							
							echo '<a href="'.get_site_url().'"><img src="'. get_template_directory_uri() .'/images/logo.png"></a>';
						?>
						</div>
					</div>
				  <div class="col-sm-9 col-md-9 col-lg-10">
				  <div class="header-right-part">
					<div class="search search-header">	
						<?php 
							$search_type	=	"Product";
							$filter_text	=	"Supplier";
							if(isset($_REQUEST['search_type']) && $_REQUEST['search_type'] != ""){
								$search_type	=	$_REQUEST['search_type'];
								if($search_type	==	"Product"){
									$filter_text	=	"Supplier";
								}else{
									$filter_text	=	"Product";
								}
							}
						?>							
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/shop' ) ); ?>">
							<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
							<input type="search"  id="<?php echo $unique_id; ?>" class="field-custom" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" value="<?php if(isset($_REQUEST['search_string']) && $_REQUEST['search_string'] != "" ) { echo $_REQUEST['search_string']; } ?>" name="search_string" required/>
							<input type="hidden" name="search_type" value="<?php echo $search_type; ?>" id="search_type">
						</form>
						 <div class="dropdown">
							<button class="btn btn-info dropdown-toggle filter_button" type="button" data-toggle="dropdown"><?php echo $search_type; ?></button>
						  <ul class="dropdown-menu">    
							<li><label for="Supplier" class="filter_text"><?php echo $filter_text; ?></label></li>
						  </ul>
						</div> 
					</div>	
					<div class="language-drop">
						<span onClick="swip_lan('en');" class="en">En</span>
						<span onClick="swip_lan('chiness');" class="chiness">中文</span>
						<span onClick="swip_lan('franch');" class="franch">Es</span>				
					</div>	
					<div class="user-profile">
						<?php if(is_user_logged_in()) {
							global $current_user;							
								echo '<span>'.substr($current_user->user_login,0,1).'</span>';
							} else { 
								echo '<img src="'. get_template_directory_uri() .'/images/sign-in-ico.png">';
							} ?>
						<ul class="profile-sign">							
							<?php if(is_user_logged_in()) {
								global $current_user;
								  ?>
								<li class="lought-btn"><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
							<?php } else { ?>
								<li class="sign-up-btn"><a href="<?php echo site_url().'/seller-login'; ?>">Sign up </a></li>
							<?php } ?>
						</ul>
					</div>
	
					<div class="product-cart">						
						<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
								?>
							<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
							<i class="fa fa-shopping-cart fa-2x"></i>
							<span>
								<?php echo sprintf ( _n( '%d item', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
								</span>
							</a>
						<?php } ?>
					</div>
					</div>
					</div>
			</div>
	</div>
	</div>
		<div class="container">
			<div class="row">
			<div class="col-12">
				<nav class="rdnav menu-header">
					<?php 
						wp_nav_menu( array(	'theme_location' => 'top-menu', 
											'menu_class' => 'nav navbar-nav') );
					?>
				</nav>
			</div>	
			</div>
		</div>
		<div class="container convention">
		<div class="row">
			<div class="col-12">
				<div class="information">					
					<img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/images/banner-add.png" />
				</div>
			</div>
		</div>
		</div>
			
	</header>
<!--<div class="container"> -->
<?php if(is_front_page()) { ?>
<div class="gallery-hero-section">
<div class="gallery-part">
<ul>
	<li class="gallery-221 gallery-one">
		<a href="#">
			<img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img01.jpg" />  
		</a> 
		 <div class="text-gallery">
		 <div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		 <div class="gallery-dcs-rft"><img class="parentimage-big" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img-big01.jpg" /> </div>
		</div> 
		 
	</li>   
	<li>
		<a href="#">     
			<img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img02.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img-big02.jpg" /></div>
		</div>
		
	</li>
	<li class="gallery-221 gallery-three">   
		<a href="#">       
			<img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img03.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img-big03.jpg" /></div> 
		</div>
		
	</li>
	<li class="gallery-for">  
		<a href="#">        
			<img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img04.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img-big04.jpg" /></div> 
		</div>
	</li>
	<li class="gallery-five">    
		<a href="#">      
			<img class="parentimage" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img05.jpg" /> 
		</a>
		<div class="text-gallery">
		<div class="gallery-dcs-lft">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
		<div class="gallery-dcs-rft"><img class="parentimage-big" src="<?php echo get_template_directory_uri() ; ?>/slider/product-img-big05.jpg" /></div> 
		</div>
	</li>
	

</ul>

</div>
</div>
<?php } ?>
<div class="clearfix"></div>	
<div class="middle-content">
	<div class="container">
