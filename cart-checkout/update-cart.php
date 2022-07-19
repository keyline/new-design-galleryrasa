<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
//print '<pre>';
//print_r($_POST);
//exit;

$conn = dbconnect();



if (!empty($_SESSION["cart_item"])) {
    $_SESSION["cart_item"][$_POST['count']]['quantity'] = $_POST['edit_quantity'];
} else {
    $cart_id = $_POST['cart_id'];
    $edit_quantity = $_POST['edit_quantity'];
    $qry1 = "update cart set quantity = '$edit_quantity'  WHERE `id`='$cart_id'";

    $q1 = $conn->prepare($qry1);
    $q1->execute();
}




goto_location('cart.php');
