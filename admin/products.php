<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();

    try {
        $sql = "SELECT * FROM " . PRODUCTS_TBL . " ORDER by dateadded desc";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $list = file_get_contents(ADMIN_HTML . 'products-tpl.php');

        $items = '';
        $p = '';
        while ($row = $q->fetch()) {
            $status = $row['status'] == 1 ? (' checked') : ('');
            $img = $row['img1'] != '' ? ('<img src="product-img.php?img=' . $row['img1'] . '" />') : ('');
            $p .= '<tr id="rw' . $row['prodid'] . '">
                      <td>' . $img . '</td>
                      <td>' . substr(stripslashes($row['prodname']), 0, 50) . '</td>
                      <td>' . CURRENCY_CODE . $row['price'] . '</td>
              <td>' . number_format($row['views']) . '</td>
                      <td>' . $row['discount'] . '%</td>
                <td><input  id="' . $row['prodid'] . '" name="pstat" type="checkbox" data-on-text="Live" data-size="mini" data-off-color="warning" data-on-color="success" ' . $status . '></td>
                      <td><a href="edit-product.php?id=' . $row['prodid'] . '"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp; &nbsp;
                <span id="del_product" data-id="' . $row['prodid'] . '"  class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp; &nbsp;
                <a target="_blank" href="../pdetails/' . $row['prodid'] . '/' . clean_link($row['prodname']) . '"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a>
                </td>
                      </tr>';

        }
        $replace = array(
            '{PRODUCTS_LIST}',
            '{CurrencyCode}'
        );
        $products = array(
            '{PRODUCTS_LIST}' => $p,
            '{CurrencyCode}' => CURRENCY_CODE
        );
        $data = str_replace($replace, $products, $list);

    } catch (PDOException $pe) {
        $data = db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    echo $data;
    include(ADMIN_HTML . "admin-footerInc.php");


?>