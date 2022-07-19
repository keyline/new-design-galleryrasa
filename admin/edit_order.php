<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    print "<pre>";
//    print_r($_REQUEST);
//} else {
$order_id = $_GET['ord_id'];
try {
    $sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name,c_add.name ship_cust_name,c_add.phone ship_cust_phone,c_add.street_address,c_add.city,c_add.state,c_add.country,c_add.zip,c_add.landmark,c_add.parent_id from "
            . "tbl_order ord,customer_login cust,gateway,customer_address c_add"
            . " where ord.customer_id=cust.id and ord.gateway_id=gateway.id and ord.address_id=c_add.id and ord.order_id = '$order_id' order by ord.order_id desc";
    $q = $conn->prepare($sql);
    //$category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    $row = $q->fetch();

//        while ($row = $q->fetch()) {
//            $order_list[] = array(
    $order_id = $row['order_id'];
    $order_org_id = $row['order_org_id'];
    $customer_id = $row['customer_id'];
    $gateway_id = $row['gateway_id'];
    $address_id = $row['address_id'];
    $note = $row['note'];
    $price = $row['price'];
    
    $order_date = $row['date'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $gateway_name = $row['gateway_name'];
    $ship_cust_name = $row['ship_cust_name'];
    $ship_cust_phone = $row['ship_cust_phone'];
    $street_address = $row['street_address'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $zip = $row['zip'];
    $landmark = $row['landmark'];
    $parent_id = $row['parent_id'];
//            );
//        }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . 'edit-order-list-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");
//}