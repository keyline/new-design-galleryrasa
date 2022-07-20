<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$email = $_POST['email'];

if (check_valid_customeremail($email)) {

    $to = $email;
    $qry_sel = "SELECT * from customer_login where email = '$email'";
    $q_sel = $conn->prepare($qry_sel);
    $q_sel->execute();
    $q_sel->setFetchMode(PDO::FETCH_ASSOC);
    $row_sel = $q_sel->fetch();
    $fname = $row_sel['fname'];
    $lname = $row_sel['lname'];
    $username = $fname . ' ' . $lname;

    $ulength = 6;
    $user_hash = GeraHash($ulength);

    $hashlink = SITE_URL . '/reset.php?email=' . $email . '&hash=' . $user_hash;


    $get_mail = get_particular_email('Forgot Password');
    $cf = html_entity_decode($get_mail['content']);
    //$cf = $get_mail['content'];
    $sub = $get_mail['subject'];
    $subject = str_replace(array('{name}'), array($username), $sub);
    $message = str_replace(array('{name}', '{customer_email}', '{forgot_link}'), array($username, $email, $hashlink), $cf);

    $qry1 = "update customer_login set hash = '$user_hash' "
            . "where email = '$email'";
    $q1 = $conn->prepare($qry1);
    $q1->execute();


    //$emailname = 'RASAGALLERY';
    
    $emailname = 'Gallery Rasa <galleryrasa@gmail.com>';
    //$nameform = 'RASAGALLERY <galleryrasa@gmail.com>';
    $nameform = '';
    send_mail($email, $subject, $message, $emailname, $nameform);

    //send_mail($to, $subject, $message, 'info@galleryrasa.net', $emailname);
    $date = date("Y-m-d H:i:s");
    $qry_mail = "insert into email_log(id,email,email_name,subject,text,date) "
            . "values('','$to','Forgot Password','$subject','$message','$date')";
    $q_mail = $conn->prepare($qry_mail);
    $q_mail->execute();

    $_SESSION['reg-success'] = "Please follow mail to reset password.";
    goto_location('login-register.php');
} else {
    $_SESSION['forgot-error'] = "Wrong Email";
    goto_location(SITE_URL . '/forget-password.php');
}