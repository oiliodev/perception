	
window.onload = function() {
   jQuery(".progress-bar-custom").loading();
};

$(function(){
	
	var currentTab = 0; // Current tab is set to be the first tab (0)
	showTab(currentTab); // Display the crurrent tab
	$("#reg_billing_phone").intlTelInput();
		
	jQuery('.navbar-nav').on('mouseover', '> li', function(e) {        
		jQuery('.gallery-hero-section').addClass('disable_background');
		jQuery('.middle-content').addClass('disable_background');
		jQuery('.footer-content').addClass('disable_background');
		jQuery('.copy-right-txt').addClass('disable_background');
			
	}).on('mouseout', '> li', function (e) {
		jQuery('.gallery-hero-section').removeClass('disable_background');    
		jQuery('.middle-content').removeClass('disable_background');    
		jQuery('.footer-content').removeClass('disable_background');    
		jQuery('.copy-right-txt').removeClass('disable_background');    
	});
	
	var $this = jQuery(".inner-title").addClass('playing');
	window.setTimeout(function(){
		  $this.addClass('finsihed');
	}, 1000);


		
	jQuery(".how_it_work_menu").click(function() {
		jQuery('html,body').animate({
				scrollTop: jQuery("#how-it-works").offset().top - 475},'slow'
			);
	});
	if (window.location.href.indexOf('#how-it-works-section') > -1) {
		 jQuery('html,body').animate({
			scrollTop: jQuery("#how-it-works").offset().top - 475},'slow'
		);
	}


	header_sticky_eff();
	jQuery(window).scroll(function() {
		header_sticky_eff();
	});
			
	$('.filter_text').click(function(e){
		var filter_button_txt = jQuery(".filter_button").html();
		jQuery(".filter_button").html($(this).html());	
		$(this).html(filter_button_txt)	
	});
		
	  $("a[href='#top']").click(function() {
		 $("html, body").animate({ scrollTop: 0 }, "slow");
		 return false;
	  });
	  


});

function header_sticky_eff(){
	
	var header = jQuery(".navbar-fixed-top");
	var scroll = jQuery(window).scrollTop();

	if (scroll >= 265) {			
		header.removeClass('header-sticky').addClass("header-scroll");
	} else {
		header.removeClass("header-scroll").addClass('header-sticky');
	}
	
	if (scroll < 60){
		jQuery(".navbar-fixed-top").removeClass('header-scroll');
	}

}
	
	
function swip_lan(class_name){
	var txt = jQuery("."+class_name).html();
	var en_txt = jQuery(".en").html();
	jQuery("."+class_name).html(en_txt);
	jQuery(".en").html(txt);
}



//START ragistration functionality
var currentTab = 0; // Current tab is set to be the first tab (0)
function showTab(n) {
	jQuery(".woocommerce-error").hide();	
  // This function will display the specified tab of the form...
	  var x = document.getElementsByClassName("tab");
	  x[n].style.display = "block";
	  //... and fix the Previous/Next buttons:
	  if (n == 0) {
		document.getElementById("prevBtn").style.display = "none";
	  } else {
		document.getElementById("prevBtn").style.display = "inline";
	  }
	  
	    var register_type = $("input[name='register_type']:checked").val();	
	  
	  if(register_type == "Seller" && n != (x.length - 1)){
			 jQuery(".form-group.buyer").html("");
	  }
		  
	  if (n == (x.length - 1)) {
		  
		  jQuery.getScript("https://www.google.com/recaptcha/api.js");
		  var recaptcha_tag	=	'<div class="g-recaptcha" data-sitekey="6LcZXxMUAAAAAKmM06vWXcj5FmacRy8wz9gYwX5K"></div>';
		  
		  if(register_type == "Seller"){
			  jQuery(".form-group.buyer").html("");
			  jQuery(".form-group.seller").html(recaptcha_tag);
		  }else{
			  jQuery(".form-group.seller").html("");
			  jQuery(".form-group.buyer").html(recaptcha_tag);
		  }
		  
		document.getElementById("nextBtn").innerHTML = "Submit";
	  } else {
		document.getElementById("nextBtn").innerHTML = "Next";
	  }
	  //... and run a function that will display the correct step indicator:
	  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:  
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;  
	if(currentTab == 2){
	  var register_type = $("input[name='register_type']:checked").val();	  
	  if(register_type	==	"Buyer"){
		  jQuery("#seller_information").removeClass( "tab" );	
		jQuery(".seller_information").hide();  
	  }else{
		jQuery(".seller_information").addClass( "tab" );
		jQuery(".tab").removeClass( "seller_information" );
	  }
	}
  
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  
  
  
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      jQuery(".woocommerce-error").show();
      valid = false;
    }
  }
  
  if(currentTab	==	 2 && jQuery("#billing_country").val() == ""){
	  jQuery("#billing_country").addClass( "invalid" );
	  valid = false;
 }
 
if (currentTab == (x.length - 1)) {
	if(jQuery("#g-recaptcha-response").val() == ""){
		jQuery("#billing_country").addClass( "invalid" );
		valid = false;
	}
	
	var register_type = $("input[name='register_type']:checked").val();	
	
	if(register_type == "Seller" && jQuery("#seller_agreement").prop("checked") == false){
		jQuery("#seller_agreement").addClass( "invalid" );
		valid = false;
	}
	
}
 //~ if(currentTab	==	 2 && jQuery("#seller_agreement").prop("checked") == false){
	 //~ jQuery("#seller_agreement").addClass( "invalid" );
	  //~ valid = false;
//~ }
  
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {	  
	  jQuery(".woocommerce-error").html("Please fill up mendetory fields");
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
//END ragistration functionality
