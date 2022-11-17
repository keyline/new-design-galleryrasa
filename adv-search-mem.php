<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

$paramCount = 0;

$qryInnerTpl= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND (v.value='%s' AND f.attribute_name = '%s') GROUP BY t.product_id)%s ";

$qryOuterTpl= "SELECT 
        p.prodid AS id,
        p.prodname AS n,
        COUNT(av.`value`) as cn,
        af.attribute_name AS an,
        av.`value` AS v
        FROM products_ecomc p 
        LEFT JOIN product_attribute_value pv ON pv.product_id=p.prodid
        LEFT JOIN attribute_value_ecomc av ON pv.attribute_value_id=av.attr_value_id
        LEFT JOIN attr_common_flds_ecomc af ON av.attr_id=af.id
        LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id
        WHERE p.prodid IN(
            select %s.product_id from (
                 %s
            ))
        GROUP BY pv.product_attr_val_id";
$joinStr= " INNER JOIN ";
$joinOnTpl= " ON %s.product_id=%s.product_id";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Initialize variables
    $params = '';
    $paramCount = 0;
    $countofRows = 0;
    $html = 0;
    $data = array();
    $countData = array();
//    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
//    if (empty($qry_arr)) {
//        goto_location($_SERVER['HTTP_REFERER']);
//        exit;
//    }
    if (isset($_POST['adv_submit']) && $_POST['adv_submit'] == 'Search') {
        unset($_SESSION['fParam']);
        $firstkey = '';
        $adv_author = trim($_POST['author']);
        $adv_attr = $_POST['attr'];
        $distributor = trim($_POST['distributor']);
        $film = trim($_POST['film']);
        $producer = trim($_POST['producer']);
        //$reel = trim($_POST['reel']);
        //$hall = trim($_POST['hall']);
        $year = trim($_POST['year']);
        //print_r($_POST);

        if ($adv_author == '' && $distributor == '' && $film == '' && $producer == '' && $year == '') {
            $data_empty = 'Empty';
        } else {
            $data_empty = 'Not Empty';
        }

        foreach ($_POST as $k => $v) {
            if ($k == 'adv_submit') {
                continue;
            }

            $params_qry[$k] = $v;
        }

        $params_qry = array_filter($params_qry);

        //Filter for -1 value
        $filterArray = array_filter($params_qry, function ($var) {
            return (strpos($var, '-1') === false);
        });
        /**
         * @allolika Dasgupta
         * Made by Allolika for diplaying keywords searched but some erros have been found
         * So changing myself @Shuvadeep Chakraborty on 07/12/2017
         */
        //Creating Session variables for Advance Search
        /**
          $keys = array_keys($params_qry);
          for($i=0; $i<count($keys);$i++){

          if($keys[$i] == 'attr'){
          $newArray[] = array(
          $params_qry[$keys[1]] => $params_qry[$keys[0]]
          );

          }else{

          $newArray[] = array(
          $keys[$i] => $params_qry[$keys[$i]]

          );
          }


          }
          $_SESSION['fParam'] = (!empty($newArray)) ? $newArray : null;

          //Making keyword Searched for displaying in frontend
          $keyword="";

          $callback =
          function ($value, $key) use (&$keyword) {
          $keyword .= $key . ":" . $value . ",";
          };

          array_walk_recursive($newArray, $callback);
         */
        //Trimmed array for spaces


        $trimmed_array = array_map('trim', $filterArray);
        //print_r($trimmed_array);
        $keys = array_keys($trimmed_array);
        $count = count($trimmed_array);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 1 && $keys[$i] == 'attr') {
                $new[] = array(
                    $trimmed_array[$keys[$i]] => $trimmed_array[$keys[$i - 1]]
                );
            } elseif ($i == 0 && $keys[$i] == 'author') {
                continue;
            } else {
                $new[] = array(
                    $keys[$i] => $trimmed_array[$keys[$i]]
                );
            }
        }
        //print_r($new);
        $_SESSION['fParam'] = (!empty($new)) ? $new : null;

        array_walk_recursive($new, function ($k, $v) use (&$new_arr) {
            // echo $k . "-" . $v . "<br>";
            $new_arr[] = ucwords(strtolower($v)) . '-' . ucwords(strtolower($k));
        });
        $keyword = implode(",", $new_arr);

        //Creating Queries
        if (array_key_exists('author', $params_qry)) {
            $qry_inner = '';
            if (array_key_exists('attr', $params_qry)) {
                $qry_inner = "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $params_qry['author'] . "%' AND f.attribute_name = '" . $params_qry['attr'] . "' GROUP BY t.product_id)author";
            } else {
                $qry_inner = "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $params_qry['author'] . "%' GROUP BY t.product_id)author";
            }
            $join = 'author';
            $i = 0;
            foreach ($params_qry as $qk => $qv) {
                if ($i == 0) {
                    //$firstkey = $qk;
                    $firstkey = 'author';
                }
                if ($qk == 'author') {
                    continue;
                }
                if ($qk == 'attr') {
                    continue;
                }
                $qry_inner .= " INNER JOIN (SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                $join = $qk;
                $i++;
            }
        } else {
            $qry_inner = '';
            $i = 0;
            if (array_key_exists('attr', $params_qry)) {
                unset($params_qry['attr']);
            }
            foreach ($params_qry as $qk => $qv) {
                //echo $params_qry[$qk];

                if ($i == 0) {
                    $firstkey = $qk;
                    $qry_inner .= " (SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' GROUP BY t.product_id)" . $qk . " ";
                    $join = $qk;
                } else {
                    $qry_inner .= " INNER JOIN (SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                    $join = $qk;
                }

                $i++;
            }
        }

        //echo $qry_inner;
        //exit;
        //$keyword = '';
        $keys = array('producer' => 1, 'story' => 1, 'director' => 1, 'photography' => 1, 'cast' => 1, 'year' => 1);
        //Comma separated search params for display in frontend

        $str = array();

        //Search query
        $sql = "SELECT 
            p.prodid AS id, 
            p.prodname AS n, 
            f.attribute_name AS an, 
            COUNT(v.`value`) as cn,
            v.`value` AS v 
            FROM 
            products_ecomc AS p 
            LEFT JOIN 
            product_attribute_value AS t 
            ON 
            p.prodid = t.product_id 
            LEFT JOIN 
            attribute_value_ecomc AS v 
            ON 
            t.attribute_value_id = v.attr_value_id 
            LEFT JOIN 
            attr_common_flds_ecomc AS f 
            ON 
            v.attr_id = f.id 
            WHERE 
            t.product_id IN 
            (SELECT 
            " . $firstkey . ".product_id 
            FROM 
            " .
                $qry_inner
                . ") group by t.attribute_value_id";

        echo $sql;

    //  $sql = vsprintf($sql, $str);
    } elseif (isset($_POST['submitButton']) && $_POST['submitButton'] == 'MemorabilaSearch') {
        //Posted data from left search
        $data_empty = 'Not Empty';

        $params_qry= array();

        $posted_details = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        //Building Inner query
        $tableIndex=1;
        $qry_inner="";
        $joinOn="";
        $sql="";
        //print_r($posted_details);
        //exit();
        $leftSearchParams=[];
        foreach ($posted_details as $key => $value) {
            # code...

            if ($key == 'submitButton' || $key == 'objSearch') {
                continue;
            }

            $currentFirstkey= $key;
            if (is_array($value)) {
                foreach ($value as $index => $attrVal) {
                    # code...
                    array_push($leftSearchParams, array($currentFirstkey => $attrVal));
                    $qry_inner .= vsprintf($qryInnerTpl, [$attrVal, $currentFirstkey, "{$currentFirstkey}{$tableIndex}",]);
                    if ($tableIndex > 1) {
                        $qry_inner .= $joinStr;
                        $prevJoinIndex=($tableIndex-1);
                        $joinOn .= vsprintf($joinOnTpl, ["{$currentFirstkey}{$tableIndex}", "{$currentFirstkey}.{$tableIndex}"]);
                    }
                    ++$tableIndex;
                }
            }
        }

        //Adding previous filter
        if (isset($_SESSION['fParam'][0])) {
            foreach ($_SESSION['fParam'][0] as $key => $value) {
                # code...
                $firstkey= $key;
                $prevJoinIndex=($tableIndex-1);
                $qry_inner .= $joinStr;
                $qry_inner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $value . "%' AND f.attribute_name = '" . $key . "' GROUP BY t.product_id)" . $firstkey . $tableIndex . " ";

                $qry_inner .= vsprintf($joinOnTpl, ["{$currentFirstkey}{$prevJoinIndex}", "{$firstkey}{$tableIndex}"]);
            }
        } else {
        }



        $sql .= vsprintf($qryOuterTpl, ["{$currentFirstkey}{$prevJoinIndex}",$qry_inner]);

        //Build keyword from searched params

        array_walk_recursive($leftSearchParams, function ($k, $v) use (&$new_arr) {
            // echo $k . "-" . $v . "<br>";
            $new_arr[] = ucwords(strtolower($v)) . '-' . ucwords(strtolower($k));
        });

        $keyword = implode(",", $new_arr);
        $firstkey= "{$firstkey}{$tableIndex}";
    } else {
        //echo 'resetting';
        $data_empty = 'Not Empty';
        $prevParams= $_SESSION['fParam'][0];
        $qry_inner="";
        $sql="";
        foreach ($prevParams as $key => $value) {
            # code...
            $firstkey= $key;
            //$qry_inner .= vsprintf($qryInnerTpl, [$value, $key]);
            $qry_inner .= " (SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 2 AND v.value like '%" . $value . "%' AND f.attribute_name = '" . $key . "' GROUP BY t.product_id)" . $firstkey . " ";
        }
        $sql .= vsprintf($qryOuterTpl, [$firstkey,$qry_inner]);


        array_walk_recursive($prevParams, function ($k, $v) use (&$new_arr) {
            // echo $k . "-" . $v . "<br>";
            $new_arr[] = ucwords(strtolower($v)) . '-' . ucwords(strtolower($k));
        });

        $keyword = implode(",", $new_arr);


        //exit();
    }


    try {
        //$conn = dbconnect();
        $q = $conn->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        if ($count) {
            $rows = $q->fetchAll();
        }
        if (!empty($rows)) {
            $data = array();
            foreach ($rows as $row) {
//                $data[$row['n']][$row['an']][] = $row['v'];
                $data[$row['id']][$row['n']][$row['an']][] = $row['v'];
                $countData[$row['an']][] = array('name' => $row['v'], 'count' => $row['cn']);
            }
        } else {
            throw new Exception("No data found!", 1);
        }

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
INNER JOIN 
memorabilia_images m 
ON 
m.product_id = p.prodid 
WHERE 
m.product_id IN 
(SELECT 
" . $firstkey . ".product_id 
FROM 
" .
                $qry_inner
                . ")";


        //  $sql2 = vsprintf($qry_img, $str);

        $q = $conn->prepare($qry_img);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();

        if ($count) {
            $dataImage = array();
            while ($row = $q->fetch()) {
                //$dataImage[$row['prodname']][$row['m_image_category_text']][] = array('id' => $row['m_image_id'],'name' => $row['m_image_name'], 'featured' => $row['is_featured'], 'product_id'=> $row['prodid']);
                $dataImage[$row['prodid']][$row['prodname']][$row['m_image_category_text']][] = array('id' => $row['m_image_id'], 'name' => $row['m_image_name'], 'featured' => $row['is_featured'], 'product_id' => $row['prodid']);
            }
        }

        //$finalData = array_merge_recursive($data, $dataImage);
        if ((!empty($dataImage) && !empty($data))) {
            $finalData = array_replace_recursive($data, $dataImage);
//            print "<pre>";
//        print_r($finalData);
        } else {
            $finalData = $data;
        }

        //$producer = array_column($finalData, 'Cast');
        //$output = custom_func($finalData);
        //$keys = array('producer' => 1, 'story' => 1, 'director' => 1, 'photography' => 1, 'music director' => 1, 'hall' => 1, 'playback' => 1, 'cast' => 1, 'film' => 1, 'color' => 1, 'year' => 1);
        $keys = array('year' => 1, 'film' => 1, 'cast' => 1, 'director' => 1, 'music' => 1, 'playback' => 1);

        //Getting left search html


        //$getResult = memorabilia_left_search($finalData, $keys, $countData);
        $getResult = memorabilia_left_search($finalData, $keys, $countData, true);
//        print "<pre>";
//        print_r($getResult);
//        exit;
        //Getting the right hand HTML
        $baseHTML = '';
        $htmlRight = '';



        if (isset($_SESSION)) {
            if (isset($_SESSION['user-id'])) {
                $usersession = true;
            } else {
                $usersession = false;
            }
        } else {
            $usersession = false;
        }


        $modal = '<div class="modal vLogin fade rasa-new-modal" id="exampleModallogin2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Login To View Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body memoraModal">
                            <form method="POST" action="login.php">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Email <strong>*</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Password <strong>*</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="pass" id="pass" required>
                                    </div> 
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <input type="submit" class="btn form-control" value="Login">
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                        <a href="forget-password.php" class="btn form-control border-0 text-left mt-1">Forgot Password</a>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-start justify-content-start mt-1">
                                        <a href="login-register.php" >Register</a>
                                    </div>
                                </div>            
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>';

        function myComparison($a, $b)
        {
            return (key($a) > key($b)) ? 1 : -1;
        }

        uasort($finalData, 'myComparison');

        if (!empty($finalData)) {
            $html = 1;
            foreach ($finalData as $filmId => $films) {
                $fid = get_image_count_memoribilia($filmId);
                $ids = array_column($films, 'year');
                foreach ($ids as $year) {
                    $year_p = implode(",", $year);
                }
                if ((!isset($fid['count_fid'])) && (!isset($year_p))) {
                    $imagecount = '';
                    $imagecount_html = '';
                } else {
                    $imagecount = $fid['count_fid'];
                    $imagecount_html = '<div class="artist-year">' . $year_p . ' <span>|</span> ' . $imagecount . ' '. 'ITEMS' . '</div>';
                }

                foreach ($films as $filmName => $film) {
                    if (is_array($film)) {
                        if (array_key_exists('Poster', $film)) {
                            foreach ($film as $k => $v) {
                                if (is_array($v) && $k == 'Poster') {
                                    for ($i = 0; $i < count($v); $i++) {
                                        if ($v[$i]['featured']) {
                                            if ($usersession == false) {
                                                $baseHTML = '<a data-toggle="modal" data-target="#exampleModallogin2">
                                                <div class="line-content">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img artist-img-bengali">                                                            
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                            <div class="artist-sub">
                                                                <a data-toggle="modal" data-target="#exampleModallogin2" class="artist-sub-btn">
                                                                    %s
                                                                </a>
                                                            </div>
                                                        </div>
                                                        %s
                                                    </div>
                                                </div>
                                                </div>
                                            </a>' . $modal;
                                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                                $productName = $filmName;
                                                $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                                $htmlRight .= sprintf($baseHTML, $productName, $productImg, $productName, $imagecount_html);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                            } else {
                                                $baseHTML = '<a href="%s" target="_blank">
                                                <div class="line-content">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img artist-img-bengali">                                                            
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                            <div class="artist-sub">
                                                                <a href="%s" target="_blank" class="artist-sub-btn">
                                                                    %s
                                                                </a>
                                                            </div>
                                                        </div>
                                                        %s
                                                    </div>
                                                </div>
                                                </div>
                                            </a>';
                                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                                $productName = $filmName;
                                                $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                                $htmlRight .= sprintf($baseHTML, $url, $productName, $productImg, $url, $productName, $imagecount_html);
                                                //echo $key . "::" . $v[$i]['name'] . "<br>";
                                            }
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
                                            if ($usersession == false) {
                                                $baseHTML = '<a data-toggle="modal" data-target="#exampleModallogin2">
                                                <div class="line-content">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img artist-img-bengali">                                                            
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                            <div class="artist-sub">
                                                                <a data-toggle="modal" data-target="#exampleModallogin2" class="artist-sub-btn">
                                                                    %s
                                                                </a>
                                                            </div>
                                                        </div>
                                                        %s
                                                    </div>
                                                </div>
                                            </div>
                                            </a>' . $modal;
                                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                                $productName = $filmName;
                                                $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                                $htmlRight .= sprintf($baseHTML, $productName, $productImg, $productName, $imagecount_html);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                            } else {
                                                $baseHTML = '<a href="%s" target="_blank">
                                                <div class="line-content">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img artist-img-bengali">                                                            
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                            <div class="artist-sub">
                                                                <a href="%s" target="_blank" class="artist-sub-btn">
                                                                    %s
                                                                </a>
                                                            </div>
                                                        </div>
                                                        %s
                                                    </div>
                                                </div>
                                            </div>
                                            </a>';
                                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                                $productName = $filmName;
                                                $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                                $htmlRight .= sprintf($baseHTML, $url, $productName, $productImg, $url, $productName, $imagecount_html);
                                                //echo $key . "::" . $v[$i]['name'] . "<br>";
                                            }
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
                                            if ($usersession == false) {
                                                $baseHTML = '<a data-toggle="modal" data-target="#exampleModallogin2">
                                                <div class="line-content">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img artist-img-bengali">                                                            
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                            <div class="artist-sub">
                                                                <a data-toggle="modal" data-target="#exampleModallogin2" class="artist-sub-btn">
                                                                    %s
                                                                </a>
                                                            </div>
                                                        </div>
                                                        %s
                                                    </div>
                                                </div>
                                                </div>
                                            </a>' . $modal;
                                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                                $productName = $filmName;
                                                $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                                $htmlRight .= sprintf($baseHTML, $productName, $productImg, $productName, $imagecount_html);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                            } else {
                                                $baseHTML = '<a href="%s" target="_blank">
                                                <div class="line-content">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img artist-img-bengali">                                                            
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                            <div class="artist-sub">
                                                                <a href="%s" target="_blank" class="artist-sub-btn">
                                                                    %s
                                                                </a>
                                                            </div>
                                                        </div>
                                                        %s
                                                    </div>
                                                </div>
                                                </div>
                                            </a>';
                                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                                $productName = $filmName;
                                                $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                                $htmlRight .= sprintf($baseHTML, $url, $productName, $productImg, $url, $productName, $imagecount_html);
                                                //echo $key . "::" . $v[$i]['name'] . "<br>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if (!array_key_exists('Synopsis', $film) && !array_key_exists('Card', $film) && !array_key_exists('Poster', $film)) {
                            if ($usersession == false) {
                                $baseHTML = '<a data-toggle="modal" data-target="#exampleModallogin2">
                                <div class="line-content">
                                <div class="artist-box">
                                    <div class="artist-box-info">
                                        <div class="artist-box-body">
                                            <div class="artist-img artist-img-bengali">                                                            
                                                <img class="img-fluid" alt="%s" src="%s">
                                            </div>
                                            <div class="artist-sub">
                                                <a data-toggle="modal" data-target="#exampleModallogin2" class="artist-sub-btn">
                                                    %s
                                                </a>
                                            </div>
                                        </div>
                                        %s
                                    </div>
                                </div>
                                </div>
                            </a>'.$modal;
                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                $productName = $filmName;
                                $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                $htmlRight .= sprintf($baseHTML, $productName, $productImg, $productName, $imagecount_html);
                            } else {
                                $baseHTML = '<a href="%s" target="_blank">
                                <div class="line-content">
                                <div class="artist-box">
                                    <div class="artist-box-info">
                                        <div class="artist-box-body">
                                            <div class="artist-img artist-img-bengali">                                                            
                                                <img class="img-fluid" alt="%s" src="%s">
                                            </div>
                                            <div class="artist-sub">
                                                <a href="%s" target="_blank" class="artist-sub-btn">
                                                    %s
                                                </a>
                                            </div>
                                        </div>
                                        %s
                                    </div>
                                </div>
                                </div>
                            </a>';
                                $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                $productName = $filmName;
                                $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                $htmlRight .= sprintf($baseHTML, $url, $productName, $productImg, $url, $productName, $imagecount_html);
                            }
                        }
                    }
                }
                $countofRows += sizeof($films);
            }
        }
    } catch (PDOException $pe) {
        $data_empty = 'Empty';

        $items = db_error($pe->getMessage());
    }

    include(INC_FOLDER . "headerInc.php");

    //if ($data_empty === false) {
    $styleDisplay = 'block';
    $list = file_get_contents(VIEWS_FOLDER . 'memorabilia.Inc.php');
    $search = array('{isShow}', '{keywordSearched}', '{countofRows}', '{leftPart}', '{rightPart}');

    if ($data_empty == 'Empty') {
        $htmlRight = '';
        $getResult = '';
    }
    $replace = array($styleDisplay, $keyword, $countofRows, $getResult, $htmlRight);

    $memorabiliaView = str_replace($search, $replace, $list);
    //}

    if (empty($finalData) && $data_empty == 'Empty') {
        $items = NO_PRODUCT_FOUND_MSG;
        include(VIEWS_FOLDER . "no-results-index.php");
    } else {
        echo $memorabiliaView;
    }

    include(INC_FOLDER . "footerInc.php");
} else {
    include(INC_FOLDER . "headerInc.php");
    $countofRows = 0;
    $html = 0;




    try {
        $qry = "SELECT
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
                    WHERE p.category_id = 2 GROUP BY t.product_id) group by t.attribute_value_id";
        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        if ($count) {
            $rows = $q->fetchAll();
        }
        if (!empty($rows)) {
            $data = array();
            foreach ($rows as $row) {
                //$data[$row['n']][$row['an']][] = $row['v'];
                $data[$row['id']][$row['n']][$row['an']][] = $row['v'];
                $countData[$row['an']][] = array('name' => $row['v'], 'count' => $row['cn']);
            }
        }
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
order BY p.prodid, m.m_image_category
";
        $q = $conn->prepare($qry_img);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();

        if ($count) {
            $dataImage = array();
            while ($row = $q->fetch()) {
                $dataImage[$row['prodid']][$row['prodname']][$row['m_image_category_text']][] = array('id' => $row['m_image_id'], 'name' => $row['m_image_name'], 'featured' => $row['is_featured'], 'product_id' => $row['prodid']);
            }
        }
        if (!empty($dataImage)) {
            $finalData = array_replace_recursive($data, $dataImage);
        } else {
            $finalData = $data;
        };


        //Getting left hand HTML
        $keys = array('producer' => 1, 'story' => 1, 'director' => 1, 'photography' => 1, 'music director' => 1, 'playback' => 1, 'cast' => 1, 'film' => 1, 'color' => 1, 'year' => 1);

        $htmlLeft = memorabilia_left_search($finalData, $keys, $countData, true);

//        print "<pre>";
//        print_r($finalData);
//        exit;
        //Getting the right hand HTML
        $baseHTML = '';
        $htmlRight = '';
        if (!empty($finalData)) {
            $html = 1;
            foreach ($finalData as $filmId => $films) {
//                print "<pre>";
//                print_r($finalData);
                $fid = get_image_count_memoribilia($filmId);
                $fid['count_fid'];
                if ($fid['count_fid'] <= 0) {
                    $imagecount = '';
                    $imagecount_html = '';
                } else {
                    $imagecount = $fid['count_fid'];
                    $imagecount_html = '<div class="mem_count_img">' . $imagecount . '</div>';
                }
                //print "<pre>";
                //print_r($films);
                //exit();
                foreach ($films as $filmName => $film) {
                    if (is_array($film)) {
                        if (array_key_exists('Poster', $film)) {
                            foreach ($film as $k => $v) {
                                if (is_array($v) && $k == 'Poster') {
                                    for ($i = 0; $i < count($v); $i++) {
                                        if ($v[$i]['featured']) {
                                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s"">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       <a href="%s" >
                       
<img class="img-responsive product-image"  style="max-height: 200px; margin: 0px auto;"alt="%s" src="%s"/></a>
                       <div class="col-md-12 product-caption">
                               <h4><a href="%s" target="_blank">%s </a></h4>
                       </div></div></div>';
                                            $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $url, $productName, $productImg, $url, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                        }
                                    }
                                }
                            }
                        } elseif (array_key_exists('Card', $film)) {
                            foreach ($film as $k => $v) {
                                if (is_array($v) && $k == 'Poster') {
                                    for ($i = 0; $i < count($v); $i++) {
                                        if ($v[$i]['featured']) {
                                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s"">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       <a href="%s">
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       <div class="col-md-12 product-caption">
                               <h4><a href="%s" target="_blank">%s </a></h4>
                       </div></div>';
                                            $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $url, $productName, $productImg, $url, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                        }
                                    }
                                }
                            }
                        } elseif (array_key_exists('Synopsis', $film)) {
                            foreach ($film as $k => $v) {
                                if (is_array($v) && $k == 'Poster') {
                                    for ($i = 0; $i < count($v); $i++) {
                                        if ($v[$i]['featured']) {
                                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s"">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       <a href="%s">
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       <div class="col-md-12 product-caption">
                               <h4><a href="%s" target="_blank">%s </a></h4>
                       </div></div>';
                                            $url = SITE_URL . "/memorabilia-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $url, $productName, $productImg, $url, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
                                        }
                                    }
                                }
                            }
                        } else {
                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s"">
                                    <div class="product-imageBox d-flex flex-column">
                                    %s
                                    <a href="%s" target="_blank">
                                    
<img class="img-responsive product-image"  style="max-height: 200px; margin: 0px auto;"alt="%s" src="%s"/></a>
                                    <div class="col-md-12 product-caption">
                                    <h4><a href="%s" target="_blank">%s </a></h4>
                                    </div></div></div>';
                            $url = SITE_URL . "/memorabilia-details/" . $filmId;
                            $productName = $filmName;
                            $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                            $htmlRight .= sprintf($baseHTML, $url, $imagecount_html, $productName, $productImg, $url, $productName);
                        }
                    }
                }
                $countofRows += sizeof($films);
            }
        }
    } catch (PDOException $pe) {
        $items = db_error($pe->getMessage());
    }
    if ($html !== 0) {
        $styleDisplay = 'none';
        $list = file_get_contents(VIEWS_FOLDER . 'memorabilia.Inc.php');
        $search = array('{isShow}', '{countofRows}', '{leftPart}', '{rightPart}');
        $replace = array($styleDisplay, $countofRows, $htmlLeft, $htmlRight);
        echo $memorabiliaView = str_replace($search, $replace, $list);
    } else {
        $heading = '<p>&nbsp;</p>';
        $items = NO_PRODUCT_FOUND_MSG;
        include(VIEWS_FOLDER . "no-results-index.php");
    }

    include(INC_FOLDER . "footerInc.php");
}
