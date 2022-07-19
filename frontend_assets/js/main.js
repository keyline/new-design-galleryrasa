/**
 * createIT main javascript file.
 */
var isIE = false;

var $devicewidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var $deviceheight = (window.innerHeight > 0) ? window.innerHeight : screen.height;


var isiPad = (navigator.userAgent.match(/iPad/i) != null);

$.fn.isAfter = function (sel) {
	return this.prevAll(sel).length !== 0;
}
$.fn.isBefore = function (sel) {
	return this.nextAll(sel).length !== 0;
}


var $bodyel = jQuery("body");
var $navbarel = jQuery(".navbar");
var $topbarel = jQuery(".ct-topBar");

/* ========================== */
/* ==== HELPER FUNCTIONS ==== */

function validatedata($attr, $defaultValue) {
    "use strict";
    if ($attr !== undefined) {
        return $attr
    }
    return $defaultValue;
}

function parseBoolean(str, $defaultValue) {
    "use strict";
    if (str == 'true') {
        return true;
    } else if (str == "false") {
        return false;
    }
    return $defaultValue;
}

(function ($) {
    "use strict";

    $(document).ready(function(){

        $(".ct-intro-topImage").css("min-height",  $deviceheight + "px");

        if($devicewidth < 768)
        {
            var $flexslider = $(".flexslider");

            $flexslider.each(function()
            {
               $(this).attr("data-controlnav", "true");
            });
        }


	    $(".ct-js-color").each(function(){
	        $(this).css("color", '#' + $(this).attr("data-color"));
		})



        $(window).scroll(function(){
            var scroll = $(window).scrollTop();

            if (scroll > 600) {
                jQuery('.ct-js-btnScrollUp').addClass('is-active');
            } else {
                jQuery('.ct-js-btnScrollUp').removeClass('is-active');
            }

        });


        if($().select2){
            $('select').select2();
        }

		// Pricing table //
        $(".ct-princing--second .container-middle").each(function () {
            var $this = $(this);
            $this.css('min-height', $this.attr('data-height') + "px");
            $this.find("div").css('min-height', $this.attr('data-height') + "px");
            $this.css('background', 'url('+$this.attr('data-image')+') no-repeat' );
        });


        // Menu //
        if($().waypoint){
            $('.ct-js-fixTop').waypoint('sticky');
        }

        // Tooltip //
		$('[data-toggle="tooltip"]').tooltip();


		// Tab //
	    $(function () {
	        $('.ct-mytab-js a:first').tab('show');
	    });


        // Search header //
	    $( ".ct-search-open-icon-js").click(function() {
	        event.preventDefault();
		    var headersearch =  $( ".header-search" );
		    headersearch.fadeIn("fast");

            $( "body").click(function() {
	            headersearch.fadeOut(0);
            });

		    headersearch.click(function(event) {
                event.stopPropagation();
            });
		    event.stopPropagation();
        });

	    $( ".ct-popup-js").click(function(event) {
	        event.preventDefault();
		    var popup =  $(".ct-popup" );
		    popup.fadeIn("slow");
            $( "body").click(function() {
	            popup.fadeOut("slow");
            });

		    popup.click(function(event) {
                event.stopPropagation();
            });

		    event.stopPropagation();
        });



        // Animations Init // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        if ($().appear) {
            if (device.mobile() || device.tablet()) {
                // disable animation on mobile
                $("body").removeClass("cssAnimate");
            } else {

                $('.cssAnimate .animated').appear(function () {
                    var $this = $(this);

                    $this.each(function () {
                        if ($this.data('time') != undefined) {
                            setTimeout(function () {
                                $this.addClass('activate');
                                $this.addClass($this.data('fx'));
                            }, $this.data('time'));
                        } else {
                            $this.addClass('activate');
                            $this.addClass($this.data('fx'));
                        }
                    });
                }, {accX: 50, accY: -150});
            }
        }

        // Link Scroll to Section // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $('.ct-js-btnScroll[href^="#"]').click(function (e) {
            e.preventDefault();

            var target = this.hash, $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        });

    }); // /documentready

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();

        if (scroll > 100) {
            $('.ct-navbar--transparent').addClass('ct-navbar--dark');
            $('.ct-navbar--transparent').addClass('ct-navbar--makeSmaller');
        } else {
            $('.ct-navbar--transparent').removeClass('ct-navbar--dark');
            $('.ct-navbar--transparent').removeClass('ct-navbar--makeSmaller');
        }

    });


})(jQuery);