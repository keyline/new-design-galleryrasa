<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL.'/login-register');
    exit;
}
$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");

?>
<main>
<div class="container arial">
    <h2 class="client-admin-heading">Update Information</h2>
    <div class="row">
    <div class="col-md-3 client-admin-left-panel">
    <?php
    include("customer-menu.php");
    ?>
        </div>
    <!--<div class="clearfix"></div>-->
   <div class="col-md-9">
            <?php
            if (isset($_SESSION['error-pass'])) {
                ?>
                <span class="label-danger"><?php echo $_SESSION['error-pass']; ?></span>
                <?php
                unset($_SESSION['error-pass']);
            }
            ?>
            <form method="POST" action="change-password.php" id="passwordForm">
                <?php
                $sql_user = "select * from customer_login where email = '" . $_SESSION['user-email'] . "'";
                $q_user = $conn->prepare($sql_user);
                $q_user->execute();
                $q_user->setFetchMode(PDO::FETCH_ASSOC);
                $row_user = $q_user->fetch();
                ?>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>First name:</label>
                    </div> 
                    <div class="col-md-9">
                        <input type="text" name="fname" value="<?php echo $row_user['fname']; ?>" class="form-control" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Last name:</label>
                    </div> 
                    <div class="col-md-9">
                        <input type="text" name="lname" value="<?php echo $row_user['lname']; ?>" class="form-control" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Email Id:</label>
                    </div> 
                    <div class="col-md-9">
                        <input type="email" name="email" value="<?php echo $_SESSION['user-email']; ?>" readonly class="form-control" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Lasttname:</label>
                    </div> 
                    <div class="col-md-9">
                        <input type="text" name="phone" value="<?php echo $row_user['phone']; ?>" class="form-control" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Enter Password:</label>
                    </div>  
                    <div class="col-md-9">
                        <input type="password" name="password" id="password" class="form-control" value="<?php echo $row_user['password']; ?>" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Re-Enter Password:</label>
                    </div>  
                    <div class="col-md-9">
                        <input type="password" name="re_password" id="re_password" class="form-control" value="<?php echo $row_user['password']; ?>" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">

                    </div>  
                    <div class="col-md-9">
                        <input type="submit" value="Update Information" class="btn btn-info form-control">
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
        $("#passwordForm").validate({
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
include("../" . INC_FOLDER . "footerInc.php");
?>

