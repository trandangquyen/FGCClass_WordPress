// preloader
$(window).load(function () {
    'use strict';
    $("#status").fadeOut();
    $("#preloader").delay(350).fadeOut("slow");

    // tag line animations
    setTimeout(function () { $('.site-logo').addClass('animated slideInDown show-element'); }, 800);
    setTimeout(function () { $('.hm-1').addClass('animated slideInRight show-element'); }, 1600);
    setTimeout(function () { $('.hm-2').addClass('animated slideInRight show-element'); }, 1800);
    setTimeout(function () { $('.hm-3').addClass('animated slideInRight show-element'); }, 2200);
    setTimeout(function () { $('.hm-4').addClass('animated bounceInRight show-element'); }, 3400);
});

$(function () {
    "use strict";

    $(".copyright").append((new Date()).getFullYear());

    // tooltip
    $('.call-at').hover(function () {
        $(this).addClass('spinIn');
        $(this).removeClass('spinOut');

        $('.tooltip-show').addClass('animated fadeInRight show-element');
        $('.tooltip-show').removeClass('fadeOutRight');
    }, function () {
        $(this).removeClass('spinIn');
        $(this).addClass('spinOut');

        $('.tooltip-show').addClass('animated fadeOutRight show-element');
        $('.tooltip-show').removeClass('fadeInRight');
    });

    // site logo click
    $('.site-logo').click(function () {
        //$('.pnl-1').fadeIn();
        //$('.pnl-2').hide();
        //$('.pnl-3').hide();
        navMenuFunc(0);
    });

    // fit text
    $('.tag-line h1, .tag-line h2').fitText(1.1, { minFontSize: '30px' });

    // slider
    $("#owl-slider").owlCarousel({
        navigation: true,
        pagination: true,
        items: 4,
        navigationText: false
    });

    // show/hide page content on click
    $('.page-panels').each(function () {
        $(this).find('section:lt(1)').show()
    })

    function navMenuFunc(index){
        var effect_options = {};
		//console.log(index);
        switch(window.nav_effect){
            case 'fadeIn':
                $('.page-panels').children().hide().eq(index).fadeIn();
            break;
            case 'slide_right':
                $('.page-panels').children().hide().eq(index).show('slide', {direction: 'right'});
            break;
            case 'slide_up':
                $('.page-panels').children().hide().eq(index).show('slide', {direction: 'up'});
            break;
            case 'scale':
                effect_options = { percent: 100 };
                $('.page-panels').children().hide().eq(index).show(window.nav_effect, effect_options);
            break;
            default:
                $('.page-panels').children().hide().eq(index).show(window.nav_effect, effect_options);
            break;
        }

        $('nav a').removeClass('active');
        $('#a_menu_'+index).addClass('active');
        $('.subscribe-message, .subscribe-error-field, .contact-error-field, .contact-message').fadeOut();
        
        if (jQuery('.nav-toggle').css('display')!='none'){
    		$('nav ul').css('display', 'none');
    		$('.nav-toggle').removeAttr('style');
    		$('.nav-container .nav-toggle').css('color', '#fff');
    		window.v_menu = 0;        	
        }
    }
    
    $('.nav-container .nav-toggle').click(function(){
    	ics_show_hide_mobile_menu();
    });
    
    function ics_show_hide_mobile_menu(){
    	if (window.v_menu==1){
    		$('nav ul').css('display', 'none');
    		$('.nav-toggle').removeAttr('style');
    		$('.nav-container .nav-toggle').css('color', '#fff');
    		window.v_menu = 0;
    	} else {
    		$('nav ul').css('display', 'block');
    		$('.nav-container .nav-toggle,nav li a').css('background-color', 'rgba(0,0,0,0.3) !important');
    		$('.nav-container .nav-toggle').css('color', '#32b8da');
    		window.v_menu = 1;
    	}
    }
    
    
    $('body').click(function(e){
    	var theclass = jQuery(e.target).attr('class');
    	if (theclass!='fa-ics fa-bars-ics'){
        	if (window.v_menu==1){
        		$('nav ul').css('display', 'none');
        		$('.nav-toggle').removeAttr('style');
        		$('.nav-container .nav-toggle').css('color', '#fff');
        		window.v_menu = 0;  		
        	}    		
    	}    	
    });
	

    $('nav a').click(function () {
        var index = $('nav a').index(this);
        navMenuFunc(index);
    });

    // scrolll to if mobile
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $('nav a').click(function () {
            $('html, body').animate({
	            scrollTop: $(".page-panels").offset().top
            }, 800);
        });
    }

});

