<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


$press_id = $_GET['img_id'];

// echo $press_id;die;

try {
    $conn = dbconnect();
    $err = false;
    $query1 = "DELETE FROM `press_img` WHERE img_id= ". $press_id."";
    $q = $conn->prepare($query1);
    $result=$q->execute();
    if($result) {
        $_SESSION['succ'] = "Photo is deleted successfully";
        goto_location("press_listing.php");
    } else {
        $_SESSION['fail'] = "Press is not edited";
        goto_location("press_listing.php");
    }
} catch (PDOException $pe) {
    $err = true;
    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
    $_SESSION['fail'] = $er;
    goto_location("press_listing.php");
}