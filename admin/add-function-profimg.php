<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $profile_id = $_POST['profile_id'];
    $people_id = $_POST['person_id'];
    //$p_image = $_POST['p_image'];
    $updt_date = date("Y-m-d H:i:s");
    $sql_p = "SELECT * from profile where person_id = '$people_id'";
    $q_p = $conn->prepare($sql_p);
    $q_p->execute();
    $q_p->setFetchMode(PDO::FETCH_ASSOC);
    $count_p = $q_p->rowCount();
    $row = $q_p->fetch();


    if ($count_p > 0) {


        $original_nm_photo = $_FILES['p_image']['name'];

        $allowedexts = array("JPEG", "JPG", "PNG", "jpeg", "jpg", "png", "GIF", "gif");
        $document_path = realpath(__DIR__ . '/..') . 'product_images/profile/';
        $extension = explode(".", $original_nm_photo);
        $exts = end($extension);
        $move_status = false;
        //$default_logo = 'default-logo.png';


        $qry_sel = "select * from profile where person_id = '$people_id'";

        $q_sel = $conn->prepare($qry_sel);
        $q_sel->execute();
        $q_sel->setFetchMode(PDO::FETCH_ASSOC);
        $row_sel = $q_sel->fetch();
        $default_image = $row_sel['image'];

        if (($_FILES['p_image']['size'] < 500000000) && in_array($exts, $allowedexts)) {
            $newname = date('d-m-y') . "_" . time() . "." . $exts;
            $destination = $document_path . $newname;
            $move_status = move_uploaded_file($_FILES['p_image']['tmp_name'], $destination);
            $logo = $newname;
        }
        $logo = $move_status == TRUE ? $logo : $default_image;



        $qry1 = "update profile set image = '$logo', last_update = '$updt_date' "
                . "where person_id = '$people_id'";

        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pr-image'] = 'Profile Image is Updated';
        goto_location('add-profile-image.php?people_id=' . $people_id);
    } else {

        $original_nm_photo = $_FILES['p_image']['name'];
        $allowedexts = array("JPEG", "JPG", "PNG", "jpeg", "jpg", "png", "GIF", "gif", "pdf", "PDF");
        $document_path = realpath(__DIR__ . '/../..') . 'product_images/profile/';
        $extension = explode(".", $original_nm_photo);
        $exts = end($extension);
        $move_status = false;
        $default_logo = '';
        if (($_FILES['p_image']['size'] < 500000000) && in_array($exts, $allowedexts)) {
            $newname = date('d-m-y') . "_" . time() . "." . $exts;
            $destination = $document_path . $newname;
            $move_status = move_uploaded_file($_FILES['p_image']['tmp_name'], $destination);
            $page_image = $newname;
        }
        $page_image = $move_status == TRUE ? $page_image : $default_logo;


        $qry1 = "INSERT INTO profile(id, person_id, image, details, dob, dod, last_update"
            . " ) VALUES('', '$people_id', '$page_image', '', '', '', '$updt_date')";
    

        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pr-image'] = 'Profile Image is Updated';
        goto_location('add-profile-image.php?people_id=' . $people_id);
    }

    // }
}