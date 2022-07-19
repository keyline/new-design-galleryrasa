(function ($) {
    "use strict";

    /* ============================================= */
    /* ==== ISOTOPE ==== */

        if (($.Isotope) && ($('.ct-withMasonry-js').length > 0)) {

            jQuery(window).load(function () {

                // blog masonry

                var $blogContainer = $('.ct-withMasonry-js'), // object that will keep track of options
                    isotopeOptions = {}, // defaults, used if not explicitly set in hash
                    defaultOptions = {
                        itemSelector: '.blog-item',
                        layoutMode: 'sloppyMasonry',
                        resizable: false, // disable normal resizing
                        // set columnWidth to a percentage of container width
                        masonry: {}
                    };


                $(window).smartresize(function () {
                    $blogContainer.isotope({
                        // update columnWidth to a percentage of container width
                        masonry: {}
                    });
                });

                // set up Isotope
                $blogContainer.isotope(defaultOptions, function () {

                    // fix for height dynamic content
                    setTimeout(function () {
                        $blogContainer.isotope('reLayout');
                    }, 1000);

                });
            });
        }

        $(".ct-withMasonry-js").isotope();

})(jQuery);