<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $from_range = $_POST['from-range'];
    $to_range = $_POST['to-range'];
    if ($from_range > $to_range) {

        $_SESSION['error-delete'] = 'From Date cannot be greater than To Date';
        goto_location('access-log');
    } else {

        $del_from_dt = $from_range . ' 00:00:00';
        $del_to_dt = $to_range . ' 23:59:59';


        $qry_del = "DELETE from `access_log` where date >= '$del_from_dt' and date <= '$del_to_dt'";
        $q_del = $conn->prepare($qry_del);
        $q_del->execute();
        $_SESSION['succ-delete'] = 'Data Deleted';
        goto_location('access-log');
    }
}