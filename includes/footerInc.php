
<!-- <footer> -->
    <!-- <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <h4>subscribe to our newsletter</h4>
                    <div class="footer-subscribe-form-wrapper"> -->



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

                        <!-- <form id="contact-form" method="post" action="contact_newsletter.php" role="form">
                            <div class="form-group">
                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="full name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="fullemail" class="form-control" id="fullemail" aria-describedby="emailHelp" placeholder="email">
                            </div>
                            <div class="form-group"> -->
                                <!--<div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>-->

                                <!--<div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK"></div>-->
                                <!-- <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div>

                                <button type="submit" class="btn btn-primary form-control" data-recaptcha="true" required data-error="Please complete the Captcha">Submit</button>
                                <div class="help-block with-errors"></div> -->
                            <!-- </div>
                        </form>
                    </div>
                </div> -->
                <!-- <div class="col-lg-8 col-md-7 mt-4 mt-md-0">
                    <div class="row align-items-end">
                        <div class="col-lg-9">
                            <h4 class="mc-l">important links</h4>
                            <div class="footer-nav">
                                <ul class="m-0 p-0"> -->

                                    <!-- <li><a href="<?php echo SITE_URL ?>">home</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/terms-conditions">terms & conditions</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/privacy-policy">privacy policy</a></li> -->
<!--                                    <li><a href="<?php echo SITE_URL ?>/page/refund-return-policies">return & refund policy</a></li>-->
<!--                                    <li><a href="<?php echo SITE_URL ?>/page/how-to-buy">how to buy</a></li>-->
                                    <!-- <li><a href="<?php echo SITE_URL ?>/page/faq">FAQ</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/about-us">about us</a></li>
                                    <li><a href="<?php echo SITE_URL ?>/page/vision-statement">vision statement</a></li>
                                    <li><a href="<?php echo SITE_URL ?>testimonials">testimonials</a></li> -->
<!--                                    <li><a href="<?php echo SITE_URL ?>/page/acknowledgements">acknowledgements</a></li>-->
                                    <!-- <li><a href="<?php echo SITE_URL ?>contactus.php">contact us</a></li> -->

                                <!-- </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="social-info">
                                <ul>

                                    <li>
                                        <a href="https://www.linkedin.com/in/rakesh-sahni-19369063/" target="_blank">
                                            <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                        </a>
                                    </li>

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
    </div> -->
    <!-- <div class="footer-bottom">
        <div class="container">
            <div class="row justify-content-center text-center flex-nowrap">
                <span>&copy; <?php // echo date("Y")?> Gallery Rasa. All Rights Reserved. Powered by Keyline Creative Services</span>

            </div>
        </div>
    </div>
</footer> -->
<!--    FOOTER STARTS-->
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="copy-part">
                    <div class="copy-link">
                        <ul class="mobile-footer">
                            <li><a href="<?php echo SITE_URL ?>about-us">About us</a></li>
                            <li><a href="<?php echo SITE_URL ?>vision-statement">VISION STATEMENT</a></li>
                            <li><a href="<?php echo SITE_URL ?>testimonials">TESTIMONIALS</a></li>
                            <li><a href="#">in the press</a></li>
                            <li><a href="#">photo book</a></li>
                            <li><a href="<?php echo SITE_URL ?>contactus">CONTACT US</a></li>
                        </ul>
                        <ul>
                            <li><a href="<?php echo SITE_URL ?>terms-conditions">TERMS & CONDITIONS</a></li>
                            <li><a href="<?php echo SITE_URL ?>faq">FAQ</a></li>
                            <li><a href="<?php echo SITE_URL ?>privacy-policy">PRIVACY POLICY</a></li>
                        </ul>
                    </div>
                    <div class="copy-right">
                        <div class="copy-social">
                            <ul>
                                <li><a href="https://www.facebook.com/galleryrasa" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL ?>images/facebook.png"></a></li>
                                <li><a href="https://www.instagram.com/galleryrasa_official" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL ?>images/insta.png"></a></li>
                                <li><a href="https://twitter.com/galleryrasaart" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL ?>images/twe.png"></a></li>
                                <li><a href="https://www.linkedin.com/in/rakesh-sahni-19369063" target="_blank"><img class="img-fluid" src="<?php echo SITE_URL ?>images/in.png"></a></li>
                            </ul>
                        </div>
                        <div class="copy-text">
                            <p>© <?php echo date("Y") ?> Gallery Rasa. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--    Sticky ENDS-->



<!--      BACK TO TOP ENDS-->

<!--<a href="#top" class="top scrolltop"><i class="zmdi zmdi-chevron-up"></i></a> -->

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <!--        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                <div class="midal-title"> get exclusive catalogue </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="zmdi zmdi-close-circle"></i> </button>
            </div>
            <div class="modal-body">
                <div class="modal-form">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name*">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Phone no*">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Message" rows="3"></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery-3.6.0.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL . JS_FOLDER ?>menumaker.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.serialtabs.js"></script>

<script defer type="text/javascript" src="<?php echo SITE_URL . JS_FOLDER ?>script.js"></script>
<script src="<?php echo SITE_URL . OWL_FOLDER ?>owl-min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.bs4-scrolling-tabs.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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



<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js"></script>






<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js">
</script>

<script src="<?php echo SITE_URL . JS_FOLDER ?>cart.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.swipebox.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate.js">
</script> -->
<script src="<?php echo SITE_URL . JS_FOLDER ?>holder.js">
</script>
<!-- <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.jscroll.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>forms.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.plugin.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.countdown.min.js">
</script> -->






<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/owl.carousel.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/slideout-min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/greensock.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/layerslider.transitions.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/layerslider.kreaturamedia.jquery.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.infinitescroll.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery.filterizr-min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/swiper.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/TimeCircles-min.js"></script> -->




<!-- for filtaration  -->

<!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/jquery-ui-min.js"></script> -->





<?php
                        $uri = $_SERVER['REQUEST_URI'];
                        //echo $uri; // Outputs: URI
                        if (strpos($uri, 'visualarchive-details/') == false) {
                            ?>
    <!-- <script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/main.js"></script> -->
    <?php
                        }
                        ?>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/select2.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/lib/multiple-select.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>/mainjs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

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



<!--<div class="text-center" style="    color: #b1b1b1; margin: 15px;  font-size: 10px;">-->
<?php
                        $end_time = microtime(true);

                        $time_taken = $end_time - $start_time;

                        $time_taken = round($time_taken, 5);

                        //echo 'Page generated in ' . $time_taken . ' seconds.';
                        ?>


<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/panzoom.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/lightgallery-all.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/jquery.mousewheel.min.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/visualarchive-details/jquery.ez-plus.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>/galleryrasa.main.js"></script>




<!--</div>-->


<!--
site key
6Ld45cAZAAAAAMXYdPBtPoVfJgEPtkcOzGHE7AC0

secret key
6Ld45cAZAAAAAIAxQ0l89J9KZ5BNi95zIWm4_i3I
-->






















</body>

</html>
