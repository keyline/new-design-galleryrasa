<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$prod_id = $_GET['prod_id'];
$prod_name = $_GET['prod_name'];




//Deleting Attribute Value (Film) from attribute Value Table
/**
$qry_del2 = "delete from attribute_value_ecomc where value = '$prod_name'";
$q_del2 = $conn->prepare($qry_del2);
$q_del2->execute();
 * 
 */
try{
    $qry_del1 = "delete from products_ecomc where prodid = '$prod_id'";
    $q_del1 = $conn->prepare($qry_del1);
    $q_del1->execute();
    
    $qry2 = "SELECT
                attr_common_flds_ecomc.attribute_name,
                attribute_value_ecomc.`value`,
                attr_common_flds_ecomc.id,
                attr_common_flds_ecomc.name_alias,
                attribute_value_ecomc.attr_value_id,
                product_attribute_value.attribute_value_id,
                products_ecomc.prodid
                FROM
                attr_common_flds_ecomc
                INNER JOIN attribute_value_ecomc ON attribute_value_ecomc.attr_id = attr_common_flds_ecomc.id
                INNER JOIN product_attribute_value ON product_attribute_value.attribute_value_id = attribute_value_ecomc.attr_value_id
                INNER JOIN products_ecomc ON product_attribute_value.product_id = products_ecomc.prodid
                WHERE attr_id IN (65,67,79) AND prodid = :prodID
                ";
            $q = $conn->prepare($qry2);
            $q->bindParam(':prodID', $prod_id, PDO::PARAM_INT);
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $count = $q->rowCount();
if($count > 0){
    
    while($row = $q->fetch()){
        
        $delValues[] = $row['attr_value_id'];
        
    }
    
}

$q = $conn->prepare("DELETE FROM `attribute_value_ecomc` WHERE `attr_value_id`= ?");

foreach ($delValues as $pdel){
    
    $q->execute($pdel);
    
}

$qry_del3 = "delete from product_attribute_value where product_id = '$prod_id'";
$q_del3 = $conn->prepare($qry_del3);
$q_del3->execute();
    
}catch(PDOException $pe){
    
    echo db_error($pe->getMessage());
}



$_SESSION['succes-del-val'] = "Artwork is deleted Successfully";
goto_location('visual-archive');
