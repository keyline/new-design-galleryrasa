<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<main>
<section class="start-body podcast-page artist-search get-page profile sign-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="podcast-body">   
                        <div class="podcast-title">
                            Create an account
                        </div>
                        <div class="podcast-content">
                            Lorem ipsum dolor sit amet, consectetur.
                        </div>
                        <div class="get-form">
                            <form id="register-form" method="POST" action="register.php" role="form" class="text-left arial">
                                <div class="form-group">
                                    <input type="text"  name="fname" id="fname" required class="form-control" placeholder="first name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lname" id="lname" required placeholder="last name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" required placeholder="E-mail address">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="phone" id="phone"  placeholder="phone">
                                </div>
                                <div class="form-group">
                                    <div class="podcast-content">
                                        <label for="cars">Visitor Type *</label>
                                    </div>
                                    <select class="form-control" id="visitorType" name="visitorType" required>
                                        <option value="">Please Select</option>
                                        <option value="Academic Institution">Academic Institution</option>
                                        <option value="Collector">Collector</option>
                                        <option value="Enthusiast">Enthusiast</option>
                                        <option value="Gallery">Gallery</option>
                                        <option value="audi">Historian</option>
                                        <option value="Museum">Museum</option>
                                        <option value="Research Scholar">Research Scholar</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                        </div>
                                                                                                                     
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input greencheck" type="checkbox" id="inlineCheckbox2" id="terms" required value="yes" required>
                                    <!-- <input type="checkbox" class="form-check-input" id="terms" required value="yes"> -->
                                    <!-- <label class="form-check-label" for="inlineCheckbox1">I agree with the <span>Terms and Conditions and Privacy Policy</span></label> -->
                                    <label class="form-check-label" for="exampleCheck1"> I agree with the <a target="_blank" href="<?php echo SITE_URL ?>terms-conditions" style="color: blue;">Terms and Conditions</a> and <a target="_blank" href="<?php echo SITE_URL ?>privacy-policy" style="color: blue;">Privacy Policy</a></label>
                                </div>
                                <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div>                                        
                                <div class="sign-action">
                                    <!-- <a href="#" class="sign-btn">SIGN UP</a> -->
                                    <button type="submit" class="sign-btn">Register</button>                
                                </div>
                            </form>
                            <div class="user-action">
                                <a href="<?php echo SITE_URL ?>login-register" class="user-btn">Already a user?<span> Sign in instead</span></a>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </section>
</main>

<?php
include(INC_FOLDER . "footerInc.php");
?>