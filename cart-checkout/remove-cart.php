<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
//            print '<pre>';
//            var_dump($_SESSION["cart_item"]);
//        exit;
if (!empty($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $k => $v) {
        if ($_GET["count"] == $k)
            unset($_SESSION["cart_item"][$k]);
        if (empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
    }
} else{
    $cart_id = $_GET["count_id"];
    $qry1 = "delete from cart WHERE `id`='$cart_id'";
//exit;
$q1 = $conn->prepare($qry1);
$q1->execute();
}
goto_location('cart.php');
