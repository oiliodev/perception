<?php
function app_output_buffer() {
	ob_start();
}
add_action('init', 'app_output_buffer');

function oliord_setup() {
	load_theme_textdomain( 'oliord' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'oliord-featured-image', 2000, 1200, true );
	add_image_size( 'oliord-thumbnail-avatar', 100, 100, true );

	register_nav_menus( array('top-menu'    => __( 'Top Menu', 'oliord' )	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	add_theme_support( 'custom-logo');
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'oliord_setup' );

/* Widget Register */
function oliord_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'oliord' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Filter Sidebar', 'oliord' ),
		'id'            => 'filter',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Filter Deal of days', 'oliord' ),
		'id'            => 'filter-deal-of-day',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => __( 'Footer 1', 'oliord' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'oliord' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'oliord' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'oliord_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Olio RD 1.1.0
 */
function oliord_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'oliord_javascript_detection', 0 );

/* Customizer Options */
function oliord_theme_section($wp_customize){
    $wp_customize->add_section('oliord_theme_section_handle', array(
        'title'             => __('Oliord Theme Settings', 'oliord'),
        'description' => '',
        'priority'       => 70,
    ));
     
     /* --------- Copy right Sectoin --------- */
     $wp_customize->add_setting('oliord_cp_op', array(
        'default'      => '',
        'capability'  => 'edit_theme_options',
        'type'          => 'theme_mod',
    ));

    $wp_customize->add_control('oliord_cp', array(
        'label'         => __('Copy right', 'oliord'),
        'section'     => 'oliord_theme_section_handle',
        'settings'    => 'oliord_cp_op',
        'type'         => 'textarea'
    ));
}
add_action( 'customize_register', 'oliord_theme_section' );

/* Register Style and Scripts */
function oliord_scripts() {
	wp_enqueue_script( 'jQuery.min', get_template_directory_uri().'/assets/js/jQuery.min.js' );	
	wp_enqueue_script( 'tether.min', get_template_directory_uri().'/assets/js/tether.min.js' );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri().'/assets/js/bootstrap.min.js' );
	wp_enqueue_style( 'font-awesome.min', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'progressbar', get_template_directory_uri().'/assets/css/jQuery-plugin-progressbar.css' );
	wp_enqueue_script( 'jquery-progressbar', get_template_directory_uri().'/assets/js/jQuery-plugin-progressbar.js' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css' );
	wp_enqueue_script( 'jquery-asAccordion', get_template_directory_uri().'/assets/js/jquery-asAccordion.js' );
	wp_enqueue_style( 'accordion-slider.min', get_template_directory_uri().'/assets/css/accordion-slider.min.css' );
	wp_enqueue_style( 'asAccordion', get_template_directory_uri().'/assets/css/asAccordion.css' );
	wp_enqueue_script( 'jquery.accordionSlider.min', get_template_directory_uri().'/assets/js/jquery.accordionSlider.min.js' );
	
	if(is_front_page()) {
		wp_enqueue_style( 'style', get_template_directory_uri().'/style.css' );
		wp_enqueue_style( 'style_home_page', get_template_directory_uri().'/assets/css/style_home_page.css' );
	}else{		
		wp_enqueue_style( 'test', get_template_directory_uri().'/assets/css/style.css' );		
		wp_enqueue_style( 'style', get_template_directory_uri().'/style_version.css' );
	}
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
	//wp_localize_script( 'wishlist', 'wishlistshortcode', array('wshortcode'      => 'hii'));
	
	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
	
}
add_action( 'wp_enqueue_scripts', 'oliord_scripts' );


require get_template_directory() . '/inc/custom_function.php';
/*************AJAX***************/
include("ajax_functions.php");
/*************AJAX***************/

/*************woocommerce template***************/
include("woocommerce_template.php");
/*************AJAX***************/
/* redirect after logout home */
/*add_action('wp_logout','redirect_after_logout');
function redirect_after_logout(){
	wp_redirect( home_url() );
	exit();
}*/

register_nav_menus( array(  
  'primary' => __( 'Primary Navigation', 'olio' ),  
  'secondary' => __('Footer Navigation', 'olio')  
) );


add_filter( 'lostpassword_url',  'wdm_lostpassword_url', 10, 0 );
function wdm_lostpassword_url() {
    return site_url('/forgot-password/');
}


function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
	
       if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
             $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
       }

       if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
              $validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'woocommerce' ) );
       }

}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );


