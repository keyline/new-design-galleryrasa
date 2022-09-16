<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


$photo_id = $_GET['photo_id'];

// echo $photo_id;die;

try {
    $conn = dbconnect();
    $err = false;
    $query1 = "DELETE FROM `photobook_img` WHERE photo_id= ". $photo_id."";
    $q = $conn->prepare($query1);
    $result=$q->execute();
    if($result) {
        $_SESSION['succ'] = "Photo is deleted successfully";
        goto_location("photobook_listing.php");
    } else {
        $_SESSION['fail'] = "Press is not edited";
        goto_location("photobook_listing.php");
    }
} catch (PDOException $pe) {
    $err = true;
    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
    $_SESSION['fail'] = $er;
    goto_location("photobook_listing.php");
}