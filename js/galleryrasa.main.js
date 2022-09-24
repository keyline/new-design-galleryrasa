$(function () {
    "use strict";
    //paste this code under head tag or in a seperate js file.
    // Wait for window load
    $(window).on('load', function () {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });

    var contactForm = $('.contact');
    // Define your library strictly...
    $('button[data-target="#galleryRasaNavbar"]').click(function () {
        var btnclass = $(this).attr("aria-expanded");
        if (btnclass == "false") {
            var target = $(this).attr("data-target");
            var img_height = $(".brand-auth + img").height();
            console.log(target);
            console.log(img_height);
            $('html,body').animate({
                scrollTop: $("#galleryRasaNavbar").offset().top + img_height
            }, 1000);
        }
    });

    $(".home .more-btn").on('click', function () {
        $(this).parent().children(".moreSection").toggleClass("height");
        $(this).html($('.home .more-btn').text() == '- Read less' ? '+ Read more' : '- Read less');
    });

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    //$('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "contact.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                        grecaptcha.reset();
                    }
                }
            });
            return false;
        }
    });

    $('.parent-container').magnificPopup({
        type: 'image',
        delegate: 'a.thumbnail',
        gallery: {
            enabled: true
        }
    });
    $('.program-name').select2({
        width: '100%',
        // placeholder: 'Search by Cast/Director/Film',
        ajax: {
            url: 'ajx_response.php',
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params) {
                return {
                    action: "homeSearch",
                    category: $('input[type="hidden"][name="catg"]').val(),
                    term: params.term, // search term
                    attributes: $('input[type="hidden"][name^="att"]').serializeArray()

                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            formatResult: formatState,
            cache: true
        },
        minimumInputLength: 2
    });

    $('.program-name2').select2({
        width: '100%',
        // placeholder: 'Search by Cast/Director/Film',
        ajax: {
            url: 'ajx_response.php',
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params) {
                return {
                    action: "allSearch",
                    category: $('input[type="hidden"][name="catg"]').val(),
                    term: params.term, // search term
                    attributes: $('input[type="hidden"][name^="att"]').serializeArray()

                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                console.log(data);
                return {
                    results: data
                };
            },
            formatResult: formatState,
            cache: true
        },
        minimumInputLength: 2
    });
    $('.desc-tag').select2({
        width: '100%',
        // placeholder: 'Search by Cast/Director/Film',
        ajax: {
            url: 'ajx_response.php',
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params) {
                return {
                    action: "allDescriptivetag",
                    category: $('input[type="hidden"][name="catg"]').val(),
                    term: params.term, // search term
                    attributes: $('input[type="hidden"][name^="att"]').serializeArray()

                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                console.log(data);
                return {
                    results: data
                };
            },
            formatResult: formatState,
            cache: true
        },
        minimumInputLength: 2
    });

    $('#subcatagory').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Classification - All",
        onUncheckAll: function () {
            $('span.placeholder').html('Classification');
        },
    });



    $('#classification1').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Classification - All",
        onUncheckAll: function () {
            $('span.placeholder').html('Classification');
        },
    });
    $('#classification2').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Classification - All",
        onUncheckAll: function () {
            $('span.placeholder').html('Classification');
        },
    });
    $('#classification3').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Classification - All",
        onUncheckAll: function () {
            $('span.placeholder').html('Classification');
        },
    });
    $('#classification4').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Classification - All",
        onUncheckAll: function () {
            $('span.placeholder').html('Classification');
        },
    });


    $('#publicationyear').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Publicationyear - All",
        onUncheckAll: function () {
            $('span.placeholder').html('publicationyear');
        },
    });

    $('#artworkyear').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Artworkyear - All",
        onUncheckAll: function () {
            $('span.placeholder').html('artworkyear');
        },
    });

    $('#medium').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Medium - All",
        onUncheckAll: function () {
            $('span.placeholder').html('medium');
        },
    });


    $('#adv-search-extract').multipleSelect({
        width: '100%',
        selectAllText: 'All',
        allSelected: "Classification - All",
        onUncheckAll: function () {
            $('span.placeholder').html('Classification');
        },

    });
    $('#subcatagory').multipleSelect('checkAll');

    // $(".filter-group").accordion({ heightStyle: "content" });

    var checkedVals = $('.check:checkbox:checked').map(function () {
        return this.value;
    }).get();

    CheckButtonEnable(checkedVals);

    //Add to cart functionlity
    var arr = $(".imgOptions option:selected").map(function () {
        var obj = {};
        obj['value'] = this.value;
        obj['parent'] = $(this).closest("div").prop("class");

        return obj;

    }).get();
    add2cartHTML(arr);

    $('.imgOptions').change(function () {
        var unselectedValues = $(this).find('option:selected').map(function () {
            var obj = {};
            obj['value'] = this.value;
            obj['parent'] = $(this).closest("div").prop("class");

            return obj;
        }).get();
        console.log(unselectedValues);
        add2cartHTML(unselectedValues);
    });

    //Bibliography left panel Checkbox Check All functionality
    /**
     * for Language Attribute
     * @param {type} headerId
     * @returns {undefined}
     */
    $('.language-All').on('change', function () {
        $('.language').prop('checked', $(this).prop("checked"));
    });

    $('.language').change(function () { //".checkbox" change 
        if ($('.language:checked').length == $('.language').length) {
            $('.language-All').prop('checked', true);
        } else {
            $('.language-All').prop('checked', false);
        }
    });

    /**
     * For Reference-type Attribute
     * @param {type} data
     * @returns {unresolved}
     */

    $('.reference_type-All').on('change', function () {
        $('.reference_type').prop('checked', $(this).prop("checked"));
    });

    $('.reference_type').change(function () { //".checkbox" change 
        if ($('.reference_type:checked').length == $('.reference_type').length) {
            $('.reference_type-All').prop('checked', true);
        } else {
            $('.reference_type-All').prop('checked', false);
        }
    });
    $('input.year').on('change', function () {
        $('input.year').not(this).prop('checked', false);
    });

    //searching left filter

    listFilter($("#year-header"), $("#year"), 'Year');
    listFilter($("#film-header"), $("#film"), 'Film');
    listFilter($("#cast-header"), $("#cast"), 'Cast');
    listFilter($("#director-header"), $("#director"), 'Director');
    listFilter($("#music-header"), $("#music"), 'Music Director');
    listFilter($("#playback-header"), $("#playback"), 'Playback Singer');

    //searching left filter BIBLIOGRAPHY
    if ($('#artist-header').length !== 0) {
        listFilter($("#artist-header"), $("#artist"), 'Artist');
    }
    if ($('#author-header').length !== 0) {
        listFilter($("#author-header"), $("#author"), 'Author');
    }
    if ($('#editor-header').length !== 0) {
        listFilter($("#editor-header"), $("#editor"), 'editor');
    }
    if ($('#place_of_publication-header').length !== 0) {
        listFilter($("#place_of_publication-header"), $("#place_of_publication"), 'Place of publication');
    }
    if ($('#publisher-header').length !== 0) {
        listFilter($("#publisher-header"), $("#publisher"), 'Publisher');
    }
    if ($('#gregorian_year-header').length !== 0) {
        listFilter($("#gregorian_year-header"), $("#gregorian_year"), 'year');
    }

    //Submit check memorabilia form
    $("form[id='adv-search-mem']").submit(function () {
        // Get the Login Name value and trim it
        var name = $.trim($("input[name='author']").val());
        var selectedCountry = $("#select-attributes").find("option:selected").prop("value");

        // Check if empty of not
        if (name != '' && selectedCountry == '-1') {
            alert('Please select a role.');
            //                            $("input[type=submit]").attr("disabled", "disabled");
            return false;
        }
        //                    $("input[type=submit]").removeAttr("disabled");
    });

    //Submit check bibliography
    $("form[id='adv-search-bibliography']").submit(function () {
        //e.preventDefault();
        // Get the Login Name value and trim it
        var name = $.trim($("input[name='author']").val());
        var selectedCountry = $("#select-attributes-biblio").find("option:selected").prop("value");
        //console.log(name + "|" + selectedCountry);
        // Check if empty of not
        if (name != '' && selectedCountry == '-1') {
            alert('Please select a role.');
            //                            $("input[type=submit]").attr("disabled", "disabled");
            return false;
        }
        //                    $("input[type=submit]").removeAttr("disabled");
    });
    contactForm.on("submit", function (e) {
        //Prevent the default behavior of a form
        e.preventDefault();
        //Get the values from the form
        var name = $("#contactName").val();
        var email = $("#contactEmail").val();
        var message = $("#contactMessage").val();

        //Our AJAX POST
        $.ajax({
            type: "POST",
            url: "/ajx_response",
            data: {
                name: name,
                email: email,
                message: message,
                action: "send_msg_contact",
                //THIS WILL TELL THE FORM IF THE USER IS CAPTCHA VERIFIED.
                captcha: grecaptcha.getResponse()
            },
            dataType: "json",
            async: true,
            cache: false,
            success: function (data) {
                console.log("THE FORM SUBMITTED CORRECTLY");
                if (data.status) {
                    $("#contact_form_results").addClass(data.class);
                    $("#contact_form_results").html(data.msg);
                    setTimeout(function () {
                        $('.contact').find('form')[0].reset();
                    }, 3000);
                    grecaptcha.reset()
                } else {
                    $("#contact_form_results").addClass(data.class);
                    $("#contact_form_results").html(data.msg);
                }

            },
            error: function () {
                console.log("AN ERROR OCCURED SUBMITTING THE FORM");
                $("#contact_form_results").html("An error occured. Please contact admin and…err, this is awkward.")
            }
        });

    });

    //Owl Carousel
    $(".owl-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        nav: true,
        dots: false,
        autoplaySpeed: 3000,
        fluidSpeed: true,
        smartSpeed: 3000,
        autoplayHoverPause: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 7,
                loop: true,
                margin: 20
            }
        }

    });

    const elem = document.getElementById('panzoom-element');
    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const resetButton = document.getElementById('reset');

    const rangeInput = document.getElementById('myRange_test1');

    const panzoom = Panzoom(elem, {
        maxScale: 4
    });

    const parent = elem.parentElement
    // No function bind needed
    // parent.addEventListener('wheel', panzoom.zoomWithWheel);
    zoomInButton.addEventListener('click', panzoom.zoomIn)
    zoomOutButton.addEventListener('click', panzoom.zoomOut)
    resetButton.addEventListener('click', panzoom.reset)

    rangeInput.addEventListener('input', function (event) {
        panzoom.zoom(event.target.valueAsNumber);
    });

    var rang_value = document.getElementById("range_value");

    rang_value.innerHTML = (rangeInput.value * 100) + "%";

    rangeInput.oninput = function () {
        rang_value.innerHTML = Math.trunc(this.value * 100) + "%";
    }

    $("#zoom_05").ezPlus({
        zoomType: "inner",
        debug: true,
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500
    });

    $("#popup").click(function () {
        $(document).find(".lg-outer").addClass("test");
    });

    $("#myRange_test1, #zoom-in, #zoom-out").on("click", function () {
        $(this).parents("div").find(".light-box-gallery-wrapper .thumb-img-wrapper .ZoomContainer").hid();
    });

    $("#reset").on("click", function () {
        $(this).parents("div").find(".light-box-gallery-wrapper .thumb-img-wrapper .ZoomContainer").show();
    });

    $("#popup").on("click", function () {
        var get_img = $(".thumb-img-wrapper img").attr("data-zoom-image");

        $('#lightgallery_test1').lightGallery({
            dynamic: true,
            dynamicEl: [{
                "src": get_img
            }]
        });
        $(document).find(".lg-image").ezPlus({
            zoomType: "inner",
            debug: true,
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500
        });

    });

    var url = window.location;

    // Will only work if string in href matches with location

    $('ul.customer_menu a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs

    $('ul.customer_menu a').filter(function () {

        return this.href == url;

    }).parent().addClass('active');

    $("#select-all-attr").on('select2:select', function () {
        debugger;
        var val = $(this).val();
        var strval = val.toString();
        var last = strval.split(':');
        console.log("Test", last);
        var serachtype = last[2];

        if (serachtype == 'Bibliography') {
            $('#search_form_all').attr('action', 'search');
        } else if (serachtype == 'Memorabilia') {
            $('#search_form_all').attr('action', 'memorabilia');
        } else if (serachtype == 'Visual Archive') {
            $('#search_form_all').attr('action', 'visualarchive-result');
        }

        document.forms['search_form'].submit();

        //alert(last);
        //var result = $("#select-all-attr").val().split('|');
        //alert(result[2]);
    });

    $('#artistform2').on('change', function (e) {


        var selval = $('#artistform2').val();
        var classval = $('#classification2').val();


        var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
        $.ajax({
            type: "POST",
            url: "artistajax.php",
            data: dataString,
            success: function (data) {


                //console.log(data);
                //$("#publicationyear").append(data).trigger('change');

                $('#publicationyeardiv').html(data);
                //$('#publicationyear').select2().trigger('change');

                var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
                $.ajax({
                    type: "POST",
                    url: "artistajax2.php",
                    data: dataString,
                    success: function (data2) {
                        console.log(data2);
                        $("#fromtopub1").html(data2);
                        $("#fromtopub2").html(data2);
                    }


                });
            }
        });

    });

    $('#classification2').on('change', function (e) {


        var selval = $('#artistform2').val();
        var classval = $('#classification2').val();


        var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
        $.ajax({
            type: "POST",
            url: "artistajax.php",
            data: dataString,
            success: function (data) {
                console.log(data);
                $('#publicationyeardiv').html(data);

                var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
                $.ajax({
                    type: "POST",
                    url: "artistajax2.php",
                    data: dataString,
                    success: function (data2) {
                        console.log(data2);
                        $("#fromtopub1").html(data2);
                        $("#fromtopub2").html(data2);
                    }


                });

            }
        });

    });

    $('#artistform3').on('change', function (e) {


        var selval = $('#artistform3').val();
        var classval = $('#classification3').val();


        var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
        $.ajax({
            type: "POST",
            url: "artistajax3.php",
            data: dataString,
            success: function (data) {


                console.log(data);
                //$("#publicationyear").append(data).trigger('change');

                $('#artworkyeardiv').html(data);
                //$('#publicationyear').select2().trigger('change');

                var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
                $.ajax({
                    type: "POST",
                    url: "artistajax4.php",
                    data: dataString,
                    success: function (data2) {
                        console.log(data2);
                        $("#fromtoart1").html(data2);
                        $("#fromtoart2").html(data2);
                    }


                });
            }
        });

    });

    $('#classification3').on('change', function (e) {


        var selval = $('#artistform3').val();
        var classval = $('#classification3').val();


        var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
        $.ajax({
            type: "POST",
            url: "artistajax3.php",
            data: dataString,
            success: function (data) {
                console.log(data);
                $('#artworkyeardiv').html(data);

                var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
                $.ajax({
                    type: "POST",
                    url: "artistajax4.php",
                    data: dataString,
                    success: function (data2) {
                        console.log(data2);
                        $("#fromtoart1").html(data2);
                        $("#fromtoart2").html(data2);
                    }
                });

            }
        });

    });

    $('#artistform4').on('change', function (e) {


        var selval = $('#artistform4').val();
        var classval = $('#classification4').val();


        var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
        $.ajax({
            type: "POST",
            url: "artistajax5.php",
            data: dataString,
            success: function (data) {
                console.log(data);

                $('#mediumdiv').html(data);

            }
        });

    });

    $('#classification4').on('change', function (e) {


        var selval = $('#artistform4').val();
        var classval = $('#classification4').val();


        var dataString = "artistvalue=" + selval + "&classificationval=" + classval;
        $.ajax({
            type: "POST",
            url: "artistajax5.php",
            data: dataString,
            success: function (data) {
                console.log(data);
                $('#mediumdiv').html(data);

            }
        });

    });

    $(".rasacolBtn").click(function () {
        $(this).parent().children(".rasaCollap").toggleClass("rasainfo");
    });
    $(".rasatestiBtn").click(function () {
        $(this).parent().children(".rasatesCollap").toggleClass("rasaTestdetail");
    });
});

