<?php
$conn = dbconnect();
$params = '';
$paramCount = 0;
$countofRows = 0;
$html = 0;
$data = array();
$keyword = '';
$getResult = array();


//$visualarchive1arr = $_POST['visualarchive1'];






$qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);




$searchTerm = 'OR';
$limitCount = 3;
//For displaying artist searched for
//print_r($qry_arr);

$emptyflag = true;

//        print_r($qry_arr);

if (count($qry_arr) > 0) {
    foreach ($qry_arr as $k => $v) {
        if ($k == 'visualarchive1') {



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

if (isset($_POST['classification1'])) {

    $classificationflag = true;

    $classification1arr = $_POST['classification1'];

    $cntclassification = count($classification1arr);

    $cls1i = 1;
    $classification1str = '';
    $classificationsearchkey = ',Classification: ';
    foreach ($classification1arr as $ckey => $cval) {

        if ($cls1i == '1') {
            $classification1str .= "(f.attribute_name='va_classification' AND v.value ='" . $cval . "')";
        } else {
            $classification1str .= " OR (f.attribute_name='va_classification' AND v.value ='" . $cval . "')";
        }

        if ($cntclassification == $cls1i) {
            $classificationsearchkey .= $cval;
        } else {
            $classificationsearchkey .= $cval . ',';
        }



        $cls1i++;
    }

    $keyword .= $classificationsearchkey;
} else {
    $classificationflag = false;
}

if (empty($finalParam) && $classificationflag == false) {

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
                    WHERE p.category_id = 19 GROUP BY t.product_id) GROUP BY t.attribute_value_id order by p.prodname';


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


    if (($classificationflag == false) && !empty($finalParam)) {


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
                    WHERE p.category_id = 19 AND ' . $finalParam . ' GROUP BY t.product_id) 
                    GROUP BY t.attribute_value_id order by p.prodname';

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
    } else if (($classificationflag == true) && empty($finalParam)) {

        $sql = "SELECT
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
                    WHERE p.category_id = 19 AND " . $classification1str . " GROUP BY t.product_id) 
                    GROUP BY t.attribute_value_id  order by p.prodname";

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
                            WHERE p.category_id = 19 AND " . $classification1str . " GROUP BY t.product_id) order BY p.prodid, vam.va_image_id";
    } else {
        $sql = "SELECT p.prodid AS id, p.prodname AS n, f.attribute_name AS an, COUNT(v.value) as cn, v.`value` AS v 
FROM products_ecomc AS p 
 JOIN product_attribute_value AS t ON p.prodid = t.product_id 
 JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
 JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
WHERE t.product_id IN 
(
select a.product_id from
(SELECT t.product_id   
 FROM products_ecomc p 
  JOIN product_attribute_value t ON p.prodid = t.product_id 
  JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
  JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where p.category_id = 19 and " . $classification1str . " GROUP BY t.product_id)a
,
(SELECT t.product_id   
 FROM products_ecomc p 
 LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
 LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
 LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
 where p.category_id = 19 
 and " . $finalParam . " GROUP BY t.product_id)b where a.product_id = b.product_id) GROUP BY t.attribute_value_id  order by p.prodname";


        $qry_img = "SELECT
p.prodname,
vam.va_image_name,
vam.va_is_featured,
vam.va_image_id,
p.prodid
FROM
products_ecomc p
INNER JOIN visual_archive_images vam ON vam.va_product_id = p.prodid
WHERE vam.va_product_id IN 
(select a.product_id from
(SELECT 
t.product_id
FROM
products_ecomc p
LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
WHERE p.category_id = 19 
AND  " . $classification1str . " GROUP BY t.product_id)a
,
(SELECT 
t.product_id
FROM
products_ecomc p
LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
WHERE p.category_id = 19 
AND " . $finalParam . " GROUP BY t.product_id)b  
where a.product_id = b.product_id) 
order BY p.prodid, vam.va_image_id";
    }
}

$sql2 = $qry_img;
//    echo $sql;
//    echo '<br>';
//    echo $qry_img;


try {
    //print "<pre>";
    // print_r($_SESSION['fParam']);
    
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
                    $imagecount_html = '<div class="va_count_img order-2 mt-3">' . $credithtml . '&nbsp;</div>';
                } else {


                    $imagecount_html = '<div class="d-flex order-2 mt-3"><div class="mem_count_img">' . $credithtml . '&nbsp</div><div class="film-year">' . $noofpublications . '</div></div>';
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




                                        $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       %s
                       <a href="%s" target="_blank" >
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       
                        <div class="product-caption">
                       
                               <h4><a  href="%s" target="_blank">%s </a></h4>
                       </div></div>';


                                        $url = SITE_URL . "/visualarchive-details/" . $filmId;
                                        $productName = $filmName;
                                        $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                        $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);








                                        // credit part is optional                                         
