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
			<div class="col-lg-9 col-md-12">
			  <div class="row">	
              <?php //wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>  
              <div class="col-md-3 col-sm-6 form-group">
	              <ul class="footer-menu">
					<li><h3>About Us</h3></li>
					<li> <a href="#">About Olio</a></li>
					<li> <a href="#">About Olio Group</a></li>
					<li> <a href="#">Sitemap</a></li>
				  </ul>
			  </div>
			<div class="col-md-3 col-sm-6 form-group">
	              <ul class="footer-menu">
					<li><h3>Customer Services</h3></li>
					<li><a href="#">Help Center</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Report Abuse</a></li>
					<li><a href="#">Submit a Dispute</a></li>
					<li><a href="#">Polices & Rules</a></li>
	              </ul>
            </div>
            <div class="col-md-3 col-sm-6 form-group"> 
				<ul class="footer-menu">
					<li><h3>How to Buy</h3></li>
					<li><a href="#">Making Payments</a></li>
					<li><a href="#">Delivery Options</a></li>
					<li><a href="#">Buyer Protection</a></li>
					<li><a href="#">New User Guide</a></li>
				  </ul>
          	</div>
          	<div class="col-md-3 col-sm-6 form-group">
				<ul class="footer-menu">
					<li><h3>Trade Services</h3></li>
					<li> <a href="#">Trade Assurance</a></li>
					<li> <a href="#">Business Identity</a></li>
					<li> <a href="#">Logistics Services</a></li>
					<li> <a href="#">Secure Payment</a></li>
					<li> <a href="#">Inspection Service</a></li>
				</ul>
             </div> 
		   </div>
		</div>

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="footer-search">
					<h3>Newsletter</h3>
					<div class="input-group form-group">
						<input class="form-control" type="text">
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button">SUBMIT</button>
						</span>
					</div>
					<div class="form-group news-icon">
						<a href="#" class="massage-ico"></a> <a href="#" class="sina-weibo-ico"></a> 
					</div>
				</div>
			</div>
    				
		</div>
		
	</div>
	
</footer>
<div class="clearfix"></div>
<div class="copy-right-txt">
	<div class="container">
	<div class="footer-line"></div>
		<div class="row">
			<div class="col-sm-12 footer-link text-center">
				<a href="#">Site Map</a> | <a href="#">Service</a> | <a href="#">Support</a> | <a href="#">Manufacturers</a> | <a href="#">Shipping</a> | <a href="#">Payments</a> | <a href="#">Terms &amp; Conditions</a> | <a href="#">Warrantee</a>
		    </div>
		<div class="col-sm-12 text-center">
			<div class="coppy-right-text">
				&copy;Copyrights Olio	  
		    </div>
		</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
<script type="text/javascript">

function whishlist(id){
		var aurl = "<?php echo admin_url( 'admin-ajax.php' ) ;?>";		
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
        
}
	


jQuery(document).ready(function($){
		 $('.search.search-header .dropdown-menu li input[type="checkbox"]').click(function() {
       	 	if ($(this).is(':checked')) {
       	 		var label = $(this).attr('id');
       	 		$('.search.search-header .dropdown > button').text(label);
        	}
    	});
    	
/*    	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a16a07fbb0c3f433d4cacdd/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();*/

});

</script>
</body>
</html>
