<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
$selectOptions = get_varchive_classification($conn);
if (isset($_REQUEST['atrvalid']) && !empty($_REQUEST)) {
    $atrvalid = $_REQUEST['atrvalid'];



    try {

        $sql = "select * from attribute_value_ecomc ave,products_ecomc pe,
            product_attribute_value pav,attr_common_flds_ecomc acfe   
where ave.attr_value_id = :atrvalId and 
pav.attribute_value_id = ave.attr_value_id and 

pav.product_id = pe.prodid and 
acfe.id = ave.attr_id";
        $q = $conn->prepare($sql);

        $q->bindParam(':atrvalId', $atrvalid, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {


            $sql2 = "SELECT av.value FROM products_ecomc p LEFT JOIN product_attribute_value pav ON p.prodid=pav.product_id
                LEFT JOIN attribute_value_ecomc av ON pav.attribute_value_id=av.attr_value_id LEFT JOIN attr_common_flds_ecomc af ON af.id=av.attr_id
                WHERE
                af.id=197 AND  
                p.prodid = '" . $row['prodid'] . "' 
                ORDER BY prodid DESC";

            $stmt = $conn->prepare($sql2);
            $stmt->execute();
            $row2 = $stmt->fetch(PDO::FETCH_ASSOC);



            $status = $row['status'] == 1 ? (' checked') : ('');
            $stock_status = $row['stock_status'] == 1 ? (' checked') : ('');
            $img = $row['img1'] != '' ? ('<img src="product-img.php?img=' . $row['img1'] . '" />') : ('');
            $product_list[] = array(
                'status' => $status,
                'prodid' => $row['prodid'],
                'img' => $img,
                'name' => substr(stripslashes($row['prodname']), 0, 50),
                'pagination' => $row2['value'],
                'price' => CURRENCY_CODE . number_format($row['price']),
                'views' => number_format($row['views']),
                'discount' => $row['discount'],
                'lnk_name' => clean_link($row['prodname']),
                'stock_status' => $stock_status,
                'stockt' => $row['stocktotal'],
                'count' => get_image_count_visualarchive($row['prodid'])
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }



    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'visualarchive-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
} else {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        print "<pre>";
        print_r($_REQUEST);
    } else {
        try {
            $selectOptions = get_subCategory_options($conn);

            $sql = "SELECT * FROM " . PRODUCTS_TBL . " WHERE `category_id` IN ('1','5','6','7','8','9','10') ORDER by dateadded desc";
            $q = $conn->prepare($sql);
            $category_id = 1;
//            $subcategory_id = (!empty($subcategory_id)) ? $subcategory_id : 5;
//            $q->bindParam(':categoryID', $category_id, PDO::PARAM_INT);
//            $q->bindParam(':subcatID', $subcategory_id, PDO::PARAM_INT);
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $count = $q->rowCount();
            while ($row = $q->fetch()) {
                $status = $row['status'] == 1 ? (' checked') : ('');
                $stock_status = $row['stock_status'] == 1 ? (' checked') : ('');
                $img = $row['img1'] != '' ? ('<img src="product-img.php?img=' . $row['img1'] . '" />') : ('');
                $product_list[] = array(
                    'status' => $status,
                    'prodid' => $row['prodid'],
                    'img' => $img,
                    'name' => substr(stripslashes($row['prodname']), 0, 50),
                    'price' => CURRENCY_CODE . number_format($row['price']),
                    'views' => number_format($row['views']),
                    'discount' => $row['discount'],
                    'lnk_name' => clean_link($row['prodname']),
                    'stock_status' => $stock_status,
                    'stockt' => $row['stocktotal'],
                    'count' => get_PDF_count_bibliography($row['prodid'], true)
                );
            }
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }

        include(ADMIN_HTML . "admin-headerInc.php");
        include(ADMIN_HTML . 'bibliography-archivist-remarks-tpl.php');
        include(ADMIN_HTML . "admin-footerInc.php");
    }
}