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
        $sql = "select distinct attr.id ,attr.attribute_name 
from 
attr_common_flds_ecomc attr
INNER JOIN
product_type_attribute_key rel
ON
attr.id = rel.attribute_id
INNER JOIN
product_type_ecomc attr_cat
ON
attr_cat.product_type_id = rel.p_type_id
where 
attr_cat.product_type_id IN ('19')";
        $q = $conn->prepare($sql);
        $category_id = 2;
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $attribute_list[] = array(
                'id' => $row['id'],
                'attr_name' => $row['attribute_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'visual-attribute-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}