(function ($) {
    "use strict";
    $(document).ready(function(){

        // One Pager Scroll // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if(jQuery().pageScroller){
            // initiate page scroller plugin

            if(!$('nav').hasClass("ct-navbar--makeSmaller"))
            {
                $('body').pageScroller({
                    navigation: '.onepage',
                    scrollOffset: -60
                });
            }
            else
            {
                $('body').pageScroller({
                    navigation: '.onepage',
                    scrollOffset: -70
                });
            }
        }

    }); // /document.ready
})(jQuery);