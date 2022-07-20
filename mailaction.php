<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "functionsInc.php");
if(isset($_POST['submit'])){
    if(isset($_SERVER['HTTP_REFERER'])) {
    $refer=  $_SERVER['HTTP_REFERER'];
}
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        unset($_SESSION['mailchimpMsg']);
        unset($_SESSION['mailchimpStatus']);
        // MailChimp API credentials
        $apiKey = 'e52bf2cb68f6be99e9e1a9a004fc3d79-us17';
        $listID = '21f750aeb2';
        
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
        
        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => $fname,
                'LNAME'     => $lname
            ]
        ]);
        
        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // store the status message based on response code
        if ($httpCode == 200) {
            $_SESSION['mailchimpMsg'] = '<p style="color: #34A853">You have successfully subscribed to Gallery Rasa.</p>';
            $_SESSION['mailchimpStatus'] = true;
        } else {
            switch ($httpCode) {
                case 214:
                    $msg = 'You are already subscribed.';
                    break;
                default:
                    $msg = 'Some problem occurred, please try again.';
                    break;
            }
            $_SESSION['mailchimpMsg'] = '<p style="color: #EA4335">'.$msg.'</p>';
            $_SESSION['mailchimpStatus'] = true;
        }
    }else{
        $_SESSION['mailchimpMsg'] = '<p style="color: #EA4335">Please enter valid email address.</p>';
        $_SESSION['mailchimpStatus'] = true;
    }
    
    goto_location($refer);
}