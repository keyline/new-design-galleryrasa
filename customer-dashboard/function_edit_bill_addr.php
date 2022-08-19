<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
//check_auth_user();
$conn = dbconnect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $addr_id = $_POST['addr_id'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];
    $landmark = $_POST['landmark'];
       
    $qry1 = "update customer_address set street_address = '$street_address',city = '$city',state = '$state',country = '$country',zip = '$zip',landmark = '$landmark' "
                . "where id = '$addr_id'";
    //exit;
        $q1 = $conn->prepare($qry1);
        $q1->execute();
        $_SESSION['succ-addr'] = 'Your Address is Updated.';
        goto_location('customer-dashboard');
}