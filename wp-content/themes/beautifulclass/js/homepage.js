(function($) {

    function runSlider(){
         $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
          });
    }
    function showMainMenu() {
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 0) {
                    $('.site-header').addClass('affix');
                } else {
                    $('.site-header').removeClass('affix');
                }
            });
        });

    }
    function showLoginForm(){
        $("a.login").click(function(event) {
            $("#thim-popup-login").addClass('active');
        });
    }
    function hideLoginForm(){
        $(document).mouseup(function(e) 
        {
            var container = $(".thim-login-container");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) 
            {
                $("#thim-popup-login").removeClass('active');
                $('body').css({
                    cursor: 'default'
                });
            }
        });
    }
    function changeMouseIcon(){
        var arreaCont = $("#thim-popup-login");       
             $(document).mousemove(function(e) {
                 if (arreaCont.hasClass('active')) {
                    var container = $(".thim-login-container");
                    if (!container.is(e.target) && container.has(e.target).length === 0) 
                    {
                        $('body').css({
                            cursor: 'url(http://localhost:8080/wordpress/wp-content/themes/beautifulclass/images/close-bt.png),auto'
                        });
                    }

                 }
            });
       
    }
    /* ----------------------------------------------- */
    /* ------------- FrontEnd Functions -------------- */
    /* ----------------------------------------------- */

    /* OnLoad Page */
    $(document).ready(function($) {
        hideLoginForm();
        showMainMenu();
        showLoginForm();
        changeMouseIcon();
        // runSlider();
        $('.thim-course-carousel').owlCarousel({
                loop: false,
                margin: 10,
                responsiveClass: true,
                nav: true,
                dots: false,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                rewind: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 4,
                    nav: true,
                    margin: 0
                  }
                }
              });
        $('.thim-owl-carousel-post').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                nav: true,
                dots: false,
                navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                rewind: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 3,
                    nav: true,
                    loop: false,
                    margin: 0
                  }
                }
              })


        
    });

    /* OnLoad Window */
    var init = function() {

    };
    window.onload = init;
})(jQuery);