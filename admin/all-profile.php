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
        $sql = "SELECT ave.attr_value_id, ave.value p_name, acfe.id attr_id, acfe.attribute_name  "
                . "FROM attribute_value_ecomc ave,attr_common_flds_ecomc acfe "
                . "WHERE ave.attr_id = acfe.id and acfe.id = '133' ORDER by ave.attr_value_id desc";
        $q = $conn->prepare($sql);
//        $category_id = 2;
//        $q->bindParam(':categoryID', $category_id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
//            $status       = $row['status'] == 1 ? (' checked') : ('');
//            $stock_status = $row['stock_status'] == 1 ? (' checked') : ('');
//            $img          = $row['img1'] != '' ? ('<img src="product-img.php?img=' . $row['img1'] . '" />') : ('');
            $profile_list[] = array(
                'attr_value_id' => $row['attr_value_id'],
                'p_name' => $row['p_name'],
                'attr_id' => $row['attr_id'],
                'attribute_name' => $row['attribute_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'profile-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}