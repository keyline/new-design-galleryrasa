<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

$adminsettingarr = get_admin_setting();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
//Initialize variables
    $params = '';
    $paramCount = 0;
    $countofRows = 0;
    $html = 0;
    $data = array();
    $keyword = '';
    $getResult = array();
//$entryPoint = [];




    if (isset($_SESSION['user-id'])) {
        $cutcreditrow = get_customer_credit($_SESSION['user-id']);

        if (!empty($cutcreditrow)) {
            $custcredit = $cutcreditrow['credit'];
        } else {
            $custcredit = 0;
        }
    }

//echo $_POST['all-search-entry'];
    if (isset($_POST['all-search-entry'])) {
        $_POST['all-search-entry'] = 'entryPoint';
    }


    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (empty($qry_arr)) {


        goto_location("visualarchive-search");
        exit;
    }



    if ((isset($_POST['srchButtonEntryPoint']) && $_POST['srchButtonEntryPoint'] == 'entryPoint') || (isset($_POST['all-search-entry']) && $_POST['all-search-entry'] == 'entryPoint')) {
//print_r($_POST);
//        print_r($_POST['visualarchive']);
//        exit;




        /**
         * Resetting $_SESSION['fParam'] here
         */
        unset($_SESSION['fParam']);
        $searchTerm = 'OR';
        $limitCount = 3;
//For displaying artist searched for
//print_r($qry_arr);

        $emptyflag = true;

//        print_r($qry_arr);

        if (count($qry_arr) > 0) {
            foreach ($qry_arr as $k => $v) {
                if ($k == 'visualarchive' || $k == 'searchall') {

//                    print_r($v);
//                    if ($v == 'va_artist') {
//                        $v = 'artist';
//                    }


                    $keyword = implode(',', array_map('ucwords', $v));


                    foreach ($v as $val) {

                        $exparr = explode(":", $val);

                        $cntarr = count($exparr);

                        if ($cntarr == '3') {

                            $newval = $exparr[0] . ":" . $exparr[1];
                            $entryPoint[] = extractKeyValuePairs($newval, ":");
                        } else {
                            $entryPoint[] = extractKeyValuePairs($val, ":");
                        }
                    }

                    $emptyflag = false;
                }
            }
        }
//
//print_r($entryPoint);
//        exit;


        if ($emptyflag == true) {
            $entryPoint = [];
        }


        //print_r($entryPoint);
        //echo $entryPoint[0]['va_artist'];

        $_SESSION['fParam'] = (!empty($entryPoint)) ? $entryPoint : null;


        /**
         * Preparing query with POST data
         */
        if (empty($entryPoint)) {
            $params2 = [];
        } else {


            foreach ($entryPoint as $value) {
                if (is_array($value)) {

                    foreach ($value as $k => $v) {
                        $params2[] = "(f.attribute_name='" . $k . "' AND v.value ='" . $v . "')";
                    }
                }
            }
        }
        $finalParam = implode(" OR ", $params2);


        if (empty($finalParam)) {

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
                    WHERE p.category_id = 19 GROUP BY t.product_id) GROUP BY t.attribute_value_id';


            $qry_img = "SELECT
                            p.prodname,
                            vam.va_image_name,
                            vam.va_is_featured,
                            vam.va_image_id,
                            p.prodid
                            FROM
                            products_ecomc p
                            INNER JOIN visual_archive_images vam ON vam.va_product_id = p.prodid
                            WHERE vam.va_product_id IN (SELECT 
                            t.product_id
                            FROM
                            products_ecomc p
                            LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                            WHERE p.category_id = 19  GROUP BY t.product_id) order BY p.prodid, vam.va_image_id";
        } else {


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
                    WHERE p.category_id = 19 AND ' . $finalParam . ' GROUP BY t.product_id) GROUP BY t.attribute_value_id';

            //Getting image details
            $qry_img = "SELECT
                            p.prodname,
                            vam.va_image_name,
                            vam.va_is_featured,
                            vam.va_image_id,
                            p.prodid
                            FROM
                            products_ecomc p
                            INNER JOIN visual_archive_images vam ON vam.va_product_id = p.prodid
                            WHERE vam.va_product_id IN (SELECT 
                            t.product_id
                            FROM
                            products_ecomc p
                            LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                            WHERE p.category_id = 19 AND " . $finalParam . "GROUP BY t.product_id) order BY p.prodid, vam.va_image_id";
        }


        $sql2 = $qry_img;
        //echo $sql;
    } elseif (isset($_POST['submitButton']) && $_POST['submitButton'] == 'VisualArchiveSearch') {
        /**
         * After Left search button POST
         * Search query
         */
        //print_r($_POST);

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
                            vam.va_image_name,
                            vam.va_is_featured,
                            vam.va_image_id,
                            p.prodid
                            FROM
                            products_ecomc p
                            INNER JOIN visual_archive_images vam ON vam.va_product_id = p.prodid
                            WHERE vam.va_product_id IN (SELECT 
                            t.product_id
                            FROM
                            products_ecomc p
                            LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
                            LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
                            LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
                            WHERE p.category_id = 19 AND " . $finalParam . "GROUP BY t.product_id) order BY p.prodid, vam.va_image_id";
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

                //print_r($row['v']);
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
                $dataImage[$row['prodid']][$row['prodname']]['image'][] = array(
                    'id' => $row['va_image_id'],
                    'name' => $row['va_image_name'],
                    'featured' => $row['va_is_featured'],
                    'product_id' => $row['prodid'],
                );
            }
        }

        //$finalData = array_merge_recursive($data, $dataImage);
        if (!empty($dataImage) && !empty($data)) {

            $finalData = array_replace_recursive($data, $dataImage);
        } else {
            $finalData = $data;
        }


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
            $year_p = 'India';
            foreach ($finalData as $filmId => $films) {
                $ids = array_column($films, 'va_country');
                foreach ($ids as $year) {
                    $year_p = implode(",", $year);
                }

                //$fid = $filmId;
                $fid = get_image_count_visualarchive($filmId);

                $prodcreditrow1 = get_product_credit($filmId);

                $getnoofpublicationsarr = getnoofpublications($filmId);

                if (empty($getnoofpublicationsarr)) {
                    $noofpublications = '';
                } else {
                    $noofpublications = 'No of Publications: ' . $getnoofpublicationsarr['value'];
                }

                //credit part is optional
//                if (empty($prodcreditrow1)) {
//                    $credithtml = 'FREE';
//                } else {
//
//                    if ($prodcreditrow1['credit'] == '0') {
//                        $credithtml = 'FREE';
//                    } else {
//
//                        $credithtml = 'Credit: ' . $prodcreditrow1['credit'];
//                    }
//                }


                $credithtml = '';



                if ($noofpublications == '' && $credithtml == '') {
                    //$imagecount = '';
                    $imagecount_html = '';
                } else {
                    //$imagecount = $fid['count_fid'];

                    if ($noofpublications == '') {
                        // $imagecount_html = '<div class="va_count_img order-2 mt-3">' . $credithtml . '&nbsp;</div>';
                    } else {


                        // $imagecount_html = '<div class="d-flex order-2 mt-3"><div class="mem_count_img">' . $credithtml . '&nbsp</div><div class="film-year">' . $noofpublications . '</div></div>';
                    }
                }



                /**
                 * Video part not required
                 * 
                  $video_mem = get_video($filmId);
                  if ((!isset($video_mem['video_link'])) || (trim($video_mem['video_link']) == '')) {
                  $video_link = '';
                  $video_html = '';
                  } else {
                  $video_link = $video_mem['video_link'];
                  $video_html = '<div class="mem-vdo"><a href="video.php?vdo=' . $video_mem['id'] . '" target="_blank"><i class="fa fa-film" aria-hidden="true"></i></a></div>';
                  }
                 * 
                 */
                $video_html = '';



                foreach ($films as $filmName => $film) {
                    if (is_array($film)) {






                        if (array_key_exists('image', $film)) {
                            foreach ($film as $k => $v) {

                                if (is_array($v) && $k == 'image') {
                                    for ($i = 0; $i < count($v); $i++) {

                                        if (isset($_SESSION['user-id'])) {




                                            $baseHTML = '<div class="artist-box-doc">
                                            <div class="line-content">
                                            <a href="%s">
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img">
                                                                %s
                                                                %s
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                        <div class="artist-sub">
                                                            <a  href="%s" class="artist-sub-btn">
                                                            %s
                                                            </a> 
                                                        </div>
                                                        </div>
                                                    
                                                        <div class="artist-year">
                                                            1941
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        </div>';

                                            $url = SITE_URL . "visualarchive-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML,$url, $imagecount_html, $video_html, $productName, $productImg , $url, $productName);
                                        } else {

                                            $modalurl = 'data-toggle="modal" data-target="#exampleModal"';








                                            $modal = '<div class="modal fade vLogin" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login To View Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="login.php">
            <div class="row">
            <div class="col-md-3">
                <label>Email <strong>*</strong></label>
            </div>
            <div class="col-md-9">
            <input type="hidden" value="' . $_SERVER['HTTP_REFERER'] . '" name="prevurl" >
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
            <div class="col-md-9">
                <a href="forget-password.php" class="btn btn-default mr-3">Forgot Password</a>
                <a href="login-register.php" >Register</a>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>';




                                            $baseHTML = '<div class="artist-box-doc">
                                            <div class="line-content">
                                            <a ' . $modalurl . '>
                                                <div class="artist-box">
                                                    <div class="artist-box-info">
                                                        <div class="artist-box-body">
                                                            <div class="artist-img">
                                                                %s
                                                                %s
                                                                <img class="img-fluid" alt="%s" src="%s">
                                                            </div>
                                                        <div class="artist-sub">
                                                            <a  ' . $modalurl . '" class="artist-sub-btn">
                                                            %s
                                                            </a> 
                                                        </div>
                                                        </div>
                                                    
                                                        <div class="artist-year">
                                                            1941
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            </div>
                                        </div>' . $modal . '';
                                            $url = SITE_URL . "/visualarchive-details/" . $filmId;
                                            $productName = $filmName;
                                            $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $productName, $productImg , $productName);
                                            //$htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $productName);
                                            //echo $key . "::" . $v[$i]['name'] . "<br>";
//                                        }
                                        }
                                    }
                                }
                            }
                        }


                        if (!array_key_exists('image', $film)) {



                            if (isset($_SESSION['user-id'])) {



                                $baseHTML = '<div class="artist-box-doc">
                                <div class="line-content">
                                <a href="%s">
                                    <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-box-body">
                                                <div class="artist-img">
                                                    %s
                                                    %s
                                                    <img class="img-fluid" alt="%s" src="%s">
                                                </div>
                                            <div class="artist-sub">
                                                <a  href="%s" class="artist-sub-btn">
                                                %s
                                                </a> 
                                            </div>
                                            </div>
                                        
                                            <div class="artist-year">
                                                1941
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            </div>';
                                $url = SITE_URL . "/visualarchive-details/" . $filmId;
                                $productName = $filmName;
                                $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                $htmlRight .= sprintf($baseHTML,$url, $imagecount_html, $video_html, $productName, $productImg , $url, $productName);

                            } else {

                                $modalurl = 'data-toggle="modal" data-target="#exampleModal"';


                                $modal = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login To View Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="login.php">
            <div class="col-md-4">
                <label>Email <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="email" id="email" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label>Password <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="password" class="form-control" name="pass" id="pass" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">

            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btn-success" value="Login">
            </div>
            <div class="col-md-4">
                <a href="forget-password.php" class="btn btn-default">Forgot Password</a>
            </div>
            
            <div class="col-md-2">
                
            </div>
            <div class="col-md-4">
                <a href="login-register.php" >Register</a>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>';


                                $baseHTML = '<div class="artist-box-doc">
                                <div class="line-content">
                                <a ' . $modalurl . '>
                                    <div class="artist-box">
                                        <div class="artist-box-info">
                                            <div class="artist-box-body">
                                                <div class="artist-img">
                                                    %s
                                                    %s
                                                    <img class="img-fluid" alt="%s" src="%s">
                                                </div>
                                            <div class="artist-sub">
                                                <a  ' . $modalurl . '" class="artist-sub-btn">
                                                %s
                                                </a> 
                                            </div>
                                            </div>
                                        
                                            <div class="artist-year">
                                                1941
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>' . $modal . '';
                                $url = SITE_URL . "/visualarchive-details/" . $filmId;
                                $productName = $filmName;
                                $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $productName, $productImg , $productName);
                                //$htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $productName);
                                //echo $key . "::" . $v[$i]['name'] . "<br>";
//                                        }
                            }



//                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                                    <div class="col-md-12">
//                                    %s
//                                    %s
//                                    <a href="%s" target="_blank">
//                                    
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                                   
//<div class="product-caption">
//                                    <h4><a href="%s" target="_blank">%s </a></h4>
//                                    </div></div>';
//                            $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                            $productName = $filmName;
//                            $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
//                            //$htmlRight .= sprintf($baseHTML, $video_html, $url, $productName, $productImg, $url, $productName);
//                       
                        }
                    }
                }
                $countofRows += sizeof($films);
            }
        }
    } catch (PDOException $pe) {
        echo $items = db_error($pe->getMessage());
    }


    $options1 = get_va_allclassification_options1($conn);
    $options2 = get_va_allclassification_options2($conn);
    $options3 = get_va_allclassification_options3($conn);
    $options4 = get_va_allclassification_options4($conn);

    $select_sub1 = $options1['s'];
    $select_sub2 = $options2['s'];
    $select_sub3 = $options3['s'];
    $select_sub4 = $options4['s'];

    $optionspublicationyear = get_va_publicationyear_options($conn);

    $select_py = $optionspublicationyear ['s'];

    $optionsartworkyear = get_va_artworkyear_options($conn);

    $select_ay = $optionsartworkyear['s'];


    $optionsmedium = get_va_medium_options($conn);

    $select_med = $optionsmedium['s'];

    $publicationoptions = allpublicationyears();
    $artworkoptions = allartworkyears();


    include(INC_FOLDER . "headerInc.php");


    if ($html) {

        $keyword = str_replace("Va_artist:", "Artist: ", $keyword);


        $styleDisplay = 'block';
//        $list = file_get_contents(VIEWS_FOLDER . 'visualarchive.Inc.php');
//        $search = array('{isShow}', '{keywordSearched}', '{countofRows}', '{rightPart}');
//        $replace = array($styleDisplay, $keyword, $countofRows, $htmlRight);
//        echo $memorabiliaView = str_replace($search, $replace, $list); 
        
        include('views/visualarchive.Inc.php');
    } else {
        $items = NO_PRODUCT_FOUND_MSG;
        include(VIEWS_FOLDER . "no-results-index.php");
    }


    include(INC_FOLDER . "footerInc.php");
}
?>


<script>
    function confirmFunction() {
        var txt;
        var r = confirm("Are you sure you want to spent credit to view this artwork!");
        if (r == true) {
            //txt = "You pressed OK!";
        } else {
            //txt = "You pressed Cancel!";
            event.preventDefault();
        }

    }
</script>


<script>
    (function ($) {
        $(document).on('contextmenu', 'img', function () {
            return false;
        })
    })(jQuery);
</script>