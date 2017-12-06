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

<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/assets/js/owl.carousel.js"></script>		
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/owl.carousel.css" />	
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets//css/owl.theme.css"  />	
<script src="<?php echo get_template_directory_uri();?>/assets/js/custom.js"></script> 

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead"  class="site-header navbar-fixed-top header-sticky" role="banner">
	<div class="header-top-part">
	<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-3 col-lg-2">
			<div class="logo">
				<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );							
					echo '<a href="'.get_site_url().'"><img src="'. get_template_directory_uri() .'/images/logo.png"></a>';
				?>
			</div>
		</div>
		<div class="d-md-none col-sm-2 col-menu-toggle">
			<div id="menu-toggle" class="menu-toggle align-middle">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="col-sm-10 col-md-9 col-lg-10">
			<div class="header-right-part">
				<div class="search search-header float-left">	
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
				<div class="language-drop float-left">
					<span onClick="swip_lan('en');" class="en">En</span>
					<span onClick="swip_lan('chiness');" class="chiness">中文</span>
					<span onClick="swip_lan('franch');" class="franch">Es</span>				
				</div>	
				<div class="user-profile float-left">
					<?php if(is_user_logged_in()) {
						global $current_user;	
													
							$attachment_url = esc_url( get_the_author_meta( 'cupp_upload_meta', $current_user->ID ) ); 
							 
							if($attachment_url == ''){
								$attachment_url	=	get_template_directory_uri() .'/images/sign-in-ico.png';
								echo '<span class="profile-name">'.substr($current_user->user_login,0,1).'</span>';
							}else{
								$image_id	= get_attachment_id( $attachment_url ); 
								$attachment_url = wp_get_attachment_image_src($image_id, 'you_may_like_thumb');
								$attachment_url	=	$attachment_url[0];
								echo '<span  class="profile-ing"><img class="img-fluid" src="'. $attachment_url .'"></span>';
							}
							
							
						} else { 
							echo '<span class="profile-user-icon"><img src="'. get_template_directory_uri() .'/images/header-ico.png"></span>';
						} ?>
					<ul class="profile-sign">							
						<?php if(is_user_logged_in()) {
							global $current_user;	
							if (is_user_wcmp_vendor($current_user)) {
								$dashboard_page_link = wcmp_vendor_dashboard_page_id() ? get_permalink(wcmp_vendor_dashboard_page_id()) : '#';
							}else{
								$dashboard_page_link =	get_permalink( get_option('woocommerce_myaccount_page_id') ); 
							}
							  ?>
							<li class="sign-up-btn login-hader"><a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('','olio'); ?>
							<img src="<?php echo  get_template_directory_uri(); ?>/images/icons8-Sign-up.png" /></a></li>
							<li class="sign-up-btn sign--up-hader "><a data-toggle="tooltip" data-placement="top" title="My Account" href="<?php echo $dashboard_page_link; ?>"><?php _e('','olio'); ?><img src="<?php echo  get_template_directory_uri(); ?>/images/my-account.png"></a></li>
						<?php } else { ?></a>
							<li class="sign-up-btn login-hader"><a data-toggle="tooltip" data-placement="top" title="Login" href="<?php echo site_url().'/seller-login'; ?>">
							<img src="<?php echo  get_template_directory_uri(); ?>/images/icons8-login.png"><?php _e('','olio'); ?></a></li>
							<li class="sign-up-btn sign--up-hader"><a data-toggle="tooltip" data-placement="top" title="Sign Up" href="<?php echo site_url().'/registration'; ?>"><?php _e('','olio'); ?>
							<img src="<?php echo  get_template_directory_uri(); ?>/images/icons8-Sign-up.png" /></a></li>
						<?php } ?>
					</ul>
				</div>
			
			<div class="hart-button float-left">
						<a href="<?php echo site_url().'/wishlist'; ?>">
					&nbsp;
						<span>
							<?php echo sprintf ( _n( '%d item', YITH_WCWL()->count_products() ), YITH_WCWL()->count_products() ); ?>
						</span>
						</a>
					</div>
					
			<div class="product-cart  count_cart_item float-left">						
			<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					?>
				<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
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
				<?php /* ?>
				<nav class="rdnav menu-header">
					<?php 
						wp_nav_menu( array(	'theme_location' => 'top-menu', 
											'menu_class' => 'nav navbar-nav') );
					?>
				</nav>
				<?php */ ?>
					<?php if ( has_nav_menu( 'primary' )) : ?>
					
					<?php /*?><div class="menu-toggle-text align-middle font-weight-bold text-uppercase"><?php _e( 'Menu', 'twentysixteen' ); ?></div><?php */?>
					<div id="site-header-menu" class="site-header-menu">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation rdnav menu-header" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(	'theme_location' => 'top-menu', 
											'menu_class' => 'nav navbar-nav') );
								?>
							</nav><!-- .main-navigation -->
						<?php endif; ?>						
					</div><!-- .site-header-menu -->
				<?php endif; ?>
				
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
