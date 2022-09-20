
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <h4>subscribe to our newsletter</h4>
                    <div class="footer-subscribe-form-wrapper">



                        <?php
//                        $msg = (isset($_SESSION['mailchimpStatus'])) ? $_SESSION['mailchimpMsg'] : '';
//
//
//                        $view_mailchimp = file_get_contents(APPS_BASE_PATH . VIEWS_FOLDER . 'mailchimp.inc.php');
//                        $search = array('{response-msg}');
//                        $replace = array($msg);
//                        echo $mailchimp = str_replace($search, $replace, $view_mailchimp);
//                        unset($_SESSION['mailchimpStatus']);
                        ?>

                        <?php
                        if (isset($_SESSION['newsletter'])) {
                            ?>
                            <p>
                                <?php echo $_SESSION['newsletter']; ?> 
                            </p>
                            <?php
                            unset($_SESSION['newsletter']);
                        }
                        ?>

                        <form id="contact-form" method="post" action="contact_newsletter.php" role="form">
                            <div class="form-group">
                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="full name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="fullemail" class="form-control" id="fullemail" aria-describedby="emailHelp" placeholder="email">
                            </div>
                            <div class="form-group">
                                <!--<div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>-->

                                <!--<div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK"></div>-->
                                <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div>

                                <button type="submit" class="btn btn-primary form-control" data-recaptcha="true" required data-error="Please complete the Captcha">Submit</button>
                                <div class="help-block with-errors"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 mt-4 mt-md-0">
                    <div class="row align-items-end">
                        <div class="col-lg-9">
                            <h4 class="mc-l">important links</h4> 
                            <div class="footer-nav">
                                <ul class="m-0 p-0">
                                    <li><a href="<?php echo SITE_URL ?>">home</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/terms-conditions">terms & conditions</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/privacy-policy">privacy policy</a></li>
<!--                                    <li><a href="<?php echo SITE_URL ?>/page/refund-return-policies">return & refund policy</a></li>-->
                                    <li><a href="<?php echo SITE_URL ?>/page/how-to-buy">how to buy</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/faq">FAQ</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/about-us">about us</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/vision-statement">vision statement</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/testimonials">testimonials</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/acknowledgements">acknowledgements</a></li>
                                    <li><a href="<?php echo SITE_URL ?>contactus.php">contact us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="social-info">
                                <ul>
                                    <!--
                                                                        <li>
                                                                            <a href="#!">
                                                                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                                                            </a>
                                                                        </li>
                                    -->
                                    <li>
                                        <a href="https://twitter.com/galleryrasaart" target="_blank">
                                            <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/galleryrasa" target="_blank">
                                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/galleryrasa_official/" target="_blank">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row justify-content-center text-center flex-nowrap">
                <span>&copy; <?php echo date("Y") ?> Gallery Rasa. All Rights Reserved. Powered by keyline Creative Services</span>

            </div>
        </div>
    </div>
</footer>
<section class="after-footer"></section>


<?php
//$uri = $_SERVER['REQUEST_URI'];
//if (strpos($uri, 'visualarchive-details/') == false) {
?>
<!--    <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-1.11.3.min.js">
    </script>-->
<?php
//} else {
?>
<!--    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    -->
<?php
//}
?>



<!--  Bootstrap JS  -->


<!--<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-1.11.3.min.js"></script>-->



<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js"></script>






<!--<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js">
</script>-->

<!-- <script src="<?php echo SITE_URL . JS_FOLDER ?>cart.js">
</script> -->
<!--<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js">
</script>-->
<!-- <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>holder.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.jscroll.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>forms.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.plugin.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.countdown.min.js">
</script> -->






<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/slideout-min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/greensock.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/layerslider.transitions.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/layerslider.kreaturamedia.jquery.js"></script>

<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.infinitescroll.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.filterizr-min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/TimeCircles-min.js"></script> -->






<!--<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery-ui-min.js"></script>-->





<?php
$uri = $_SERVER['REQUEST_URI'];
//echo $uri; // Outputs: URI
if (strpos($uri, 'visualarchive-details/') == false) {
    ?>
    <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/main.js"></script>
    <?php
}
?>
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/select2.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/multiple-select.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/magnific-popup/jquery.magnific-popup.min.js"></script> -->


