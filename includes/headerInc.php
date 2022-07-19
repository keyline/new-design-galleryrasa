<?php
$start_time = microtime(TRUE);
if (!isset($_COOKIE["cookieid"])) {
    setcookie("cookieid", gen_id(20), time() + 60 * 60 * 24 * 30, '/');
}  #30 days to expire/delete user shopping basket
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci" />
        <title><?php echo!isset($title) ? ('Welcome to Gallery Rasa') : ($title) ?></title>



        <link rel="icon" href="<?php echo SITE_URL ?>images/gallery-favicon.png">
        <!--  Bootstrap CSS  -->
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>bootstrap.min.css">

        <!--  Font-awesome CSS  -->
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>font-awesome.min.css">



        <link href="<?php echo SITE_URL . CSS_FOLDER ?>select2.css" rel="stylesheet">


        <link href="<?php echo SITE_URL . CSS_FOLDER ?>owl.theme.default.min.css" rel="stylesheet">
        <link href="<?php echo SITE_URL . CSS_FOLDER ?>owl.carousel.min.css" rel="stylesheet">


        <!--Visual Archive Page Image Zoom Plugin-->
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/visualarchive-details/lightgallery.css">
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/visualarchive-details/visualarchive-lighbox.css">
        
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/multiple-select.css">
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>/magnific-popup.css">
        
        <!--  Custom CSS  -->
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>custom.css">
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>style.css">
        <!--  Responsive CSS  -->
        <link rel="stylesheet" href="<?php echo SITE_URL . CSS_FOLDER ?>responsive.css">

        <script>
            //paste this code under head tag or in a seperate js file.
            // Wait for window load
            $(window).load(function () {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");
                ;
            });
        </script>


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






    <body>

        <header>
            <div class="brand-wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="brand-auth">
                            <div class="brand text-center">
                                <a href="<?php echo SITE_URL ?>">
                                    <img src="<?php echo SITE_URL ?>images/gallery-rasa-logo.png" alt="Gallery Rasa" width="400" height="126" class="img-fluid">
                                </a>
                                <h2>tempered by knowledge<br>driven by passion</h2>
                            </div>
                        </div>
                        <img src="<?php echo SITE_URL ?>images/tree-inner.png" alt="Gallery Rasa" width="1170" height="577" class="img-fluid">
                        <?php
                                if (!isset($_SESSION['user-email'])) {
                                    ?>
                            <div class="auth">
                                    <a href="<?php echo SITE_URL ?>login-register">Login <span class="pink">/</span> Register</a>
                                
                            </div>
                                    <?php
                                } else {
                                    ?>
                                <div class="loggedin">
                                    <ul class="d-sm-flex justify-content-center p-0">
                                    <?php
                                    $_SESSION['user-id'];
                                    $conn = dbconnect();
                                    $qry_credit_header = "SELECT credit from customer_credit where customer_id = '" . $_SESSION['user-id'] . "'";
                                    $q_credit_header = $conn->prepare($qry_credit_header);
                                    $q_credit_header->execute();
                                    $q_credit_header->setFetchMode(PDO::FETCH_ASSOC);
                                    $row_credit_header = $q_credit_header->fetch();

                                    if (empty($row_credit_header)) {
                                        $credit_header = '0';
                                    } else {
                                        $credit_header = $row_credit_header['credit'];
                                    }
                                    ?>

                                        <li>Welcome <a href="<?php echo SITE_URL ?>/customer-dashboard/customer-dashboard"><?php echo $_SESSION['user-name']; ?>  </a></li>
<!--                                        <li><a href="<?php echo SITE_URL . '/customer-dashboard/' ?>buy-credit.php">Buy Credit (<?php echo $credit_header; ?>)</a></li>-->
                                        <li><a href="<?php echo SITE_URL ?>/logout">  Logout</a></li>
                                    <?php
                                }
                                ?> 
                            
                                <?php
                                if ((isset($_SESSION['user-email'])) || (isset($_SESSION["cart_item"]))) {
                                    if (isset($_SESSION["cart_item"])) {
                                        $no_items_sess = count($_SESSION["cart_item"]);
                                        ?>
<!--                                        <li><a href="<?php echo SITE_URL . '/cart-checkout/cart.php' ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>(<?php echo $no_items_sess; ?>)</a></li>-->
                                        <?php
                                    } if (isset($_SESSION['user-email'])) {
                                        $conn = dbconnect();
                                        $qry_cart_item = "SELECT count(id) cart_item from cart where customer_id = '" . $_SESSION['user-id'] . "'";
                                        $q_cart_item = $conn->prepare($qry_cart_item);
                                        $q_cart_item->execute();
                                        $q_cart_item->setFetchMode(PDO::FETCH_ASSOC);
                                        $row_cart_item = $q_cart_item->fetch();
                                        $no_cart_item = $row_cart_item['cart_item'];
                                        ?>
<!--                                        <li><a href="<?php echo SITE_URL . '/cart-checkout/cart.php' ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>(<?php echo $no_cart_item; ?>)</a></li>-->
                                        <?php
                                    }
                                }
                                ?>
                                    </ul>
                        </div>
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
                                        <a class="nav-link" href="<?php echo SITE_URL ?>visualarchive-search">visual archives</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo SITE_URL ?>beforeSearch">Bibliography</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo SITE_URL ?>memorabilia-search">bengali film ARCHIVES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo SITE_URL ?>exhibition-search">exhibition</a>
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

