<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Initialize variables
    $params = '';
    $paramCount = 0;
    $countofRows = 0;
    $html = 0;
    $data = array();
    $keyword = '';
    $getResult = array();



    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (empty($qry_arr)) {
        goto_location("memorabilia-search");
        exit;
    }
    if (isset($_POST['srchButtonEntryPoint']) && $_POST['srchButtonEntryPoint'] == 'entryPoint') {
//        print_r($_POST);

        /**
         * Resetting $_SESSION['fParam'] here
         */
        unset($_SESSION['fParam']);
        $searchTerm = 'OR';
        $limitCount = 3;
        //For displaying artist searched for
        if (count($qry_arr) > 0) {
            foreach ($qry_arr as $k => $v) {
                if ($k == 'memorabilia') {
                    $keyword = implode(',', array_map('ucwords', $v));
                    foreach ($v as $val) {
                        $entryPoint[] = extractKeyValuePairs($val, ":");
                    }
                }
            }
        }
        //print_r($entryPoint);
        $_SESSION['fParam'] = (!empty($entryPoint)) ? $entryPoint : null;


        /**
         * Preparing query with POST data
         */
        foreach ($entryPoint as $value) {
            if (is_array($value)) {

                foreach ($value as $k => $v) {
                    $params2[] = "(f.attribute_name='" . $k . "' AND v.value ='" . $v . "')";
                }
            }
        }
        $finalParam = implode(" OR ", $params2);

        $sql = 'SELECT
                    p.prodid AS id,            
                    p.prodname  AS n,
                    f.attribute_name AS an,
                    COUNT(v.value) as cn,
                    v.`value` AS v
                    FROM
                    products_ecomc AS p
                    LEFT JOIN product_attribute_value AS t 
                    ON p.prodid = t.product_id
                    LEFT JOIN attribute_value_ecomc AS v 
                    ON t.attribute_value_id = v.attr_value_id
                    LEFT JOIN attr_common_flds_ecomc AS f 
                    ON v.attr_id = f.id 
                    WHERE t.product_id IN (SELECT 
                    t.product_id
                    FROM
                    products_ecomc p
                    LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                    LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                    LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                    WHERE p.category_id = 2 AND ' . $finalParam . ' GROUP BY t.product_id) GROUP BY t.attribute_value_id';

        //Getting image details
        $qry_img = "SELECT
                            p.prodname,
                            m.m_image_name,
                            m.m_image_category_text,
                            m.is_featured,
                            m.m_image_id,
                            p.prodid
                            FROM
                            products_ecomc p
                            INNER JOIN memorabilia_images m ON m.product_id = p.prodid
                            WHERE m.product_id IN (SELECT 
                            t.product_id
                            FROM
                            products_ecomc p
                            LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                            WHERE p.category_id = 2 AND " . $finalParam . "GROUP BY t.product_id) order BY p.prodid, m.m_image_category";
        $sql2 = $qry_img;
        //echo $sql;
    } elseif (isset($_POST['submitButton']) && $_POST['submitButton'] == 'MemorabilaSearch') {
        /**
         * After Left search button POST
         * Search query
         */
       // print_r($_POST);

        foreach ($_POST as $k => $v) {

            if ($k == 'submitButton' OR $k == 'objSearch')
                continue;
            $match = "-1";
            $str = implode(',', $v);
            if (stripos($str, $match) !== false)
                continue;
            $params_qry[$k] = $v;
        }

        /**
         * Pushing left search params to $_SESSION['fParam']
         */
//        print "<pre>";
//        print_r($_SESSION['fParam']);
//        print_r($params_qry);
        //Changing structue of the $params_qry as to SESSION variable structure
        foreach ($params_qry as $key => $val) {
            $attr = $key;
            if (is_array($val)) {
                foreach ($val as $v) {
                    $newArray[] = array(
                        $attr => $v
                    );
                }
            }
        }

        //Appending New search terms to $_SESSION['append'] after comparing $_SESSION['bParam']
        $sessAppend = array_map('unserialize', array_diff(array_map('serialize', $newArray), array_map('serialize', $_SESSION['fParam'])));

        foreach ($sessAppend AS $newsess) {
            if (is_array($newsess)) {

                $_SESSION['append'][] = $newsess;
            }
        }

        $queryInner = '';
        $keyword = implode(", ", r_implode($params_qry, ","));

        $i = 0;
        $p = 1;
        $arrayCount = 0;
        //print "<pre>";
       // print_r($params_qry);
        foreach ($params_qry AS $k => $value) {

            $key = $k;
            $arrayCount += sizeof($value);
            if (is_array($value)) {
                if ($key == 'year_range') {

                    $match = "-1";

                    $stringCheck = implode(" ", $params_qry['year_range']);
                    if (stripos($stringCheck, $match) === false) {
                        $j = $i++;
                        $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
                    attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
                p.category_id = 2 AND v.value BETWEEN " . implode(" AND ", $params_qry['year_range']) . " AND f.attribute_name = 'year' GROUP BY t.product_id)t" . $i;

                        if ($i == 1) {
                            $queryInner .= " INNER JOIN ";
                        }
                        if ($i >= 2 && $i <= $arrayCount)
                            $queryInner .= " ON t" . $j . ".product_id = t" . $i . ".product_id INNER JOIN ";
                    }
                }else {

                    foreach ($value AS $v) {

                        $j = $i++;

//                    for($i = $j; $i<count($v); $i++)
                        $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value='" . $v . "' AND f.attribute_name = '" . $k . "' GROUP BY t.product_id)t" . $i;

                        if ($i == 1) {
                            $queryInner .= " INNER JOIN ";
                        }
                        if ($i >= 2 && $i <= $arrayCount)
                            $queryInner .= " ON t" . $j . ".product_id = t" . $i . ".product_id INNER JOIN ";
                    }
                }
            }
        }
        //Remove Extra "INNER JOIN" from queryinner
        $count = strlen($queryInner);
        $queryInner = substr($queryInner, 0, ($count - 12));

