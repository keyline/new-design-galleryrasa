<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
//if(isset($_POST['edit_value'])){
$prod_id = $_POST['prod_id'];
$prodcredit_id = $_POST['prodcredit_id'];
$credit = $_POST['credit'];

$date = date('Y-m-d H:i:s');
if ($prodcredit_id == '0') {


    $creditcolumns = array(
        'id' => "'" . "'",
        'prodid' => "'" . $prod_id . "'",
        'credit' => "'" . $credit . "'",
        'created_at' => "'" . $date . "'",
        'updated_at' => "'" . $date . "'"
    );

    $pqr = insert('va_product_credit', $creditcolumns);

    $q = $conn->prepare($pqr);
    if ($q->execute()) {
        $_SESSION['succes-edit-prod'] = "Credit Edited Successfully";
        goto_location('edit-vaproduct-credit.php?prod_id=' . $prod_id);
    } else {
        $_SESSION['fail-edit-prod'] = "Credit Edit Failed";
        goto_location('edit-vaproduct-credit.php?prod_id=' . $prod_id);
    }
} else {

    $creditarr = array(
        'credit' => $credit
    );

    $wherearr = array(
        'id' => $prodcredit_id
    );

    $pqr = update('va_product_credit', $creditarr, $wherearr);

    $q = $conn->prepare($pqr);
    if ($q->execute()) {
        $_SESSION['succes-edit-prod'] = "Credit Edited Successfully";
        goto_location('edit-vaproduct-credit.php?prod_id=' . $prod_id);
    } else {
        $_SESSION['fail-edit-prod'] = "Credit Edit Failed";
        goto_location('edit-vaproduct-credit.php?prod_id=' . $prod_id);
    }
}


