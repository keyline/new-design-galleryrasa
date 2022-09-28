
//navigation-part start

//navigation

$('.sidebar-toggle').on('click', function(){
    $('.header .sidebar').addClass('active');
    $('.menu-overlay').addClass('active');
});
$('.close-btn').on('click', function(){
    $('.header .sidebar').removeClass('active');
    $('.menu-overlay').removeClass('active');
});
// $(".header .menu-overlay").click(function(){
//     $(".header .sidebar").removeClass("active");
//     $(this).removeClass('active');
//   });
// $('.menu-overlay-box').on('click', function(){
//     $('.header .sidebar').removeClass('active');
//     $('.menu-overlay').removeClass('active');
// });

//navigation-part end





//search

$('.search-btn').on('click', function(){
    $('.user-options .search-wrap').addClass('active');
    $('.header .search-overlay').addClass('active');
});

$('.header .search-overlay').on('click', function(){
   $('.user-options .search-wrap').removeClass('active');
    $(this).removeClass('active');
});

$('.user-options .close-btn').on('click', function(){
   $('.user-options .search-wrap').removeClass('active');
    $(this).removeClass('active');
    $('.header .search-overlay').removeClass('active');
    $(this).removeClass('active');

});


$(document).ready(function() {
    $("#cssmenu").menumaker({
        title: "",              // The text of the button which toggles the menu
        breakpoint: 991,		// The breakpoint for switching to the mobile view
        format: "multitoggle"       // It takes three values: dropdown for a simple toggle menu, select for select list menu, multitoggle for a menu where each submenu can be toggled separately
    });
 
  $("#home-slider").owlCarousel({
 
	  dots: false,
      nav: true,
	  loop: true,
	  autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
 
      slideSpeed : 300,
      paginationSpeed : 400,
 
      items : 1, 
      itemsDesktop : false,
      itemsDesktopSmall : false,
      itemsTablet: false,
      itemsMobile : false
 
  });
  $("#home-explore").owlCarousel({
        loop: true,
        margin: 30,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 2,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 5,
            }
        }
    });

    $("#home-affordable").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"]
    });

    $("#home-artistmeet-most").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            750: {
                items: 4,
            },
            1000: {
                items: 6,
            }
        }
    });
    $("#home-artistmeet-trend").owlCarousel({
        loop: true,
        margin: 30,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            750: {
                items: 4,
            },
            1000: {
                items: 6,
            }
        }
    });
    $("#home-artistmeet-mostvist").owlCarousel({
        loop: true,
        margin: 30,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            750: {
                items: 4,
            },
            1000: {
                items: 6,
            }
        }
    });
    $("#home-artistmeet-month").owlCarousel({
        loop: true,
        margin: 30,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            750: {
                items: 4,
            },
            1000: {
                items: 6,
            }
        }
    });
 
});

    $("#my-about").owlCarousel({
        loop: true,
        margin: 20,
		dots: true,
		nav: false,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
        
    });

    $("#my-about-mobile").owlCarousel({
        loop: true,
        margin: 20,
		dots: true,
		nav: false,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
        
    });

    $("#press").owlCarousel({
        loop: true,
        margin: 20,
		dots: true,
		nav: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
        
    });



        $("#visual-artist").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
//        navText: ["<i class='zmdi zmdi-arrow-left'></i>", "<i class='zmdi zmdi-arrow-right'></i>"],
        navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
           


        responsive: {
            0: {
                items: 1.5,
            },
            600: {
                items: 2.5,
            },
            750: {
                items: 3.5,
            },
            1000: {
                items: 5.5,
            }
        }
    });
        $("#bibliography").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
        responsive: {
            0: {
                items: 1.5,
            },
            600: {
                items: 2.5,
            },
            750: {
                items: 3.5,
            },
            1000: {
                items: 5.5,
            }
        }
    });
        $("#bengali-film").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
       navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
        responsive: {
            0: {
                items: 1.5,
            },
            600: {
                items: 2.5,
            },
            750: {
                items: 3.5,
            },
            1000: {
                items: 5.5,
            }
        }
    });

     $("#artwork").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
