<?php
	require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
unset($_SESSION['fParam']);
unset($_SESSION['append']);

        include(INC_FOLDER . "headerInc.php");
   //Get dynamic content
   $conn = dbconnect(); 


$sql2 = "SELECT * FROM `podcast` ";
$q2 = $conn->query($sql2);

$q2->execute();
$q2->setFetchMode(PDO::FETCH_ASSOC);
$epirow = $q2->fetchAll();


// echo '<pre>';
// print_r($epirow);exit();
// $episodeid = $_GET['episode_id'];;
// print_r ($episodeid);
// exit();
 include(VIEWS_FOLDER . "podcastinc.php");
       include(INC_FOLDER . "footerInc.php");
?>