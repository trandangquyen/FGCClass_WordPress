(function($) {
    // Function to scroll to top on click arrow button event
    function scrollTop() {
        $(function() {
            // scroll body to 0px on click
            $('#scroll-toparr').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    }
    // Function to show megamenu when mouse scroll
    function showMenu() {
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 500) {
                    $('.pcst-megamenu').addClass('active');
                    $('.mobilest-megamenu').addClass('active');
                } else {
                    $('.pcst-megamenu').removeClass('active');
                    $('.mobilest-megamenu').removeClass('active');
                }
            });
        });

    }
    // Function to change something on resize window event
    function resizeWindow(){
        $(window).resize(function(event) {
            /* Act on the event */
            var win = $(this);
            if (win.width() >= 1100) {
                $(".mb-mainmenu").hide();
                $(".cookie-wrapper,.par-menu").removeClass('active');

            }
        });
    }
    // Function to show Main menu mobile.
    function showMbmenu(){
        $(".cookie-wrapper").click(function(event) {
            /* Act on the event */
            $("html").css({
                height: '100%'
            });
            $("body").toggleClass('on');           
            $(this).toggleClass('active');
            $(this).closest('.par-menu').toggleClass('active')
        });
        $(".canvas-overlay").click(function(event) {
            $("html").css({
                height: 'auto'
            });
            $("body").removeClass('on');
            setTimeout(function(){ 
                $(".mbmenu-wrapper .sub-child1>li").removeClass('active');
                $(".mbmenu-wrapper .sub-child2").slideUp();
            }, 500);
            
            $(".par-menu").css({
                'z-index': 515
            });
        });
        $(".mbmenu-wrapper").on("swiperight",function(){
            $("html").css({
                height: 'auto'
            });
          $("body").removeClass('on');
          setTimeout(function(){ 
                $(".mbmenu-wrapper .sub-child1>li").removeClass('active');
                $(".mbmenu-wrapper .sub-child2").slideUp();
            }, 500);
        });
        $(".swipe-overlay").on("swipeleft",function(){
            $("html").css({
                height: '100%'
            });
          $("body").addClass('on');
        });
        $(".canvas-overlay").on("touchmove",function(event){
          event.preventDefault();
          return false;
        });
    }
    // Function to show sub childs of the menu mobile.
    function showSubmenuMobile(){
        $(".mbmenu-wrapper .sub-child1>li>a").click(function(event) {
            $(this).parent().toggleClass('active');
            $(this).parent().siblings().removeClass('active');
            $(this).parent().siblings().find('.sub-child2').slideUp();
            $(this).next('.sub-child2').slideToggle();
        });
        $(".mbmenu-wrapper .sub-child2>li>a").click(function(event) {
            $(this).toggleClass('active');
        });
    }
    // Function to disable message on event windows onload.
    function disableLoadingMessage(){
        $.mobile.loading().hide();
        // $("div[data-role='page']").css('outline', 'none');
    }
    /**
     * START - ONLOAD - JS
     */
    /* ----------------------------------------------- */
    /* ------------- FrontEnd Functions -------------- */
    /* ----------------------------------------------- */


    /* ----------------------------------------------- */
    /* ----------------------------------------------- */
    /* OnLoad Page */
    $(document).ready(function($) {
        scrollTop();
        showMenu();
        resizeWindow();
        showMbmenu();
        showSubmenuMobile();
        disableLoadingMessage();
    });

    /* OnLoad Window */
    var init = function() {

    };
    window.onload = init;

})(jQuery);
