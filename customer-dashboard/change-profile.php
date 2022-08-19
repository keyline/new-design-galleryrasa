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

    
    $email = $_POST['email'];
    
        $qry1 = "update customer_login set fname = '$fname',lname = '$lname' " . "where email = '$email'";
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pass'] = 'Your Profile is Updated.';
        // unset($_SESSION['user-email']);
        // unset($_SESSION['user-id']);
        // unset($_SESSION['user-name']);
        // unset($_SESSION['user-email']);
        goto_location('customer-dashboard');
}