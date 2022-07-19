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
    $details = $_POST['details'];
    $details = trim($_POST['details']);
    $details = htmlentities($details);
    $dob = $_POST['dob'];
    $dod = $_POST['dod'];
    
    $updt_date = date("Y-m-d H:i:s");
    $sql_p = "SELECT * from profile where person_id = '$people_id'";
    $q_p = $conn->prepare($sql_p);
    $q_p->execute();
    $q_p->setFetchMode(PDO::FETCH_ASSOC);
    $count_p = $q_p->rowCount();
    $row = $q_p->fetch();


    if ($count_p > 0) {


        $qry1 = "update profile set details = '$details', dob = '$dob', dod = '$dod',last_update = '$updt_date' "
                . "where person_id = '$people_id'";

        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pr-image'] = 'Profile Information is Updated';
        goto_location('add-profile-desc.php?people_id=' . $people_id);
    } else {

        $qry1 = "INSERT INTO profile(id, person_id, image, details, dob, dod, last_update"
            . " ) VALUES('', '$people_id', '', '$details', '$dob', '$dod', '$updt_date')";
    

        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pr-image'] = 'Profile Image is Updated';
        goto_location('add-profile-desc.php?people_id=' . $people_id);
    }

    // }
}