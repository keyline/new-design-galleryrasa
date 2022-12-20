<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
unset($_SESSION['fParam']);
unset($_SESSION['append']);

include(INC_FOLDER . "headerInc.php");

//$options = get_subCategory_options($conn);
//$select_sub = $options['s'];
//Get dynamic content for Memorabilia
try {
    $conn = dbconnect();
    $qry = "SELECT `detail` FROM " . CMS_TBL . " WHERE `title`='Visual Archive'";
    $q = $conn->query($qry);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $q->fetch()) {
        $data = $row['detail'];
    }

    //Get Carousel for Memorabilia images
    $sql = "SELECT * FROM " . CAROUSEL_TBL . " WHERE category= 'VA' AND status=1 and image_nm!='' ";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $carouselHTML = '';
    $total = $q->rowCount();
    if ($total > 0) {
        while ($carousel = $q->fetch()) {
            $carousel['image_nm'];
            $imageSRC = IMGSRC . "carousel/" . $carousel['image_nm'];
            $carouselHTML .= '<div class="item"><img src="' . $imageSRC . '" alt="' . $carousel['image_nm'] . '"></div>';
        }
    }


    $options1 = get_va_allclassification_options1($conn);
    //$options2 = get_va_allclassification_options2($conn);
    //$options3 = get_va_allclassification_options3($conn);
    //$options4 = get_va_allclassification_options4($conn);

    $select_sub1 = $options1['s'];
    //$select_sub2 = $options2['s'];
    //$select_sub3 = $options3['s'];
    //$select_sub4 = $options4['s'];

    $optionspublicationyear = get_va_publicationyear_options($conn);

    $select_py = $optionspublicationyear ['s'];

    $optionsartworkyear = get_va_artworkyear_options($conn);

    $select_ay = $optionsartworkyear['s'];


    $optionsmedium = get_va_medium_options($conn);

    $select_med = $optionsmedium['s'];





    $publicationoptions = allpublicationyears();
    $artworkoptions = allartworkyears();

//    if (!empty($data) && !empty($carouselHTML)) {



//    $home = file_get_contents(VIEWS_FOLDER . 'home-visualarchive.Inc.php');



    //$finalContent = $home.$data;
    //echo str_replace('{carousel_items}', $carouselHTML, $home);



//    $search = array('{classifications1}', '{adv-search-options1}','{classifications2}', '{adv-search-options2}',
//        '{classifications3}', '{adv-search-options3}','{classifications4}', '{adv-search-options4}',
//        '{publicationyears}','{publicationoption}','{artworkyears}','{artworkoption}', '{medium}','{carousel_items}');
//    $replace = array($options1['op'], $select_sub1,$options2['op'], $select_sub2,
//        $options3['op'], $select_sub3,$options4['op'], $select_sub4,
//        $select_py,$publicationoptions, $select_ay,$artworkoptions, $select_med, $carouselHTML);
//
//
//
//    echo $home = str_replace($search, $replace, $home);



//    } else {
//        echo $home = file_get_contents(VIEWS_FOLDER . 'home-visualarchive.Inc.php');
//
//
//        $search = array('{classifications}','{adv-search-options}',);
//        $replace = array($options['op'],$select_sub,);
//
//
//        echo $home = str_replace($search, $replace, $home);
//
//    }
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}
$count = 1;


include('views/home-visualarchive.Inc.php');

include(INC_FOLDER . "footerInc.php");
