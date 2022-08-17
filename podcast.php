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

// $conn = dbconnect();
// $qry = "SELECT `detail` FROM " . CMS_TBL . " WHERE `title`='exhibition'";
// $q = $conn->query($qry);
// $q->execute();
// $q->setFetchMode(PDO::FETCH_ASSOC);
// while ($row = $q->fetch()) {
//     $data = $row['detail'];
// }

// //Get Carousel for Memorabilia images
// $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE category= 'EX' AND status=1 and image_nm!='' ";
// $q = $conn->query($sql);
// $q->setFetchMode(PDO::FETCH_ASSOC);
// $carouselHTML = '';
// $total = $q->rowCount();
// if ($total > 0) {
//     while ($carousel = $q->fetch()) {
//         $carousel['image_nm'];
//         $imageSRC = IMGSRC . "carousel/" . $carousel['image_nm'];
//         $carouselHTML .= '<div class="item"><img src="' . $imageSRC . '" alt="' . $carousel['image_nm'] . '"></div>';
//     }
// }



// $sql2 = "SELECT * FROM exhibition WHERE status = '0' ";
// $q2 = $conn->query($sql2);

// $q2->execute();
// $q2->setFetchMode(PDO::FETCH_ASSOC);
// $exrow = $q2->fetchAll();








// if (empty($_POST) || !isset($_POST)) {


//     try {



//         $sql3 = "SELECT exhibition_paintings.*,exhibition_artists.*,exhibition_medium.name mediumname  
// FROM exhibition,exhibition_paintings,exhibition_paintings_relation,exhibition_artists,exhibition_medium   
// where 
// exhibition_medium.id = exhibition_paintings.medium and 
// exhibition.id = exhibition_paintings_relation.exhibition_id and 
// exhibition_paintings_relation.painting_id = exhibition_paintings.id and 
// exhibition_paintings.artist_id = exhibition_artists.id and 
// exhibition.status = '1' order by exhibition_paintings.name ";
//         $q3 = $conn->query($sql3);

//         $q3->execute();
//         $q3->setFetchMode(PDO::FETCH_ASSOC);
//         $paintingrow = $q3->fetchAll();

//         $sql4 = "SELECT * 
// FROM exhibition   
// where 

// exhibition.status = '1' limit 1 ";
//         $q4 = $conn->query($sql4);

//         $q4->execute();
//         $q4->setFetchMode(PDO::FETCH_ASSOC);
//         $openexhibitionrow = $q4->fetchAll();

//         foreach ($openexhibitionrow as $k3 => $v3) {
//             $exhibition_name = $v3['exhibition_name'];
//         }
//     } catch (PDOException $pe) {
//         echo db_error($pe->getMessage());
//     }
//     $count = 1;
// } else {


//     $exhibition = $_POST['exhibition'];

//     try {


//         $sql3 = "SELECT exhibition_paintings.*,exhibition_artists.*,exhibition_medium.name mediumname  
// FROM exhibition,exhibition_paintings,exhibition_paintings_relation,exhibition_artists,exhibition_medium   
// where 
// exhibition_medium.id = exhibition_paintings.medium and  
// exhibition.id = exhibition_paintings_relation.exhibition_id and 
// exhibition_paintings_relation.painting_id = exhibition_paintings.id and 
// exhibition_paintings.artist_id = exhibition_artists.id and 
// exhibition_paintings.status = '1' and 
// exhibition.id = '$exhibition' order by exhibition_paintings.name ";
//         $q3 = $conn->query($sql3);

//         $q3->execute();
//         $q3->setFetchMode(PDO::FETCH_ASSOC);
//         $paintingrow = $q3->fetchAll();


//         $sql4 = "SELECT * 
// FROM exhibition   
// where 

// exhibition.id = '$exhibition' ";
//         $q4 = $conn->query($sql4);

//         $q4->execute();
//         $q4->setFetchMode(PDO::FETCH_ASSOC);
//         $openexhibitionrow = $q4->fetchAll();

//         foreach ($openexhibitionrow as $k3 => $v3) {
//             $exhibition_name = $v3['exhibition_name'];
//         }
//     } catch (PDOException $pe) {
//         echo db_error($pe->getMessage());
//     }
//     $count = 1;
// }
include(VIEWS_FOLDER . "podcastinc.php");
include(INC_FOLDER . "footerInc.php");
