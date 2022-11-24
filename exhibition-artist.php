<?php
$getid= $_REQUEST['id'];
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
unset($_SESSION['fParam']);
unset($_SESSION['append']);

 include(INC_FOLDER . "headerInc.php");
// dynamic start
$conn = dbconnect();
$sql1 = "SELECT *  FROM  exhibition_artists WHERE id = $getid";
$q1 = $conn->query($sql1);

$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$exrow = $q1->fetchAll();

 // print_r ($exrow); exit();

 // print_r ($exartwork); exit();

include(VIEWS_FOLDER . "home-exhibition-artist.php");
 include(INC_FOLDER . "footerInc.php");