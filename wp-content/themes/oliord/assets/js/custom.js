	
window.onload = function() {
   jQuery(".dimond_members").find(".progress-bar-custom").loading();
   jQuery(".progress-bar-custom").loading();
};


//~ $(function(){
 //~ var shrinkHeader = 100;
  //~ $(window).scroll(function() {
    //~ var scroll = getCurrentScroll();
      //~ if ( scroll >= shrinkHeader ) {
           //~ $('.deals-day-banner').addClass('shrink');
        //~ }
        //~ else {
            //~ $('.deals-day-banner').removeClass('shrink');
        //~ }
  //~ });
//~ function getCurrentScroll() {
    //~ return window.pageYOffset || document.documentElement.scrollTop;
    //~ }
//~ });


$(function(){	
	
	//~ jQuery('#example2').accordionSlider({
	//~ width: 1960,
	//~ height: 500,
	//~ responsiveMode: 'custom',
	//~ autoplay: false,
	//~ mouseWheel:false,
	//~ keyboard:false,
	//~ visiblePanels: 8,
	//~ breakpoints: {
		//~ 900: {visiblePanels: 6,height: 900},
		//~ 600: {visiblePanels: 4,height: 1000}
	//~ }
//~ });

//~ $('ul.products li').hover(
//~ function() {
	//~ $(this).addClass('expand');
//~ }, function() {
	//~ $(this).removeClass('expand');
	//~ $(this).parent().find('li').removeClass("expand");
//~ });
    
    


//jQuery('.filter-sidebar').on('mouseover', '> div', function(e) {	
//~ jQuery('.filter-sidebar').mouseover(function(){
	//~ jQuery('.catlog_products').addClass('disable_background');
			
//~ }).on('mouseout', '> div', function (e) {
		//~ jQuery('.catlog_products').removeClass('disable_background');
//~ });
	

//~ $('.filter-sidebar').hover(
//~ function() {
	//~ click_filter();
//~ });


$('.flash_deals ul li').hover(
function() {	
	$(this).find('.progress-bar-custom').loading();
});

    
$('.catlog_products ul.products li').hover(
function() {
	//~ $(this,".progress-bar-custom").loading();   
	
	$(this).parent().find('li').removeClass("expand");	
	//~ $('.first').hide();
	$(this).find('.first').show();
	$(this).find('.progress-bar-custom').loading();
	$(this).addClass('expand');
});
    

	//~ var currentTab = 0; // Current tab is set to be the first tab (0)
	//~ showTab(currentTab); // Display the crurrent tab
	$("#reg_billing_phone").intlTelInput();
		
	jQuery('.navbar-nav').on('mouseover', '> #menu-item-159', function(e) {        
		jQuery('.gallery-hero-section').addClass('disable_background');
		jQuery('.middle-content').addClass('disable_background');
		jQuery('.footer-content').addClass('disable_background');
		jQuery('.copy-right-txt').addClass('disable_background');
			
	}).on('mouseout', '> #menu-item-159', function (e) {
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
	
	
	var site_url = b2b_obj.currentUrl;	
	
		
	$('.filter_select').on('change',function(){
		var th = $(this), name = th.prop('name');	 
		jQuery(':checkbox[name="'  + name + '"]').not($(this)).prop('checked',false);   				 
	 
		var price 		= $("input[name=deal_price]:checked").val();
		var min_price 	= $("input[name=deal_price]:checked").attr("min");
		var max_price 	= $("input[name=deal_price]:checked").attr('max');		
	 
		var discount  	= $("input[name=deal_discount]:checked").val();
		var min_disc  	= $("input[name=deal_discount]:checked").attr("min_disc");
		var max_disc  	= $("input[name=deal_discount]:checked").attr("max_disc");		
	
		var review		= $("input[name=review]:checked").val();
		var min_review 	= $("input[name=review]:checked").attr('min_review');
		var max_review 	= $("input[name=review]:checked").attr('max_review');
	
		if (typeof price === "undefined") {
			var price = 0;
			var min_price = 0;
			var max_price = 0;
		}
		if (typeof discount === "undefined") {
			var discount = 0;
			var min_disc = 0;
			var max_disc = 0;
		}
		if (typeof review === "undefined") {
			var review = 0;
			var min_review = 0;
			var max_review = 0;
		}
		
  
		//~ jQuery(':checkbox[name="'  + name + '"]').not($(this)).prop('checked',false);   				 
		 //~ var url = site_url+"/deals-of-the-day/?price="+price+"&min_price="+min_price+
		//~ "&max_price="+max_price+"&discount="+discount+"&min_disc="+min_disc+"&max_disc="+max_disc+
		//~ "&review="+review+"&min_review="+min_review+"&max_review="+max_review+"&sort="+sort+"&field="+field+"&order="+order;
		
		var url = site_url+"/deals-of-the-day/?price="+price+"&min_price="+min_price+
		"&max_price="+max_price+"&discount="+discount+"&min_disc="+min_disc+"&max_disc="+max_disc+
		"&review="+review+"&min_review="+min_review+"&max_review="+max_review;		
		window.location.href = url;	  
	});
	
	
	jQuery("#deal_sort").on('change',function(){	
		
		var price 		= $("input[name=deal_price]:checked").val();
		var min_price 	= $("input[name=deal_price]:checked").attr("min");
		var max_price 	= $("input[name=deal_price]:checked").attr('max');		
	 
		var discount  	= $("input[name=deal_discount]:checked").val();
		var min_disc  	= $("input[name=deal_discount]:checked").attr("min_disc");
		var max_disc  	= $("input[name=deal_discount]:checked").attr("max_disc");		
	
		var review		= $("input[name=review]:checked").val();
		var min_review 	= $("input[name=review]:checked").attr('min_review');
		var max_review 	= $("input[name=review]:checked").attr('max_review');
	
		if (typeof price === "undefined") {
			var price = 0;
			var min_price = 0;
			var max_price = 0;
		}
		if (typeof discount === "undefined") {
			var discount = 0;
			var min_disc = 0;
			var max_disc = 0;
		}
		if (typeof review === "undefined") {
			var review = 0;
			var min_review = 0;
			var max_review = 0;
		}
		
		var sort = jQuery("#deal_sort option:selected").val();
		var field = jQuery("#deal_sort option:selected").attr('field');
		var order = jQuery("#deal_sort option:selected").attr('order');
		
		var url = site_url+"/deals-of-the-day/?price="+price+"&min_price="+min_price+
		"&max_price="+max_price+"&discount="+discount+"&min_disc="+min_disc+"&max_disc="+max_disc+
		"&review="+review+"&min_review="+min_review+"&max_review="+max_review+"&sort="+sort+"&field="+field+"&order="+order;
		window.location.href = url;
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
		jQuery("#search_type").val($(this).html());	
		$(this).html(filter_button_txt)	
	});
		
	  $("a[href='#top']").click(function() {
		 $("html, body").animate({ scrollTop: 0 }, "slow");
		 return false;
	  });
	  
	  
	  jQuery("#join_convention").click(function() {
		  var company_email_id	=	jQuery("#company_email_id").val();
			jQuery.ajax(
			{
					'type': "post",
					'url':b2b_obj.ajax_url,
					'data': 'action=join_convention&company_email_id='+company_email_id,        
					success: function(msg){
						if(msg	== 1){
							alert("Thanks for joining with us");
							jQuery("#company_email_id").val('');
							//~ jQuery('.invited-join').html('<p class="deals-day-text">Thanks for joining</p>');
						}
					}
			});
	  });

});



  
 function login_type(type){	
	 
	 if(type	==	"login_with_QR"){
			jQuery(".login-form").hide(2);
			jQuery(".qr-login-form").show();
	 }else{
		 	jQuery(".qr-login-form").hide();
			jQuery(".login-form").show();
		 }
	
	//~ jQuery.ajax(
	//~ {
			//~ 'type': "post",
			//~ 'url':b2b_obj.ajax_url,
			//~ 'data': 'action=login_type&type='+type,        
			//~ success: function(msg){
				//~ if(msg	== 1){
					//~ alert('Thank you. Stickers will be dropped off on your next scheduled pick-up or delivery.');
				//~ }
			//~ }
	//~ });
	
}


function header_sticky_eff(){
	
	var header = jQuery(".navbar-fixed-top");
	var scroll = jQuery(window).scrollTop();

	if (scroll >= 480) {
		header.removeClass('header-sticky').addClass("header-scroll");		
		jQuery('body').addClass("header-scroll");
	} else {
		header.removeClass("header-scroll").addClass('header-sticky');
		jQuery('body').removeClass("header-scroll");
	}
	
	if (scroll < 60){
		jQuery(".navbar-fixed-top").removeClass('header-scroll');
		jQuery('body').removeClass("header-scroll");
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
	   if(register_type	==	"Buyer"){
		jQuery("#seller_information").removeClass( "tab" );	
		jQuery(".seller_information").hide();  		
		jQuery("#seller_step").removeClass( "step" );
		jQuery("#seller_step").hide();
		jQuery(".registration_progress").removeClass( "seller_registration_progress" );
	  }else{
		jQuery("#seller_information").addClass( "tab" );
		jQuery(".tab").removeClass( "seller_information" );	
		jQuery("#seller_step").addClass( "step" );
		jQuery("#seller_step").show();
		jQuery(".registration_progress").addClass( "seller_registration_progress" );
	  }
	  
	  
	  
	  if(register_type == "Seller" && n != (x.length - 1)){
			 jQuery(".form-group.buyer").html("");
	  }
		  //~ alert(x.length);
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
  //~ var register_type = $("input[name='register_type']:checked").val();
	
	//~ if(currentTab == 1){

	//~ if(register_type	==	"Buyer"){
		//~ jQuery("#seller_information").removeClass( "tab" );	
		//~ jQuery(".seller_information").hide();  		
		//~ jQuery("#seller_step").removeClass( "step" );
		//~ jQuery("#seller_step").hide();
		//~ jQuery(".registration_progress").removeClass( "seller_registration_progress" );
	  //~ }else{
		//~ jQuery(".seller_information").addClass( "tab" );
		//~ jQuery(".tab").removeClass( "seller_information" );	
		//~ jQuery("#seller_step").addClass( "step" );
		//~ jQuery("#seller_step").show();
		//~ jQuery(".registration_progress").addClass( "seller_registration_progress" );
	  //~ }
	//~ }
	
	/*if(currentTab == 2){
	  if(register_type	==	"Buyer"){
		jQuery("#seller_information").removeClass( "tab" );	
		jQuery(".seller_information").hide();  		
		jQuery("#seller_step").removeClass( "step" );
		jQuery("#seller_step").hide();
		jQuery(".registration_progress").removeClass( "seller_registration_progress" );
	  }else{
		jQuery(".seller_information").addClass( "tab" );
		jQuery(".tab").removeClass( "seller_information" );	
		jQuery("#seller_step").addClass( "step" );
		jQuery("#seller_step").show();
		jQuery(".registration_progress").addClass( "seller_registration_progress" );
	  }
	}*/
  
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
	 jQuery('.loader').show();
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    //~ jQuery('#regForm').submit();
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
  
  var content = 'Please fill up mandatory fields';
  var str_Reg	=	/^[a-zA-Z\s]*$/;  
  var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
  var MobilenumberRegex = /^[0-9 +]+$/;
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
  // A loop that checks every input field in the current tab:
  jQuery(".form-control").removeClass("invalid");
  
  
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    // alert(y[i].prop('id'));
    
		if (y[i].value == "") {
			
			if(y[i].id != "billing_address_2"){
				// add an "invalid" class to the field:
				y[i].className += " invalid";
				// and set the current valid status to false
				var content = 'Please fill up mandatory fields';				
				valid = false;
				
			}
			
		}
		else  if(y[i].id == "reg_billing_first_name"){
				if(!y[i].value.match(str_Reg))
				{					
					var content = 'Please Enter only character';
					jQuery("#reg_billing_first_name").addClass( "invalid" );
					//~ jQuery(".woocommerce-error").show();
					valid = false;
				}
		} 
		else  if(y[i].id == "reg_email"){				
				if(!y[i].value.match(emailReg))
				{
					
					var content = 'Please Enter Valid Email address';
					jQuery("#reg_email").addClass( "invalid" );
					//~ jQuery(".woocommerce-error").show();
					valid = false;
				}
		} else if(y[i].id == "reg_password"){
			//~ var passwordReg = /^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$/;	
			var passwordReg = /^(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
			if(!y[i].value.match(passwordReg))
			{
				
				var content = 'Password length must be greater than or equal to 8 & use one or more uppercase,lowercase, numeric & special characters';
				jQuery("#reg_password").addClass( "invalid" );
				//~ jQuery(".woocommerce-error").show();
				valid = false;
			}
		} else if(jQuery("#reg_password").val() != jQuery("#confirm_password").val()){
			
			jQuery("#confirm_password").addClass( "invalid" );
			var content = 'Password & confirm password do not match';
			//~ jQuery(".woocommerce-error").show();
			valid = false;
		} else if(y[i].id == "billing_postcode"){
			if(!y[i].value.match(numberRegex))
			{
				jQuery("#billing_postcode").addClass( "invalid" );
				var content = 'Please enter only numeric value';
				//~ jQuery(".woocommerce-error").show();
				valid = false;
			}
		}else if(y[i].id == "reg_billing_phone"){
			if(!y[i].value.match(MobilenumberRegex))
			{
				jQuery("#reg_billing_phone").addClass( "invalid" );
				var content = 'Please enter only numeric value';
				//~ jQuery(".woocommerce-error").show();
				valid = false;
			}
		}
		
		
  }
  
  	jQuery("#billing_country").removeClass("invalid");	
	if(currentTab	==	2 && jQuery("#billing_country").val() == ""){
		jQuery("#billing_country").addClass( "invalid" );
		valid = false;
	}
 
	if(currentTab	==	 2 && jQuery("#billing_state").val() == ""){
		jQuery("#billing_state").addClass( "invalid" );
		valid = false;
	}
	
	if(currentTab	==	 2 && jQuery("#billing_city").val() != ""){
		if(!jQuery("#billing_city").val().match(str_Reg))
		{					
			var content = 'Please Enter only character';
			jQuery("#billing_city").addClass( "invalid" );
			valid = false;
		}
	}
	
	if (currentTab == (x.length - 1)) {
		if(jQuery("#g-recaptcha-response").val() == ""){
			var content = 'Please select captcha';
			jQuery("#g-recaptcha-response").addClass( "invalid" );
			valid = false;
		}
		
		var register_type = $("input[name='register_type']:checked").val();	
		
		if(register_type == "Seller" && !jQuery("#juridicial_person_name").val().match(str_Reg)){
				var content = 'Please Enter only character';
				jQuery("#juridicial_person_name").addClass( "invalid" );
				valid = false;
		}
		
		if(register_type == "Seller" && !jQuery("#juridicial_person_email").val().match(emailReg)){
			var content = 'Please Enter valid email address';
			jQuery("#juridicial_person_email").addClass( "invalid" );			
			valid = false;
		}
		
		if(register_type == "Seller" && jQuery("#seller_agreement").prop("checked") == false){
			var content = 'Please check term & condition';
			jQuery("#seller_agreement").addClass( "invalid" );
			valid = false;
		}
		
	}
 //~ if(currentTab	==	 2 && jQuery("#seller_agreement").prop("checked") == false){
	 //~ jQuery("#seller_agreement").addClass( "invalid" );
	  //~ valid = false;
//~ }
  
  if(valid == false){
	  //~ jQuery(".woocommerce-error").html("Please fill up mandatory fields");
	  //~ jQuery(".woocommerce-error").html(content);
	  
		jQuery(".woocommerce-error").html(content);
		jQuery(".woocommerce-error").show();
	  return false;
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {	  
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

function click_filter(){
		//~ jQuery(".side-bar-filter").animate({
			//~ width: "toggle"
		//~ });	
		
	jQuery(".side-bar-filter").slideToggle("slow");
	//~ jQuery(".side-bar-filter").removeAttr("style");      
	
	jQuery('body').toggleClass('disable_background');
	jQuery(".side-bar-filter").toggleClass("active");
	jQuery(".click_filter_toogle").toggleClass("open");

}