//                                            $prodcreditrow = get_product_credit($filmId);
//
//                                            $prodcredit = $prodcreditrow['credit'];
//
//                                            if (empty($prodcreditrow) || $prodcreditrow['credit'] == '0') {
//
//
//
//
//
//                                                $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                       <div class="product-imageBox d-flex flex-column">
//                       %s
//                       %s
//                       <a href="%s" target="_blank" >
//                       
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                       
//                        <div class="product-caption">
//                       
//                               <h4><a  href="%s" target="_blank">%s </a></h4>
//                       </div></div>';
//
//
//                                                $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                                                $productName = $filmName;
//                                                $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                                                $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
//                                            } else {
//
//
//                                                if ($prodcredit > $custcredit) {
//
//                                                    $modalurlchk1 = 'data-toggle="modal" data-target="#creditModal' . $filmId . '"';
//
//                                                    $modal1 = '<div class="modal fade" id="creditModal' . $filmId . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
//  <div class="modal-dialog" role="document">
//    <div class="modal-content">
//      <div class="modal-header">
//        <h5 class="modal-title" id="exampleModalLabel">Credit of ' . $filmName . '</h5>
//        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//          <span aria-hidden="true">&times;</span>
//        </button>
//      </div>
//      <div class="modal-body">
//        You cannot view the details.<br>
//        You need ' . $prodcredit . ' credit to view this artwork.<br>
//        You have only ' . $custcredit . ' credits left.
//      </div>
//      <div class="modal-footer">
//        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
//        
//      </div>
//    </div>
//  </div>
//</div>';
//
//                                                    $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                       <div class="product-imageBox d-flex flex-column">
//                       %s
//                       %s
//                       <a ' . $modalurlchk1 . '>
//                       
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                       
//                        <div class=" product-caption">
//                       
//                               <h4><a ' . $modalurlchk1 . '>%s </a></h4>
//                       </div></div>' . $modal1 . '';
//
//                                                    $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                                                    $productName = $filmName;
//                                                    //$productImg = (!empty($v[$i]['name'])) ? (SITE_URL . '/' . THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                                                    $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//
//                                                    $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $productName, $productImg, $productName);
//                                                    //$htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $productName);
//                                                } else {
//
//
//                                                    $produtcustcreditchk = product_in_cust_credit($_SESSION['user-id'], $filmId);
//                                                    if ($produtcustcreditchk == true) {
//
//                                                        $creditetimediffrow = get_credit_timediff($filmId);
//
//                                                        $timediffseconds = $creditetimediffrow['timediff'];
//
//                                                        $sevendayssecondsdiff = (3600 * 24) * $adminsettingarr['credit_dayspan'];
//
//
//                                                        if ($timediffseconds > $sevendayssecondsdiff) {
//
//
//                                                            $onclickvar = ' onclick="confirmFunction()" ';
//                                                        } else {
//                                                            $onclickvar = '';
//                                                        }
//                                                    } else {
//                                                        $onclickvar = ' onclick="confirmFunction()" ';
//                                                    }
//
//
//
//                                                    $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                       <div class="product-imageBox d-flex flex-column">
//                       %s
//                       %s
//                       <a href="%s" target="_blank"   ' . $onclickvar . ' >
//                       
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                       
//                        <div class=" product-caption">
//                       
//                               <h4><a  href="%s" target="_blank"  ' . $onclickvar . ' >%s </a></h4>
//                       </div></div>';
//
//
//                                                    $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                                                    $productName = $filmName;
//                                                    $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                                                    $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
//                                                }
//                                            }
                                    } else {

//                                        if ($v[$i]['featured']) {


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




                                        $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       %s
                       <a ' . $modalurl . '>
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       
                        <div class=" product-caption">
                       
                               <h4><a ' . $modalurl . '>%s </a></h4>
                       </div></div>' . $modal . '';
                                        $url = SITE_URL . "/visualarchive-details/" . $filmId;
                                        $productName = $filmName;
                                        $productImg = (!empty($v[$i]['name'])) ? (ORG_SITE_URL . '/' . VA_THUMB_IMGS . $v[$i]['name']) : (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                                        $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $productName, $productImg, $productName);
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



                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       %s
                       <a href="%s" target="_blank" >
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       
                        <div class=" product-caption">
                       
                               <h4><a  href="%s" target="_blank" >%s </a></h4>
                       </div></div>';




                            $url = SITE_URL . "/visualarchive-details/" . $filmId;
                            $productName = $filmName;
                            $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);










