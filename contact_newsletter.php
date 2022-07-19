<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$adminsettingarr = get_admin_setting();

$name = $_POST['fullname'];
$email = $_POST['fullemail'];


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
//    'response' => $_POST['g-recaptcha']
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

    $get_mail = get_particular_email('newsletter');
    $cf = html_entity_decode($get_mail['content']);
    $sub = 'Thank you ' . $name . ' for subscribing to our newsletter';

    $subject = $sub;
    $message = str_replace(array('{name}'), array($name), $cf);


    $get_mail2 = get_particular_email('newsletter-accept');
    $cf2 = html_entity_decode($get_mail2['content']);
    $sub2 = '' . $name . ' has requested for newsletter';
    ;
    $subject2 = $sub2;
    $message2 = str_replace(array('{name}', '{email}'), array($name, $email), $cf2);


    $to = $email;

    $emailname = 'Gallery Rasa <info@galleryrasa.com>';
    //$nameform = 'RASAGALLERY <galleryrasa@gmail.com>';
    $nameform = '';
    //send_mail($to, 



    $to2 = $adminsettingarr['email'];

    $emailname2 = 'Gallery Rasa <info@galleryrasa.com>';

    $nameform2 = '';
    if (send_mail($to2, $subject2, $message2, $emailname2, $nameform2)) {
        
        
//        send_mail($to, $subject, $message, $emailname, $nameform);
//        send_mail($to2, $subject2, $message2, $emailname2, $nameform2);

        //echo 'Newsletter is subscribe';

        $_SESSION['newsletter'] = 'Message is send';

        header("Location: index.php");
    }
} else {

    //echo 'Error to subscribe newsletter';
    $_SESSION['newsletter'] = 'Error to subscribe newsletter';

    header("Location: index.php");
}