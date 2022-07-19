<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $order_id = $_POST['order_id'];
    $orderpre_id = $_POST['orderpre_id'];
    $customer_name= $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $order_date = $_POST['order_date'];
    $comment = $_POST['comment'];
    $status = $_POST['status'];
    $today_date = date("Y-m-d H:i:s");
    $qry_stat = "insert into order_status(id,order_id,status,comment,date) "
        . "values('','$order_id','$status','$comment','$today_date')";
$q_stat = $conn->prepare($qry_stat);
$q_stat->execute();




$to = $customer_email;

$get_mail = get_particular_email('Order Comment');
$cf = html_entity_decode($get_mail['content']);
$sub = $get_mail['subject'];
$subject = str_replace(array('{order_id}'), array($order_id), $sub);
$message = str_replace(array('{name}','{order_id}','{order_date}','{order_status}','{order_comment}'), array($customer_name,$order_id,$order_date,$status,$comment), $cf);

$emailname = 'RASAGALLERY';
$nameform = 'RASAGALLERY';
send_mail($to, $subject, $message, $emailname, $nameform);

$date = date("Y-m-d H:i:s");
    $qry_mail = "insert into email_log(id,email,email_name,subject,text,date) "
            . "values('','$to','Order Comment','$subject','$message','$date')";
    $q_mail = $conn->prepare($qry_mail);
    $q_mail->execute();


$_SESSION['status_change'] = "Order Status is changed";
goto_location('edit_order.php?ord_id='.$orderpre_id); 
}
