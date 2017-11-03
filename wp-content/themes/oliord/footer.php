<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package oliord
 */

?>
	</div>
</div>
<footer class="footer-content">
	<div class="wrap container">
		<div class="row">
			<div class="col-md-12">
              <?php //wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>  
              <ul class="footer-menu">
				  <li><h3>About Us</h3></li>
				<li> <a href="#">Know Olio</a></li>
				<li> <a href="#">Contact Us</a></li>
			</ul>
			<ul class="footer-menu">
				<li><h3>Sell On Olio</h3></li>
				<li> <a href="#">Supplier Membership</a></li>
				<li> <a href="#">Policies</a></li>
              </ul>
              <ul class="footer-menu">
				<li><h3>Buy on Olio</h3></li>
				<li><a href="#">Catalog</a></li>
              </ul>
              <ul class="footer-menu">
				<li><h3>How may I help u?</h3></li>
				<li> <a href="#">Your Account</a></li>
				<li> <a href="#">Your Orders</a></li>
				<li> <a href="#">Shipping Policies</a></li>
				<li> <a href="#">Returns and Refunds</a></li>
				<li> <a href="#">Help</a></li>
				<li> <a href="#">FAQ</a></li>
              </ul>
              <ul class="footer-menu">
				<li><h3> Trade services</h3></li>
				<li> <a href="#">QC</a></li>
				<li> <a href="#">Product Videos</a></li>
				<li> <a href="#">Shipping Options</a></li>
				<li> <a href="#">Secure Payment</a></li>
				<li> <a href="#">Multilingual Support</a></li>
				<li> <a href="#">Online Convention Booth</a></li>
              </ul>
			</div>
    				
		</div>
		
	</div>
	</div>
</footer>
<div class="clearfix"></div>
<div class="copy-right-txt">
			<div class="text-right">
				<?php
					if( !empty(get_theme_mod("oliord_cp_op")) ) { echo get_theme_mod("oliord_cp_op"); } 
					else { echo 'Please insert copyright text from theme settings.'; }
				?>
			</div>
		</div>
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery('#example2').accordionSlider({
	width: 1960,
	height: 500,
	responsiveMode: 'custom',
	autoplay: false,
	mouseWheel:false,
	keyboard:false,
	visiblePanels: 8,
	breakpoints: {
		900: {visiblePanels: 6,height: 900},
		600: {visiblePanels: 4,height: 1000}
	}
});

jQuery(document).ready(function($){

	$('.add_wishlist').click(function(e){
		e.preventDefault();
		var aurl = "<?php echo admin_url( 'admin-ajax.php' ) ;?>";
		var id = $(this).attr('id');
		$.ajax({
            url : aurl,
            type : 'post',
            data : {
                action : 'addtowishlist',
                post_id : id
            },
            success : function( response ) {
                window.location.href= response;
            }
        });
});
		 $('.search.search-header .dropdown-menu li input[type="checkbox"]').click(function() {
       	 	if ($(this).is(':checked')) {
       	 		var label = $(this).attr('id');
       	 		$('.search.search-header .dropdown > button').text(label);
        	}
    	});
});

</script>
</body>
</html>
