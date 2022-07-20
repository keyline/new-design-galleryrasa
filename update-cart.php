<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
//print '<pre>';
//print_r($_POST);
//exit;

$conn = dbconnect();



if (!empty($_SESSION["cart_item"])) {
    $_SESSION["cart_item"][$_POST['count']]['quantity'] = $_POST['edit_quantity'];
}
goto_location('cart.php');
