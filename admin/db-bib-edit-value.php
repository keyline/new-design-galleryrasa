<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
//if(isset($_POST['edit_value'])){
$value_id = $_POST['value_id'];
$attr_id = $_POST['attr_id'];
$value_name = $_POST['value_name'];
$qry_sel = "update attribute_value_ecomc set value = '$value_name' where attr_value_id = '$value_id'";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();

//}
$_SESSION['succes-edit'] = "Edited Successfully";
goto_location('edit-bib-value.php?att_id='.$attr_id.'&attr_value_id='.$value_id);