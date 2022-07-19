<?php
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
if (!isset($_SESSION['valid_admin'])) {
    echo 'Session has expired. Please login';
    exit;
}
$conn = dbconnect();

switch ($_REQUEST['cmd']) {

    case "pd":
        try {
            $qry = "DELETE FROM " . DELIVERY_TBL . " WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $q->execute();

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;

    case "an":
        echo get_attrib_names($conn);
        break;

    case "ua":
die();
        try {

            $q = $conn->prepare("SELECT * FROM " . ADMIN_TBL . "
	            				 WHERE user=:usr");
            $q->bindParam(':usr', $_SESSION['valid_admin']);

            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $row = $q->fetch();
            $pass_hash = crypt($_POST['op'], PASSWRD_SALT);
            if (!strcasecmp($pass_hash, $row['pass']) == 0) {
                echo 'Your old password does not match';
                exit;
            }

            $qry = "UPDATE " . ADMIN_TBL;
            $qry .= " SET pass=:pass WHERE user=:usr ";
            $q = $conn->prepare($qry);
            $hash = crypt($_POST['np'], PASSWRD_SALT);
            $q->bindParam(':pass', $hash);
            $q->bindParam(':usr', $_SESSION['valid_admin']);
            $q->execute();

            echo 'Updated successfully';
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
            exit;
        }


        break;

    case "ue":

        try {

            $q = $conn->prepare("SELECT * FROM " . ADMIN_TBL . "
	            				 WHERE user=:usr");
            $q->bindParam(':usr', $_SESSION['valid_admin']);

            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $row = $q->fetch();
            $pass_hash = crypt($_POST['cp'], PASSWRD_SALT);
            if (!strcasecmp($pass_hash, $row['pass']) == 0) {
                echo 'Invalid Password';
                exit;
            }

            $qry = "UPDATE " . ADMIN_TBL;
            $qry .= " SET email=:em WHERE user=:usr";
            $q = $conn->prepare($qry);
            $q->bindParam(':usr', $_SESSION['valid_admin']);
            $q->bindParam(':em', $_POST['em']);
            $q->execute();

            echo 'Updated successfully';
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
            exit;
        }


        break;

    case "da":
        try {
            if ($_POST['cod'] === "true") {
                $cod = 1;
            } else {
                $cod = 0;
            }
            $qry = insert(DELIVERY_TBL,
                array('id' => 'null', 'd_options' => ':option', 'amount' => ':amount', 'cod' => $cod));

            $q = $conn->prepare($qry);
            $q->bindParam(':option', $_POST['option']);
            $q->bindParam(':amount', $_POST['amount']);

            $q->execute();
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }

        $shipping = list_delivery_options($conn);
        echo $shipping['shp2'];
        break;

    case "do":
        $qry = "DELETE FROM " . ORDERS_TBL . " WHERE orderid=:id";
        $q = $conn->prepare($qry);
        $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $q->execute();

        break;

    case "ov":
        $sql = "SELECT * FROM " . ORDERS_TBL . " WHERE orderid='" . $_GET['id'] . "' ";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();

        $od = '';
        if (!is_null($row['orderid'])) {
            $od .= '<dt>Order #</dt><dd>' . $row['orderid'] . '</dd>';
        }
        if (!is_null($row['order_date'])) {
            $od .= '<dt>Order Date</dt><dd>' . $row['order_date'] . '</dd>';
        }
        if (!is_null($row['email'])) {
            $od .= '<dt>Email</dt><dd>' . $row['email'] . '</dd>';
        }

        if (is_object(json_decode($row['order_items']))) {
            $obj = json_decode($row['order_items']);
            if (!is_null($obj->{'add1'})) {
                $od .= '<dt>Address</dt><dd>' . $obj->{'add1'} . '</dd>';
            }
            if (!is_null($obj->{'add2'})) {
                $od .= '<dt>Address</dt><dd>' . $obj->{'add2'} . '</dd>';
            }
            if (!is_null($obj->{'city'})) {
                $od .= '<dt>City</dt><dd>' . $obj->{'city'} . '</dd>';
            }
            if (!is_null($obj->{'postcode'})) {
                $od .= '<dt>Postcode</dt><dd>' . $obj->{'postcode'} . '</dd>';
            }
            if (!is_null($obj->{'country'})) {
                $od .= '<dt>Country</dt><dd>' . $obj->{'country'} . '</dd>';
            }
            if (!is_null($obj->{'phone'})) {
                $od .= '<dt>Phone</dt><dd>' . $obj->{'phone'} . '</dd>';
            }
            if (!is_null($obj->{'order_items'})) {
                $od .= '<dt>Ordered Items</dt><dd>' . $obj->{'order_items'} . '</dd>';
            }

        }

        if (!is_null($row['order_total'])) {
            $od .= '<dt>Postage</dt><dd>' . CURRENCY_CODE . $row['shipping'] . '</dd>';
        }
        if (!is_null($row['order_total'])) {
            $od .= '<dt>Total</dt><dd>' . CURRENCY_CODE . $row['order_total'] . '</dd>';
        }
        $od .= '<dt>Grand Total</dt><dd>' . CURRENCY_CODE . ($row['shipping'] + $row['order_total']) . '</dd>';
        echo '<h3>' . $row['firstname'] . ' ' . $row['lastname'] . '</h3><dl class="dl-horizontal">' . $od . '</dl>';
        break;

    case "uc":

        try {
            $img = $_POST['img'];
            $qry = "UPDATE " . CAROUSEL_TBL . "
			  SET p_title=:p_title, 
			  p_desc=:p_desc,
			  p_link=:p_link,
			  p_btn=:p_btn";

            if (isset($_SESSION['cimg']) && count($_SESSION['cimg']) > 0) {
                $img = $_SESSION['cimg'];
            }
            $qry .= ", p_img='" . $img . "' ";
            $qry .= " WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':p_title', $_POST['t']);
            $q->bindParam(':p_desc', $_POST['d']);
            $q->bindParam(':p_link', $_POST['l']);
            $q->bindParam(':p_btn', $_POST['lb']);
            $q->bindParam(':id', $_POST['id']);
            $q->execute();

            cache_carousel($conn);
            if (isset($_SESSION['cimg'])) {
                $_SESSION['cimg'] = array();
            }
            echo list_carousel($_POST['t'], $_POST['d'], $_POST['l'], $_POST['lb'], $_POST['id'], $_POST['st'], $img);

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }

        break;


    case "ol":
        $info = get_attrib_options_list($conn);
        echo '<div class="well">' . $info['a'] . $info['b'] . '</div>';
        break;

    case "ui":
        try {

            $qry = "UPDATE " . PRODUCTS_TBL . "
			SET img1=:img
	                WHERE prodid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':img', $_POST['im']);
            $q->bindParam(':id', $_POST['id']);

            $q->execute();
            echo 'Updated Successfully';
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;


    case "di":
        try {

            $qry = "DELETE FROM " . IMAGES_TBL . " WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $q->execute();

            $qry = "UPDATE " . PRODUCTS_TBL . " SET img1='' WHERE prodid=:pid";
            $q = $conn->prepare($qry);
            $q->bindParam(':pid', $_POST['pid'], PDO::PARAM_INT);
            $q->execute();
            echo 'Deleted';
            unlink('../' . THUMB_IMGS . $_POST['im']);
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;

    case "dp":
        try {

            $qry = "DELETE FROM " . IMAGES_TBL . " WHERE prodid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $q->execute();

            $qry = "DELETE FROM " . PRODUCTS_TBL . " WHERE prodid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $q->execute();

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;
    case "cl":
        echo json_encode(get_select_fields($_REQUEST['id'], $_REQUEST['key']));
        break;


    case "cf":
        $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE id='" . $_GET['id'] . "' ";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();
        array_walk_recursive($row, create_function('&$val', '$val = trim($val);'));
        $tpl = file_get_contents(ADMIN_HTML . 'carousel-modal-tpl.php');
        $search = array(
            '{TITLE}',
            '{LINK}',
            '{PDESC}',
            '{BTN}',
            '{STAT}',
            '{ID}',
            '{IMG}'
        );
        $replace = array(
            $row['p_title'],
            $row['p_link'],
            $row['p_desc'],
            $row['p_btn'],
            $row['stat'],
            $row['id'],
            $row['p_img']
        );

        echo str_replace($search, $replace, $tpl);
        break;

    case "ad":

        $qry = "DELETE " . ATTRIBUTES_TBL . ", " . ATTRIBUTE_VARS_TBL . "
					FROM " . ATTRIBUTES_TBL . "
					LEFT JOIN " . ATTRIBUTE_VARS_TBL .
            " ON " . ATTRIBUTES_TBL . ".id = " . ATTRIBUTE_VARS_TBL . ".id
					WHERE " . ATTRIBUTES_TBL . ".id=:id";
        $q = $conn->prepare($qry);
        $q->bindParam(':id', $_POST['n'], PDO::PARAM_INT);
        $q->execute();


        break;

    case "od":

        $qry = "DELETE  FROM " . ATTRIBUTE_VARS_TBL . " WHERE uid=:id";
        $q = $conn->prepare($qry);
        $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $q->execute();

        break;

    case "cd":
        if (trim($_POST['n']) != '') {
            $qry = "DELETE FROM " . CATEGORIES_TBL . " WHERE catid=:cat";
            $q = $conn->prepare($qry);
            $q->bindParam(':cat', $_POST['n'], PDO::PARAM_INT);
            $q->execute();
        }
        echo json_encode(get_categories($conn));
        break;

    case "cs":
        try {

            $qry = "UPDATE " . CAROUSEL_TBL . "
					SET stat=:st
			                WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':st', $_POST['st']);
            $q->bindParam(':id', $_POST['id']);
            $q->execute();
            cache_carousel($conn);
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;
	
	case "st_s":
	        try {
            $qry = "UPDATE " . PRODUCTS_TBL . "
					SET stock_status=:st
			                WHERE prodid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':st', $_POST['st']);
            $q->bindParam(':id', $_POST['id']);
            $q->execute();

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;
        
        case "cm_s":
	        try {
            $qry = "UPDATE " . CMS_TBL . "
					SET status=:st
			                WHERE cid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':st', $_POST['st'],PDO::PARAM_INT);
            $q->bindParam(':id', $_POST['id'],PDO::PARAM_INT);
            $q->execute();

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;
	
	case "st_t":
	        try {
            $qry = "UPDATE " . PRODUCTS_TBL . "
					SET timer_stat=:st
			                WHERE prodid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':st', $_POST['st'], PDO::PARAM_INT);
            $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $q->execute();

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;

    case "ps":
        try {
            $qry = "UPDATE " . PRODUCTS_TBL . "
					SET status=:st
			                WHERE prodid=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':st', $_POST['st'], PDO::PARAM_INT);
            $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $q->execute();

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;

    case "dc":

        try {
            $qry = "DELETE FROM " . CAROUSEL_TBL . "
			    WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $q->execute();
            cache_carousel($conn);
            echo 'd';
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
        break;

    case "ca":
        if (trim($_POST['n']) != '' && trim($_POST['m'] != '')) {
            $qry = insert(ATTR_VAL, array('attr_value_id'=> 'null', 'attr_id' => ':id', 'value' => ':val'));
            $bind = array(':id' => $_POST['m'], ':val' => $_POST['n']);
            $q = $conn->prepare($qry);
            $q->execute($bind);
        }
        //echo PdoDebugger::show($qry, $bind);
        //echo json_encode(get_categories($conn));
        break;

    case "ss":

        echo product_attributes($conn, $_POST['id'], $_POST['fi']);
        break;

    case "so":

        $qry = "UPDATE " . ATTRIBUTE_VARS_TBL;
        $qry .= " SET var=:var, stock=:stock";
        if (isset($_POST['p']) && (int)$_POST['p'] > 0) {
            $qry .= ", price=:price";
        }
        $qry .= " WHERE uid=:id ";

        $q = $conn->prepare($qry);
        if (isset($_POST['p']) && (int)$_POST['p'] > 0) {
            $q->bindParam(':price', $_POST['p']);
        }
        $q->bindParam(':var', $_POST['n']);
        $q->bindParam(':id', $_POST['id']);
	 $q->bindParam(':stock', $_POST['s']);
        $q->execute();
        $rs = stripslashes($_POST['n']);
        if (isset($_POST['p']) && $_POST['p'] != '') {
            $rs .= ' / ' . $_POST['p'];
        }
        echo $rs;
        break;

    case "aa":
        if (trim($_POST['n']) != '') {
            $qry = insert(ATTRIBUTES_TBL, array('id' => 'null', 'name' => ':name'));
            $bind = array(':name' => $_POST['n']);
            $q = $conn->prepare($qry);
            $q->execute($bind);
        }

        echo get_attrib_names($conn);
        break;

    case "ao":

        $q = $conn->prepare("SELECT " . ATTRIBUTES_TBL . ".*, " . ATTRIBUTE_VARS_TBL . ".*
              FROM " . ATTRIBUTES_TBL . "
	      LEFT JOIN 
	      " . ATTRIBUTE_VARS_TBL . " ON " . ATTRIBUTES_TBL . ".id=" . ATTRIBUTE_VARS_TBL . ".id
	      WHERE " . ATTRIBUTES_TBL . ".id=:id ORDER by " . ATTRIBUTE_VARS_TBL . ".key_ desc limit 1");
        $q->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();
        $key = $row['key_'] + 1;

        if (trim($_POST['n']) != '') {
            $bind = array(':name' => $_POST['n']);
            $arr = array(
                'uid' => 'null',
                'id' => ':id',
                'key_' => $key,
                'var' => ':name'
            );
            if (isset($_POST["fp"]) && $_POST["fp"] != '') {
                $arr['price'] = ':price';
                $bind[':price'] = $_POST['fp'];
            }
                if (isset($_POST["s"]) && $_POST["s"] != '') {
                $arr['stock'] = ':stock';
                $bind[':stock'] = $_POST['s'];
            }
            $bind[':id'] = $_POST['id'];
            $qry = insert(ATTRIBUTE_VARS_TBL, $arr);
            $q = $conn->prepare($qry);
            $q->execute($bind);
        }

        $info = get_attrib_options_list($conn);
        echo $info['b'];
        break;
    case "ce":

        $qry = "UPDATE " . CATEGORIES_TBL;
        $qry .= " SET cat_name=:cat
			            WHERE catid='" . $_POST['id'] . "'";
        $q = $conn->prepare($qry);
        $q->bindParam(':cat', $_POST['n']);
        $q->execute();


        echo json_encode(get_categories($conn, $_POST['n']));
        break;

    case "sa":

        $qry = "UPDATE " . ATTRIBUTES_TBL;
        $qry .= " SET name=:attr
			            WHERE id='" . $_POST['id'] . "'";
        $q = $conn->prepare($qry);
        $q->bindParam(':attr', $_POST['n']);
        $q->execute();

        echo $_POST['n'];

        break;

}

?>