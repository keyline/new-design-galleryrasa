<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<main>
<section class="start-body podcast-page artist-search get-page profile">
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
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="podcast-body">      
                        <div class="podcast-title">
                            Welcome back!
                        </div>
                        <div class="podcast-content">
                            Lorem ipsum dolor sit amet, consectetur.
                        </div>
                        <div class="get-form">
                            <form id="login-form" method="POST" action="login.php" role="form">
                            <input type="hidden" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" name="prevurl" >
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" required placeholder="E-mail address">
                                </div>
                                <div class="form-group password">
                                    <input type="password" name="pass" id="pass"  class="form-control" required placeholder="password">
                                </div>
                                <div class="profile-action">
                                    <div class="sign-action">
                                        <!-- <a href="./dashboard.php" class="sign-btn">sign in</a> -->
                                        <button type="submit" class="sign-btn">sign in</button>
                                    </div>
                                    <div class="password-action">
                                        <!-- <a href="./reset-password.php" class="password-btn">forgot password</a> -->
                                        <a href="forget-password.php" class="password-btn">Forgot Password</a>
                                    </div>
                                </div>                          
                            </form>
                            <div class="user-action">
                                <a href="<?php echo SITE_URL ?>registerInc" class="user-btn">New user? <span>Sign up instead</span></a>
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