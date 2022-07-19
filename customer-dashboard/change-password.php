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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    if ($password != $re_password) {
        $_SESSION['error-pass'] = 'Re Entered Wrong Password';
        goto_location('customer-dashboard');
    } else {
        $qry1 = "update customer_login set password = '$password',fname = '$fname',lname = '$lname',phone = '$phone' "
                . "where email = '$email'";
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pass'] = 'Your Information is Changed. Please Login Again';
        unset($_SESSION['user-email']);
        unset($_SESSION['user-id']);
        unset($_SESSION['user-name']);
        unset($_SESSION['user-email']);
        goto_location('edit-profile');
    }
}