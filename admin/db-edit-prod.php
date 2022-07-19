<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
$conn = dbconnect();
//if(isset($_POST['edit_value'])){
$prod_id = $_POST['prod_id'];
//$attr_id = $_POST['attr_id'];
$prod_name = $_POST['prod_name'];


$sql1 = "select * from products_ecomc where prodid = '$prod_id'";

$q1 = $conn->prepare($sql1);
$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$count1 = $q1->rowCount();
$row1 = $q1->fetch();

$old_prod = $row1['prodname'];


//$sql = "select ave.* from attribute_value_ecomc ave where ave.attr_id = '65' and ave.value = '$old_prod '";

$sql = "select ave.* from attribute_value_ecomc ave,products_ecomc pe 
where 
pe.prodname = ave.value and  
pe.prodid = '$prod_id' and 
ave.attr_id = '65'";

$q = $conn->prepare($sql);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);
$count = $q->rowCount();
$row = $q->fetch();

$attr_value_id = $row['attr_value_id'];
$value = $row['value'];




//$qry_updt1 = "update products_ecomc set prodname = '$prod_name' where prodid = '$prod_id'";
//$q_updt1 = $conn->prepare($qry_updt1);
//$q_updt1->execute();



$query1 = "update products_ecomc set prodname = :prodname where prodid = :prodid";
$bind1 = array(':prodname' => $prod_name, ':prodid' => $prod_id);
$stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
$stmt1->execute($bind1);
//if($stmt1->execute($bind1)==true){
//    echo 'success';
//}else{
//    echo 'fail';
//}
//exit;
//$qry_updt2 = "update attribute_value_ecomc set value = '$prod_name' where attr_value_id = '$attr_value_id'";
//$q_updt2 = $conn->prepare($qry_updt2);
//$q_updt2->execute();



$query2 = "update attribute_value_ecomc set value = :prodname where attr_value_id = :attr_value_id";
$bind2 = array(':prodname' => $prod_name, ':attr_value_id' => $attr_value_id);
$stmt2 = $conn->prepare($query2);
//echo PdoDebugger::show($query2, $bind2);
$stmt2->execute($bind2);





//}
$_SESSION['succes-edit-prod'] = "Edited Successfully";


if (isset($_POST['type']) && $_POST['type'] == 'va') {
    $type = $_POST['type'];
    goto_location('edit-product-name.php?prod_id=' . $prod_id . '&type=' . $type);
} else {
    goto_location('edit-product-name.php?prod_id=' . $prod_id);
}
