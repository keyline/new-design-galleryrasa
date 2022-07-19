<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

$date = date('Y-m-d H:i:s');
$allvaproductsarr = allvaproducts();

foreach ($allvaproductsarr as $k => $v) {

    //print_r($v);

    $creditcolumns = array(
        'id' => "'" . "'",
        'prodid' => "'" . $v['prodid'] . "'",
        'credit' => "'" . '1' . "'",
        'created_at' => "'" . $date . "'",
        'updated_at' => "'" . $date . "'"
    );

    $pqr2 = insert('va_product_credit', $creditcolumns);

    $q2 = $conn->prepare($pqr2);
    $q2->execute();
}
