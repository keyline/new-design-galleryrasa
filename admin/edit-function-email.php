<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    $cust_id = $_POST['cust_id'];
//    $fname = $_POST['fname'];
//    $lname = $_POST['lname'];
    $email_id = $_POST['email_id'];
    $subject = $_POST['subject'];
    $email_content = trim($_POST['email_content']);
    $email_content = htmlentities($email_content);
    
   
//    if ($password != $re_password) {
//        $_SESSION['error-pass'] = 'Re Entered Wrong Password';
//        goto_location('customer-dashboard');
//    } else {
        $qry1 = "update email_template set subject = '$subject',content = '$email_content' "
                . "where id = '$email_id'";
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-email'] = 'Email Template is Updated';

        goto_location('edit_email.php?email_id='.$email_id);
  //  }
}