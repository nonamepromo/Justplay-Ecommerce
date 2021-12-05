/*-----------------------------------------------------------------------------------*/
/* 		Mian Js Start
/*-----------------------------------------------------------------------------------*/
$(document).ready(function($) {
"use strict"
/*-----------------------------------------------------------------------------------*/
/*		STICKY NAVIGATION
/*-----------------------------------------------------------------------------------*/
$(".sticky").sticky({topSpacing:0});
/*-----------------------------------------------------------------------------------*/
/* 	LOADER
/*-----------------------------------------------------------------------------------*/
$("#loader").delay(500).fadeOut("slow");
/*-----------------------------------------------------------------------------------*/
/*  FULL SCREEN
/*-----------------------------------------------------------------------------------*/
$('.full-screen').superslides({});
/*-----------------------------------------------------------------------------------*/
/*    Parallax
/*-----------------------------------------------------------------------------------*/
jQuery.stellar({
   horizontalScrolling: false,
   scrollProperty: 'scroll',
   positionProperty: 'position',
});

/*-----------------------------------------------------------------------------------*/
/* 		Parallax
/*-----------------------------------------------------------------------------------*/
$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(400);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(500).fadeOut(100);
});
/*-----------------------------------------------------------------------------------*/
/* 		Parallax
/*-----------------------------------------------------------------------------------*/
$('.images-slider').flexslider({
  animation: "fade",
  controlNav: "thumbnails"
});
/*-----------------------------------------------------------------------------------*/
/* 	GALLERY SLIDER
/*-----------------------------------------------------------------------------------*/
$('.block-slide').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
}});
/*-----------------------------------------------------------------------------------*/
/* 	SLIDER REVOLUTION
/*-----------------------------------------------------------------------------------*/
jQuery('.tp-banner').show().revolution({
	dottedOverlay:"none",
	delay:10000,
	startwidth:1170,
	startheight:900,
	navigationType:"",
	navigationArrows:"solo",
	navigationStyle:"preview1",
	parallax:"mouse",
	parallaxBgFreeze:"on",
	parallaxLevels:[7,4,3,2,5,4,3,2,1,0],
	keyboardNavigation:"on",
	shadow:0,
	fullWidth:"on",
	fullScreen:"off",
	shuffle:"off",
	autoHeight:"off",
	forceFullWidth:"off",
	fullScreenOffsetContainer:""
});

/*-----------------------------------------------------------------------------------*/
/* 	TESTIMONIAL SLIDER
/*-----------------------------------------------------------------------------------*/
$(".single-slide").owlCarousel({
    items : 1,
	autoplay:true,
	loop:true,
	autoplayTimeout:5000,
	autoplayHoverPause:true,
	singleItem	: true,
    navigation : true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	pagination : true,
	animateOut: 'fadeOut'
});
$('.item-slide').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
		900:{
            items:3
        },
        1200:{
            items:4
        }
    }
});
/* ------------------------------------------------------------------------
   SEARCH OVERLAP
------------------------------------------------------------------------ */
$(window).load(function() {
  $('#shop-thumb').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 5,
    asNavFor: '#slider-shop'
  });
$('#slider-shop').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#shop-thumb"
  });
});
/* ------------------------------------------------------------------------
   SEARCH OVERLAP
------------------------------------------------------------------------ */
jQuery('.search-open').on('click', function(){
	jQuery('.search-inside').fadeIn();
});
jQuery('.search-close').on('click', function(){
	jQuery('.search-inside').fadeOut();
});
/*-----------------------------------------------------------------------------------*/
/* 		Active Menu Item on Page Scroll
/*-----------------------------------------------------------------------------------*/
$(window).scroll(function(event) {
		Scroll();
});
$('.scroll a').on('click', function() {
	$('html, body').animate({scrollTop: $(this.hash).offset().top -0}, 1000);
		return false;
});
// User define function
function Scroll() {
var contentTop      =   [];
var contentBottom   =   [];
var winTop      =   $(window).scrollTop();
var rangeTop    =   0;
var rangeBottom =   1000;
$('nav').find('.scroll a').each(function(){
	contentTop.push( $( $(this).attr('href') ).offset().top);
		contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
})
$.each( contentTop, function(i){
if ( winTop > contentTop[i] - rangeTop ){
	$('nav li.scroll')
	  .removeClass('active')
		.eq(i).addClass('active');
}}  )};
});
/*-----------------------------------------------------------------------------------*/
/*    CONTACT FORM
/*-----------------------------------------------------------------------------------*/
function checkmail(input){
  var pattern1=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  	if(pattern1.test(input)){ return true; }else{ return false; }}
    function proceed(){
    	var name = document.getElementById("name");
		var email = document.getElementById("email");
		var company = document.getElementById("company");
		var web = document.getElementById("website");
		var msg = document.getElementById("message");
		var errors = "";
		if(name.value == ""){
		name.className = 'error';
	  	  return false;}
		  else if(email.value == ""){
		  email.className = 'error';
		  return false;}
		    else if(checkmail(email.value)==false){
		        alert('Please provide a valid email address.');
		        return false;}
		    else if(company.value == ""){
		        company.className = 'error';
		        return false;}
		   else if(web.value == ""){
		        web.className = 'error';
		        return false;}
		   else if(msg.value == ""){
		        msg.className = 'error';
		        return false;}
		   else
		  {
	$.ajax({
		type: "POST",
		url: "php/submit.php",
		data: $("#contact_form").serialize(),
		success: function(msg){
		//alert(msg);
		if(msg){
			$('#contact_form').fadeOut(1000);
			$('#contact_message').fadeIn(1000);
				document.getElementById("contact_message");
			 return true;
		}}
	});
}};


