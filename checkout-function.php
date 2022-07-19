<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$street_address = $_POST['street_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$zip = $_POST['zip'];
$landmark = $_POST['landmark'];
$order_note = $_POST['order_note'];
$total = $_POST['total'];

$order_date = date("Y-m-d H:i:s");

$qry1 = "insert into customer_details(id,fname,lname,phone,email,address,city,state,country,zip,landmark) "
        . "values('','$fname','$lname','$phone','$email','$street_address','$city','$state','$country','$zip','$landmark')";
//exit;
$q1 = $conn->prepare($qry1);
$q1->execute();

$qry2 = "insert into tbl_order(order_id,customer_id,note,price,status,date) "
        . "values('','','$order_note','$total','Order is Placed','$order_date')";
$q2 = $conn->prepare($qry2);
$q2->execute();

$qry_sel = "SELECT max(order_id) max_id from tbl_order";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
$ord_id = $row_sel['max_id'];


foreach ($_SESSION["cart_item"] as $item) {

    $product_id = $item["product_id"];
    $image_id = $item["image_id"];
    $quantity = $item["quantity"];
    $price = $item["price"];
    $type = $item["type"];

    $qry3 = "insert into order_products(id,order_id,customer_id,product_id,image_id,quantity,price,details) "
            . "values('','$ord_id','','$product_id','$image_id','$quantity','$price','$type')";
    $q3 = $conn->prepare($qry3);
    $q3->execute();
}

unset($_SESSION["cart_item"]);

goto_location('success-payment');