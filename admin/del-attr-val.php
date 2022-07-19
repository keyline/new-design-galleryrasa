<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$prod_id = $_GET['prod_id'];
$attr_val_id = $_GET['attr_val_id'];


$qry_del = "delete from product_attribute_value where product_id = '$prod_id' and attribute_value_id = '$attr_val_id'";

$q_del = $conn->prepare($qry_del);
$q_del->execute();


$_SESSION['succes-del-val'] = "Attribute value deleted Successfully";


if (isset($_POST['type']) && $_POST['type'] == 'va') {
    $type = $_POST['type'];
    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
} else if ($_POST['type'] == 'bib') {

    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
} else {
    goto_location('add-delete-attribute.php?prod_id=' . $prod_id);
}





