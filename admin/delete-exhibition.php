<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();


$exhibition_id = $_GET['id'];

//echo $exhibition_id;die;

try {
    $conn = dbconnect();
    $err = false;
    $query1 = "DELETE FROM `exhibition` WHERE id= ". $exhibition_id."";
    $q = $conn->prepare($query1);
    $result=$q->execute();
    if($result) {
        $_SESSION['succ'] = "Exhibition is deleted successfully";
        goto_location("exhibition-list.php");
    } else {
        $_SESSION['fail'] = "Exhibition is not deleted";
        goto_location("exhibition-list.php");
    }
} catch (PDOException $pe) {
    $err = true;
    $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
    $_SESSION['fail'] = $er;
    goto_location("exhibition-list.php");
}

//echo "Hello";
?>