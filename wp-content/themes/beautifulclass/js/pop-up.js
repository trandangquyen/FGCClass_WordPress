//  Function Click out site pop-> hide

$.fn.clickOff = function(callback, selfDestroy) {
    var clicked = false;
    var parent = this;
    var destroy = selfDestroy || true;

    parent.click(function() {
        clicked = true;
    });

    $(document).click(function(event) {
        if (!clicked) {
            callback(parent, event);
        }
        if (destroy) {
            //parent.clickOff = function() {};
            //parent.off("click");
            //$(document).off("click");
            //parent.off("clickOff");
        };
        clicked = false;
    });
};
$("#overlay-region").click(function() {
    $(".win-wrapper").removeClass('show').addClass('hide');
    $(this).css({
        display: 'none',
        left: '0'
    });
});

(function($) {
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

    });
    /* OnLoad Window */
    var init = function() {
    };
    window.onload = init;

})(jQuery);
