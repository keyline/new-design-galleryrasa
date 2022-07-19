<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


    $attr_id = $_GET['attr_id'];
    try {
        //$sql = "select * from attribute_value_ecomc where attr_id = '$attr_id'";
        
        $sql = "select ave.attr_value_id,ave.attr_id,ave.value,pe.prodid,pe.prodname 
from products_ecomc pe,product_attribute_value pav,attr_common_flds_ecomc acfe,attribute_value_ecomc ave 
where 
acfe.id = '$attr_id' and 
acfe.id = ave.attr_id and 
ave.attr_value_id = pav.attribute_value_id and 
pav.product_id = pe.prodid 
order by ave.value";
        $q = $conn->prepare($sql);
        $category_id = 2;
 
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $attribute_value_list[] = array(
                'id' => $row['attr_value_id'],
                'attr_id' => $row['attr_id'],
                'value' => $row['value'],
                'prodid' => $row['prodid'],
                'prodname' => $row['prodname'],

            );
        }
        
        
        
        
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'attribute-value-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
//}