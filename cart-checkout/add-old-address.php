<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");   
        
        
$conn = dbconnect();

$_SESSION['sel_old_addr'] = $cust_addr = $_POST['addr_id'];

$addr_array = get_user_addr($cust_addr);

 $address =   "<strong>Chosen Shipping Address:</strong>".
             "<br>Name: ".$addr_array['name'].
             "<br>Phone: ".$addr_array['phone'].
             "<br>Address: ".$addr_array['street_address'].
             "<br>City: ".$addr_array['city'].
             "<br>State: ". $addr_array['state'].
             "<br>Country: ".$addr_array['country'].
             "<br>Zip: ".$addr_array['zip']. 
             "<br>Landmark: ".$addr_array['landmark']; 
 
 echo $address;