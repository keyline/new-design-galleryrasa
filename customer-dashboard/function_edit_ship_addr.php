<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
//check_auth_user();
$conn = dbconnect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $ship_addr_id = $_POST['ship_addr_id'];
    $ship_cust_name = $_POST['ship_cust_name'];
    $ship_cust_phone = $_POST['ship_cust_phone'];
    $ship_street_address = $_POST['ship_street_address'];
    $ship_city = $_POST['ship_city'];
    $ship_state = $_POST['ship_state'];
    $ship_country = $_POST['ship_country'];
    $ship_zip = $_POST['ship_zip'];
    $ship_landmark = $_POST['ship_landmark'];
       
    $qry1 = "update customer_address set name = '$ship_cust_name',phone = '$ship_cust_phone',street_address = '$ship_street_address',city = '$ship_city',state = '$ship_state',country = '$ship_country',zip = '$ship_zip',landmark = '$ship_landmark' "
                . "where id = '$ship_addr_id'";
    //exit;
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-addr'] = 'Your Address is Updated.';
        goto_location('cust-address');
}