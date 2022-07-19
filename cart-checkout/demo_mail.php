<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
//$cust_id = $_SESSION['user-id'];
//
//$email = $_SESSION['user-email'];

$to = 'alolika@keylines.net';
$mail = 'alolika@keylines.net';
$cf = file_get_contents('mail.txt');
$message = str_replace(array('{mail}'), array($mail), $cf);



        $subject = 'New Order';
//        $message = 'Dear, <strong>' . $fname . ' ' . $lname . '</strong>' .
//                '<br>Thanks for Registering in RASA GALLERY' .
//                '<br>It\'s a automated system generated email. Do not reply to this  email.
// 
//<br>------------------------
//<br>Username: <strong>' . $email . '</strong>
//<br>Password: <strong>' . $pass . '</strong>
//<br>------------------------
// 
//<br><br>You can Reset your Password. 
//
//<br><br><strong>RASA GALLERY</strong>. ';

        $emailname = 'GALLERYRASA';
        $nameform = 'GALLERYRASA';
        send_mail($to, $subject, $message, $emailname, $nameform);