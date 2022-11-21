<?php
$start_time = microtime(true);
if (!isset($_COOKIE["cookieid"])) {
    setcookie("cookieid", gen_id(20), time() + 60 * 60 * 24 * 30, '/');
}  #30 days to expire/delete user shopping basket
// $_SESSION["cart_item"]




?>



<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo!isset($title) ? ('Welcome to Gallery Rasa') : ($title) ?></title>



        <link rel="icon" href="<?php echo SITE_URL ?>images/gallery-favicon.png">
        <!--  Bootstrap CSS  -->      
        <link href="<?php echo SITE_URL . CSS_FOLDER ?>select2.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/multiple-select.css">

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL . CSS_FOLDER ?>menumaker.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>jquery.serialtabs.css" />
<title>Welcome to Gallery Rasa</title>
<style>
    :root {
        --primaryColor: #396B7B;
        --secondaryColor: #63B7D1;
        --trirdColor: #757575;
        --fourthColor: #000;
        --textColor: #333;
    }

</style>
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/jquery-ui.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL . CSS_FOLDER ?>style.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL . CSS_FOLDER ?>pushbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL . CSS_FOLDER ?>demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL . CSS_FOLDER ?>responsive.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>jquery.bs4-scrolling-tabs.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>font">
        <link rel="stylesheet" href="assets/font">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!------------GOOGLE FONT------------>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<!------------ZMDI ICON------------>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>font-awesome.css">
<!------------OWL------------>
<link rel="stylesheet" href="<?php echo SITE_URL . OWL_FOLDER ?>owl3.css">
<!--<link rel="stylesheet" href="https://fonts.google.com/icons?selected=Material%20Icons%20Outlined%3Aaccount_circle%3A">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="slick/slick.css" />
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />

        <style>
            @font-face {
                font-family: ink-free;
                src: url(../fonts/ink-free-normal.ttf);
            }
        </style>


        <?php
        if (trim(RECAPTCHA_SITEKEY) != null) {
            if (basename($_SERVER['PHP_SELF']) == 'contactus.php') {
                echo "<script src='https://www.google.com/recaptcha/api.js?hl=" . RECAPTCHA_LAN . "'></script>";
            }
        }