function onClick(e) {
    e.preventDefault();
    grecaptcha.ready(function () {
        grecaptcha.execute('6LcI58AZAAAAAFM0UR6P4zj9PChh5UJmVKHNONIY', {
            action: 'submit'
        }).then(function (token) {
            // Add your logic to submit to your backend server here.
            document.getElementById("contact-form").submit();
        });
    });
}
function CheckButtonEnable(myVal) {
    if (jQuery.isEmptyObject(myVal) == 'false') {
        $('.search-filters-title').find('#btnReset').prop('disabled', false);
    }
    $('.search-filters-title').find('#btnReset').prop('disabled', true);

}

function listFilter(header, list, placeholder) {
    jQuery.expr[':'].Contains = function (a, i, m) {
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };
    //$("<form></form").attr({ "class": "filterform", "action": "#" })
    var form = $("<form></form").attr({ "class": "filterform", "action": "#" }),
        wrapDiv = $("<div></div>").attr({ "class": "form-group" }),
        input = $("<input>").attr({ "class": "form-control", "type": "text", 'placeholder': 'Search in ' + placeholder });
    $(wrapDiv).append(form).append(input).appendTo(header);

    $(input)
        .change(function () {
            var filter = $(this).val().toLowerCase();
            if (filter) {
                //$(list).find("label:not(:Contains(" + filter + "))").parent().slideUp();
                //$(list).find("label:Contains(" + filter + ")").parent().slideDown();
                $(list).find('.subList').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1)
                });
            } else {
                $(list).find("li").slideDown();
            }
            return false;
        })
        .keyup(function () {
            $(this).change();
        });
}

