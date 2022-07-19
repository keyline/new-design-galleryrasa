<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
$conn = dbconnect();
//if(isset($_POST['edit_value'])){
$prod_id = $_POST['prod_id'];
$archivist_remarks = $_POST['archivist-remarks'];
$no_of_publication = $_POST['no_of_publication'];

$va_archivistremarksarr = archivistremarks($prod_id);
$va_noofpublicationsarr = noofpublications($prod_id);



if (!empty($va_archivistremarksarr)) {

//    $valuearr = array(
//        'value' => $archivist_remarks
//    );
//
//    $wherearr = array(
//        'attr_value_id' => $va_archivistremarksarr['attribute_value_id']
//    );
//
//    $pqr1 = update('attribute_value_ecomc', $valuearr, $wherearr);
//    
//    $q1 = $conn->prepare($pqr1);
//    if ($q1->execute()) {
//        $addflag = true;
//    } else {
//        $addflag = false;
//    }




    $query1 = "update attribute_value_ecomc set value = :archivist_remarks "
            . "where attr_value_id = :attribute_value_id";

    $bind1 = array(':archivist_remarks' => $archivist_remarks, ':attribute_value_id' => $va_archivistremarksarr['attribute_value_id']);
    $stmt1 = $conn->prepare($query1);
    $stmt1->execute($bind1);
} else {
//    $insertcolumns = array(
//        'attr_value_id' => "'" . "'",
//        'attr_id' => "'205'",
//        'value' => "'" . $archivist_remarks . "'"
//    );
//
//    $pqr1 = insert('attribute_value_ecomc', $insertcolumns);
//
//    $q1 = $conn->prepare($pqr1);
//    if ($q1->execute()) {
//        $addflag = true;
//    } else {
//        $addflag = false;
//    }




    $query1 = "insert into attribute_value_ecomc(attr_value_id,attr_id,value) "
            . "values(:attr_value_id,:attr_id,:value) ";

    $bind1 = array(':attr_value_id' => '',
        ':attr_id' => '131',
        ':value' => $archivist_remarks);
    $stmt1 = $conn->prepare($query1);
    //echo PdoDebugger::show($query1, $bind1);
    $stmt1->execute($bind1);





    $lastattrvalarr = lastinsertattrval(131);


//    $insertcolumns2 = array(
//        'product_attr_val_id' => "'" . "'",
//        'product_id' => "'" . $prod_id . "'",
//        'attribute_value_id' => "'" . $lastattrvalarr['lastattrval1'] . "'",
//        'independent_values' => "null",
//        'sequence' => "null"
//    );
//
//    $pqr2 = insert('product_attribute_value', $insertcolumns2);
//
//    $q2 = $conn->prepare($pqr2);
//    if ($q2->execute()) {
//        $addflag = true;
//    } else {
//        $addflag = false;
//    }



    $query2 = "insert into product_attribute_value(product_attr_val_id,product_id,attribute_value_id) "
            . "values(:product_attr_val_id,:product_id,:attribute_value_id) ";
    $bind2 = array(':product_attr_val_id' => '', ':product_id' => $prod_id,
        ':attribute_value_id' => $lastattrvalarr['lastattrval1']);
    $stmt2 = $conn->prepare($query2);
//echo PdoDebugger::show($query2, $bind2);
    $stmt2->execute($bind2);
}




if (!empty($va_noofpublicationsarr)) {


//    $valuearr = array(
//        'value' => $no_of_publication
//    );
//
//    $wherearr = array(
//        'attr_value_id' => $va_noofpublicationsarr['attribute_value_id']
//    );
//
//    $pqr1 = update('attribute_value_ecomc', $valuearr, $wherearr);
//
//    $q1 = $conn->prepare($pqr1);
//    if ($q1->execute()) {
//        $addflag = true;
//    } else {
//        $addflag = false;
//    }




    $query1 = "update attribute_value_ecomc set value = :no_of_publication "
            . "where attr_value_id = :attribute_value_id";

    $bind1 = array(':no_of_publication' => $no_of_publication,
        ':attribute_value_id' => $va_noofpublicationsarr['attribute_value_id']);
    $stmt1 = $conn->prepare($query1);
    $stmt1->execute($bind1);
} else {

    if ($no_of_publication != '') {

//        $insertcolumns = array(
//            'attr_value_id' => "'" . "'",
//            'attr_id' => "'227'",
//            'value' => "'" . $no_of_publication . "'"
//        );
//
//        $pqr1 = insert('attribute_value_ecomc', $insertcolumns);
//
//        $q1 = $conn->prepare($pqr1);
//        if ($q1->execute()) {
//            $addflag = true;
//        } else {
//            $addflag = false;
//        }



        $query1 = "insert into attribute_value_ecomc(attr_value_id,attr_id,value) "
                . "values(:attr_value_id,:attr_id,:value) ";

        $bind1 = array(':attr_value_id' => '',
            ':attr_id' => '230',
            ':value' => $no_of_publication);
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute($bind1);


        $lastattrvalarr2 = lastinsertattrval(230);

//        $insertcolumns2 = array(
//            'product_attr_val_id' => "'" . "'",
//            'product_id' => "'" . $prod_id . "'",
//            'attribute_value_id' => "'" . $lastattrvalarr2['lastattrval1'] . "'",
//            'independent_values' => "null",
//            'sequence' => "null"
//        );
//
//
//        $pqr2 = insert('product_attribute_value', $insertcolumns2);
//
//        $q2 = $conn->prepare($pqr2);
//        if ($q2->execute()) {
//            $addflag = true;
//        } else {
//            $addflag = false;
//        }



        $query2 = "insert into product_attribute_value(product_attr_val_id,product_id,attribute_value_id) "
                . "values(:product_attr_val_id,:product_id,:attribute_value_id) ";
        $bind2 = array(':product_attr_val_id' => '', ':product_id' => $prod_id,
            ':attribute_value_id' => $lastattrvalarr2['lastattrval1']);
        $stmt2 = $conn->prepare($query2);
//echo PdoDebugger::show($query2, $bind2);
        $stmt2->execute($bind2);
    }
}




if ($addflag == false) {
    $_SESSION['fail-edit'] = "Edited Successfully";
    goto_location('edit-bibliography-archivist-remarks.php?prod_id=' . $prod_id);
} else {
    $_SESSION['succes-edit'] = "Edited Successfully";
    goto_location('edit-bibliography-archivist-remarks.php?prod_id=' . $prod_id);
}