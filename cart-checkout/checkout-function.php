<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
$cust_id = $_SESSION['user-id'];

//$fname = $_POST['fname'];
//$lname = $_POST['lname'];
//$phone = $_POST['phone'];
$email = $_POST['email'];
$street_address = $_POST['street_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$zip = $_POST['zip'];
$landmark = $_POST['landmark'];
//$order_note = $_POST['order_note'];
//$total = $_POST['total'];

$order_date = date("Y-m-d H:i:s");

if ($_POST['country'] == '') {
    $_SESSION['ship_error'] = "Billing address is not entered properly.";
    goto_location('checkout.php');
    exit;
}

if (!isset($_SESSION['bill_addr_exist'])) {

    $bill_addr_Array = array('street_address' => $street_address, 'city' => $city, 'state' => $state, 'country' => $country, 'zip' => $zip, 'landmark' => $landmark, 'parent_id' => '0');
    $_SESSION["bill_address"] = $bill_addr_Array;


    if (isset($_POST['ship_street_address'])) {
        $ship_cust_name = $_POST['ship_cust_name'];
        $ship_cust_phone = $_POST['ship_cust_phone'];
        $ship_street_address = $_POST['ship_street_address'];
        $ship_city = $_POST['ship_city'];
        $ship_state = $_POST['ship_state'];
        $ship_country = $_POST['ship_country'];
        $ship_zip = $_POST['ship_zip'];
        $ship_landmark = $_POST['ship_landmark'];

        $ship_addr_Array = array('ship_cust_name' => $ship_cust_name, 'ship_cust_phone' => $ship_cust_phone, 'ship_street_address' => $ship_street_address, 'ship_city' => $ship_city, 'ship_state' => $ship_state, 'ship_country' => $ship_country, 'ship_zip' => $ship_zip, 'ship_landmark' => $ship_landmark, 'ship_parent_id' => '0');
        $_SESSION["ship_address"] = $ship_addr_Array;
    }
} else {

    $bill_addr_Array = array('street_address' => $street_address, 'city' => $city, 'state' => $state, 'country' => $country, 'zip' => $zip, 'landmark' => $landmark, 'parent_id' => '0');
    $_SESSION["bill_address"] = $bill_addr_Array;



    if (isset($_SESSION['sel_old_addr'])) {
        $cust_addr = $_SESSION['sel_old_addr'];
        $addr_array = get_user_addr($cust_addr);

        $ship_cust_name = $addr_array['name'];
        $ship_cust_phone = $addr_array['phone'];
        $ship_street_address = $addr_array['street_address'];
        $ship_city = $addr_array['city'];
        $ship_state = $addr_array['state'];
        $ship_country = $addr_array['country'];
        $ship_zip = $addr_array['zip'];
        $ship_landmark = $addr_array['landmark'];

        $ship_addr_Array = array('ship_cust_name' => $ship_cust_name, 'ship_cust_phone' => $ship_cust_phone, 'ship_street_address' => $ship_street_address, 'ship_city' => $ship_city, 'ship_state' => $ship_state, 'ship_country' => $ship_country, 'ship_zip' => $ship_zip, 'ship_landmark' => $ship_landmark, 'ship_parent_id' => '0');
        $_SESSION["ship_address"] = $ship_addr_Array;
        //print_r($_SESSION["ship_address"]);
    }

    if (trim($_POST['ship_street_address']) != '') {

        $ship_cust_name = $_POST['ship_cust_name'];
        $ship_cust_phone = $_POST['ship_cust_phone'];
        $ship_street_address = $_POST['ship_street_address'];
        $ship_city = $_POST['ship_city'];
        $ship_state = $_POST['ship_state'];
        $ship_country = $_POST['ship_country'];
        $ship_zip = $_POST['ship_zip'];
        $ship_landmark = $_POST['ship_landmark'];

        $ship_addr_Array = array('ship_cust_name' => $ship_cust_name, 'ship_cust_phone' => $ship_cust_phone, 'ship_street_address' => $ship_street_address, 'ship_city' => $ship_city, 'ship_state' => $ship_state, 'ship_country' => $ship_country, 'ship_zip' => $ship_zip, 'ship_landmark' => $ship_landmark, 'ship_parent_id' => '0');
        $_SESSION["ship_address"] = $ship_addr_Array;
    }
}

//print_r($_SESSION["ship_address"]);
//exit;
if (isset($_SESSION["ship_address"])) {
    $filter_ship_array = array_filter($_SESSION["ship_address"]);
    if (!empty($filter_ship_array)) {
//    echo count($filter_ship_array);
//    var_dump($filter_ship_array);
        $add_name = trim($_SESSION["ship_address"]['ship_cust_name']);
        $add_phn = trim($_SESSION["ship_address"]['ship_cust_phone']);
        $addr = trim($_SESSION["ship_address"]['ship_street_address']);
        $add_city = trim($_SESSION["ship_address"]['ship_city']);
        $add_state = trim($_SESSION["ship_address"]['ship_state']);
        $add_country = trim($_SESSION["ship_address"]['ship_country']);
        $add_zip = trim($_SESSION["ship_address"]['ship_zip']);
        //exit;

        if (($add_name == '') || ($add_phn == '') || ($addr == '') || ($add_city == '') || ($add_state == '') || ($add_country == '') || ($add_zip == '')) {


            $_SESSION['ship_error'] = "Shipping address is not entered properly.";
            goto_location('checkout.php');
            exit;
        }
    }
}



goto_location('gateway.php');
