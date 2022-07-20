<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>


<main>
    <div class="container">

        <?php
        if (isset($_SESSION['succ-pass'])) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['succ-pass']; ?></div>
            <?php
            unset($_SESSION['succ-pass']);
        }
        ?>
        <?php
        if (isset($_SESSION['reg-error'])) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['reg-error'] ?></div>
            <?php
            unset($_SESSION['reg-error']);
        }
        ?> 
        <?php
        if (isset($_SESSION['error_operation'])) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['error_operation'] ?></div>
            <?php
            unset($_SESSION['error_operation']);
        }
        ?> 
        <?php
        if (isset($_SESSION['login-error'])) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['login-error'] ?></div>
            <?php
            unset($_SESSION['login-error']);
        }
        ?> 
        <?php
        if (isset($_SESSION['reg-success'])) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['reg-success'] ?></div>
            <?php
            unset($_SESSION['reg-success']);
        }
        ?> 
        <?php
        if (isset($_SESSION['succ-pass-reset'])) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['succ-pass-reset'] ?></div>
            <?php
            unset($_SESSION['succ-pass-reset']);
        }
        ?>    
        <div class="row justify-content-center text-center">
            <div class="col-md-6 mb-5 mb-md-0">
                <h3 class="text-left">Register - New Users</h3>
                <form id="register-form" method="POST" action="register.php" role="form" class="text-left arial">
                    <div class="form-group row">
                        <div class="col-md-4 p-0">
                            <label for="fname">First Name *</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="fname" id="fname" required placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 p-0">
                            <label for="fname">Last Name *</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="lname" id="lname" required placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 p-0">
                            <label for="fname">Email *</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" id="email" required placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 p-0">
                            <label for="fname">Phone</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 p-0">
                            <label for="fname">Visitor Type *</label>
                        </div>
                        <div class="col-md-8">
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

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required value="yes">
                        <label class="form-check-label" for="exampleCheck1"> I agree with the <a target="_blank" href="page/terms-conditions" style="color: blue;">Terms and Conditions</a> and <a target="_blank" href="page/terms-conditions" style="color: blue;">Privacy Policy</a></label>

                    </div>

                    <div class="g-recaptcha" id="sape_captcha" data-sitekey="6LcwDKsZAAAAAGh3QyRMNaEANIPKUPvYuoOpQ2JY"></div>

                    <button type="submit" class="btn btn-primary form-control">Register</button>

                </form>
            </div>
            <div class="col-md-6">
                <h3>Login</h3>
                <form id="login-form" method="POST" action="login.php" role="form">
                    <input type="hidden" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" name="prevurl" >
                    <input type="email" class="form-control" name="email" id="email" required placeholder="Email">


                    <input type="password" class="form-control" name="pass" id="pass" required placeholder="Password">


                    <button type="submit" class="btn btn-primary form-control">Login</button>
                    <a href="forget-password.php" class="btn btn-primary form-control">Forgot Password</a>
                </form>
            </div>
        </div>
    </div>
</main>


<?php
include(INC_FOLDER . "footerInc.php");
?>