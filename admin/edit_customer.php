<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

$cust_id = $_GET['cust_id'];
try {
    $sql = "select * from "
            . "customer_login where id = '$cust_id'";
    $q = $conn->prepare($sql);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    $row = $q->fetch();

    $customer_id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    $status = $row['status'];
    $reg_date = $row['reg_date'];
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . 'edit-customer-tpl.php');
?>

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
include(ADMIN_HTML . "admin-footerInc.php");
//}