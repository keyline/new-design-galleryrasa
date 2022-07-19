// *************************************************************************//
// ! This is main JS file that contains custom scripts used in this template*/
// *************************************************************************//

$( document ).ready(function() {
    "use strict";
    // **********************************************************************//
    // ! Base Variable
    // **********************************************************************//
    var my_window = $(window);

	// **********************************************************************//
    // ! Swiper Slider
    // **********************************************************************//
    $(".owl-demo").owlCarousel({
        autoPlay: false,
        items : 4,
        pagination: false,
        navigation: true,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        itemsTablet: [768,2],
        itemsMobile:[479,2],
    });
    $(".hipster-product").owlCarousel({
        autoPlay: false,
        items : 3,
        pagination: false,
        navigation: true,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,2],
        itemsTablet: [768,2],
        itemsMobile:[479,2],
    });
    $(".latest-blog, .banner-slider").owlCarousel({
        autoPlay: false,
        items : 3,
        pagination: false,
        navigation: true,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,2],
        itemsTablet: [768,1],
        itemsMobile:[479,1],
    });
    $(".instagram-slider").owlCarousel({
        autoPlay: false,
        items : 6,
        pagination: false,
        navigation: false,
        itemsTablet: [768,3],
        itemsMobile:[479,3],
    });
    $(".sidebar-slider").owlCarousel({
        autoPlay: false,
        items : 2,
        itemsDesktopSmall: [979,1],
        itemsTablet: [768,1],
        itemsMobile:[479,1],
        pagination: true,
        navigation: true,
    });
    $(".owl-quickly, .owl-testimonials, .slider-kids").owlCarousel({
        autoPlay: false,
        items : 1,
        pagination: true,
        navigation: true,
        itemsDesktop: [1199,1],
        itemsDesktopSmall: [979,1],
        itemsTablet: [768,1],
        itemsMobile:[479,1]
    });
    $(".owl-brands").owlCarousel({
        autoPlay: false,
        items : 5,
        pagination: false,
        navigation: true,
        itemsDesktop: [1199,5],
        itemsDesktopSmall: [979,4],
        itemsTablet: [768,2],
        itemsMobile:[479,1]
    });
    $(".category-slider").owlCarousel({
        autoPlay: false,
        items : 4,
        pagination: false,
        navigation: true,
        itemsDesktop: [1199,4],
        itemsDesktopSmall: [979,3],
        itemsTablet: [768,2],
        itemsMobile:[479,2]
    });

    // **********************************************************************//
    // ! Top panel
    // **********************************************************************//
    var topPanelClosed = 'top-panel-closed';
    var topPanelOpened = 'top-panel-opened';
    var panel = '#panel';
    var body = 'body';

    $('.top-bar').on('click', '.top-panel-open', function(){
        if($(body).hasClass(topPanelOpened)) {
            closePanel();
        } else {
            openPanel();
        }
    });

    $('.close-panel').on('click', function(){
        $(panel).click();
    });

    function openPanel() {
        $(body).removeClass(topPanelClosed).addClass(topPanelOpened);

        setTimeout(function() {
            $(panel).one('click', function(event) {
                if($(body).hasClass(topPanelOpened)) {
                    closePanel();
                }
            });
        }, 1);
    }

    function closePanel() {
        $(body).removeClass(topPanelOpened).addClass(topPanelClosed);
    }

    // **********************************************************************//
    // ! Fixed Header
    // **********************************************************************//
    var fixedHeader = '.fixed-header';

	my_window.scroll(function () {
	    var sc = my_window.scrollTop()
	    if (sc > 150) {
	        $(fixedHeader).addClass("enabled");
	    } else {
	        $(fixedHeader).removeClass("enabled");
	    }
	});

	// **********************************************************************//
    // ! Header search
    // **********************************************************************//

    var header = 'header';
    var headerSearch = '.header-search';
    var searchFullWidth = 'search-full-width';

    $(header).on('click', '.search-btn', function(){
        if($(headerSearch).hasClass(searchFullWidth)) {
            
        } else {
            $(headerSearch).addClass(searchFullWidth);
        }
    });

    $(header).on('click', '.close-search', function(){
        $(headerSearch).removeClass(searchFullWidth);
    });

	// **********************************************************************//
    // ! PopUp
    // **********************************************************************//
    /*var popUp = '.popup';
    var bodyUp = 'body';
    var openModal = 'open_modal';

    my_window.on('load', function(){
        setTimeout(function(){
            $(bodyUp).addClass(openModal);
            $(popUp).show();
        }, 2200);
        $(popUp).on('click', '.close', function(){
            $(popUp).hide();
            $(bodyUp).removeClass(openModal);
        });
	});*/
    
    // **********************************************************************//
    // ! Mobile Menu
    // **********************************************************************//
    window.onload = function() {
        var slideout = new Slideout({
          'panel': document.getElementById('panel'),
          'menu': document.getElementById('menu'),
          'touch': false,
          'side': 'right'
        });

        document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
          slideout.toggle();
        });

        $('.toggle-button').on('click', function() {
            slideout.toggle();
        });

        function close(eve) {
            eve.preventDefault();
            slideout.close();
        }

        slideout
        .on('beforeopen', function() {
            this.panel.classList.add('panel-open');
        })
        .on('open', function() {
            this.panel.addEventListener('click', close);
        })
        .on('beforeclose', function() {
            this.panel.classList.remove('panel-open');
            this.panel.removeEventListener('click', close);
        });

    };
    $('.fa').on('click', function(){
        if ($(this).parent().parent().hasClass('menu-parent')) {
            $(this).parent().parent().addClass('open-modile-menu');
        }
    });

    $('.menu').on('click', '.menu-back', function(){
        $('.menu-parent').removeClass('open-modile-menu');
    });

    // **********************************************************************//
    // ! Fixed Footer
    // **********************************************************************//
    my_window.on('load', function(){
         $('.footer-instagram').css('opacity', '1');
    });
    var footer = $('.footer-instagram');
    var pageWrapper = $('#panel');
    pageWrapper.css('marginBottom', footer.outerHeight() );
    my_window.resize(function() {
        pageWrapper.css('marginBottom', footer.outerHeight() );
    });
    // **********************************************************************//
    // ! Layer Slider
    // **********************************************************************//
    $("#layerslider").layerSlider({
        type: 'responsive',
        width: 1920,
        height: 720,
        autoStart: false,
        pauseOnHover: 'enabled',
        showBarTimer: false,
        navPrevNext: true,
        showCircleTimer: false,
        navStartStop: false,
        navButtons: true,
        skin: 'outline',
        skinsPath: '../skins/',
        thumbnailNavigation: false
    });
    $("#layer-boxed").layerSlider({
        type: 'responsive',
        width: 1140,
        height: 620,
        autoStart: false,
        pauseOnHover: 'enabled',
        showBarTimer: false,
        navPrevNext: true,
        showCircleTimer: false,
        navStartStop: false,
        navButtons: true,
        skin: 'outline',
        skinsPath: '../skins/',
        thumbnailNavigation: false
    });
    $("#slider-banner").layerSlider({
        type: 'responsive',
        width: 750,
        height: 535,
        autoStart: false,
        pauseOnHover: 'enabled',
        showBarTimer: false,
        navPrevNext: false,
        showCircleTimer: false,
        navStartStop: false,
        navButtons: true,
        skin: 'outline',
        skinsPath: '../skins/',
        thumbnailNavigation: false
    });
    $("#layerslider-video").layerSlider({
        type: 'fullsize',
        autoStart: false,
        fillmode: 'cover',
        showBarTimer: false,
        navPrevNext: true,
        showCircleTimer: false,
        navStartStop: false,
        navButtons: false,
        skin: 'outline',
        skinsPath: '../skins/',
        thumbnailNavigation: false
    });

    // **********************************************************************//
    // ! Paraxify
    // **********************************************************************//
    var myParaxify = paraxify('.paraxify');

    // **********************************************************************//
    // ! Memu Resize
    // **********************************************************************//
    my_window.on('load', function(){

        my_window.resize(function() {
            memu_resize();
        });
        memu_resize();
        function memu_resize(){
            $('.menu-parent-item .nav-sublist-dropdown').each(function() {
                var extraBoxedOffset = 0;

                var li = $(this).parent();
                var liOffset = li.offset().left - extraBoxedOffset;
                var liOffsetTop = li.offset().top;
                var liWidth = $(this).parent().width();
                var dropdowntMarginLeft = liWidth/2;
                var dropdownWidth = $(this).outerWidth();
                var dropdowntLeft = liOffset - dropdownWidth/2;
                
                var left = 0;
                var top = $('header').outerHeight()/2;
                if(dropdowntLeft < 0) {
                    left = liOffset - 10;
                    dropdowntMarginLeft = 0;
                } else {
                    left = dropdownWidth/2;
                }
                $(this).css({
                    'top': top,
                    'left': - left,
                    'marginLeft': dropdowntMarginLeft
                });
            });
        }
    });

    // **********************************************************************//
    // ! Shop Script
    // **********************************************************************//
    $('.cat-parent').on('click', '.open', function(){
        $('.children').toggle('slow/300/fast');
    });
    $('.filter-wrap').on('click', '.trigger', function(){
        $(this).parent().find('.options').toggleClass('opened');
    });
    $('.filters-btn').on('click', function(){
        $(this).toggleClass('active');
        $('.shop-filters-area').slideToggle('slow/300/fast')
    });
    var quickView = '.quick-view-excerpts';
    $(quickView).on('click', 'h5', function(){
        $(quickView).toggleClass('view-up');
        $('.quick-view-info').slideToggle('slow/300/fast');
    });

    // **********************************************************************//
    // ! Quantity product
    // **********************************************************************//
    var quantity = '.quantity';

    $(quantity).on('click', '.minus', function(){
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val(),10) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $(quantity).on('click', '.plus', function(){
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val(),10) + 1);
        $input.change();
        return false;
    });

    // **********************************************************************//
    // ! Thumbnails carousel
    // **********************************************************************//
    var conf = {
        center: true,
        backgroundControl: false
    };

    var cache = {
        $carouselContainer: $('.thumbnails-carousel').parent(),
        $thumbnailsLi: $('.thumbnails-carousel li'),
        $controls: $('.thumbnails-carousel').parent().find('.carousel-control')
    };

    function init() {
        cache.$carouselContainer.find('ol.carousel-indicators').addClass('indicators-fix');
        cache.$thumbnailsLi.first().addClass('active-thumbnail');

        if(!conf.backgroundControl) {
          cache.$carouselContainer.find('.carousel-control').addClass('controls-background-reset');
        }
        else {
          cache.$controls.height(cache.$carouselContainer.find('.carousel-inner').height());
        }

        if(conf.center) {
          cache.$thumbnailsLi.wrapAll("<div class='center clearfix'></div>");
        }
    }

    function refreshOpacities(domEl) {
        cache.$thumbnailsLi.removeClass('active-thumbnail');
        cache.$thumbnailsLi.eq($(domEl).index()).addClass('active-thumbnail');
    } 

    function bindUiActions() {
        cache.$carouselContainer.on('slide.bs.carousel', function(e) {
            refreshOpacities(e.relatedTarget);
    });

        cache.$thumbnailsLi.on('click', function(){
            cache.$carouselContainer.carousel($(this).index());
        });
    }

    $.fn.thumbnailsCarousel = function(options) {
        conf = $.extend(conf, options);

        init();
        bindUiActions();

        return this;
    }

    $('.thumbnails-carousel').thumbnailsCarousel();

    $('#content').infinitescroll({
        navSelector     : "#next:last",
        nextSelector    : "a#next:last",
        itemSelector    : "#content",
        debug           : true,
        dataType        : 'html',
        maxPage         : 3,
        path: function(index) {
            return "load-infinite" + index + ".html";
        }
    }, function(newElements, data, url){

        
    });

    // **********************************************************************//
    // ! One Page
    // **********************************************************************//

    var lastId,
        topMenu = $("#top-menu, #top-menu-fixed"),
        topMenuHeight = topMenu.outerHeight()+65,
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
          var item = $($(this).attr("href"));
          if (item.length) { return item; }
        });

    menuItems.on('click', function(e){
        var href = $(this).attr("href"),
            offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
        $('html, body').stop().animate({ 
            scrollTop: offsetTop
        }, 300);
        e.preventDefault();
    });

    my_window.scroll(function(){
       var fromTop = $(this).scrollTop()+topMenuHeight;
       
       var cur = scrollItems.map(function(){
         if ($(this).offset().top < fromTop)
           return this;
       });
       cur = cur[cur.length-1];
       var id = cur && cur.length ? cur[0].id : "";
       
       if (lastId !== id) {
           lastId = id;
           menuItems
             .parent().removeClass("active")
             .end().filter("[href='#"+id+"']").parent().addClass("active");
       }                   
    });
    // **********************************************************************//
    // ! Look Book
    // **********************************************************************//
    var slidesCount = $('.et-product-info-slide').length;

    var infoSwiper = new Swiper('.et-products-info-slider', {
        paginationClickable: true,
        direction: 'vertical',
        slidesPerView: 1,
        initialSlide: slidesCount,
        simulateTouch: false,
        noSwiping: true,
        loop: true,
        onInit: function(swiper) {
            updateNavigation();
        }
    });

    var imagesSwiper = new Swiper('.et-products-images-slider', {
        paginationClickable: true,
        direction: 'vertical',
        slidesPerView: 1,
        loop: true,
        simulateTouch: false,
        noSwiping: true,
        prevButton: '.et-products-navigation .et-swiper-prev',
        nextButton: '.et-products-navigation .et-swiper-next',
        onSlideNextStart: function(swiper) {
            infoSwiper.slidePrev();
            updateNavigation();
        },
        onSlidePrevStart: function(swiper) {
            infoSwiper.slideNext();
            updateNavigation();
        }
    });

    function updateNavigation() {
        var $nextBtn = $('.et-products-navigation .et-swiper-next'),
            $prevBtn = $('.et-products-navigation .et-swiper-prev'),
            currentIndex = $('.et-product-info-slide.swiper-slide-active').data('swiper-slide-index'),
            prevIndex = ( currentIndex >= slidesCount - 1 ) ? 0 : currentIndex + 1,
            nextIndex = ( currentIndex <= 0 ) ? slidesCount - 1 : currentIndex - 1,
            $nextProduct = $('.et-product-info-slide[data-swiper-slide-index="' + nextIndex + '"]'),
            nextTitle = $nextProduct.find('.product-title a').first().text(),
            nextPrice = $nextProduct.find('.price').html(),
            $prevProduct = $('.et-product-info-slide[data-swiper-slide-index="' + prevIndex + '"]'),
            prevTitle = $prevProduct.find('.product-title a').first().text(),
            prevPrice = $prevProduct.find('.price').html();

        $nextBtn.find('.swiper-nav-title').text(nextTitle);
        $nextBtn.find('.swiper-nav-price').html(nextPrice);

        $prevBtn.find('.swiper-nav-title').text(prevTitle);
        $prevBtn.find('.swiper-nav-price').html(prevPrice);
    }

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 3,
        breakpoints: {
            320: {
              slidesPerView: 1,
            },
            480: {
              slidesPerView: 1,
            },
            992: {
              slidesPerView: 1,
            }
        },
        paginationClickable: true,
        spaceBetween: 0,
        pagination: false,
        loop: true
    });
    // **********************************************************************//
    // ! CountDownTimer
    // **********************************************************************//
    $("#CountDownTimer").TimeCircles({
        time: {
            Days: { color: "#d64444" },
            Hours: { color: "#d64444" },
            Minutes: { color: "#d64444" },
            Seconds: { color: "#d64444" }
        },
        circle_bg_color: "rgba(255, 255, 255, 0)",
        bg_width: 0.4,
        fg_width: 0.05,
    });
    $("#CountDownTimerWhite").TimeCircles({
        time: {
            Days: { color: "#fff" },
            Hours: { color: "#fff" },
            Minutes: { color: "#fff" },
            Seconds: { color: "#fff" }
        },
        circle_bg_color: "rgba(255, 255, 255, 0.2)",
        bg_width: 0.3,
        fg_width: 0.03,
    });


    // **********************************************************************//
    // ! slider-range
    // **********************************************************************//
    var sliderRange = '#slider-range';
    $( sliderRange ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( sliderRange ).slider( "values", 0 ) + " - $" + $( sliderRange ).slider( "values", 1 ) );

})