/*-----------------------------------------------------------------------------------
    Animated progress bars
/*-----------------------------------------------------------------------------------*/
$('.progress-bars').waypoint(function() {
  $('.progress').each(function(){
    $(this).find('.progress-bar').animate({
      width:$(this).attr('data-percent')
     },100);
});},
	{
	offset: '100%',
    triggerOnce: true
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


jQuery(document).ready(function($){
	var isLateralNavAnimating = false;

	//open/close lateral navigation
	$('.cd-nav-trigger').on('click', function(event){
		event.preventDefault();
		//stop if nav animation is running
		if( !isLateralNavAnimating ) {
			if($(this).parents('.csstransitions').length > 0 ) isLateralNavAnimating = true;

			$('body').toggleClass('navigation-is-open');
			$('.cd-navigation-wrapper').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				//animation is over
				isLateralNavAnimating = false;
			});
		}
	});


    //Check Current Password
    $("#current_pwd").keyup(function (){
        var current_pwd = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:"/check-user-pwd",
            data:{current_pwd:current_pwd},
            success:function (resp){
                if(resp=="false"){
                    $("#chkPwd").html("<font color='red'>La password inserita non è corretta</font>");
                }else if(resp=="true"){
                    $("#chkPwd").html("<font color='green'>La password inserita è corretta</font>");
                }
            },error:function (){
                alert("Error");
            }
        });
    });

    $("#passwordForm").validate({
    rules:{
        confirm_pwd:{
            required:true,
            minlength:6,
            maxlength:20,
            equalTo:"#new_pwd"
        }
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight:function(element, errorClass, validClass) {
        $(element).parents('.control-group').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.control-group').removeClass('error');
        $(element).parents('.control-group').addClass('success');
    }
    });

    // Password Strength script
    $('#myPassword').passtrength({
        minChars: 6,
        passwordToggle: true,
        tooltip: true,
        eyeImg: "/images/frontend_images/eye.svg",
    });


    //Copy Billing Address to Shipping Address Script
    $("#copyAddress").click(function (){
        if(this.checked){
            $("#shipping_name").val($("#billing_name").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_city").val($("#billing_city").val());
            $("#shipping_state").val($("#billing_state").val());
            $("#shipping_pincode").val($("#billing_pincode").val());
            $("#shipping_mobile").val($("#billing_mobile").val());
            $("#shipping_country").val($("#billing_country").val());
        }else{
            $("#shipping_name").val('');
            $("#shipping_address").val('');
            $("#shipping_city").val('');
            $("#shipping_state").val('');
            $("#shipping_pincode").val('');
            $("#shipping_mobile").val('');
            $("#shipping_country").val('');
        }
    });
});

function selectPaymentMethod(){
    if($('#Paypal').is(':checked') || $('#COD').is(':checked')){

    }else{
        alert ("Per favore seleziona un metodo di pagamento");
        return false;
    }
}

function checkPincode(){
   var pincode = $("#chkPincode").val();
   if(pincode=="") {
       alert("Perfavore inserisci un CAP valido");
       return false;
   }
   $.ajax({
       type:'post',
       data:{pincode:pincode},
       url:'/check-pincode',
       success:function(resp){
           if(resp>0){
               $("#pincodeResponse").html("<font color='green'>Spediamo nella tua città!</font>");
           }else{
               $("#pincodeResponse").html("<font color='red'>Ci dispiace ma non possiamo ancora spedire nella tua città!</font>");
           }
       },error:function (){
           alert("Error");
       }
   });
}