function wooc_save_extra_register_fields( $customer_id ) {
       if ( isset( $_POST['billing_first_name'] ) ) {
              update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
              update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
       }
       if ( isset( $_POST['username'] ) ) {
              update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['username'] ) );
              update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['username'] ) );
       }

       if ( isset( $_POST['billing_phone'] ) ) {
            update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
       }
       if ( isset( $_POST['billing_address_1'] ) ) {
            update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
       }
       if ( isset( $_POST['billing_address_2'] ) ) {
            update_user_meta( $customer_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2'] ) );
       }
       if ( isset( $_POST['billing_country'] ) ) {
            update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
       }
       if ( isset( $_POST['billing_state'] ) ) {
            update_user_meta( $customer_id, 'billing_state', sanitize_text_field( $_POST['billing_state'] ) );
       }
       if ( isset( $_POST['billing_city'] ) ) {
            update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
       }
       if ( isset( $_POST['billing_postcode'] ) ) {
            update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode']));
       }
       if ( isset( $_POST['usertype'] ) ) {
            update_user_meta( $customer_id, 'usertype', sanitize_text_field( $_POST['usertype']));
       }
       
}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );


//~ add_action('pre_get_posts','shop_filter_cat');

 //~ function shop_filter_cat($query) {
    //~ if (!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query()) {
       //~ $query->set('tax_query', array(
                    //~ array ('taxonomy' => 'product_cat',
                                       //~ 'field' => 'slug',
                                        //~ 'terms' => 'type-1'
                                 //~ )
                     //~ )
       //~ );   
    //~ }
 //~ }
add_action('pre_get_posts', 'woocm_product_query', 10);
function woocm_product_query($query) {
	global $wpdb;	
	if ( is_post_type_archive('product') ) {		
		if(!empty($_REQUEST)){
			$search_item	=	trim($_REQUEST['search_string']);	
			
			if(trim($_REQUEST['search_type'])	==	"Supplier"){
				
				$metakey_array = array(
					array('key' => 'membership','value' => $search_item,'compare' => 'LIKE')
				);

				
				$args = array(
					's' => $search_item,
					'role'	=> 'dc_vendor',
					'meta_query' => array(
						'relation' => 'OR',
						$metakey_array
					)
				);
				
				$user_query = new WP_User_Query( $args );
				
				if ( ! empty( $user_query->results ) ) {
					$ID_ARR	=	array();
					foreach ( $user_query->results as $user ) {
						$ID_ARR[]	=	$user->ID;		
					}
				}		
				$seller_ids	=	implode(',',$ID_ARR);		
			}
			
			if(trim($_REQUEST['search_type'])	==	"Product"){
				/*$args = array(
							'post_type' => 'product',
							'orderby' => 'date',
							'order' => 'DESC',					
							's' => $search_item,
							'post_status'    => 'publish',
							'paged' => get_query_var( 'paged' ),
						);*/
						$query->set( 's', $search_item );
			}else{		
					//~ $args = array(
							//~ 'post_type' => 'product',
							//~ 'orderby' => 'date',
							//~ 'order' => 'DESC',
							//~ 'author' => $seller_ids,
							//~ 'post_status'    => 'publish',
							//~ 'paged' => get_query_var( 'paged' )
						//~ );
				$query->set( 'author', $seller_ids );
			}
			
			
		}		
	}
}


