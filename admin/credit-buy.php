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




        $sql = "select cch.* , tcp.transactionid,tcp.payment_status,
            cl.fname,cl.lname,cl.email,cl.phone 
from customer_credit_history cch,tbl_credit_payment tcp, customer_login cl  
where 
cch.customer_id = cl.id and 
cch.id = tcp.credit_history_id and 
cch.transaction_type = '0'   
order by cch.credit_date desc";


//        $sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name from "
//                . "tbl_order ord,customer_login cust,gateway where ord.customer_id=cust.id and ord.gateway_id=gateway.id order by ord.order_id desc";
        
        
        $q = $conn->prepare($sql);
        //$category_id = 2;

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $order_list[] = array(
                'credit_id' => $row['credit_id'],
                'credit' => $row['credit'],
                'amount' => $row['amount'],
                'credit_date' => $row['credit_date'],
                'transactionid' => $row['transactionid'],
                'payment_status' => $row['payment_status'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'email' => $row['email'],
                'phone' => $row['phone']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'credit-buy-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}