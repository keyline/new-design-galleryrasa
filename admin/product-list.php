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
        $sql = "select distinct prd.prodid ,prd.prodname 
from 
products_ecomc prd
INNER JOIN
product_type_ecomc attr_cat
ON
prd.category_id=attr_cat.product_type_id 
where 
attr_cat.product_type_id IN ('2','11','12','13','14')";
        $q = $conn->prepare($sql);
        $category_id = 2;
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $product_list[] = array(
                'id' => $row['prodid'],
                'prod_name' => $row['prodname']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'product-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}