<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$email = $_POST['user'];
$hash = $_POST['hash'];
$password = $_POST['password'];
$re_password = $_POST['re_password'];
if ($password != $re_password) {
    $_SESSION['error-pass-forgot'] = 'Re Entered Wrong Password';
    goto_location('reset.php?email=' . $email . '&hash=' . $hash);
} else {

    if (check_valid_customerhash($email, $hash)) {
        $qry1 = "update customer_login set password = '$password', hash = '' "
                . "where email = '$email'";
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pass-reset'] = 'Password is reset. Please Login';
        goto_location('login-register.php');
    }
    else{
        $_SESSION['error_operation'] = 'Error Operation';
    goto_location('login-register');
    }
}