<?php

/* Project Name: Rasa
 * Author: Keyline
 * Author URI: http://www.keylines.net
 * Author e-mail: info@keylines.net
 * Version: 1.0
 * Created: July 2017
 * License: http://keylines.net/
 */
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['attr'] == 'Visual Archive') {
        

        if (empty($_POST['pname']) || empty($_POST['credit'])) {
            goto_location('add-new');
            exit;
        }

        $columns = array(
            'prodid' => 'null',
            'subcatid' => ':category',
            'prodname' => ':pname',
            'price' => '0',
            'dateadded' => 'now()',
            'keywords' => ':keywords',
        );


        $bind = array(
            ':category' => (!empty($_POST['sub-category'])) ? $_POST['sub-category'] : NULL,
            ':pname' => $_POST['pname'],
            ':keywords' => $_POST['tags']
        );







        if (isset($_SESSION['imgs']) && count($_SESSION['imgs']) > 0) {
            $bind[':img1'] = $_SESSION['imgs'][0];
            $columns['img1'] = ':img1';
        }

        array_walk_recursive($_POST, create_function('&$val', '$val = trim($val);'));
//        if (isset($_POST["discount"]) && !empty($_POST["discount"])) {
//            $bind[':discount'] = $_POST['discount'];
//            $columns['discount'] = ':discount';
//        }

        if (isset($_POST["desc1"]) && !empty($_POST["desc1"])) {
            $bind[':prodesc'] = $_POST['desc1'];
            $columns['prodesc'] = ':prodesc';
        }
        if (isset($_POST["desc2"]) && !empty($_POST["desc2"])) {
            $bind[':prodesc2'] = $_POST['desc2'];
            $columns['prodesc2'] = ':prodesc2';
        }



        $db_fields = get_Inputtype_text_fields();

        //Segrigetting select field attributes and text input attributes
        $insertV = array();
        $rightNow = array();
        foreach ($_POST as $level => $priv) {
            if (is_array($priv)) {
                foreach ($priv AS $key => $val) {
                    if (!is_array($val) && !empty($val)) {

                        $insertV[$key] = $val;
                    } else if (!empty($val)) {

                        foreach ($val as $k => $v) {
                            $rightNow[] = $v;
                        }
                    }
                }
            }
        }



        //Getting text input fields into an array and insert into attribute_value_ecomc
        $exactMatch = array_intersect_key($db_fields, $insertV);
        $what_I_need = array_combine($exactMatch, $insertV);
        $finalList = array();
        foreach ($what_I_need AS $k => $v) {
            $cln['attr_value_id'] = 'null';
            $cln['attr_id'] = ':attrID';
            $cln['value'] = ':attrVALUE';

            $bind_attr[':attrID'] = $k;
            $bind_attr[':attrVALUE'] = $v;

            $qr = insert(ATTR_VAL, $cln);
            $q = $conn->prepare($qr);
            $q->execute($bind_attr);
            $last_id = $conn->lastInsertId();
            $finalList[] = array_push($rightNow, $last_id);
        }

        $todaydate = date('Y-m-d H:s:i');

        try {


            $err = false;
            $qry = insert(PRODUCTS_TBL, $columns);
            
            $q = $conn->prepare($qry);
//            echo PdoDebugger::show($qry, $bind);
//            exit;
            $q->execute($bind);
            $id = $conn->lastInsertId();


            $creditcolumns = array(
                'id' => "'" . "'",
                'prodid' => ':prodid',
                'credit' => ':credit',
                'created_at' => "'" .$todaydate."'" ,
                'updated_at' => "'" .$todaydate."'" 
            );



            $creditbind = array(
                ':prodid' => $id,
                ':credit' => $_POST['credit']
            );



            $qry2 = insert('va_product_credit', $creditcolumns);
            $q2 = $conn->prepare($qry2);
//            echo PdoDebugger::show($qry2, $creditbind);
//            exit;
            $q2->execute($creditbind);



            //Inserting Select field attributes
            for ($i = 0; $i < count($rightNow); $i++) {

                $columns_p['product_attr_val_id'] = 'null';
                $columns_p['attribute_value_id'] = ':attr_value';
                $columns_p['product_id'] = ':p_id';

                $bind_p[':attr_value'] = $rightNow[$i];
                $bind_p[':p_id'] = $id;
                $pqr = insert(PROD_ATTR_VALUE, $columns_p);
                $q = $conn->prepare($pqr);
                $q->execute($bind_p);
            }

            //Inserting input text field attributes

            if (isset($_SESSION['imgs']) && count($_SESSION['imgs']) > 0) {
                foreach ($_SESSION['imgs'] as $k => $v) {
                    $qry = insert(IMAGES_TBL, array('id' => 'null', 'prodid' => $id, 'img_name' => ':img'));
                    $q = $conn->prepare($qry);
                    $bind = array(':img' => $v);
                    $q->execute($bind);
                }
                $_SESSION['imgs'] = array();
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
        }
    } else {

        //|| empty($_POST['sub-category'])
        if (empty($_POST['pname']) || empty($_POST['product_price'])) {
            goto_location('add-new');
            exit;
        }
        $columns = array(
            'prodid' => 'null',
            'subcatid' => ':category',
            'prodname' => ':pname',
            'price' => ':price',
            'dateadded' => 'now()',
            'keywords' => ':keywords',
        );


        $bind = array(
            ':category' => (!empty($_POST['sub-category'])) ? $_POST['sub-category'] : NULL,
            ':pname' => $_POST['pname'],
            ':price' => $_POST['product_price'],
            ':keywords' => $_POST['tags']
        );

        if (isset($_SESSION['imgs']) && count($_SESSION['imgs']) > 0) {
            $bind[':img1'] = $_SESSION['imgs'][0];
            $columns['img1'] = ':img1';
        }

        array_walk_recursive($_POST, create_function('&$val', '$val = trim($val);'));
        if (isset($_POST["discount"]) && !empty($_POST["discount"])) {
            $bind[':discount'] = $_POST['discount'];
            $columns['discount'] = ':discount';
        }


        if (isset($_POST["desc1"]) && !empty($_POST["desc1"])) {
            $bind[':prodesc'] = $_POST['desc1'];
            $columns['prodesc'] = ':prodesc';
        }
        if (isset($_POST["desc2"]) && !empty($_POST["desc2"])) {
            $bind[':prodesc2'] = $_POST['desc2'];
            $columns['prodesc2'] = ':prodesc2';
        }


        if (isset($_POST["stock"]) && !empty($_POST["stock"])) {
            $bind[':stocktotal'] = $_POST['stock'];
            $columns['stocktotal'] = ':stocktotal';
        }
        $db_fields = get_Inputtype_text_fields();

        //Segrigetting select field attributes and text input attributes
        $insertV = array();
        $rightNow = array();
        foreach ($_POST as $level => $priv) {
            if (is_array($priv)) {
                foreach ($priv AS $key => $val) {
                    if (!is_array($val) && !empty($val)) {

                        $insertV[$key] = $val;
                    } else if (!empty($val)) {

                        foreach ($val as $k => $v) {
                            $rightNow[] = $v;
                        }
                    }
                }
            }
        }

        //Getting text input fields into an array and insert into attribute_value_ecomc
        $exactMatch = array_intersect_key($db_fields, $insertV);
        $what_I_need = array_combine($exactMatch, $insertV);
        $finalList = array();
        foreach ($what_I_need AS $k => $v) {
            $cln['attr_value_id'] = 'null';
            $cln['attr_id'] = ':attrID';
            $cln['value'] = ':attrVALUE';

            $bind_attr[':attrID'] = $k;
            $bind_attr[':attrVALUE'] = $v;

            $qr = insert(ATTR_VAL, $cln);
            $q = $conn->prepare($qr);
            $q->execute($bind_attr);
            $last_id = $conn->lastInsertId();
            $finalList[] = array_push($rightNow, $last_id);
        }

        try {
            $err = false;
            $qry = insert(PRODUCTS_TBL, $columns);
            $q = $conn->prepare($qry);
            $q->execute($bind);
            $id = $conn->lastInsertId();

            //Inserting Select field attributes
            for ($i = 0; $i < count($rightNow); $i++) {

                $columns_p['product_attr_val_id'] = 'null';
                $columns_p['attribute_value_id'] = ':attr_value';
                $columns_p['product_id'] = ':p_id';

                $bind_p[':attr_value'] = $rightNow[$i];
                $bind_p[':p_id'] = $id;
                $pqr = insert(PROD_ATTR_VALUE, $columns_p);
                $q = $conn->prepare($pqr);
                $q->execute($bind_p);
            }

            //Inserting input text field attributes

            if (isset($_SESSION['imgs']) && count($_SESSION['imgs']) > 0) {
                foreach ($_SESSION['imgs'] as $k => $v) {
                    $qry = insert(IMAGES_TBL, array('id' => 'null', 'prodid' => $id, 'img_name' => ':img'));
                    $q = $conn->prepare($qry);
                    $bind = array(':img' => $v);
                    $q->execute($bind);
                }
                $_SESSION['imgs'] = array();
            }
        } catch (PDOException $pe) {
            $err = true;
            $er = db_error($pe->getMessage()) . '. Check that relevant fields like Info tab are completed';
        }
    }
    $replace = array('{BTN}', '{MSG}', '{SHOP}', '{EDIT}');
    $items = array(
        'Another',
        'Item has been added',
        SITE_URL . '/pdetails/' . $id . '/' . clean_link($_POST['pname']),
        'edit-product.php?id=' . $id
    );

    include(ADMIN_HTML . "admin-headerInc.php");
    if ($err) {
        echo '<div class="alert alert-danger" role="alert"><h4>' . $er . '</h4></div>';
    }
    if (!$err) {
        echo str_replace($replace, $items, PRODUCT_ADDED_MSG);
    };
    include(ADMIN_HTML . "admin-footerInc.php");
    exit;
} else {

    $s = get_categories($conn);
    $select = $s['s'];
    $html = get_attributes_html($conn);

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . "add-new-tpl.php");
    include(ADMIN_HTML . "admin-footerInc.php");
}
?>  