function formatState(data) {
    $.map(data.children, function (child) {
        var ob = child.text + child.html;
    });
    return ob;
}

function CiteThis(headerId) {
    // alert();
    // alert(headerId);
    $.ajax({
        type: "POST",
        url: "/ajx_response",
        data: { headerId: headerId, action: 'CiteThis' },
        //contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        cache: false,
        success: function (msg) {
            console.log(msg);
            if (msg.Status == "success") {
                $("#divCitethis").html(msg.Response);
            } else {
                $("#divCitethis").text("Something went wrong! Please try again!");
                return false;
            }
        }
    });
}

function PreviewPdf(Id) {
    var iFrame = $("#myFrame");
    $.ajax({
        type: "POST",
        url: "/ajx_response.php",
        data: { headerId: Id, action: 'PreviewPdf' },
        //contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        cache: false,
        success: function (data) {

            if (data.imageURL) {
                iFrame.show();
                iFrame.attr("src", data.imageURL);
            } else {
                iFrame.show();
                iFrame.contents().find("html").html(data.errormsg);
                return false;
            }
        }
    });

}

function addtoCart(product_id, reference_id) {
    var product = product_id;
    var image = reference_id;
    var url = "<?php echo SITE_URL; ?>";
    $.post(url + '/ajx_response', { product: product, image: image, action: "Cart" })
        .done(function (data) {
            console.log(data)
        });
}

//For bibliography form submit to cart
function Add_To_Cart() {

    $(".cart-add-form").submit();
}


function add2cartHTML(input) {

    $.each(input, function (i, value) {
        for (var key in value) {


            if (key == 'value') {

                var res = value[key].split("$");

            }
            if (key == 'parent') {

                $("." + value[key]).find('input[name=price]').val(res[1]);
                $("." + value[key]).find('input[name=type]').val(res[0]);
                $("." + value[key]).find('input[name=size]').val(res[0]);
            }
        }
    });
}	