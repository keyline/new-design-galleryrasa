<?php
/* Project Name: Rasa Gallery
 * Author: Keylines
 * Author URI: http://www.keylines.net
 * Author e-mail: info@keylines.net
 * Created: DEC 2017
 * License: http://keylines.net/
 */
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

   
} else {
    $product_id = stripslashes($_REQUEST['id']);
    $prod_name = get_prod_name($product_id);
	$paginationValue= (! $paginationValue=get_pagination_value($product_id)) ? 'Not Available' : $paginationValue;
    $page =  (!empty($_REQUEST['section'])) ? $_REQUEST['section'] : null;
    $include_page = ($page === NULL) ? "post-va-images-tpl.php" : "";
    include(ADMIN_HTML . "admin-headerInc.php");
    $cf = file_get_contents(ADMIN_HTML . $include_page);
    $replace = array('{productID}', '{ProductName}', '{pagination}', '{data-prodid}');
     $items = array($product_id, $prod_name['prodname'], $paginationValue, $product_id);
    echo str_replace($replace, $items, $cf);
    include(ADMIN_HTML . "admin-footerInc.php");
}

?>  