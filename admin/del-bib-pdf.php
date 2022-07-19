<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$pdfid = $_GET['pdfid'];
$prodid = $_GET['prodid'];

$qry2 = "SELECT * from bibliography_pdf where id ='$pdfid'";
$q2 = $conn->prepare($qry2);
$q2->execute();
$q2->setFetchMode(PDO::FETCH_ASSOC);
$row2 = $q2->fetchAll();


$qry_del = "delete from bibliography_pdf where id = '$pdfid' ";

$q_del = $conn->prepare($qry_del);
if ($q_del->execute()) {
    $_SESSION['succes-add'] = "Pdf Successfully";
    unlink('../../' . 'bibliograply_pdf' . '/' . $row2['bib_pdf']);
} else {
    $_SESSION['error-add'] = "Pdf is not deleted";
}





goto_location('add-bib-pdf.php?id='.$prodid.'&section=bibliography');


//if (isset($_GET['type']) && $_GET['type'] == 'va') {
//    $type = $_POST['type'];
//    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
//} else if ($_POST['type'] == 'bib') {
//
//    goto_location('add-delete-attribute.php?prod_id=' . $prod_id . '&type=' . $type);
//} else {
//    goto_location('add-delete-attribute.php?prod_id=' . $prod_id. '&type=' . $type);
//}





