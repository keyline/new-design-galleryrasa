<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $prod_id = $_POST['prod_id'];
    $vdo_link = $_POST['vdo_link'];
    $updt_date = date("Y-m-d H:i:s");
    
    
    $sql_p = "SELECT * from video where product_id = '$prod_id'";
    $q_p = $conn->prepare($sql_p);
    $q_p->execute();
    $q_p->setFetchMode(PDO::FETCH_ASSOC);
    $count_p = $q_p->rowCount();
    $row = $q_p->fetch();


    if ($count_p > 0) {


        $qry1 = "update video set video_link = '$vdo_link', update_date = '$updt_date' "
                . "where product_id = '$prod_id'";

        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pr-vdo'] = 'Video is Updated';
        goto_location('video.php?prod_id=' . $prod_id);
    } else {

        $qry1 = "INSERT INTO video(id, product_id, video_link, update_date"
            . " ) VALUES('', '$prod_id', '$vdo_link', '$updt_date')";
    

        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-pr-vdo'] = 'Video is Updated';
        goto_location('video.php?prod_id=' . $prod_id);
    }

    // }
}