(function ($) {
    "use strict";

    $(document).ready(function () {

        /* ============================= */
        /* ==== MAGNIFIC POPUP ========= */


	$('.ct-playVideo-js').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});


    })
}(jQuery));