<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
//if(isset($_POST['edit_value'])){
$type = $_POST['type'];
$prod_id = $_POST['prod_id'];
$attr_val = $_POST['attr_val'];
$all_values = $_POST['all_values'];

$val_arr = explode(',',$all_values);

//var_dump($val_arr);
//exit;
if(in_array($attr_val, $val_arr)) {

$_SESSION['succes-add-val-fail'] = "Attribute value already exists";
goto_location('add-delete-attribute.php?prod_id='.$prod_id);
} else {
//$value_name = $_POST['value_name'];
$qry_inst = "insert into product_attribute_value(product_attr_val_id,product_id,attribute_value_id,independent_values,sequence) "
        . "values('','$prod_id','$attr_val','','')";

$q_inst = $conn->prepare($qry_inst);
$q_inst->execute();

//}

$_SESSION['succes-add-val'] = "Attribute value inserted Successfully";



if (isset($_POST['type']) && $_POST['type'] == 'va') {
    $type = $_POST['type'];
    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
} else if ($_POST['type'] == 'bib') {

    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
} else {
    goto_location('add-delete-attribute.php?prod_id=' . $prod_id);
}





//goto_location('add-delete-attribute.php?prod_id='.$prod_id);
}