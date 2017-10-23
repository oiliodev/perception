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
			<div class="row col-md-12">
              <?php //wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>  
              <ul class="footer-menu">
				<li> <a href="#">Know Olio</a></li>
				<li> <a href="#">Sell On Olio</a></li>
				<li> <a href="#">Buy on Olio</a></li>
				<li> <a href="#">Catalog</a></li>
			</ul>
			<ul class="footer-menu">
				<li> <a href="#">Online convention booth</a></li>
				<li> <a href="#">Trade services</a></li>
				<li> <a href="#">Product videos</a></li>
				<li> <a href="#">QC</a></li>
              </ul>
              <ul class="footer-menu">
				<li> <a href="#">Policies</a></li>
				<li> <a href="#">Shipping Policies</a></li>
				<li> <a href="#">Multi lingual support</a></li>
				<li> <a href="#">Secure Payment</a></li>
              </ul>
              <ul class="footer-menu">
				<li> <a href="#">Your orders</a></li>
				<li> <a href="#">Shipping options</a></li>
				<li> <a href="#">Returns and Refunds</a></li>
				<li> <a href="#">How may I help u?</a></li>
              </ul>
              <ul class="footer-menu">
				<li> <a href="#">About Us</a></li>
				<li> <a href="#">Supplier membership</a></li>
				<li> <a href="#">Your Account</a></li>
				<li> <a href="#">Contact us</a></li>
              </ul>
               <ul class="footer-menu">
				<li> <a href="#">Help</a></li>
				<li> <a href="#">FAQ</a></li>
              </ul>
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



</script>
</body>
</html>
