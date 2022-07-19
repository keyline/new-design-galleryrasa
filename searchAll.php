<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
try {
    //Get Carousel for Biblography images
//            $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE category= 'B' AND status=1 and image_nm!='' ";
//            $q = $conn->query($sql);
//            $q->setFetchMode(PDO::FETCH_ASSOC);
//            $carouselHTML = '';
//            $total = $q->rowCount();
//            if($total > 0){
//                while($carousel = $q->fetch()){
//                    $carousel['image_nm'];
//                    $imageSRC = IMGSRC  . "carousel/" .$carousel['image_nm'];
//                    $carouselHTML .= '<div class="item"><img src="' . $imageSRC .'" alt="' . $carousel['image_nm'] . '"></div>';
//                }
//            }



    $qry = "SELECT `detail` FROM " . CMS_TBL . " WHERE `title`='Allsearch'";
    $q2 = $conn->query($qry);
    $q2->execute();
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    while ($row2 = $q2->fetch()) {
        $data = $row2['detail'];
    }


    //print_r($data);
} catch (PDOException $pe) {
    $items = db_error($pe->getMessage());
}
unset($_SESSION['bParam']);
//include(INC_FOLDER . "headerInc.php");
$home = file_get_contents(VIEWS_FOLDER . 'searchallInc.php');
$options = get_subCategory_options($conn);
$select_sub = $options['s'];


//$search = array('{subcategory_list}','{carousel_items}', '{adv-search-options}','{cms}');
//$replace = array($select_sub, $carouselHTML, $options['op'],$data);


$search = array('{cms}');
$replace = array($data);

echo $home = str_replace($search, $replace, $home);
$count = 1;

//try{
//            $conn = dbconnect();
//            $qry = "SELECT `detail` FROM ". CMS_TBL . " WHERE `title`='Bibliography'";
//            $q= $conn->query($qry);
//            $q->execute();
//            $q->setFetchMode(PDO::FETCH_ASSOC);
//            while($row = $q->fetch()){
//                $data = $row['detail'];
//            }
//            
//            if(!empty($data)) $finalContent = $home.$data;
//            echo $finalContent;
//        }catch(PDOException $pe){
//            echo db_error($pe->getMessage());
//        }
//if ($count == 0) {
//    $items = NO_PRODUCT_FOUND_MSG;
//    include(VIEWS_FOLDER . "no-results-index.php");
//} else {
//    include(VIEWS_FOLDER . "index.php");
?>

<?php

//}
//include(INC_FOLDER . "footerInc.php");
