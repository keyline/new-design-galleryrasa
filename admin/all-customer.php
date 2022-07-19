<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print "<pre>";
    print_r($_REQUEST);
} else {
    try {
        $sql = "select * from "
                . "customer_login order by id desc";
        $q = $conn->prepare($sql);     
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $customer_list[] = array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'reg_date' => $row['reg_date']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'customer-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}