<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Rasa</title>
    <link rel="icon" href="images/gallery-favicon.png">
    <!--  Bootstrap CSS  -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--  Font-awesome CSS  -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!--  Custom CSS  -->
    <link rel="stylesheet" href="css/style.css">
    <!--  Responsive CSS  -->
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>

    <header>
        <div class="brand-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="brand-auth">
                        <div class="brand text-center">
                            <a href="/galleryrasa/index.html">
                                <img src="images/gallery-rasa-logo.png" alt="Gallery Rasa" width="400" height="126" class="img-fluid">
                            </a>
                            <h2>tempered by knowledge<br>driven by passion</h2>
                        </div>
                        <div class="auth"><a href="login-register.html">Login <span class="pink">/</span> Register</a></div>
                    </div>
                    <img src="images/tree-inner.png" alt="Gallery Rasa" width="1170" height="577" class="img-fluid">
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <div class="row justify-content-around w-100">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#galleryRasaNavbar" aria-controls="galleryRasaNavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="galleryRasaNavbar">
                            <ul class="navbar-nav w-100 justify-content-around text-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="visual-archive.html">visual archives</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Bibliography</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">exhibition</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">bengali film ARCHIVES</a>
                                </li>
                                <li class="nav-item auth">
                                    <a class="nav-link" href="login-register.html">Login / Register</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.891815092772!2d88.33816641432442!3d22.508241841003684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02775b1c534ced%3A0xc5b1b6196af5fbbb!2sGallery%20Rasa!5e0!3m2!1sen!2sin!4v1597853415023!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="col-lg-6">
                    <img src="images/contact_image.jpg" alt="..." class="img-fluid">
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h3 class="contact-title">contact us</h3>
                            <form id="contactPage-form" method="post" action="" role="form">
                                <input type="text" class="form-control" id="" placeholder="Name">
                                <input type="email" class="form-control" id="" placeholder="Email">
                                <input type="text" class="form-control" id="" placeholder="Phone">
                                
                                <input type="text" class="form-control" id="" placeholder="Subject">
                                <textarea class="form-control" id="" rows="3" placeholder="Message"></textarea>
                                  <button type="submit" class="btn btn-primary form-control">Submit</button>

                            </form>
                        </div>
                        <div class="col-md-6 text-left mt-5 mt-md-0">
                            <h3 class="contact-h3">Gallery Rasa</h3>
                            <p>
                            
                            A unit of Rajyoti Creative Pursuits Private Limited <br />
                            828/1 Block P, New Alipore <br />
                            Kolkata: 700 053 <br />
                            India
                            </p>
                            <p>
                            Land Phone: <a href="tel:03324007348">+91 33 2400 7348</a>
                                </p>
                            <p>
                                Email: <a href="mailto:galleryrasa@gmail.com">galleryrasa<span style="font-family: cursive; font-size: 15px; color: rgb(35 31 32 / 0.6);">@</span>gmail.com</a>
                            </p>
                            <p>
                            Nearest metro station: Rabindra Sarovar
                            </p>
                            <p>
                                Land Mark : Near erstwhile Rasoi factory
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <h4>subscribe to our newsletter</h4>
                        <div class="footer-subscribe-form-wrapper">
                            <form id="contact-form" method="post" action="" role="form">
                              <div class="form-group">
                                <input type="text" class="form-control" id="" placeholder="full name">
                              </div>
                              <div class="form-group">
                                <input type="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="email">
                              </div>
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="6LcK58AZAAAAAKKl5POhCtrRLQWIj6C9kCU3NT4R" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                    <button type="submit" class="btn btn-primary form-control" data-recaptcha="true" required data-error="Please complete the Captcha">Submit</button>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 mt-4 mt-md-0">
                        <div class="row align-items-end">
                            <div class="col-lg-9">
                                <h4>important links</h4>
                                <div class="footer-nav">
                                    <ul class="m-0 p-0">
                                        <li><a href="#!">terms & conditions</a></li>
                                        <li><a href="#!">privacy policy</a></li>
                                        <li><a href="#!">return & refund policy</a></li>
                                        <li><a href="#!">how to buy</a></li>
                                        <li><a href="index.html">home</a></li>
                                        <li><a href="index.html">about us</a></li>
                                        <li><a href="#!">mission statement</a></li>
                                        <li><a href="contact.html">contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="social-info">
                                    <ul>
                                        <li>
                                            <a href="#!">
                                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#!">
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
                    <span>&copy; 2020 Gallery Rasa. All Rights Reserved. Powered by keyline Creative Services</span>
                </div>
            </div>
        </div>
    </footer>
    <section class="after-footer"></section>

    <!--  Bootstrap JS  -->
<!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="js/bootstrap.min.js"></script>
    
     <script>
         $(document).ready(function(){
            $('button[data-target="#galleryRasaNavbar"]').click(function() {
                var btnclass = $(this).attr("aria-expanded");
                if(btnclass == "false"){
                    var target = $(this).attr("data-target");
                    var img_height = $(".brand-auth + img").height();
                    console.log(target);
                    console.log(img_height);
                    $('html,body').animate({
                      scrollTop: $("#galleryRasaNavbar").offset().top + img_height
                    }, 1000);                       
                }
            });
            $(".more-btn").click(function(){
                $(this).parent().next(".moreSection").slideDown("slow");
                $(this).hide();
            })
             var more_section = $(".moreSection")
             for(var i = 0; i < more_section.length; i++) {
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
            grecaptcha.ready(function() {
              grecaptcha.execute('6LcI58AZAAAAAFM0UR6P4zj9PChh5UJmVKHNONIY', {action: 'submit'}).then(function(token) {
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
<!--
    site key
    6Ld45cAZAAAAAMXYdPBtPoVfJgEPtkcOzGHE7AC0
    
    secret key
    6Ld45cAZAAAAAIAxQ0l89J9KZ5BNi95zIWm4_i3I
-->
    
</body>

</html>