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
        $sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name from "
                . "tbl_order ord,customer_login cust,gateway where ord.customer_id=cust.id and ord.gateway_id=gateway.id order by ord.order_id desc";
        $q = $conn->prepare($sql);
        //$category_id = 2;
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $order_list[] = array(
                'order_id' => $row['order_id'],
                'order_org_id' => $row['order_org_id'],
                'customer_id' => $row['customer_id'],
                'gateway_id' => $row['gateway_id'],
                'note' => $row['note'],
                'price' => $row['price'],
                'order_date' => $row['date'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'gateway_name' => $row['gateway_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'order-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}