<?php
ini_set('display_errors','off');
error_reporting(E_ALL);
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

ini_set("memory_limit",-1);
ini_set("max_execution_time","-1");
    
require_once('wp-load.php');

global $wpdb;
$table_name  = "wp_qrLogin";

if(!empty($_POST)){
	
if ( isset( $_POST['login_dealer_nonce'] ) && wp_verify_nonce( $_POST['login_dealer_nonce'], 'login_dealer' ) ) {
	
	$info = array();
    $info['user_login'] = $_POST['user_login'];
    $info['user_password'] = $_POST['password'];
    
    $info['remember'] = true;
    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
         $msg = 'Wrong username or password.';
    } else {
	
		$user    = get_user_by( 'login', $info['user_login'] );		
		$user_id = $user->ID;
		$hash	= $_REQUEST['qrHash'];
		$user_login	=	$info['user_login'] ;
		//~ $rows_affected = $wpdb->update( $table_name, array( 'hash' => 'used' ), array( 'uname' => $user_login ) );
		$rows_affected = $wpdb->update( $table_name, array( 'hash' => $_POST['qrHash'],'uname' => $user_login ), array( 'hash' => $_POST['qrHash'] ) );

		if ( $rows_affected ) {
			wp_set_current_user( $user_id, $user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user_login );			
		}
			
    }

}

	
}


	

	$qrHash = preg_replace( "/[^0-9a-zA-Z ]/", "", $_GET['qrHash'] );
	global $wpdb;
	
	$qrUserLogin = $wpdb->get_results( $wpdb->prepare( "SELECT uIP FROM $table_name WHERE hash = %s", $qrHash ) ); ?>
	<?php echo $msg; ?>
	<h1>A login request for<br>
		<?php bloginfo( 'url' ); ?><br>
		has been made from<br>
		<?php echo $qrUserLogin[0]->uIP; ?><br>
		are you sure that you want to log in?</h1>
	
<form method="post" name="dealer_form" id="dealer_form">
		<div class="message"></div>						
		<div class="form-group position-relative mt-1">
			<i class="fa fa-user" aria-hidden="true"></i>
			<input type="text" class="form-control" required name="user_login" id="dealer_id" size="32" maxlength="100" value="" placeholder="User Name">
		</div>
		<div class="form-group position-relative">
			<i class="fa fa-lock" aria-hidden="true"></i>											
			<input type="password" class="form-control" name="password" id="password" size="32" maxlength="100" value="" placeholder="Type Password">
		</div>
		<?php wp_nonce_field( 'login_dealer', 'login_dealer_nonce' ); ?>
		<div class="clearfix form-group mb-0">
			<input type="hidden" name="action" value="login_with_dealer">
			
			<input type="hiddenn" name="page" value="qr-login">
			<input type="hiddenn" name="qrHash" value="<?php echo $qrHash; ?>">
			<input type="hiddenn" name="QRnonceAdmin" value="<?php echo wp_create_nonce( 'QRnonceAdmin' ); ?>">
			<input class="button button-primary button-large" type="submit" value="YES">
		
			<button type="submitt" id="get_login" class="btn btn-muted pull-left">Login</button>			
		</div>						
	</form>

	
	
<?php
exit;
?>
