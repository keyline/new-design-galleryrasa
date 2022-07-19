<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $set_id = $_POST['set_id'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if ($_POST['old_pass'] != $_POST['pass']) {
        $pass_hash = crypt($pass, PASSWRD_SALT);
    } else {
        $pass_hash = $_POST['old_pass'];
    }

    $email = $_POST['email'];
    $tax = $_POST['tax'];
    $conv_rate = $_POST['conv_rate'];
    $website_name = $_POST['website_name'];
    
    $credit_dayspan = $_POST['credit_dayspan'];
    $credit_value = $_POST['credit_value'];
    
    $max_download_mail_send = $_POST['max_download_mail_send'];

    $keyword = $_POST['keyword'];
    $description = $_POST['description'];
    $arc_anim = $_POST['arc_anim'];

    $original_nm_photo = $_FILES['logo']['name'];
    
    $allowedexts = array("JPEG", "JPG", "PNG", "jpeg", "jpg", "png", "GIF", "gif");
    $document_path = realpath(__DIR__ . '/..') . 'images/';
    $extension = explode(".", $original_nm_photo);
    $exts = end($extension);
    $move_status = false;
    //$default_logo = 'default-logo.png';


    $qry_sel = "select * from admin_ecomc where id = '$set_id'";
    
    $q_sel = $conn->prepare($qry_sel);
    $q_sel->execute();
    $q_sel->setFetchMode(PDO::FETCH_ASSOC);
    $row_sel = $q_sel->fetch();
    $default_logo = $row_sel['logo'];


    if (($_FILES['logo']['size'] < 500000000) && in_array($exts, $allowedexts)) {
        $newname = date('d-m-y') . "_" . time() . "." . $exts;
        $destination = $document_path . $newname;
        $move_status = move_uploaded_file($_FILES['logo']['tmp_name'], $destination);
        $logo = $newname;
    }
    $logo = $move_status == TRUE ? $logo : $default_logo;



    $qry1 = "update admin_ecomc set user = '$user', pass = '$pass_hash', email = '$email', tax = '$tax', "
            . "conv_rate = '$conv_rate', website_name = '$website_name',logo = '$logo',arc_anim = '$arc_anim',"
            . "credit_dayspan = '$credit_dayspan',credit_value = '$credit_value', max_download_mail_send = '$max_download_mail_send', "
            . "keyword = '$keyword',description = '$description' "
            . "where id = '$set_id'";
    
    $q1 = $conn->prepare($qry1);
    $q1->execute();
    $_SESSION['succ-pass'] = 'User Information is Updated';
    
    goto_location('edit-Setting.php');
    
}