?>
    </head>
    <!-- NAVBAR
    ================================================== -->
    <body class="noise-banner">
        <header class="header">
        <!--  NEW NAV ENDS   -->
        <section class="topPanel">
            <div class="container">
                <div class="nav-inner">
                    <div class="heade-img">
                        <div class="brand">
                            <a href="<?php echo SITE_URL ?>" class="logo"> <img class="img-fluid" src="<?php echo SITE_URL ?>images/logo.png" alt="" title="Home">
                                <div class="brand-text">
                                    <p>Tempered by Knowledge</p>
                                    <p>Driven by Passion</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="nav-box-part">
                        <div class="nav-info">
                            <div id="cssmenu">
                                <ul class="nav navbar-nav navbar-left" id="nav">
                                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>">home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>visualarchive-search">VISUAL ARCHIVES</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>beforeSearch">BIBLIOGRAPHY</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>memorabilia-search">BENGALI FILM ARCHIVES</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>podcast-search">PODCAST</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>exhibition-search">EXHIBITION<span class="material-icons">new_releases</span></a></li>
                                </ul>
                            </div>   
                        </div>
                        <div class="head-bar">
                            <?php if (isset($_SESSION["user-id"])) {
                                $sql_user = "SELECT COUNT(id)  as productCount FROM cart WHERE customer_id='" . $_SESSION['user-id'] . "'";
                                $q_user = $conn->prepare($sql_user);
                                $q_user->execute();
                                $q_user->setFetchMode(PDO::FETCH_ASSOC);
                                $row_user = $q_user->fetch();?>
                            <div class="drafts-action">
                                <a href="<?php echo SITE_URL ?>cart-checkout/cart.php" class="drafts-btn"><span class="material-icons cart-box">shopping_bag</span><span class="badge"><?php echo $row_user['productCount']; ?></span></a>
                            </div>
                            <?php } else { ?>
                                <div class="drafts-action">
                                    <a href="<?php echo SITE_URL ?>cart-checkout/cart.php" class="drafts-btn"><span class="material-icons cart-box">shopping_bag</span><span class="badge">0</span></a>
                                </div>
                            <?php } ?>                            
                            <?php if (!isset($_SESSION['user-email'])) { ?>
                                <div class="contact-action">
                                    <a href="<?php echo SITE_URL ?>login-register" class="contact-btn"><span class="material-icons cart-box">person</span></a>
                                </div>
                            <?php } else { ?> 
                            <?php
                                    $sql_user = "select * from customer_login where email = '" . $_SESSION['user-email'] . "'";
                                    // echo $sql_user;
                                    //     exit();
                                    $q_user = $conn->prepare($sql_user);
                                    $q_user->execute();
                                    $q_user->setFetchMode(PDO::FETCH_ASSOC);
                                    $row_user = $q_user->fetch();
                                    ?>  

                                    <div class="contact-action">                           
                                        <div class="dropdown show">
                                            <a href="#" class="contact-btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown"><span class="material-icons cart-box">person</span></a>
                                            
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#"><span class="material-icons">account_circle</span> <?php echo $row_user['fname']; ?> <?php echo $row_user['lname']; ?></a>
                                            <a class="dropdown-item" href="<?php echo SITE_URL ?>/customer-dashboard/customer-dashboard"><span class="material-icons">dashboard</span> Dashboard</a>
                                            <a class="dropdown-item" href="<?php echo SITE_URL ?>/logout"><span class="material-icons round"> logout </span> Logout</a>           </div>
                                        </div>
                                    </div>



                                <!-- <div class="contact-action">
                                    <a href="<?php echo SITE_URL ?>/customer-dashboard/customer-dashboard" class="contact-btn"><span class="material-icons round"> logout </span></a>
                                </div> -->
                            <div class="right-nav">
                                <button class="sidebar-toggle">
                                    <span class="material-icons">menu</span>
                                </button>
                                <!-- sidebar -->
                                <aside class="sidebar" id="sideBox">
                                    <div class="sidebar-header">
                                        <button class="close-btn"><i class="zmdi zmdi-close"></i></button>
                                        <!-- <span class="material-symbols">close</span> -->
                                        <!-- <span class="material-symbols">done</span> -->
                                    </div>
                                    <div class="nav-boxs">
                                        <ul class="nav navbar-nav navbar-left " id="nav">
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>about-us">About us</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>vision-statement">VISION STATEMENT</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>testimonials">TESTIMONIALS</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>in_the_press">in the press</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>photo_book">photo book</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>contactus">CONTACT US</a></li>
                                        </ul>
                                    </div>
                                    <div class="nav-boxs nav-boxs-mobile">
                                        <ul class="nav navbar-nav navbar-left " id="nav">
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>">home</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>visualarchive-search">VISUAL ARCHIVES</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>beforeSearch">BIBLIOGRAPHY</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>memorabilia-search">BENGALI FILM ARCHIVES</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>podcast-search">PODCAST</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>exhibition-search">EXHIBITION</a></li>
                                        </ul>
                                    </div>
                                    <div class="nav-form">
                                        <h4>Subscribe to our Newsletter</h4>
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
                                        <!-- <form>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="your name">
                                            </div>
                                            <div class="form-group arrow-box">
                                                <input type="email" class="form-control" placeholder="your e-mail address">
                                                <a href="#" class="arrow"><i class="zmdi zmdi-arrow-right"></i></a>
                                            </div>
                                        </form> -->
                                        <form id="contact-form" method="post" action="contact_newsletter.php" role="form">
                                            <div class="form-group">
                                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="your name">
                                            </div>
                                            <div class="form-group arrow-box">
                                                <input type="email" name="fullemail" class="form-control" id="fullemail" aria-describedby="emailHelp" placeholder="your e-mail address">
                                                <!-- <a href="#" class="arrow"><i class="zmdi zmdi-arrow-right"></i></a> -->
                                                <button type="submit" class="arrow"><i class="zmdi zmdi-arrow-right"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <!--<div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>-->

                                                <div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK"></div>
                                                <!-- <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div> -->

                                                <!-- <button type="submit" class="btn btn-primary form-control" data-recaptcha="true" required data-error="Please complete the Captcha">Submit</button> -->
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="nav-social">
                                        <h4>Find us on Social Media</h4>
                                        <ul>
                                            <li><a href="https://www.facebook.com/galleryrasa" target="_blank"><img class="img-fluid" src="images/facebook-white.png"></a></li>
                                            <li><a href="https://www.instagram.com/galleryrasa_official" target="_blank"><img class="img-fluid" src="images/insta-white.png"></a></li>
                                            <li><a href="https://twitter.com/galleryrasaart" target="_blank"><img class="img-fluid" src="images/twe-white.png"></a></li>
                                            <li><a href="https://www.linkedin.com/in/rakesh-sahni-19369063" target="_blank"><img class="img-fluid" src="images/in-white.png"></a></li>
                                        </ul>
                                    </div>
                                </aside>
                            </div>

                            
                        </div>

                    </div>

                </div>
                <div style="color: black">Welcome <?php echo $row_user['fname']; ?> <?php echo $row_user['lname']; ?></div>
                        <?php } ?>
            </div>
        </section>
        <!--  NEW NAV ENDS   -->
    </header>
    
    <div class="menu-overlay-box">
    <div class="menu-overlay"></div>
    </div>



    
