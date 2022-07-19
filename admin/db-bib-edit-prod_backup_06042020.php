<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
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
//$q = $conn->prepare($sql);
//$q->execute();
//$q->setFetchMode(PDO::FETCH_ASSOC);
//$count = $q->rowCount();
//$row = $q->fetch();
//
//$attr_value_id = $row['attr_value_id'];
//$value = $row['value'];




$qry_updt1 = "update products_ecomc set prodname = '$prod_name' where prodid = '$prod_id'";
$q_updt1 = $conn->prepare($qry_updt1);
$q_updt1->execute();


//$qry_updt2 = "update attribute_value_ecomc set value = '$prod_name' where attr_value_id = '$attr_value_id'";
//
//$q_updt2 = $conn->prepare($qry_updt2);
//$q_updt2->execute();
//}
$_SESSION['succes-edit-prod'] = "Edited Successfully";
goto_location('edit-bib-product-name.php?prod_id=' . $prod_id);
