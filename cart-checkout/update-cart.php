<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
// print '<pre>';
// print_r($_POST);
// exit;
$apiStatus = TRUE;
$apiMessage = '';
$apiResponse = [];

$cart_id = $_POST['cart_id'];
$qty = $_POST['qty'];

$conn       = dbconnect();
$qry_sel    = "select * from cart where id = '$cart_id'";
$q_sel      = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel    = $q_sel->fetch();
//echo '<pre>';print_r($row_sel);die;
$productPrice   = (($row_sel)?$row_sel['price']:0.00);
$subtotal       = $productPrice*$qty;

if($qty>=1){
    $sql            = "update cart set quantity = '$qty',subtotal = '$subtotal'  WHERE `id`='$cart_id'";
} else {
    $sql            = "DELETE FROM `cart` WHERE `id`='$cart_id'";
}
$q1             = $conn->prepare($sql);
$q1->execute();

$apiStatus      = TRUE;
$apiMessage     = 'Cart Updated Successfully !!!';
$apiResponse    = ['cart_id' => $cart_id, 'qty' => $qty, 'subtotal' => $subtotal];
$data           = array('status' => $apiStatus, 'message' => $apiMessage, 'response' => $apiResponse);
header('Content-Type: application/json');
echo json_encode($data);

// if (!empty($_SESSION["cart_item"])) {
//     $_SESSION["cart_item"][$_POST['count']]['quantity'] = $_POST['edit_quantity'];
// } else {
//     $cart_id = $_POST['cart_id'];
//     $edit_quantity = $_POST['edit_quantity'];
//     $qry1 = "update cart set quantity = '$edit_quantity'  WHERE `id`='$cart_id'";

//     $q1 = $conn->prepare($qry1);
//     $q1->execute();
// }
// goto_location('cart.php');