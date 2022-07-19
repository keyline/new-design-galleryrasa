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



        $sql = "select ave.value artist,pe.prodid,TIMESTAMPDIFF(second,cch.credit_date,now()) timediff,pe.prodname,
            cch.*,cl.fname,cl.lname,cl.email,cl.phone  
from customer_credit_history cch,products_ecomc pe, 
product_attribute_value pav,attribute_value_ecomc ave,attr_common_flds_ecomc acfe, customer_login cl   
where 
cch.customer_id = cl.id and 
cch.transaction_type = '1' and 
cch.prodid = pe.prodid and 

pe.prodid = pav.product_id and
pav.attribute_value_id = ave.attr_value_id and 
acfe.id = ave.attr_id and 
acfe.id = '187'

order by cch.credit_date desc";

//        $sql = "select cch.* , tcp.transactionid,tcp.payment_status,
//            cl.fname,cl.lname,cl.email,cl.phone 
//from customer_credit_history cch,tbl_credit_payment tcp, customer_login cl  
//where 
//cch.customer_id = cl.id and 
//cch.id = tcp.credit_history_id and 
//cch.transaction_type = '0'   
//order by cch.credit_date desc";


        $q = $conn->prepare($sql);
        //$category_id = 2;

        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $order_list[] = array(
                'artist' => $row['artist'],
                'prodid' => $row['prodid'],
                'timediff' => $row['timediff'],
                'prodname' => $row['prodname'],
                'id' => $row['id'],
                'customer_id' => $row['customer_id'],
                'credit_id' => $row['credit_id'],
                'transaction_type' => $row['transaction_type'],
                'credit' => $row['credit'],
                'credit_date' => $row['credit_date'],
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
    include(ADMIN_HTML . 'product-credit-spent-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}