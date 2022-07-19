<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_REQUEST['type'] === 'memorabilia') {
    $title = "Delete Memorabilia Unused Attributes[All attributes](Delete multiple rows by selecting checkboxes)";
    try {
        $sql = "select * from attribute_value_ecomc av join (SELECT af.id,af.attribute_name"
                . " FROM product_type_attribute_key ak INNER JOIN attr_common_flds_ecomc af"
                . " ON ak.attribute_id=af.id WHERE ak.p_type_id=2) AS attributes on"
                . " av.attr_id=attributes.id LEFT JOIN product_attribute_value pav"
                . " ON av.attr_value_id = pav.attribute_value_id"
                . " WHERE pav.attribute_value_id is NULL ORDER BY av.attr_id";
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $attribute_list[] = array(
                'count' => 0,
                'attr_id' => $row['attr_value_id'],
                'attr_name' => $row['value'],
                'attr_parent' => $row['attribute_name']
            );
        }
    } catch (Exception $ex) {
        echo db_error($pe->getMessage());
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_REQUEST['type'] === 'biblio') {
    $title = "Delete Unused Attributes[Artist,Author,Editor](Delete multiple rows by selecting checkboxes)";
    try {
        $sql = "SELECT
                COUNT(product_id) AS count,
                attribute_value_ecomc.attr_value_id,
                attribute_value_ecomc.`value`,
                attr_common_flds_ecomc.attribute_name
                FROM
                attribute_value_ecomc
                LEFT JOIN product_attribute_value ON attribute_value_ecomc.attr_value_id = product_attribute_value.attribute_value_id
                LEFT JOIN products_ecomc ON products_ecomc.prodid = product_attribute_value.product_id
                INNER JOIN attr_common_flds_ecomc ON attr_common_flds_ecomc.id = attribute_value_ecomc.attr_id
                WHERE attr_id IN(145,133,9)
                GROUP BY attr_value_id
                ";
        $q = $conn->prepare($sql);


        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $attribute_list[] = array(
                'count' => $row['count'],
                'attr_id' => $row['attr_value_id'],
                'attr_name' => $row['value'],
                'attr_parent' => $row['attribute_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_REQUEST['type'] === 'visualarchive') {
    $title = "Delete Unused Attributes[Artist](Delete multiple rows by selecting checkboxes)";
    try {
        $sql = "SELECT
                COUNT(product_id) AS count,
                attribute_value_ecomc.attr_value_id,
                attribute_value_ecomc.`value`,
                attr_common_flds_ecomc.attribute_name
                FROM
                attribute_value_ecomc
                LEFT JOIN product_attribute_value ON attribute_value_ecomc.attr_value_id = product_attribute_value.attribute_value_id
                LEFT JOIN products_ecomc ON products_ecomc.prodid = product_attribute_value.product_id
                INNER JOIN attr_common_flds_ecomc ON attr_common_flds_ecomc.id = attribute_value_ecomc.attr_id
                WHERE attr_id IN(187)
                GROUP BY attr_value_id
                ";
        $q = $conn->prepare($sql);


        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            $attribute_list[] = array(
                'count' => $row['count'],
                'attr_id' => $row['attr_value_id'],
                'attr_name' => $row['value'],
                'attr_parent' => $row['attribute_name']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }
} else {
  exit(0);
}

$tableBody = '';
if (!empty($attribute_list)) {
    $i = 1;
    foreach ($attribute_list as $k => $v) {
        if (!$v['count']) {
            $tableBody .= '<tr id="rw' . $v['attr_id'] . '"><td>'
                    . $v['attr_id'] . '</td>'
                    . '<td>' . $v['attr_name'] . '(' . $v['attr_parent'] . ')</td>'
                    . '<td><input type="checkbox" name="customer_id[]" class="delete_customer" value="'
                    . $v["attr_id"] . '"/>'
                    . '</td></tr>';
                    
            $i++;
        }
    }
}


$search_view = file_get_contents(ADMIN_HTML . 'delete-unused-attributes-tpl.php');
$search = array('{title}', '{tbody}');
$replace = array($title, $tableBody);
$finalView = str_replace($search, $replace, $search_view);
include(ADMIN_HTML . "admin-headerInc.php");
echo $finalView;
include(ADMIN_HTML . "admin-footerInc.php");
