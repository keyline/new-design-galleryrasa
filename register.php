<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");


$conn = dbconnect();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$visitorType = $_POST['visitorType'];
$ulength = 6;
$pass = GeraHash($ulength);
$reg_date = date("Y-m-d H:i:s");


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


if ($response['success'] === false) {

    $_SESSION['reg-error'] = 'Captcha Error';
    goto_location('login-register.php');
} else {



    if (!check_valid_customer($email)) {


        $columns = array(
            'id' => "'" . "'",
            'fname' => "'" . $fname . "'",
            'lname' => "'" . $lname . "'",
            'email' => "'" . $email . "'",
            'phone' => "'" . $phone . "'",
            'visitorType' => "'" . $visitorType . "'",
            'password' => "'" . $pass . "'",
            'status' => "'" . '0' . "'",
            'reg_date' => "'" . $reg_date . "'"
        );

        try {
            $pqr = insert(CUST_LOGIN, $columns);
            //exit;
            $q = $conn->prepare($pqr);
            $q->execute();

            $qry_em = "SELECT admin_ecomc.email admin_email from admin_ecomc";
            $q_em = $conn->prepare($qry_em);
            $q_em->execute();
            $q_em->setFetchMode(PDO::FETCH_ASSOC);
            $row_em = $q_em->fetch();
            $admin_email = $row_em['admin_email'];

            $username = $fname . ' ' . $lname;
            $to = $email ;
//        $subject = 'Sign Up in RASA GALLERY of <strong>' . $fname . ' ' . $lname . '</strong>';
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


            $get_mail = get_particular_email('Customer Registration');
            $cf = html_entity_decode($get_mail['content']);
            $sub = $get_mail['subject'];
            $subject = str_replace(array('{name}'), array($username), $sub);
            $message = str_replace(array('{name}', '{customer_email}', '{password}'), array($username, $email, $pass), $cf);
            
            
            
            
            $get_mail2 = get_particular_email('new-registration-admin');
            $cf2 = html_entity_decode($get_mail2['content']);
            $sub2 = $get_mail2['subject'];
            $subject2 = str_replace(array('{name}'), array($username), $sub2);
            $message2 = str_replace(array('{name}', '{customer_email}', ), array($username, $email), $cf2);
            
            

            //$emailname = 'RASAGALLERY';


            $emailname = 'Gallery Rasa <info@galleryrasa.com>';
            //$nameform = 'RASAGALLERY <galleryrasa@gmail.com>';
            $nameform = '';
            send_mail($to, $subject, $message, $emailname, $nameform);
            //send_mail($to, $subject, $message, 'info@galleryrasa.net', $emailname);
            
            
            $to2 =  $admin_email;
            send_mail($to2, $subject2, $message2, $emailname, $nameform);
            
            

            $qry_mail = "insert into email_log(id,email,email_name,subject,text,date) "
                    . "values('','$to','Customer Registration','$subject','$message','$reg_date')";
            $q_mail = $conn->prepare($qry_mail);
            $q_mail->execute();

            $_SESSION['reg-success'] = "Successfully Registered. Please check your email for password.";
            goto_location('login-register.php');
        } catch (PDOException $pe) {
            $err = true;
            $_SESSION['reg-error'] = $er = db_error($pe->getMessage());
            goto_location('login-register.php');
        }
    } else {
        $_SESSION['reg-error'] = 'User already exists';
        goto_location('login-register.php');
    }
}
