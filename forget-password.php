<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<main>

<section class="start-body podcast-page artist-search get-page profile password">
    <div class="container">
        <?php
        if (isset($_SESSION['forgot-error'])) {
            ?>
            <span class="label-danger"><?php echo $_SESSION['forgot-error']; ?></span>
            <?php
            unset($_SESSION['forgot-error']);
        }
        ?>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="podcast-body">
                        <div class="podcast-title">
                            Reset your password
                        </div>
                        <div class="podcast-content">
                            Lorem ipsum dolor sit amet, consectetur.
                        </div>
                        <div class="get-form">
                            <form method="POST" action="forget-check.php" class="forgot-pass">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" required placeholder="registered e-mail address">
                                </div>
                                <div class="sign-action">
                                    <!-- <a href="#" class="sign-btn" value="Reset">send reset link</a> -->
                                    <input type="submit" class="sign-btn" value="Reset">
                                </div>
                            </form>
                            <div class="user-action">
                                <a href="<?php echo SITE_URL ?>login-register" class="user-btn"><span>Back to Sign in</span></a>
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