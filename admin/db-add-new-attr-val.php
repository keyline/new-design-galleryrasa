<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
$conn = dbconnect();

$type = $_POST['type'];
$prod_id = $_POST['prod_id'];
$alias = $_POST['alias'];
$attribute_id = $_POST['attribute_id'];

$addflag = false;

if (isset($_POST['attrvalselect'])) {
    $attrval = $_POST['attrvaltext'];
} else {

    $attrval = $_POST['attrval'];
}




if (empty($_POST)) {
    $_SESSION['fail'] = "Enter Attribute Value";
    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
} else {


    if (isset($_POST['attrvalselect'])) {

        
        if ($_POST['attrvalselect'] == 'new_val') {
          
            $query1 = "insert into attribute_value_ecomc(attr_id,value) values(:attr_id,:attrval)";
            $bind1 = array(':attr_id' => $attribute_id, ':attrval' => $attrval);
            $stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
            if ($stmt1->execute($bind1)) {
                $addflag = true;
            }



            $query2 = "select * from attribute_value_ecomc where attr_value_id="
                    . "(SELECT max(attr_value_id) FROM attribute_value_ecomc where attr_id='$attribute_id') ";
            $q1 = $conn->prepare($query2);
            $q1->execute();
            $q1->setFetchMode(PDO::FETCH_ASSOC);
            $attrvalarr = $q1->fetch();


            $query3 = "insert into product_attribute_value(product_id,attribute_value_id) "
                    . "values(:product_id,:attribute_value_id)";
            $bind2 = array(':product_id' => $prod_id, ':attribute_value_id' => $attrvalarr['attr_value_id']);
            $stmt2 = $conn->prepare($query3);
//echo PdoDebugger::show($query1, $bind1);
//exit;
            if ($stmt2->execute($bind2)) {
                $addflag = true;
            }
        } else {
            
            
            


            $query4 = "insert into product_attribute_value(product_id,attribute_value_id) "
                    . "values(:product_id,:attribute_value_id)";
            $bind4 = array(':product_id' => $prod_id, ':attribute_value_id' => $_POST['attrvalselect']);
            $stmt4 = $conn->prepare($query4);
//echo PdoDebugger::show($query4, $bind4);
//exit;
            if ($stmt4->execute($bind4)) {
                $addflag = true;
            }
        }
    } else {


        $query1 = "insert into attribute_value_ecomc(attr_id,value) values(:attr_id,:attrval)";
        $bind1 = array(':attr_id' => $attribute_id, ':attrval' => $attrval);
        $stmt1 = $conn->prepare($query1);
//echo PdoDebugger::show($query1, $bind1);
//exit;
        if ($stmt1->execute($bind1)) {
            $addflag = true;
        }



        $query2 = "select * from attribute_value_ecomc where attr_value_id="
                . "(SELECT max(attr_value_id) FROM attribute_value_ecomc where attr_id='$attribute_id') ";
        $q1 = $conn->prepare($query2);
        $q1->execute();
        $q1->setFetchMode(PDO::FETCH_ASSOC);
        $attrvalarr = $q1->fetch();


        $query3 = "insert into product_attribute_value(product_id,attribute_value_id) "
                . "values(:product_id,:attribute_value_id)";
        $bind2 = array(':product_id' => $prod_id, ':attribute_value_id' => $attrvalarr['attr_value_id']);
        $stmt2 = $conn->prepare($query3);
//echo PdoDebugger::show($query1, $bind1);
//exit;
        if ($stmt2->execute($bind2)) {
            $addflag = true;
        }
    }

    if ($addflag == true) {
        $_SESSION['succ'] = "Attribute  Value Added Successfully";
        goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
    } else {
        $_SESSION['fail'] = "Failed to Add Attribute  Value";
        goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
    }
}