//*********************Debug Purpose*************//        
//$queryInner .= "ON t" . $i .".product_id = t" .($i-1) . ".product_id";
//         echo $queryInner;
//         echo $arrayCount . "<br>";
//         echo $i;
//*********************Debug Purpose*************//
        //Wrapping Query Inner with outer query to get full query


        $outerQuery = "SELECT
                    p.prodid AS id,            
                    p.prodname  AS n,
                    f.attribute_name AS an,
                    COUNT(v.value) as cn,
                    v.`value` AS v
                    FROM
                    products_ecomc AS p
                    LEFT JOIN product_attribute_value AS t 
                    ON p.prodid = t.product_id
                    LEFT JOIN attribute_value_ecomc AS v 
                    ON t.attribute_value_id = v.attr_value_id
                    LEFT JOIN attr_common_flds_ecomc AS f 
                    ON v.attr_id = f.id 
                    WHERE t.product_id IN(SELECT t1.product_id FROM (%s)) group by t.attribute_value_id";
        //Merge Queries
        $sql = sprintf($outerQuery, $queryInner);

        //Getting image details
        $qry_img = "SELECT
                    p.prodname,
                    m.m_image_name,
                    m.m_image_category_text,
                    m.is_featured,
                    m.m_image_id,
                    p.prodid
                    FROM
                    products_ecomc p
                    INNER JOIN memorabilia_images m ON m.product_id = p.prodid
                    WHERE m.product_id IN (SELECT t1.product_id FROM (%s))";

        $sql2 = sprintf($qry_img, $queryInner);
        //echo $sql;
    }else {

        foreach ($_SESSION['fParam'] as $value) {
            if (is_array($value)) {

                foreach ($value as $k => $v) {
                    $params2[] = "(f.attribute_name='" . $k . "' AND v.value ='" . $v . "')";
                }
            }
        }
        unset($_SESSION['append']);
        $finalParam = implode(" OR ", $params2);
        $keyword = implode(", ", r_implode($_SESSION['fParam'], ","));

        $sql = 'SELECT
                    p.prodid AS id,            
                    p.prodname  AS n,
                    f.attribute_name AS an,
                    COUNT(v.`value`) as cn,
                    v.`value` AS v
                    FROM
                    products_ecomc AS p
                    LEFT JOIN product_attribute_value AS t 
                    ON p.prodid = t.product_id
                    LEFT JOIN attribute_value_ecomc AS v 
                    ON t.attribute_value_id = v.attr_value_id
                    LEFT JOIN attr_common_flds_ecomc AS f 
                    ON v.attr_id = f.id 
                    WHERE t.product_id IN (SELECT 
                    t.product_id
                    FROM
                    products_ecomc p
                    LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                    LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                    LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                    WHERE p.category_id = 2 AND ' . $finalParam . ' GROUP BY t.product_id) group by t.attribute_value_id';

        //Getting image details
        $qry_img = "SELECT
                            p.prodname,
                            m.m_image_name,
                            m.m_image_category_text,
                            m.is_featured,
                            m.m_image_id,
                            p.prodid
                            FROM
                            products_ecomc p
                            INNER JOIN memorabilia_images m ON m.product_id = p.prodid
                            WHERE m.product_id IN (SELECT 
                            t.product_id
                            FROM
                            products_ecomc p
                            LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                            WHERE p.category_id = 2 AND " . $finalParam . "GROUP BY t.product_id) order BY p.prodid, m.m_image_category";
        $sql2 = $qry_img;
        //echo $sql;
    }




    try {
        //print "<pre>";
        // print_r($_SESSION['fParam']);
        $conn = dbconnect();
        $countData = array();
        /**
          $str = array();
          $s = count($qstr);
          $a = array('with', 'less', 'and');    # ignore these search terms
          $count = 0;
          for ($i = 0; $i < $s; $i++) {
          (strlen($qstr[$i]) > 0 && !in_array(strtolower($qstr[$i]), $a)) ? (array_push($str, addslashes($qstr[$i]))) : ('');
          }
          //print_r($qstr);

         * */
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        if ($count) {
            $rows = $q->fetchAll();
        }
        //print "<pre>";
        //print_r($rows);
        //exit(0);
        if (!empty($rows)) {
            $data = array();
            foreach ($rows as $row) {

//                $data[$row['n']][$row['an']][] = $row['v'];
                $data[$row['id']][$row['n']][$row['an']][] = $row['v'];
                $countData[$row['an']][] = array('name' => $row['v'], 'count' => $row['cn']);
            }
        }

//      print "<pre>";
//         print_r($countData);

        $q = $conn->prepare($sql2);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();

        if ($count) {
            $dataImage = array();
            while ($row = $q->fetch()) {
                //$dataImage[$row['prodname']][$row['m_image_category_text']][] = array('id' => $row['m_image_id'],'name' => $row['m_image_name'], 'featured' => $row['is_featured'], 'product_id'=> $row['prodid']);
                $dataImage[$row['prodid']][$row['prodname']][$row['m_image_category_text']][] = array(
                    'id' => $row['m_image_id'],
                    'name' => $row['m_image_name'],
                    'featured' => $row['is_featured'],
                    'product_id' => $row['prodid'],
                );
            }
        }
        
        //$finalData = array_merge_recursive($data, $dataImage);
        if (!empty($dataImage) && !empty($data)) {

            $finalData = array_replace_recursive($data, $dataImage);
        } else {
            $finalData = $data;
        };

        //$producer = array_column($finalData, 'Cast');
        //$output = custom_func($finalData);
        $keys = array('year' => 1, 'film' => 1, 'cast' => 1, 'director' => 1, 'music' => 1, 'playback' => 1);

        //Getting left search html
        $getResult = memorabilia_left_search($finalData, $keys, $countData);
//        print "<pre>";
//        print_r($finalData);
        //var_dump($getResult);
//        exit;
        //Getting the right hand HTML
        $baseHTML = '';
        $htmlRight = '';

        function myComparison($a, $b) {
            return (key($a) > key($b)) ? 1 : -1;
        }

        uasort($finalData, 'myComparison');
           // print '<pre>';
            //print_r($finalData);
            //exit(0);

        if (!empty($finalData)) {
            $html = 1;

            foreach ($finalData as $filmId => $films) {
                $ids = array_column($films, 'year');
                foreach ($ids as $year) {
                    $year_p = implode(",", $year);
                }

                //$fid = $filmId;
                $fid = get_image_count_memoribilia($filmId);
                if ((!isset($fid['count_fid'])) && (!isset($year_p))) {
                    $imagecount = '';
                    $imagecount_html = '';
                } else {
                    $imagecount = $fid['count_fid'];
                    $imagecount_html = '<div class="mem_count_img">' . $imagecount . '&nbsp;Item&nbsp;</div><div class="film-year">' . $year_p . '</div>';
                }

                $video_mem = get_video($filmId);
                if ((!isset($video_mem['video_link'])) || (trim($video_mem['video_link']) == '')) {
                    $video_link = '';
                    $video_html = '';
                } else {
                    $video_link = $video_mem['video_link'];
                    $video_html = '<div class="mem-vdo"><a href="video.php?vdo=' . $video_mem['id'] . '" target="_blank"><i class="fa fa-film" aria-hidden="true"></i></a></div>';
                }




                foreach ($films as $filmName => $film) {
                    if (is_array($film)) {

                        if (array_key_exists('Poster', $film)) {
                            foreach ($film as $k => $v) {

                                if (is_array($v) && $k == 'Poster') {
                                    for ($i = 0; $i < count($v); $i++) {

                                        if ($v[$i]['featured']) {

                                            $baseHTML = '<div class="col-sm-6 col-md-3 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="col-md-12 product-imageBox">
                       %s
                       %s
                       <a href="%s" target="_blank">
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       
                        <div class=" col-md-12 product-caption">
                       
                               <h4><a href="%s" target="_blank">%s </a></h4>
                       </div></div>';
                                            $url = SITE_URL . "/visual-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                        }
                                    }
                                }
                            }
                        }
                        if (array_key_exists('Card', $film)) {
                            foreach ($film as $k => $v) {

                                if (is_array($v) && $k == 'Card') {
                                    for ($i = 0; $i < count($v); $i++) {

                                        if ($v[$i]['featured']) {
                                            $baseHTML = '<div class="col-sm-6 col-md-3 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="col-md-12 product-imageBox">
                       %s
                       %s
                       <a href="%s" target="_blank">
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                      
    <div class=" col-md-12 product-caption">
                               <h4><a href="%s" target="_blank">%s </a></h4>
                       </div></div>';
                                            $url = SITE_URL . "/visual-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                        }
                                    }
                                }
                            }
                        }
                        if (array_key_exists('Synopsis', $film)) {
                            foreach ($film as $k => $v) {

                                if (is_array($v) && $k == 'Synopsis') {
                                    for ($i = 0; $i < count($v); $i++) {

                                        if ($v[$i]['featured']) {
                                            $baseHTML = '<div class="col-sm-6 col-md-3 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="col-md-12 product-imageBox">
                       %s
                       %s
                       <a href="%s" target="_blank">
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       
                       <div class=" col-md-12 product-caption">
                               <h4><a href="%s" target="_blank">%s </a></h4>
                       </div></div>';
                                            $url = SITE_URL . "/visual-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                        }
                                    }
                                }
                            }
                        }
                        if (!array_key_exists('Synopsis', $film) && !array_key_exists('Card', $film) && !array_key_exists('Poster', $film)) {
                            $baseHTML = '<div class="col-sm-6 col-md-3 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s">
                                    <div class="col-md-12 product-imageBox">
                                    %s
                                    %s
                                    <a href="%s" target="_blank">
                                    
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                                   
<div class="col-md-12 product-caption">
                                    <h4><a href="%s" target="_blank">%s </a></h4>
                                    </div></div>';
                            $url = SITE_URL . "/visual-details/" . $filmId;
                            $productName = $filmName;
                            $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
                        }
                    }
                }
                $countofRows += sizeof($films);
            }
        }
    } catch (PDOException $pe) {
        echo $items = db_error($pe->getMessage());
    }
    include(INC_FOLDER . "headerInc.php");


    if ($html) {
        $styleDisplay = 'block';
        $list = file_get_contents(VIEWS_FOLDER . 'visual-archive.Inc.php');
        $search = array('{isShow}', '{keywordSearched}', '{countofRows}', '{leftPart}', '{rightPart}');
        $replace = array($styleDisplay, $keyword, $countofRows, $getResult, $htmlRight);
        echo $memorabiliaView = str_replace($search, $replace, $list);
    } else {
        $items = NO_PRODUCT_FOUND_MSG;
        include(VIEWS_FOLDER . "no-results-index.php");
    }


    include(INC_FOLDER . "footerInc.php");
}



