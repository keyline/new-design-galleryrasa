<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
$user = $_GET['email'];
$hash = $_GET['hash'];

if (!check_valid_customerhash($user, $hash)) {
    $_SESSION['error_operation'] = 'Error Operation';
    goto_location('login-register');
} else {

    include(INC_FOLDER . "headerInc.php");
    ?>
<main>
    <div class="container arial">
                <h3 class="text-center">Reset Password</h3>
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
    <?php
    if (isset($_SESSION['error-pass-forgot'])) {
        ?>
            <span class="label-danger"><?php echo $_SESSION['error-pass-forgot']; ?></span>
            <?php
            unset($_SESSION['error-pass-forgot']);
        }
        ?>
            <form method="POST" action="reset-function.php" id="resetForm">
            <input type="hidden" name="user" value="<?php echo $user; ?>" >
            <input type="hidden" name="hash" value="<?php echo $hash; ?>" >
                <div class="row">
                <div class="col-md-4">
                    <label>Password <strong>*</strong></label>
                </div>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="col-md-4">
                    <label>Retype Password <strong>*</strong></label>
                </div>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="re_password" id="re_password" required>
                </div>
                <div class="col-md-4">
                    
                </div>
                    <div class="col-md-8">
                        <input type="submit" class="btn form-control" value="Reset">
                    </div>
                </div>
        </form>
        </div>
        </div>
    </div>
</main>
    <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-1.11.3.min.js">
    </script>
    <script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js">
    </script>
    <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.js"></script>
    <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate2.js"></script>

    <script>
    //	$.validator.setDefaults({
    //		submitHandler: function() {
    //			alert("submitted!");
    //		}
    //	});

        $(document).ready(function () {
            // validate the comment form when it is submitted

            // validate signup form on keyup and submit
            $("#resetForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 5
                    },
                    re_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    re_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    }
                }
            });

        });
    </script>
    <?php
    include(INC_FOLDER . "footerInc.php");
}
?>