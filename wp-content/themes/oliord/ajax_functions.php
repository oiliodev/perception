<?php 

/*************AJAX***************/

add_action( 'wp_ajax_login_type', 'login_type_fun' );
add_action( 'wp_ajax_nopriv_login_type', 'login_type_fun' );
function login_type_fun() {
	global $wpdb;	
	$type	=	$_REQUEST['type'];
	if($type	==	"login_with_QR"){
				
	}				
	wp_die();

}


add_action( 'wp_ajax_join_convention', 'join_convention_fun' );
add_action( 'wp_ajax_nopriv_join_convention', 'join_convention_fun' );
function join_convention_fun() {
	global $wpdb;	
	$to	=	$_REQUEST['company_email_id'];
    //~ echo wp_mail( $company_email_id, 'Join convention', 'Thanks for joining with us' );
    
    $email_from	=	"admin@olio.com";
    $subject	=	"Join convention";
    
	$headers = array('From: Olio <'.$email_from.'>');
	$subject 	=	$subject;	
	$headers[] 	= 	'Content-Type: text/html; charset=UTF-8';
	$body		=	"<b>Thanks for joining with us</b>";	
	echo wp_mail( $to, $subject, $body, $headers );
	wp_die();
}

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
		$html = '<select name="billing_state" id="billing_state" class="form-control"><option value="0">Select State</option>';
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


add_action( 'wp_ajax_nopriv_addtowishlist', 'addtowishlist' );
add_action( 'wp_ajax_addtowishlist', 'addtowishlist' );
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
			echo $link = get_permalink( $_REQEST['current_page_id'] )."?remove_from_wishlist=".$_POST['post_id'];
		}else{ 
			echo $link = get_permalink( $_REQEST['current_page_id'] )."?add_to_wishlist=".$_POST['post_id'];
		}
			
			die;
	}else{
		echo $link = site_url().'/seller-login';
		die;
	}
	
}


?>
