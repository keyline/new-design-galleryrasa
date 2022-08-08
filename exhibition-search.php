<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
unset($_SESSION['fParam']);
unset($_SESSION['append']);

   include(INC_FOLDER . "headerInc.php");

//Get dynamic content for Memorabilia

$conn = dbconnect();
$currentDateTime = date("Y-m-d");
$sql2 = "SELECT * FROM `exhibition` WHERE `from_exhibition_date` <= '$currentDateTime' AND `end_exhibition_date` >= '$currentDateTime' ";
$q2 = $conn->query($sql2);

$q2->execute();
$q2->setFetchMode(PDO::FETCH_ASSOC);
$exrow = $q2->fetchAll();
 


// echo $currentDateTime; exit();

$sql = "SELECT * FROM `exhibition` WHERE `from_exhibition_date` > '$currentDateTime' ";
$q = $conn->query($sql);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);
$exrow1 = $q->fetchAll();

$sql1 = "SELECT * FROM `exhibition` WHERE `from_exhibition_date` <= '$currentDateTime' AND `end_exhibition_date` < '$currentDateTime' ";
$q1 = $conn->query($sql1);
$q1->execute();
$q1->setFetchMode(PDO::FETCH_ASSOC);
$exrow2 = $q1->fetchAll();



// for($i=0; $i < count($exrow); $i++)
// {
// 	if($exrow[$i]['from_exhibition_date'] > date("Y-m-d")){
// 		echo "upcoming <br>";	
// 	}
// 	else if($exrow[$i]['from_exhibition_date'] < date("Y-m-d"))
// 	{
// 		if ($exrow[$i]['end_exhibition_date'] > date("Y-m-d")) {
// 			echo "current <br>";
// 		}
// 		else
// 		{
// 			echo "past <br>";
// 		}
		
// 	}
	
// }
include(VIEWS_FOLDER . "home-exhibitionInc.php");
   include(INC_FOLDER . "footerInc.php");