add_shortcode('deals_of_the_day_filter','filter_dealoftheday');
function filter_dealoftheday(){
	
	$price = $_REQUEST['price'];
	$discount = $_REQUEST['discount'];
	$review = $_REQUEST['review'];
	$sort = $_REQUEST['sort'];
	
	$checked_1 = "";
	$checked_2 = "";
	$checked_3 = "";
	$checked_4 = "";
	
	$deal_checked_1 = "";
	$deal_checked_2 = "";
	$deal_checked_3 = "";
	
	$review_checked_1 = "";
	$review_checked_2 = "";
	$review_checked_3 = "";
	$review_checked_4 = "";
	
	if($price == 1){
		$checked_1 = 'checked="checked"';
	}	
	if($price == 2){
		$checked_2 = 'checked="checked"';
	}
	
	if($price == 3){
		$checked_3 = 'checked="checked"';
	}
	
	if($price == 4){
		$checked_4 = 'checked="checked"';
	}
	
	
	if($discount == 10){
		$deal_checked_1 = 'checked="checked"';
	}	
	if($discount == 25){
		$deal_checked_2 = 'checked="checked"';
	}
	
	if($discount == 50){
		$deal_checked_3 = 'checked="checked"';
	}
	
	
	if($review == 1){
		$review_checked_1 = 'checked="checked"';
	}	
	if($review == 2){
		$review_checked_2 = 'checked="checked"';
	}	
	if($review == 3){
		$review_checked_3 = 'checked="checked"';
	}
	
	if($review == 4){
		$review_checked_4 = 'checked="checked"';
	}
	


	$html = '<div class="side-bar-filter filter-man"><div class="filter">
	<div class="drop-down">
	<div class="price-section">
		<label>Price</label>
		<input type="checkbox" name="deal_price" class="deal_price filter_select" '.$checked_1.' value="1" min="0" max="24"> Under $25
		<input type="checkbox" name="deal_price" class="deal_price filter_select" '.$checked_2.' value="2" min="25" max="50"> $25 to $50
		<input type="checkbox" name="deal_price" class="deal_price filter_select" '.$checked_3.' value="3" min="50" max="100"> $50 to $100
		<input type="checkbox" name="deal_price" class="deal_price filter_select" '.$checked_4.' value="4" min="100" max="200"> $100 to $200
	</div>
	
	<div class="deal_discount-section">
		<label>Discount</label>
		<input type="checkbox" name="deal_discount" class="deal_discount filter_select" '.$deal_checked_1.' value="10" min_disc="10" max_disc="99"> 10% off or More
		<input type="checkbox" name="deal_discount" class="deal_discount filter_select" '.$deal_checked_2.' value="25" min_disc="25" max_disc="99"> 25% off or More
		<input type="checkbox" name="deal_discount" class="deal_discount filter_select" '.$deal_checked_3.'  value="50" min_disc="50" max_disc="99"> 50% off or More
	</div>
	
	<div class="deal_review-section">
		<label>Average Customer Review</label>
		<input type="checkbox" name="review" class="review filter_select" '.$review_checked_4.' value="4" min_review="4" max_review="4.99"> Stars 4 and up
		<input type="checkbox" name="review" class="review filter_select" '.$review_checked_3.' value="3" min_review="3" max_review="3.99"> 3 and up
		<input type="checkbox" name="review" class="review filter_select" '.$review_checked_2.' value="2" min_review="2" max_review="2.99"> 2 and up
		<input type="checkbox" name="review" class="review filter_select" '.$review_checked_1.' value="1" min_review="1" max_review="1.99"> 1 and up
	</div>
	
		
		</div>
	</div>';
	
	
	$html .= '</div>';
	
	
		$html .= '<div class="filter">		
			<div class="drop-down">
				<select name="deal_sort" id="deal_sort" class="filter_select">
					<option value="0" field="" order="">Shot By</option>
					<option value="1" field="_sale_price" order="asc"';
					if($sort == 1){
						$html .= 'selected="selected"';
					}			
					$html .= '>Price- Low to High</option>
					<option value="2" field="_sale_price" order="desc"';
					if($sort == 2){
						$html .= 'selected="selected"';
					}			
					$html .= '>Price- High to Low</option>
					<option value="3" field="discount" order="asc"';
					if($sort == 3){
						$html .= 'selected="selected"';
					}			
					$html .='>Discount- Low to High</option>
					<option value="4" field="discount" order="desc"';
					if($sort == 4){
						$html .= 'selected="selected"';
					}			
					$html .='>Discount- High to Low</option>			
				</select>
			</div>
	</div>';
	
	
	return $html;
}
//~ remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


function get_attachment_id( $url ) {
	$attachment_id = 0;
	$dir = wp_upload_dir();
	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
	}
	return $attachment_id;
}

