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
                            <input type="text" name="name" class="form-control" id="" placeholder="Name" required>
                            <input type="email" name="email" class="form-control" id="" placeholder="Email" required>
                            <input type="text" name="phone" class="form-control" id="" placeholder="Phone" required>

                            <input type="text" name="subject" class="form-control" id="" placeholder="Subject" required>
                            <textarea name="message" class="form-control" id="" rows="3" placeholder="Message" required></textarea>
                            <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div>
                            <!--<div class="g-recaptcha" data-sitekey="6LeGYzEbAAAAABEW4etvHZZKGwNs3SaF7FAQcCAK"></div>-->
                            <button type="submit" class="btn btn-primary form-control" style="margin-top: 30px;">Submit</button>

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
                            <strong>Mobile:</strong> <a href="tel:+917604081323">+91 76040 81323 [WhatsApp only]</a>
                        </p>
                        <p>
                            <strong>Land Phone:</strong> <a href="tel:03324007348">+91 33 2400 7348</a> / <a href="tel:03335519871">+91 33 3551 9871</a>
                        </p>
                        <p>
<!--                            Email: <a href="mailto:galleryrasa@gmail.com">galleryrasa<span style="font-family: cursive; font-size: 15px; color: rgb(35 31 32 / 0.6);">@</span>gmail.com</a>-->
                            <strong>Email:</strong> <a href="mailto:galleryrasa.com">info@galleryrasa.com</a>
                        </p>
                        <p>
                            <strong>Nearest metro station:</strong> Rabindra Sarovar
                        </p>
                        <p>
                            <strong>Landmark:</strong> Near erstwhile Rasoi factory
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>







<!--<div class="breadcrumbs">
        <div class="container">
                <div class="row">
                        <div class="col-md-12 text-center">
                                <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><i class="fa fa-angle-right"></i></li>
                                        <li><a href="#">Contact</a></li>
                                </ul>
                                <h2>Contact</h2>
                                
                        </div>
                </div>
        </div>
</div>

<div class="container">
        <div class="content-page contact-page row">
                <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1347593.3755817274!2d-76.79683240216765!3d42.73449846964041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2z0J3RjNGOLdCZ0L7RgNC6LCDQodCo0JA!5e0!3m2!1sru!2sua!4v1482826502397" width="100" height="500" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-8">
                        <form>
                                <div class="form-group">
                                        <p>
                                                <label>Your Name (required)</label>
                                                <input type="text" name="your-name">
                                        </p>
                                        
                                </div>
                                <div class="form-group">
                                        <p>
                                                <label>Your Email (required)</label>
                                                <input type="email" name="your-email">
                                        </p>
                                        
                                </div>
                                <label>Your Message</label>
                                <textarea name="your-message" id="your-message" cols="40" rows="10"></textarea>
                                <input type="submit" value="Send message" class="submit">
                        </form>
                </div>
                <div class="col-md-4">
                        <h2>Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit Donec facilisis.</h2>
                        <p>Etiam nulla nunc, aliquet vel metus nec, scelerisque tempus enim. Sed eget blandit lectus. Donec facilisis ornare turpis id pretium. Maecenas scelerisque interdum dolor in vestibulum proin euismod dui purus. Maecenas scelerisque interdum dolor in vestibulum proin euismod dui purus.</p>
                        <address>
                                <ul>
                                        <li>30 South Avenue San Francisco</li>
                                        <li>Phone: <a href="#" class="active-color">+1 408 996 1010</a></li>
                                        <li>Email: <a href="#" class="active-color">youremail@site.com</a></li>
                                </ul>
                        </address>
                </div>
        </div>
</div>-->

<?php require_once("includes/footerInc.php"); ?>