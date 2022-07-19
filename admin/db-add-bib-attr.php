<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
$conn = dbconnect();
//if(isset($_POST['edit_value'])){


$attr_id = $_POST['attrid'];
$attrval = $_POST['attrval'];
//$qry_sel = "insert into attribute_value_ecomc(attr_id,value) values('" . $attr_id . "','" . $attrval . "')";
//
//$q_sel = $conn->prepare($qry_sel);
//$q_sel->execute();



$query1 = "insert into attribute_value_ecomc(attr_id,value) values(:attr_id,:attrval)";
$bind1 = array(':attr_id' => $attr_id, ':attrval' => $attrval);
$stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
$stmt1->execute($bind1);

//}
$_SESSION['succes-add'] = "Added Successfully";


goto_location('bib-list-attr-value.php?attr_id=' . $attr_id);
