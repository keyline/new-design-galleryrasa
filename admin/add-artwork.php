<?php

/* Project Name: e-Com Cart
 * Author: LobisDev
 * Author URI: http://www.lobisdev.one/ecom-cart
 * Author e-mail: admin@lobisdev.one
 * Created: Nov 2015
 * License: http://codecanyon.net/
 */
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


$people_id = stripslashes($_REQUEST['people_id']);
$qry_org = "SELECT * from attribute_value_ecomc where attr_value_id = '$people_id'";

$q_org = $conn->prepare($qry_org);
$q_org->execute();
$q_org->setFetchMode(PDO::FETCH_ASSOC);
$row_org = $q_org->fetch();
$people_name = $row_org['value'];

include(ADMIN_HTML . "admin-headerInc.php");
$cf = file_get_contents(ADMIN_HTML . 'add-artwork-tpl.php');
$replace = array('{peopleID}','{peopleName}');

$items = array($people_id, $people_name);
echo str_replace($replace, $items, $cf);
include(ADMIN_HTML . "admin-footerInc.php");
?>  