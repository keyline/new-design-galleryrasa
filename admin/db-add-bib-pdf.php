<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
$conn = dbconnect();


//$destination = '../' . IMGSRC . $_POST['type'] . '/';
$pdf_destination = '../../' . 'bibliograply_pdf' . '/';

check_auth_admin();
//$va_destination = '../' . IMGSRC . VARCHIVE;




$product_id = $_POST['product'];
$pdffile = $_FILES['pdffile'];

$pdfname1 = $_FILES["pdffile"]["name"];





$RandomNum = rand(0, 9999999999);

$ImageName2 = str_replace(' ', '-', strtolower($pdfname1));

$ImageName = substr($ImageName2, 0, 50);

$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
$ImageExt = str_replace('.', '', $ImageExt);

$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
//$newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.' . $ImageExt;

$newImageName = substr($ImageName, 0, 30) . '-' . $RandomNum . '.pdf';




$orgname = $newImageName;

$imgarr = explode(".", $orgname);

$ImageExt1 = end($imgarr);

$imgarrcnt = count($imgarr);

$imgorgcnt = $imgarrcnt - 1;
$orgnameexcptextnd = '';
for ($l = 0; $l < $imgorgcnt; $l++) {
    if ($l == ($imgorgcnt - 1)) {

        $orgnameexcptextnd .= $imgarr[$l];
    } else {
        $orgnameexcptextnd .= $imgarr[$l] . '.';
    }
    //$orgnameexcptextnd .= $imgarr[$l];
}

//$newNameFile = base64_encode($orgnameexcptextnd) . '.' . $ImageExt1;
$newNameFile = base64_encode($orgnameexcptextnd) . '.pdf';

$destination = $pdf_destination . $newNameFile;

if (move_uploaded_file($_FILES['pdffile']['tmp_name'], $destination)) {

//if(move_uploaded_file($newNameFile, $pdf_destination)){
    $movestatus = true;
} else {
    $movestatus = false;
}

if (file_exists($pdf_destination . $newNameFile)) {


    $columns = array(
        'id' => 'null',
        'prodid' => ':productID',
        'bib_pdf' => ':pdfName',
        'bib_pdf_credit' => ':credit',
        'creation_date' => 'now()'
    );
    $bind = array(
        ':productID' => $product_id,
        ':pdfName' => $newImageName,
        ':credit' => '0'
    );
    try {
        $conn = dbconnect();
        $err = false;
        $qry = insert("bibliography_pdf", $columns);
        echo PdoDebugger::show($qry, $bind);
        $q = $conn->prepare($qry);

        $q->execute($bind);

        $_SESSION['succes-add'] = "Added Successfully";

        goto_location('add-bib-pdf.php?id=' . $product_id);
    } catch (PDOException $pe) {
        $err = true;
        $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';

        $_SESSION['error-add'] = $er;

        goto_location('add-bib-pdf.php?id=' . $product_id);
    }
}



//$query1 = "insert into attribute_value_ecomc(attr_id,value) values(:attr_id,:attrval)";
//$bind1 = array(':attr_id' => $attr_id, ':attrval' => $attrval);
//$stmt1 = $conn->prepare($query1);
////echo PdoDebugger::show($query1, $bind1);
////exit;
//$stmt1->execute($bind1);
//
////}
//$_SESSION['succes-add'] = "Added Successfully";
//
//
//goto_location('bib-list-attr-value.php?attr_id=' . $attr_id);