<script>
    $(document).ready(function () {
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
        $(".more-btn").click(function () {
            $(this).parent().next(".moreSection").slideDown("slow");
            $(this).hide();
        })
        var more_section = $(".moreSection")
        for (var i = 0; i < more_section.length; i++) {
            more_section.hide();
            more_section.first().show();
        }
    })
</script>


<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    //        function onSubmit(token) {
    //         document.getElementById("contact-form").submit();
    //       }
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
</script>
<script>
    $(function () {

        window.verifyRecaptchaCallback = function (response) {
            $('input[data-recaptcha]').val(response).trigger('change')
        }

        window.expiredRecaptchaCallback = function () {
            $('input[data-recaptcha]').val("").trigger('change')
        }

        $('#contact-form').validator();

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
        })
    });
</script>


<script type="text/javascript">
    (function ($) {
        var contactForm = $('.contact');

        $('.parent-container').magnificPopup({
            type: 'image',
            delegate: 'a.thumbnail',
            gallery: {
                enabled: true
            }
        });
        $('.swipebox').swipebox();
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
        $('#subcatagory').multipleSelect({
            width: '100%',
            selectAllText: 'All',
            allSelected: "Classification - All",
            onUncheckAll: function () {
                $('span.placeholder').html('Classification');
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

        $(".filter-group").accordion({heightStyle: "content"});

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
        console.log(arr);
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
            autoplaySpeed: 3000,
            fluidSpeed: true,
            smartSpeed: 3000,
            autoplayHoverPause: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 7,
                    nav: false,
                    loop: true,
                    margin: 20
                }
            }

        });

    })(jQuery);

    function listFilter(header, list, placeholder) {
        jQuery.expr[':'].Contains = function (a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };
        var form = $("<form></form").attr({"class": "filterform", "action": "#"}),
                input = $("<input>").attr({"class": "filterinput", "type": "text", 'placeholder': 'Search in ' + placeholder});
        $(form).append(input).appendTo(header);

        $(input)
                .change(function () {
                    var filter = $(this).val();
                    if (filter) {
                        $(list).find("label:not(:Contains(" + filter + "))").parent().slideUp();
                        $(list).find("label:Contains(" + filter + ")").parent().slideDown();
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
        //alert(headerId);
        $.ajax({
            type: "POST",
            url: "/ajx_response",
            data: {headerId: headerId, action: 'CiteThis'},
            //contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            cache: false,
            success: function (msg) {
                console.log(msg);
                if (msg.Status == "success") {
                    $("#divCitethis").html(msg.Response);
                } else {
                    $("#divCitethis").text("Somwthing went wrong! Please try again!");
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
            data: {headerId: Id, action: 'PreviewPdf'},
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
        $.post(url + '/ajx_response', {product: product, image: image, action: "Cart"})
                .done(function (data) {
                    console.log(data)
                });
    }

    //For bibliography form submit to cart
    function Add_To_Cart() {

        $(".cart-add-form").submit();
    }

    function CheckButtonEnable(myVal) {
        if (jQuery.isEmptyObject(myVal) == 'false') {
            $('.search-filters-title').find('#btnReset').prop('disabled', false);
        }
        $('.search-filters-title').find('#btnReset').prop('disabled', true);

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




</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111631752-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-111631752-1');
</script>
<!--facebook like box-->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=194444497276148';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>



<!--<div class="text-center" style="color: #b1b1b1; margin: 15px;  font-size: 10px;">-->
<?php
$end_time = microtime(TRUE);

$time_taken = $end_time - $start_time;

$time_taken = round($time_taken, 5);

//echo 'Page generated in ' . $time_taken . ' seconds.';
?>


<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/panzoom.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/lightgallery-all.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/jquery.mousewheel.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/jquery.ez-plus.js"></script>

<script>

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
//            parent.addEventListener('wheel', panzoom.zoomWithWheel);
    zoomInButton.addEventListener('click', panzoom.zoomIn)
    zoomOutButton.addEventListener('click', panzoom.zoomOut)
    resetButton.addEventListener('click', panzoom.reset)

    rangeInput.addEventListener('input', (event) => {
        panzoom.zoom(event.target.valueAsNumber)
    })

//        var rang_value = document.getElementById("range_value");
//        rang_value.innerHTML = (rangeInput.value * 100) + "%";
//        rangeInput.oninput = function() {
//            rang_value.innerHTML = (this.value * 100) + "%";
//        }
//        var rang_value = document.getElementById("range_value");
//        rang_value.innerHTML = (rangeInput.value).replace(".", "") + "00%";
//        rangeInput.oninput = function() {
//            rang_value.innerHTML = (this.value).replace(".", "") + "0%";
//        }
    var rang_value = document.getElementById("range_value");
    rang_value.innerHTML = (rangeInput.value * 100) + "%";
    rangeInput.oninput = function () {
        rang_value.innerHTML = Math.trunc(this.value * 100) + "%";
    }

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#zoom_05").ezPlus({
            zoomType: "inner",
            debug: true,
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500
        });
    });
//        $("#popup").on("click", function(){
//            $(".lg-image").ezPlus({
//                zoomType: "inner",
//                debug: true,
//                cursor: "crosshair",
//                zoomWindowFadeIn: 500,
//                zoomWindowFadeOut: 500
//            });
//        })
    $("#popup").click(function () {
        $(document).find(".lg-outer").addClass("test");
    })
</script>
<script>
    $("#myRange_test1, #zoom-in, #zoom-out").on("click", function () {
        $(this).parents("div").find(".light-box-gallery-wrapper .thumb-img-wrapper .ZoomContainer").hide();
    })
    $("#reset").on("click", function () {
        $(this).parents("div").find(".light-box-gallery-wrapper .thumb-img-wrapper .ZoomContainer").show();
    })

    $("#popup").on("click", () => {
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

</script>
<script>
    class Pushbar {
    constructor(config = { overlay: true, blur: false }) {
        this.activeId;
        this.activeElement;
        this.overlayElement;
        if (config.overlay) {
            this.overlayElement = document.createElement('div');
            this.overlayElement.classList.add('pushbar_overlay');
            document.querySelector('body').appendChild(this.overlayElement);
        }
        if (config.blur) {
            const mainContent = document.querySelector('.pushbar_main_content');
            if (mainContent) {
                mainContent.classList.add('pushbar_blur');
            }
        }
        this.bindEvents();
    }

    emitOpening() {
        const event = new CustomEvent('pushbar_opening', { bubbles: true, detail: { element: this.activeElement, id: this.activeId } });
        this.activeElement.dispatchEvent(event);
    }

    emitClosing() {
        const event = new CustomEvent('pushbar_closing', { bubbles: true, detail: { element: this.activeElement, id: this.activeId } });
        this.activeElement.dispatchEvent(event);
    }

    handleOpenEvent(e) {
        e.preventDefault();
        const pushbarId = e.currentTarget.getAttribute('data-pushbar-target');
        this.open(pushbarId);
    }

    handleCloseEvent(e) {
        e.preventDefault();
        this.close();
    }

    handleKeyEvent(e) {
        if (e.keyCode === 27) this.close();
    }

    bindEvents() {
        const triggers = document.querySelectorAll('[data-pushbar-target]');
        const closers = document.querySelectorAll('[data-pushbar-close]');
        triggers.forEach(trigger => trigger.addEventListener('click', e => this.handleOpenEvent(e), false));
        closers.forEach(closer => closer.addEventListener('click', e => this.handleCloseEvent(e), false));
        if (this.overlayElement) {
            this.overlayElement.addEventListener('click', e => this.handleCloseEvent(e), false);
        }
        document.addEventListener('keyup', e => this.handleKeyEvent(e));
    }

    open(pushbarId) {
        if (this.activeId === String(pushbarId) || !pushbarId) return;
        if (this.activeId && this.activeId !== String(pushbarId)) this.close();
        this.activeId = pushbarId
        this.activeElement = document.querySelector(`[data-pushbar-id="${this.activeId}"]`)
        if (!this.activeElement) return;
        this.emitOpening();
        this.activeElement.classList.add('opened');
        const pageRootElement = document.querySelector('html')
        pageRootElement.classList.add('pushbar_locked');
        pageRootElement.setAttribute('pushbar', pushbarId)
    }

    close() {
        if (!this.activeId) return;
        this.emitClosing();
        this.activeElement.classList.remove('opened');
        const pageRootElement = document.querySelector('html')
        pageRootElement.classList.remove('pushbar_locked');
        pageRootElement.removeAttribute('pushbar')
        this.activeId = null;
        this.activeElement = null;
    }
}
</script>

<!--</div>-->


<!--
site key
6Ld45cAZAAAAAMXYdPBtPoVfJgEPtkcOzGHE7AC0

secret key
6Ld45cAZAAAAAIAxQ0l89J9KZ5BNi95zIWm4_i3I
-->

</body>

</html>