//        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ["<i class='zmdi zmdi-arrow-left'></i>PREV", "NEXT<i class='zmdi zmdi-arrow-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
     $("#bengali-film-box").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
       navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
     $("#bengali-film-box-2").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
       navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
     $("#testimonial").owlCarousel({
//        loop: false,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
       navText: ["<span class='material-icons'>chevron_left</span>", "<span class='material-icons'>navigate_next</span>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
     $("#exhibition-artwork").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
         navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
     $("#exhibition-artwork-2").owlCarousel({
        loop: true,
        margin: 20,
		dots: false,
		nav: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
         navText: ["<span class='material-icons'>arrow_back</span>", "<span class='material-icons'>arrow_forward</span>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            750: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });



$(document).ready(function(){
    // jquery.serialtabs initialisation
    $('.serialtabs-nav').serialtabs();
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 200) {
        $(".header").addClass("sticky-header");
    } else {
        $(".header").removeClass("sticky-header");
    }
});


// ============= Page right sticky form =================
$(function() {
	$("#feedback-tab").click(function() {
		$("#feedback-form").toggle("slide");
	});
    $("#feedback-form form").on('submit', function(event) {
		var $form = $(this);
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function() {
				$("#feedback-form").toggle("slide").find("textarea").val('');
			}
		});
		event.preventDefault();
	});
});

//======================= TAB ========================//

$(' .owl_1').owlCarousel({
    loop:false,
    margin:2,	
	responsiveClass:true,autoplayHoverPause:true,
	autoplay:true,
	 slideSpeed: 400,
      paginationSpeed: 400,
	 autoplayTimeout:3000,
    responsive:{
        0:{
            items:3,
            nav:true,
			  loop:false
        },
        600:{
            items:3,
            nav:true,
			  loop:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
})

$(document) .ready(function(){
var li =  $(".owl-item li ");
$(".owl-item li").click(function(){
li.removeClass('active');
});
});

//===================Artist=====================//
let tabs = document.querySelectorAll('.tab');
        let content = document.querySelectorAll('.content-item');
        for (let i = 0; i < tabs.length; i++) {            
            tabs[i].addEventListener('click', () => tabClick(i));
        }

        function tabClick(currentTab) {
            removeActive();
            tabs[currentTab].classList.add('active');
            content[currentTab].classList.add('active');
            console.log(currentTab);
        }

        function removeActive() {
            for (let i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
                content[i].classList.remove('active');
            }
        }

//===================Select=====================//
$('.hidden p').click(function(){
  $(this).closest('.select').find('.input').text($(this).text());
  $(this).closest('.select').find('input').val($(this).attr('value'));
  $(this).closest('.select').trigger("change");
});

//navigation-part active{
        $(document).ready(function() {

              var url = window.location;









              var str1 = url;

              var str2 = 'searchResult.php';

              //                    if(url.indexOf(str2)){

              //                       alert("found"); 

              //                    }





              // Will only work if string in href matches with location



              $('ul#nav a[href="' + url + '"]').parent().addClass('active');



              // Will also work for relative and absolute hrefs



              $('ul#nav a').filter(function() {



                  return this.href == url;



              }).parent().addClass('active');



          });


const toggleBtn = document.querySelector(".sidebar-toggle");

const sidebar = document.querySelector(".sidebar ");

const closeBtn = document.querySelector(".close-btn");

toggleBtn.addEventListener("click", function () {
  sidebar.classList.toggle("show-sidebar");
});

closeBtn.addEventListener("click", function () {
  sidebar.classList.remove("show-sidebar");
});

// VISUAL ARCHIVES SEARCH DETAILS //

		var zoom = 1;
		
		$('.zoom').on('click', function(){
			zoom += 0.1;
			$('.target').css('transform', 'scale(' + zoom + ')');
		});
		$('.zoom-init').on('click', function(){
			zoom = 1;
			$('.target').css('transform', 'scale(' + zoom + ')');
		});
		$('.zoom-out').on('click', function(){
			zoom -= 0.1;
			$('.target').css('transform', 'scale(' + zoom + ')');
		});


// EXHIBITION DETAILS //
let switchTabs = (tab) => {
	// get all tab list items and remove the is-active class
	let tabs = document.querySelectorAll(".tabs li");
	tabs.forEach(t => {t.classList.remove("is-active");});
	// set is-active on the passed tab element
	tab.classList.add("is-active");
	// get all content elements and remove is-active
	let contents = document.querySelectorAll("#tab-content .content");
	contents.forEach(t => {t.classList.remove("is-active");});
	// get the data-index data attribute from the selected tab (passed here)
	let activeTabIndex = tab.getAttribute("data-index");
	// get the corresonding tab content via the data-content attribute
	let activeContent = document.querySelector(`[data-content='${activeTabIndex}']`);
	// set is-active on the corresponding tab content
	activeContent.classList.add("is-active");
}

// CART //
function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});
    


//select form//
(function ( $ ) {
	var elActive = '';
    $.fn.selectCF = function( options ) {
 
        // option
        var settings = $.extend({
//            color: "#333", // color
//            backgroundColor: "#50C9AD", // background
			change: function( ){ }, // event change
        }, options );
 
        return this.each(function(){
			
			var selectParent = $(this);
				list = [],
				html = '';
				
			//parameter CSS
			var width = $(selectParent).width();
			
			$(selectParent).hide();
			if( $(selectParent).children('option').length == 0 ){ return; }
			$(selectParent).children('option').each(function(){
				if( $(this).is(':selected') ){ s = 1; title = $(this).text(); }else{ s = 0; }
				list.push({ 
					value: $(this).attr('value'),
					text: $(this).text(),
					selected: s,
				})
			})
			
			// style
			var style = " background: "+settings.backgroundColor+"; color: "+settings.color+" ";
			
			html += "<ul class='selectCF'>";
			html += 	"<li>";
//			html += 		"<span class='arrowCF ion-chevron-right' style='"+style+"'></span>";
			html += 		"<span class='titleCF' style='"+style+"; width:"+width+"px'>"+title+"</span>";
			html += 		"<span class='searchCF' style='"+style+"; width:"+width+"px'><input style='color:"+settings.color+"' /></span>";
			html += 		"<ul>";
			$.each(list, function(k, v){ s = (v.selected == 1)? "selected":"";
			html += 			"<li value="+v.value+" class='"+s+"'>"+v.text+"</li>";})		
			html += 		"</ul>";
			html += 	"</li>";
			html += "</ul>";
			$(selectParent).after(html);
			var customSelect = $(this).next('ul.selectCF'); // add Html
			var seachEl = $(this).next('ul.selectCF').children('li').children('.searchCF');
			var seachElOption = $(this).next('ul.selectCF').children('li').children('ul').children('li');
			var seachElInput = $(this).next('ul.selectCF').children('li').children('.searchCF').children('input');
			
			// handle active select
			$(customSelect).unbind('click').bind('click',function(e){
				e.stopPropagation();
				if($(this).hasClass('onCF')){ 
					elActive = ''; 
					$(this).removeClass('onCF');
					$(this).removeClass('searchActive'); $(seachElInput).val(''); 
					$(seachElOption).show();
				}else{
					if(elActive != ''){ 
						$(elActive).removeClass('onCF'); 
						$(elActive).removeClass('searchActive'); $(seachElInput).val('');
						$(seachElOption).show();
					}
					elActive = $(this);
					$(this).addClass('onCF');
					$(seachEl).children('input').focus();
				}
			})
			
			// handle choose option
			var optionSelect = $(customSelect).children('li').children('ul').children('li');
			$(optionSelect).bind('click', function(e){
				var value = $(this).attr('value');
				if( $(this).hasClass('selected') ){
					//
				}else{
					$(optionSelect).removeClass('selected');
					$(this).addClass('selected');
					$(customSelect).children('li').children('.titleCF').html($(this).html());
					$(selectParent).val(value);
					settings.change.call(selectParent); // call event change
				}
			})
				
			// handle search 
			$(seachEl).children('input').bind('keyup', function(e){
				var value = $(this).val();
				if( value ){
					$(customSelect).addClass('searchActive');
					$(seachElOption).each(function(){
						if( $(this).text().search(new RegExp(value, "i")) < 0 ) {
							// not item
							$(this).fadeOut();
						}else{
							// have item
							$(this).fadeIn();
						}
					})
				}else{
					$(customSelect).removeClass('searchActive');
					$(seachElOption).fadeIn();
				}
			})
			
		});
    };
	$(document).click(function(){
		if(elActive != ''){
			$(elActive).removeClass('onCF');
			$(elActive).removeClass('searchActive');
		}
	})
}( jQuery ));

$(function(){
  var event_change = $('#event-change');
  $( ".select" ).selectCF({
    change: function(){
      var value = $(this).val();
      var text = $(this).children('option:selected').html();
      console.log(value+' : '+text);
      event_change.html(value+' : '+text);
    }
  });
  $( ".test" ).selectCF({
    color: "#FFF",
    backgroundColor: "#663052",
  });
})



//modal//
// OPTIONAL JS

// Change the button text & add active class
$('.jRadioDropdown').change(function() {
  var dropdown = $(this).closest('.dropdown');
  var thislabel = $(this).closest('label');

  dropdown.find('label').removeClass('active');
  if( $(this).is(':checked') ) {
    thislabel.addClass('active');
    dropdown.find('p').html( thislabel.text() );
  }

});    
 
//Add tabindex on labels
$('label.dropdown-item').each(function (index, value){
  $(this).attr('tabindex', 0 );
  $(this).find('input').attr('tabindex', -1 );
});

//Add keyboard navigation
$('label.dropdown-item').keypress(function(e){
  if((e.keyCode ? e.keyCode : e.which) == 13){
    $(this).trigger('click');
  }
});



    //Initialize Swiper//
    
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });




//press//
var swiper = new Swiper(".mySwiper", {
    loop: true,
        pagination: {
          el: ".swiper-pagination",
          type: "fraction",
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      }); 
var swiper = new Swiper(".myNewSwiper", {
    loop: true,
        pagination: {
          el: ".swiper-pagination",
          type: "fraction",
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      }); 


    $(document).ready( function() {
    var swiperH = new Swiper('.swiper-container-h', {
        pagination: '.swiper-pagination-h',
        paginationClickable: true,
        spaceBetween: 50
    });
    var swiperV = new Swiper('.swiper-container-v', {
        pagination: '.swiper-pagination-v',
        paginationClickable: true,
        direction: 'horizontal',
        spaceBetween: 50,
        nested: true
    });
});


//get in touch//
var modal = document.querySelector(".modal");
var trigger = document.querySelector(".trigger");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

//trigger.addEventListener("click", toggleModal);
//closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

// select dropdown//

//    $('#example-multiple-selected').multiselect();

//jQuery code
// $( document ).on( "click", ".button-nav, .navigation-backdrop", function () {
  
//     var $nav = $( "#navigation-demo" );
//     var $hasClass = $nav.hasClass( "open" );

//     if ( !$hasClass ) {
//         $nav.addClass( "open" );
//         $( "body" ).append( "<div class='navigation-backdrop'></div>" );
//     } else {
//         $nav.removeClass( "open" );
//         $( ".navigation-backdrop" ).remove();
//     }

// });
