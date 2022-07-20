<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$adminsettingarr = get_admin_setting();

//echo $adminsettingarr['email'];
//exit;
//$email = "contact-form";
//$emailarr = get_particular_email($ename);
//$cust_id = $_SESSION['user-id'];
//
//$email = $_SESSION['user-email'];


$reg_date = date("Y-m-d H:i:s");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$data = [
    'secret' => '6LcwDKsZAAAAAMN4pMR6J8vzpakFi-umXdg9vkex',
    'response' => @$_POST['g-recaptcha-response']
];

$curl = curl_init();

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($curl);
$response = json_decode($response, true);

//$data = [
//    'secret' => '6LeGYzEbAAAAALt5X1hPjTGHKcpqk9kgRQwHR3ko',
//    'response' => @$_POST['g-recaptcha-response']
//];
//
//$curl = curl_init();
//
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
//curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
//
//$response = curl_exec($curl);
//$response = json_decode($response, true);


if ($response['success'] === true) {



    $get_mail = get_particular_email('contact-form');
    $cf = html_entity_decode($get_mail['content']);
    $sub = $get_mail['subject'] . ' - ' . $_POST['subject'] . '( From ' . $name . ')';
    ;
    $subject = $sub;
    $message = str_replace(array('{name}', '{email}', '{phone}', '{msg}'), array($name, $email, $phone, $message), $cf);



    $get_mail2 = get_particular_email('contact-form-reply');
    $cf2 = html_entity_decode($get_mail2['content']);
    $sub2 = 'Thank you ' . $name . ' for contacting Gallery Rasa';
    ;
    $subject2 = $sub2;
    $message2 = str_replace(array('{name}'), array($name), $cf2);


    if ($name != '' && $email != '' && $phone != '' && $subject != '' && $message != '') {

        $to = $adminsettingarr['email'];

        $emailname = 'Gallery Rasa <info@galleryrasa.com>';
        //$nameform = 'RASAGALLERY <galleryrasa@gmail.com>';
        $nameform = '';
        //send_mail($to, $subject, $message, $emailname, $nameform);




        if (send_mail($to, $subject, $message, $emailname, $nameform)) {

            $qry_mail = "insert into email_log(id,email,email_name,subject,text,date) "
                    . "values('','$to','contact-form','$subject','$message','$reg_date')";
            $q_mail = $conn->prepare($qry_mail);
            $q_mail->execute();




            $to2 = $email;

            $emailname2 = 'Gallery Rasa <info@galleryrasa.com>';

            $nameform2 = '';

            send_mail($to2, $subject2, $message2, $emailname2, $nameform2);


            $_SESSION['succ'] = 'Thank you for getting in touch!';

            header("Location: contactus.php");
        } else {
            $_SESSION['fail'] = 'Error to send message';

            header("Location: contactus.php");
        }
    } else {
        $_SESSION['fail'] = 'Fill up the form completely';

        header("Location: contactus.php");
    }
} else {
    $_SESSION['fail'] = 'Wrong Captcha';

    header("Location: contactus.php");
}