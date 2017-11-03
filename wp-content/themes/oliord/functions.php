<?php
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
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri().'/assets/js/bootstrap.min.js' );
	wp_enqueue_style( 'font-awesome.min', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'progressbar', get_template_directory_uri().'/assets/css/jQuery-plugin-progressbar.css' );
	wp_enqueue_script( 'jquery-progressbar', get_template_directory_uri().'/assets/js/jQuery-plugin-progressbar.js' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css' );
	wp_enqueue_script( 'jquery-asAccordion', get_template_directory_uri().'/assets/js/jquery-asAccordion.js' );
	wp_enqueue_style( 'accordion-slider.min', get_template_directory_uri().'/assets/css/accordion-slider.min.css' );
	wp_enqueue_style( 'asAccordion', get_template_directory_uri().'/assets/css/asAccordion.css' );
	wp_enqueue_script( 'jquery.accordionSlider.min', get_template_directory_uri().'/assets/js/jquery.accordionSlider.min.js' );
	
	if( is_page( array( 'home-version-2') )){
		wp_enqueue_style( 'style', get_template_directory_uri().'/style_version.css' );
	}else{
		wp_enqueue_style( 'style', get_template_directory_uri().'/style.css' );
	}
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
	//wp_localize_script( 'wishlist', 'wishlistshortcode', array('wshortcode'      => 'hii'));
}
add_action( 'wp_enqueue_scripts', 'oliord_scripts' );


require get_template_directory() . '/inc/custom_function.php';
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

function addtowishlist(){

	if(is_user_logged_in()==TRUE){

		global $wpdb;
		$user_id = get_current_user_id();
		$results = $wpdb->get_results( 'SELECT prod_id FROM wp_yith_wcwl WHERE user_id ='.$user_id);
		foreach ($results as $prod_id) {
			$prod_ids[] = $prod_id->prod_id;
		}
		$prod_ids = array_unique($prod_ids);
		if(in_array($_POST['post_id'], $prod_ids)){
			echo $link = get_permalink( get_option('page_on_front') )."?remove_from_wishlist=".$_POST['post_id'];
		}else{ 
			echo $link = get_permalink( get_option('page_on_front') )."?add_to_wishlist=".$_POST['post_id'];
		}
			
			die;
	}else{
		echo $link = site_url().'/seller-login';
		die;
	}
	
}
add_action( 'wp_ajax_nopriv_addtowishlist', 'addtowishlist' );
add_action( 'wp_ajax_addtowishlist', 'addtowishlist' );

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

/* get state */
add_action('wp_ajax_change_state','change_state');
add_action( 'wp_ajax_nopriv_change_state', 'change_state' );
function change_state(){
	$current_cc = $_POST['contry'];
	$woo_countries = new WC_Countries();

	$default_country = $woo_countries->get_base_country();
	$states = $woo_countries->get_states( $current_cc );  
	if(!empty($states)){
		?>
		<label for="billing_state" class="name-form"><?php _e( 'State/Province', 'woocommerce' ); ?></label>
		<?php 
		$html = '<select name="billing_state" id="billing_state"><option value="0">Select State</option>';
		foreach($states as $key => $value){
			$html .= '<option value="'.$key.'">'.$value.'</option>';
		}
		echo $html;
	}else{
		?>
		<label for="billing_state" class="name-form"><?php _e( 'State/Province', 'woocommerce' ); ?></label>
		<input type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if ( ! empty( $_POST['billing_state'] ) ) esc_attr_e( $_POST['billing_state'] ); ?>" />		
		<?php
	}
	die;
}

