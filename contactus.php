<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
$title = "Contact Us";
require_once(INCLUDED_FILES . "headerInc.php");
?>
<main>
<section class="start-body podcast-page artist-search get-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="podcast-body get-body">
                        <div class="podcast-title">
                            Get in touch
                        </div>
                        <div class="podcast-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </div>
                        <div class="get-form">
                        <?php
                        if (isset($_SESSION['succ'])) {
                            ?>
                            <span class="label label-success" style="background-color: green;padding: 5px;color: #fff;float: right;"><?php echo $_SESSION['succ'] ?></span>
                            <?php
                            unset($_SESSION['succ']);
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['fail'])) {
                            ?>
                            <span class="label label-success" style="background-color: red;padding: 5px;color: #fff;float: right;"><?php echo $_SESSION['fail'] ?></span>
                            <?php
                            unset($_SESSION['fail']);
                        }
                        ?>
                            <form id="contactPage-form" method="post" action="db-contact.php" role="form">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="name" class="form-control" id="" placeholder="NAME">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="email" class="form-control" id="" placeholder="E-mail address">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="tel" name="phone" class="form-control" id="" placeholder="phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" name="subject" class="form-control" id="" placeholder="subject">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id=""  placeholder="message" rows="6"></textarea>
                                    </div>
                                    <div>
                                        <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div>
                                    </div><br>
                                    <!-- <button type="button" class="submit-btn modal-btn trigger">submit</button> -->
                                    <button type="submit" class="submit-btn modal-btn trigge" >Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="map-sec">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14743.567776569067!2d88.3402982!3d22.508237!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc5b1b6196af5fbbb!2sGallery%20Rasa!5e0!3m2!1sen!2sin!4v1655999603843!5m2!1sen!2sin" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>        
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="get-info">
                        <div class="get-title">
                            Gallery Rasa
                        </div>
                        <div class="get-content">
                            A unit of Rajyoti Creative Pursuits Private Limited,828/1 Block P, New Alipore,Kolkata - 700 053, India
                        </div>
                        <ul>
                            <li>
                                <span class="material-icons">whatsapp</span>
                                <a href="#" class="get-icon">+91 76040 81323</a>
                            </li>
                            <li>
                                <span class="material-icons">phone_in_talk</span>
                                <a href="#" class="get-icon">+91 33 2400 7348</a>
                                <span>/</span>
                                <a href="#" class="get-icon">+91 33 3551 9871</a>
                            </li>
                            <li>
                                <span class="material-icons">local_post_office</span>
                                <a href="#" class="get-icon">info@galleryrasa.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once("includes/footerInc.php"); ?>