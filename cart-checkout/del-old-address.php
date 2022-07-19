<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");   
        
        
$conn = dbconnect();

$cust_addr = $_POST['del_addr_id'];

if(isset($_SESSION['sel_old_addr'])){
    if($_SESSION['sel_old_addr'] == $cust_addr){
        unset($_SESSION['sel_old_addr']);
    }
}

$qry1 = "delete from customer_address WHERE `id`='$cust_addr'";
//exit;
$q1 = $conn->prepare($qry1);
$q1->execute();



echo 'Address is deleted';