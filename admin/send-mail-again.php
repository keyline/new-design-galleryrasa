<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

$log_id = $_POST['log_id'];
$to = $_POST['to'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$emailname = 'RASAGALLERY';
$nameform = 'RASAGALLERY';
$mail = send_mail($to, $subject, $message, $emailname, $nameform);

if($mail){
    $_SESSION['mail-success'] = 'Mail has been send successfully';
goto_location('emaillog_content.php?log_id='.$log_id);
} else {
    $_SESSION['mail-fail'] = 'Mail sending failure';
goto_location('emaillog_content.php?log_id='.$log_id);
}