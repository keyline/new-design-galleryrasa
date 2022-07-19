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

/**
@date 06/04/2020
@author Shuvadeep
@reason New Update query where product_name is wrong  and edited by Site admin but chnages only reflected in products_ecomc table
		not on product_attribute_value table
		
*/
$sql="UPDATE attribute_value_ecomc T2 , products_ecomc T1 INNER JOIN (SELECT * FROM product_attribute_value pav INNER JOIN attribute_value_ecomc av ON pav.attribute_value_id=av.attr_value_id
WHERE pav.product_id=:prod_id) AS res
ON T1.prodid=res.product_id
SET T1.prodname=:new_name_t1,
T2.value=:new_name_t2
WHERE res.value = :old_name
AND
T2.attr_value_id=res.attr_value_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
$stmt->bindParam(':new_name_t1', $prod_name, PDO::PARAM_STR);
$stmt->bindParam(':new_name_t2', $prod_name, PDO::PARAM_STR);
$stmt->bindParam(':old_name', $old_prod, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() > 0)
{
		$stmt=null;
		$_SESSION['succes-edit-prod'] = "Edited Successfully";
		goto_location('edit-bib-product-name.php?prod_id=' . $prod_id);
}else
{	
		$_SESSION['succes-edit-prod'] = "Edited Failed, Please try again!!";
		goto_location('edit-bib-product-name.php?prod_id=' . $prod_id);
}

//$sql = "select ave.* from attribute_value_ecomc ave where ave.attr_id = '65' and ave.value = '$old_prod '";
//$q = $conn->prepare($sql);
//$q->execute();
//$q->setFetchMode(PDO::FETCH_ASSOC);
//$count = $q->rowCount();
//$row = $q->fetch();
//
//$attr_value_id = $row['attr_value_id'];
//$value = $row['value'];



/**
Old Code turned off due to update not carried out on product_attribute_value table therefore
diffrent values are during search and seemore
*/
//$qry_updt1 = "update products_ecomc set prodname = '$prod_name' where prodid = '$prod_id'";
//$q_updt1 = $conn->prepare($qry_updt1);
//$q_updt1->execute();


//$qry_updt2 = "update attribute_value_ecomc set value = '$prod_name' where attr_value_id = '$attr_value_id'";
//
//$q_updt2 = $conn->prepare($qry_updt2);
//$q_updt2->execute();
//}