// Credit part is optional
//                                $prodcreditrow = get_product_credit($filmId);
//
//                                $prodcredit = $prodcreditrow['credit'];
//
//                                if (empty($prodcreditrow) || $prodcreditrow['credit'] == '0') {
//
//                                    $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                       <div class="product-imageBox d-flex flex-column">
//                       %s
//                       %s
//                       <a href="%s" target="_blank" >
//                       
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                       
//                        <div class=" product-caption">
//                       
//                               <h4><a  href="%s" target="_blank" >%s </a></h4>
//                       </div></div>';
//
//
//
//
//                                    $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                                    $productName = $filmName;
//                                    $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                                    $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
//                                } else {
//
//
//                                    if ($prodcredit > $custcredit) {
//
//                                        $modalurlchk1 = 'data-toggle="modal" data-target="#creditModal' . $filmId . '"';
//
//                                        $modal1 = '<div class="modal fade" id="creditModal' . $filmId . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
//  <div class="modal-dialog" role="document">
//    <div class="modal-content">
//      <div class="modal-header">
//        <h5 class="modal-title" id="exampleModalLabel">Credit of ' . $filmName . '</h5>
//        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//          <span aria-hidden="true">&times;</span>
//        </button>
//      </div>
//      <div class="modal-body">
//        You cannot view the details.<br>
//        You need ' . $prodcredit . ' credit to view this artwork.<br>
//        You have only ' . $custcredit . ' credits left.
//      </div>
//      <div class="modal-footer">
//        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
//        
//      </div>
//    </div>
//  </div>
//</div>';
//
//                                        $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                       <div class="product-imageBox d-flex flex-column">
//                       %s
//                       %s
//                       <a ' . $modalurlchk1 . '>
//                       
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                       
//                        <div class=" product-caption">
//                       
//                               <h4><a ' . $modalurlchk1 . '>%s </a></h4>
//                       </div></div>' . $modal1 . '';
//
//                                        $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                                        $productName = $filmName;
//                                        $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                                        $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $productName, $productImg, $productName);
//                                        //$htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $productName);
//                                    } else {
//
//
//
//
//                                        $produtcustcreditchk = product_in_cust_credit($_SESSION['user-id'], $filmId);
//                                        if ($produtcustcreditchk == true) {
//
//                                            $creditetimediffrow = get_credit_timediff($filmId);
//
//                                            $timediffseconds = $creditetimediffrow['timediff'];
//
//                                            $sevendayssecondsdiff = (3600 * 24) * $adminsettingarr['credit_dayspan'];
//
//
//                                            if ($timediffseconds > $sevendayssecondsdiff) {
//
//
//                                                $onclickvar = ' onclick="confirmFunction()" ';
//                                            } else {
//                                                $onclickvar = '';
//                                            }
//                                        } else {
//                                            $onclickvar = ' onclick="confirmFunction()" ';
//                                        }
//
//
//
//
//
//
//
//                                        $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
//                       <div class="product-imageBox d-flex flex-column">
//                       %s
//                       %s
//                       <a href="%s" target="_blank" ' . $onclickvar . '>
//                       
//<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
//                       
//                        <div class=" product-caption">
//                       
//                               <h4><a  href="%s" target="_blank" ' . $onclickvar . ' >%s </a></h4>
//                       </div></div>';
//
//
//
//
//                                        $url = SITE_URL . "/visualarchive-details/" . $filmId;
//                                        $productName = $filmName;
//                                        $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
//                                        $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $url, $productName, $productImg, $url, $productName);
//                                    }
//                                }
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


                            $baseHTML = '<div class="col-sm-6 col-md-4 product-outerBorder wow flipInX text-center" data-wow-duration="1s" data-wow-delay="0.5s">
                       <div class="product-imageBox d-flex flex-column">
                       %s
                       %s
                       <a ' . $modalurl . '>
                       
<img class="img-responsive product-image" alt="%s" src="%s"/></a></div>
                       
                        <div class=" product-caption">
                       
                               <h4><a ' . $modalurl . '>%s </a></h4>
                       </div></div>' . $modal . '';
                            $url = SITE_URL . "/visualarchive-details/" . $filmId;
                            $productName = $filmName;
                            $productImg = (SITE_URL . JS_FOLDER . 'holder.js/300x180/auto/text:' . NO_IMAGE);
                            $htmlRight .= sprintf($baseHTML, $imagecount_html, $video_html, $productName, $productImg, $productName);
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
    
//    $list = file_get_contents(VIEWS_FOLDER . 'adv-search-vaInc.php');
//    $search = array('{isShow}', '{keywordSearched}', '{countofRows}', '{rightPart}');
//    $replace = array($styleDisplay, $keyword, $countofRows, $htmlRight);
//    echo $memorabiliaView = str_replace($search, $replace, $list);

    include('views/adv-search-vaInc.php');
} else {
    $items = NO_PRODUCT_FOUND_MSG;
    include(VIEWS_FOLDER . "no-results-index.php");
}

//include('views/adv-search-vaInc.php');
include(INC_FOLDER . "footerInc.php");
