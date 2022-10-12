<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


$artwork_id = $_GET['id'];
$exibition_id = $_GET['exibition_id'];

  // echo $exibition_id;die;

try {
    $conn = dbconnect();
    $err = false;
    $query1 = "DELETE FROM `exhibition_paintings` WHERE id= ". $artwork_id."";
    $q = $conn->prepare($query1);
    $result=$q->execute();
    if($result) {
        $_SESSION['succ'] = "Artwork is deleted successfully";
        goto_location("exhibition-paintings.php?exibition_id=" . $exibition_id);
    } else {
        $_SESSION['fail'] = "Artwork is not deleted";
        goto_location("exhibition-paintings.php?exibition_id=" . $exibition_id);
    }
} catch (PDOException $pe) {
    $err = true;
    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
    $_SESSION['fail'] = $er;
    goto_location("exhibition-paintings.php?exibition_id=" . $exibition_id);
}