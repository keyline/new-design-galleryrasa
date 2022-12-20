<style>
    .list-unstyled li{
        border-bottom: 1px solid #e2e2e2;
        /* margin-bottom: 8px; */
        line-height: 32px;
    }
</style>

<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();


$adminsettingarr = get_admin_setting();

if (isset($_SESSION['user-id'])) {
    //   echo count_click('visual-archive',$_GET['pid']);
    $userflag = true;


// cedit portion is optioanal
//    $cutcreditrow = get_customer_credit($_SESSION['user-id']);
//
//    if (!empty($cutcreditrow)) {
//        $custcredit = $cutcreditrow['credit'];
//    } else {
//        $custcredit = 0;
//    }
//
//    $prodcreditrow = get_product_credit($_GET['pid']);
//
//    if (empty($prodcreditrow)) {
//        $prodcredit = '0';
//    } else {
//        $prodcredit = $prodcreditrow['credit'];
//    }
//
//
//
//    if ($prodcredit > $custcredit) {
//        $creditflag = false;
//        $creditflagstring = '<h1 class="filmName">You do not have enough credit to view details</h1>';
//    } else {
//
//        $produtcustcreditchk = product_in_cust_credit($_SESSION['user-id'], $_GET['pid']);
//
//        if ($produtcustcreditchk == true) {
//
//
//            $creditetimediffrow = get_credit_timediff($_GET['pid']);
//
//            $timediffseconds = $creditetimediffrow['timediff'];
//
//            $sevendayssecondsdiff = (3600 * 24) * $adminsettingarr['credit_dayspan'];
//
//
//            if ($timediffseconds > $sevendayssecondsdiff) {
//
//
//
//
//
//                $creditflag = true;
//                $custnewcredit = $custcredit - $prodcredit;
//
//                $creditarr = array(
//                    'credit' => $custnewcredit
//                );
//
//                $wherearr = array(
//                    'customer_id' => $_SESSION['user-id']
//                );
//
//                $pqr1 = update('customer_credit', $creditarr, $wherearr);
//
//                $q1 = $conn->prepare($pqr1);
//                $q1->execute();
//
//                $credit_date = date("Y-m-d H:i:s");
//
//                $credithistorycolumns = array(
//                    'id' => "'" . "'",
//                    'customer_id' => "'" . $_SESSION['user-id'] . "'",
//                    'credit_id' => "'" . $cutcreditrow['id'] . "'",
//                    'prodid' => "'" . $_GET['pid'] . "'",
//                    'transaction_type' => "'" . '1' . "'",
//                    'credit' => "'" . $prodcredit . "'",
//                    'credit_date' => "'" . $credit_date . "'"
//                );
//
//                $pqr2 = insert('customer_credit_history', $credithistorycolumns);
//
//                $q2 = $conn->prepare($pqr2);
//                $q2->execute();
//
//
//                $cutcreditrow2 = get_customer_credit($_SESSION['user-id']);
//
//                if (!empty($cutcreditrow)) {
//                    $custcredit2 = $cutcreditrow2['credit'];
//                } else {
//                    $custcredit2 = 0;
//                }
//
//
//
//
//                $creditmodal = '<div id="myModal" class="modal fade">
//    <div class="modal-dialog">
//        <div class="modal-content">
//            <div class="modal-header">
//                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
//                <h4 class="modal-title">Credit Result</h4>
//            </div>
//            <div class="modal-body">
//                <p>You have spent ' . $prodcredit . ' credits for this Artwork.</p>
//                <p>Now you have ' . $custcredit2 . ' credits left.</p>
//                <p>You can view the detailed artwork for 7 days.</p>
//            </div>
//        </div>
//    </div>
//</div>';
//            } else {
//
//                $creditflag = true;
//
//                $cutcreditrow2 = get_customer_credit($_SESSION['user-id']);
//
//                if (!empty($cutcreditrow)) {
//                    $custcredit2 = $cutcreditrow2['credit'];
//                } else {
//                    $custcredit2 = 0;
//                }
//
//
//
//                $secondsdiff = $sevendayssecondsdiff - $timediffseconds;
//
//                $timeleft = secondsToTime($secondsdiff);
//
//                $creditmodal = '<div id="myModal" class="modal fade">
//    <div class="modal-dialog">
//        <div class="modal-content">
//            <div class="modal-header">
//                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
//                <h4 class="modal-title">Credit Result</h4>
//            </div>
//            <div class="modal-body">
//                <p>You have ' . $custcredit2 . ' credits left.</p>
//                    <p>You can view the detailed artwork for another ' . $timeleft . '</p>
//            </div>
//        </div>
//    </div>
//</div>';
//            }
//        } else {
//
//
//
//            $creditflag = true;
//            $custnewcredit = $custcredit - $prodcredit;
//
//            $creditarr = array(
//                'credit' => $custnewcredit
//            );
//
//            $wherearr = array(
//                'customer_id' => $_SESSION['user-id']
//            );
//
//            $pqr1 = update('customer_credit', $creditarr, $wherearr);
//
//            $q1 = $conn->prepare($pqr1);
//            $q1->execute();
//
//            $credit_date = date("Y-m-d H:i:s");
//
//            $credithistorycolumns = array(
//                'id' => "'" . "'",
//                'customer_id' => "'" . $_SESSION['user-id'] . "'",
//                'credit_id' => "'" . $cutcreditrow['id'] . "'",
//                'prodid' => "'" . $_GET['pid'] . "'",
//                'transaction_type' => "'" . '1' . "'",
//                'credit' => "'" . $prodcredit . "'",
//                'credit_date' => "'" . $credit_date . "'"
//            );
//
//            $pqr2 = insert('customer_credit_history', $credithistorycolumns);
//
//            $q2 = $conn->prepare($pqr2);
//            $q2->execute();
//
//
//            $cutcreditrow2 = get_customer_credit($_SESSION['user-id']);
//
//            if (!empty($cutcreditrow)) {
//                $custcredit2 = $cutcreditrow2['credit'];
//            } else {
//                $custcredit2 = 0;
//            }
//
//
//
//
//            $creditmodal = '<div id="myModal" class="modal fade">
//    <div class="modal-dialog">
//        <div class="modal-content">
//            <div class="modal-header">
//                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
//                <h4 class="modal-title">Credit Result</h4>
//            </div>
//            <div class="modal-body">
//                <p>You have spent ' . $prodcredit . ' credits for this Artwork.</p>
//                <p>Now you have ' . $custcredit2 . ' credits left.</p>
//                <p>You can view the detailed artwork for 7 days.</p>
//            </div>
//        </div>
//    </div>
//</div>';
//        }
//    }
//
} else {
    $userflag = false;
    $userflagmsg = '<h1 class="filmName"><a href="../login-register.php">Login</a> to view the details</h1>';
}



if (!isset($_GET['pid']) || empty($_GET['pid'])) {
    $pid = 0;
}
if (isset($_SESSION['user-id'])) {
    $pid = $_GET['pid'];
    count_click('visualarchive', $pid);
}
if (isset($_SESSION['user-id'])) {
    try {
        $conn = dbconnect();
        $qry = "SELECT tbl2.id productId, tbl2.n product, tbl2.pc category, tbl2.an attribute_name, tbl2.an_alias alias, group_concat(tbl2.v SEPARATOR ', ') AS value FROM 
            ( SELECT p.prodid AS id, p.prodname AS n, pt.product_type_name AS pc, f.attribute_name AS an, f.name_alias AS an_alias, f.position AS pos, v.`value` AS v FROM products_ecomc AS p LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id WHERE t.product_id IN (
SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id 
LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id 
WHERE t.product_id =" . $pid . ")) as tbl2 GROUP BY tbl2.n, tbl2.an ORDER BY tbl2.pos";

        $q = $conn->query($qry);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        if ($count) {
            $rows = $q->fetchAll();
        }

//        print('<pre>');
//        print_r($rows);


        $productnameflag = 0;
        $classificationflag = 0;
        foreach ($rows as $k1 => $v1) {
            if ($v1['alias']=="Name of the {{Product}}" && $v1['attribute_name']=="va_title_of_parent") {
                $productnameflag = 1;
            }
            if ($v1['alias']=="Classification" && $v1['attribute_name']=="va_classification") {
                $classificationflag = 1;
                $clval = $v1['value'];
            }
        }


        if ($productnameflag == 1 && $classificationflag == 1) {
            $cntrows = count($rows);
            $cntindex = 0;
            foreach ($rows as $k2 => $v2) {
                if ($v2['alias']=="Name of the {{Product}}" && $v2['attribute_name']=="va_title_of_parent") {
                    $rows[$cntindex]['alias'] = 'Name of the '.$clval;
                }

                $cntindex++;
            }
        }



        if (!empty($rows)) {
            $data = array();
            foreach ($rows as $row) {
                $data[$row['product']][$row['alias']] = $row['value'];
            }
        }


        //Getting Image details
        $qry = "SELECT
                        p.prodname,
                        v.va_image_name,
                        v.va_image_category_text,
                        v.va_status,
                        v.va_image_details,
                        v.va_is_featured,
                        v.va_image_id,
                        p.prodid
                        FROM
                        products_ecomc p
                        INNER JOIN visual_archive_images v ON v.va_product_id = p.prodid
                        WHERE v.va_product_id =" . $pid;
        $q = $conn->prepare($qry);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
        $count = $q->rowCount();
        $dataImage = array();
        if ($count) {
            $dataImage = array();

            while ($row = $q->fetch()) {
                //print_r($row);
                $dataImage[$row['prodname']][$row['va_image_category_text']][] = array('id' => $row['va_image_id'], 'name' => $row['va_image_name'], 'featured' => $row['va_is_featured'], 'product_id' => $row['prodid'],
                    'imageDetails' => $row['va_image_details']
                );
            }
        }
        //$finalData = array_merge_recursive($data, $dataImage);
        //Prepare html list for attributes
        $dbKeys = get_attrKeys_by_category('Visual Archive');

    //    $ommitKey = array('Name of Visual Archive' => 1, 'Language' => 1,);

        $ommitKey = array('Name of Visual Archive' => 1,); //Changed due to client required


        $contentHtml = '';



        foreach ($data as $attr => $value) {
            $productName = $attr;
            if (is_array($value)) {
                $arr1 = [];
                $arr1val = [];
                $arr2 = [];
                $arr2val = [];
                $arr3 = [];
                $arr3val = [];
                $arr1index = 0;
                $arr2index = 0;
                $arr3index = 0;


                $arr4 = [];
                $arr4val = [];
                $arr4index = 0;

                $arr5 = [];
                $arr5val = [];
                $arr5index = 0;

                // print_r($value);
        //    if (array_key_exists("Place Of Publication", $value)) {
        //       echo 'hello';
        //    }
                foreach ($value as $k => $v) {
                    if ($k == 'Language') {
                        $language = $v;
                    }

                    if (array_key_exists($k, $ommitKey)) {
                        continue;
                    }


                    if (array_key_exists("Size In cms", $value)) {
                        if ($k == "Size In cms") {
                            $k = "Size";

                            $cmarr1 = [];

                            $lengtharr = [];
                            $breadtharr = [];
                            $heightarr = [];

                            $cmarrchk = true;

                            if (strpos($v, 'x') !== false) {
                                $cmarr1 = explode('x', $v);
                                $separator = 'x';
                            } if (strpos($v, 'X') !== false) {
                                $cmarr1 = explode('X', $v);
                                $separator = 'X';
                            }

                            if (($k == "Size") && (strpos($v, 'X') != true) && (strpos($v, 'x') != true)) {
                                $cmarrchk = false;
                            }


                            if ($cmarrchk == false) {
                                $cmarr1 = explode('x', $v);
                                $separator = 'x';

                                $length = '';
                                preg_match_all('!\d+\.*\d*!', trim($v), $lengtharr);


                                foreach ($lengtharr as $kl1 => $kv1) {
                                    foreach ($kv1 as $kv1key => $kv1val) {
                                        if ($kv1val != '') {
                                            $length = $kv1val;
                                        }
                                    }
                                }


                                $lengthfloat = floatval($length);
                                $lengthinch = $lengthfloat * 0.393700787;
                                $lengthinch = round(floatval($lengthinch), 1);

                                $inchesstr = $lengthinch . ' inches';

                                if (strpos($v, 'cms') !== false) {
                                    $v = $v . '; ' . $inchesstr . '';
                                } else {
                                    $v = $v . ' cms; ' . $inchesstr . '';
                                }
                            } else {
                                if (count($cmarr1) == '2') {
                                    preg_match_all('!\d+\.*\d*!', trim($cmarr1[0]), $lengtharr);


                                    foreach ($lengtharr as $kl1 => $kv1) {
                                        foreach ($kv1 as $kv1key => $kv1val) {
                                            if ($kv1val != '') {
                                                $length = $kv1val;
                                            }
                                        }
                                    }



                                    //$length = $lengtharr[0][0];


                                    preg_match_all('!\d+\.*\d*!', trim($cmarr1[1]), $breadtharr);

                                    foreach ($breadtharr as $kl2 => $kv2) {
                                        foreach ($kv2 as $kv2key => $kv2val) {
                                            if ($kv2val != '') {
                                                $breadth = $kv2val;
                                            }
                                        }
                                    }

                                    //$breadth = $breadtharr[0][0];

                                    $lengthfloat = floatval($length);
                                    $lengthinch = $lengthfloat * 0.393700787;
                                    $lengthinch = round(floatval($lengthinch), 1);

                                    $breadthfloat = floatval($breadth);
                                    $breadthinch = $breadthfloat * 0.393700787;
                                    $breadthinch = round(floatval($breadthinch), 1);


                                    $inchesstr = $lengthinch . ' ' . $separator . ' ' . $breadthinch . ' inches';


                                    if (strpos($v, 'cms') !== false) {
                                        $v = $v . '; ' . $inchesstr . '';
                                    } else {
                                        $v = $v . ' cms; ' . $inchesstr . '';
                                    }
                                }
                                if (count($cmarr1) == '3') {
                                    preg_match_all('!\d+\.*\d*!', trim($cmarr1[0]), $lengtharr);

                                    foreach ($lengtharr as $kl1 => $kv1) {
                                        foreach ($kv1 as $kv1key => $kv1val) {
                                            if ($kv1val != '') {
                                                $length = $kv1val;
                                            }
                                        }
                                    }


                                    //$length = $lengtharr[0][0];

                                    preg_match_all('!\d+\.*\d*!', trim($cmarr1[1]), $breadtharr);

                                    foreach ($breadtharr as $kl2 => $kv2) {
                                        foreach ($kv2 as $kv2key => $kv2val) {
                                            if ($kv2val != '') {
                                                $breadth = $kv2val;
                                            }
                                        }
                                    }

                                    //$breadth = $breadtharr[0][0];

                                    preg_match_all('!\d+\.*\d*!', trim($cmarr1[2]), $heightarr);

                                    foreach ($heightarr as $kl3 => $kv3) {
                                        foreach ($kv3 as $kv3key => $kv3val) {
                                            if ($kv3val != '') {
                                                $height = $kv3val;
                                            }
                                        }
                                    }

                                    //$height = $heightarr[0][0];

                                    $lengthfloat = floatval($length);
                                    $lengthinch = $lengthfloat * 0.393700787;
                                    $lengthinch = round(floatval($lengthinch), 1);

                                    $breadthfloat = floatval($breadth);
                                    $breadthinch = $breadthfloat * 0.393700787;
                                    $breadthinch = round(floatval($breadthinch), 1);

                                    $heightfloat = floatval($height);
                                    $heightinch = $heightfloat * 0.393700787;
                                    $heightinch = round(floatval($heightinch), 1);


                                    $inchesstr = $lengthinch . ' ' . $separator . ' ' . $breadthinch . ' ' . $separator . ' ' . $heightinch . ' inches';


                                    if (strpos($v, 'cms') !== false) {
                                        $v = $v . '; ' . $inchesstr . '';
                                    } else {
                                        $v = $v . ' cms; ' . $inchesstr . '';
                                    }
                                }
                            }
                        }
                    }



                    if (array_key_exists("Publisher/s", $value)) {
                        //echo 'hello';

                        if ($k == 'Publisher/s') {
                            $arr1[$arr1index] = 'Publisher/s';

                            $arr1val[$arr1index] = $v;
                            $arr1index++;
                        }

                        if ($k == 'Place Of Publication') {
                            $arr1val[0] = $arr1val[0] . ', ' . $v;
                            continue;
                        }


                        if ($k == 'Country Of Publication') {
                            $arr1val[0] = $arr1val[0] . ', ' . $v;
                            continue;
                        }
                    }



                    if (array_key_exists("Date of Publication", $value)) {
                        if ($k == 'Date of Publication') {
                            $arr2[$arr2index] = 'Date of Publication';

                            $arr2val[$arr2index] = $v;
                            $arr2index++;
                        }

                        if ($k == 'Month of Publication') {
                            $arr2val[0] = $arr2val[0] . '-' . $v;

                            continue;
                        }

                        if ($k == 'Year of Publication') {
                            $arr2val[0] = $arr2val[0] . '-' . $v;
                            continue;
                        }
                    }









                    if (array_key_exists("Date of Artwork", $value)) {
                        if ($k == 'Date of Artwork') {
                            $arr4[$arr4index] = 'Date of Artwork';

                            $arr4val[$arr4index] = $v;
                            $arr4index++;
                        }

                        if ($k == 'Month of Artwork') {
                            $arr4val[0] = $arr4val[0] . '-' . $v;

                            continue;
                        }

                        if ($k == 'Year of Artwork') {
                            $arr4val[0] = $arr4val[0] . '-' . $v;
                            continue;
                        }
                    }


                    if (array_key_exists("Gallery/Museum", $value)) {
                        if ($k == 'Gallery/Museum') {
                            $arr5[$arr5index] = 'Gallery/Museum';

                            $arr5val[$arr5index] = $v;
                            $arr5index++;
                        }

                        if ($k == 'Place Of Gallery') {
                            $arr5val[0] = $arr5val[0] . ', ' . $v;

                            continue;
                        }
                    }




                    $arr3[$arr3index] = $k;
                    $arr3val[$arr3index] = $v;

                    $arr3index++;

                    //$contentHtml .= "<li><strong>" . $k . "</strong>: " . $v . "</li><hr>";
                    //if($v[$i][]$v[$i]['m_is_print'])
                }
            }
        }


        if (in_array("Publisher/s", $arr3)) {
            $keyofarr3 = array_search('Publisher/s', $arr3);
            $arr3val[$keyofarr3] = $arr1val[0];
        }

        if (in_array("Date of Publication", $arr3)) {
            $keyofarr32 = array_search('Date of Publication', $arr3);

            $arr3val[$keyofarr32] = $arr2val[0];
        }


        if (in_array("Date of Artwork", $arr3)) {
            $keyofarr33 = array_search('Date of Artwork', $arr3);

            $arr3val[$keyofarr33] = $arr4val[0];
        }

        if (in_array("Gallery/Museum", $arr3)) {
            $keyofarr34 = array_search('Gallery/Museum', $arr3);

            $arr3val[$keyofarr34] = $arr5val[0];
        }


        $arr3count = count($arr3);

        for ($j = 0; $j < $arr3count; $j++) {
            // $contentHtml .= "<li><strong>" . $arr3[$j] . "</strong><span>" . $arr3val[$j] . "</span></li>";
            $contentHtml .= '<tr>
                                <td>  '. $arr3[$j] . '</td>
                                <td class="table-border"> ' . $arr3val[$j] .  '</td>
                            </tr>';
        }


        $imageDetails = '';
        $singleImg = '';
//    print_r($dataImage);
//    exit;
        if (!empty($dataImage)) {
            foreach ($dataImage as $key => $film) {
                foreach ($film as $k => $v) {
//                print '<pre>';
//                print_r($film);
//                $imageDetails .= '<div class="clearfix"></div><h2>' . str_replace("Picture", "Picture", $k) . '</h2><div class="parent-container ' . $k . '">';

                    // $imageDetails .= '<div class="details-img box target">';
                    if (is_array($v)) {
                        for ($i = 0; $i < count($v); $i++) {
                            $imgarr = explode(".", $v[$i]['name']);

                            $ext = end($imgarr);

                            $imgarrcnt = count($imgarr);

                            $orgnameexcptextnd = '';
                            $imgorgcnt = $imgarrcnt - 1;
                            for ($l = 0; $l < $imgorgcnt; $l++) {
                                if ($l == ($imgorgcnt - 1)) {
                                    $orgnameexcptextnd .= $imgarr[$l];
                                } else {
                                    $orgnameexcptextnd .= $imgarr[$l] . '.';
                                }
                            }



                            // $imageDetails .= '<div class="light-box-gallery-wrapper panzoom-parent wow fadeInDown" id="lightgallery_test1" data-wow-duration="1s" data-wow-delay="0.5s">'
                            //         . '<div class="' . $k . "_" . $i . ' image-box-inner thumb-img-wrapper panzoom" id="panzoom-element" data-src="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">'
                            //         //. '<a class="thumbnail visual-archive-main-image" href="' . SITE_URL . '/' . ARTWORKS_ORG_IMGS . $v[$i]['name'] . '">'
                            //         . '<img id="zoom_05" data-zoom-image="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '" width="411" class="img-responsive image-visual-archive zoom-img" src="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">'
                            //         //. '</a>'
                            //         . '</div>
                            //     ';
                            // adding for light gallery plugin
                            $imageDetails .= '<div class="light-box-gallery-wrapper panzoom-parent wow fadeInDown" id="lightgallery_test1" data-wow-duration="1s" data-wow-delay="0.5s">';
                            $imageDetails .= '<div class="' . $k . "_" . $i . ' image-box-inner thumb-img-wrapper panzoom" id="panzoom-element" data-download-url="../actiondownloadvapdf.php" data-src="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">';
                            $imageDetails .= '<img id="zoom_05" data-zoom-image="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '" class="img-fluid img-responsive image-visual-archive zoom-img" src="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">'

                            //. '</a>'
                            . '</div>';

                            // $singleImg .= '<img class="img-fluid" src="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">';

                            // $imageDetails .= '<img class="img-fluid" src="' . '../artworkimage?img=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">';


                            $imageDetails .= '</div>';
                        }
                    }
                    // $imageDetails .= '</div>';
                }
            }
        }
        if ($userflag != false) {
            $downloadform = '<form method="post" class="visualarchive-download" action="../actiondownloadvapdf.php">'
                    . '<input type="hidden"  name="prodid" value="' . $_GET['pid'] . '">'
                    . '<input type="hidden" name="userid" value="' . $_SESSION['user-id'] . '">'
                    . '<button type="submit" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> Download</button>'
                    . ''
                    . '</form>';

            $viewImage = '<form method="post" target="_blank" class="enlarge-img" action="../displayvaimage.php">'
                    . '<input type="hidden"  name="prodid" value="' . $_GET['pid'] . '">'
                    . '<input type="hidden" name="userid" value="' . $_SESSION['user-id'] . '">'
                    . '<input type="submit" class="btn btn-info" value="Enlarge Image">'
                    . ''
                    . '</form>';
        }
    } catch (PDOException $pe) {
        echo $error = db_error($pe->getMessage());
    }
}
include(INC_FOLDER . "headerInc.php");

// credit portion is optional

//if ($userflag == false) {
//    $list = file_get_contents(VIEWS_FOLDER . 'visualarchive-detailsnouserInc.php');
//    $search = array('{usercheck}', '{creditcheck}', '{imageDetails}', '{productName}', '{language}', '{attributeList}');
//    $replace = array($userflagmsg, '', '', '', '', '');
//    echo $detailsView = str_replace($search, $replace, $list);
//} else if ($creditflag == false) {
//    $list = file_get_contents(VIEWS_FOLDER . 'visualarchive-detailsInc.php');
//    $search = array('{usercheck}', '{creditcheck}', '{imageDetails}', '{productName}', '{language}', '{attributeList}');
//    $replace = array('', $creditflagstring, '', '', '', '');
//    echo $detailsView = str_replace($search, $replace, $list);
//} else {
//
//    $list = file_get_contents(VIEWS_FOLDER . 'visualarchive-detailsInc.php');
//    $search = array('{creditmodal}', '{usercheck}', '{creditcheck}', '{imageDetails}', '{productName}', '{language}', '{attributeList}', '{download}', '{viewImage}');
//    $replace = array($creditmodal, '', '', $imageDetails, $productName, $language, $contentHtml, $downloadform, $viewImage);
//    echo $detailsView = str_replace($search, $replace, $list);
//}




if ($userflag == false) {
    $list = file_get_contents(VIEWS_FOLDER . 'visualarchive-detailsnouserInc.php');
    $search = array('{usercheck}', '{creditcheck}', '{imageDetails}', '{productName}', '{language}', '{attributeList}');
    $replace = array($userflagmsg, '', '', '', '', '');
    echo $detailsView = str_replace($search, $replace, $list);
} else {
    $list = file_get_contents(VIEWS_FOLDER . 'visualarchive-detailsInc.php');
    // $search = array('{usercheck}',  '{imageDetails}', '{productName}', '{language}', '{attributeList}', '{download}', '{viewImage}' , '{singleImg}' );

    $search = array('{usercheck}',  '{imageDetails}', '{productName}', '{language}', '{attributeList}', '{download}', '{viewImage}');

    // $replace = array('',  $imageDetails, $productName, $language, $contentHtml, $downloadform, $viewImage, $singleImg );

    $replace = array('',  $imageDetails, $productName, $language, $contentHtml, $downloadform, $viewImage);

    echo $detailsView = str_replace($search, $replace, $list);
}





include(INC_FOLDER . "footerInc.php");
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script>
    $(document).ready(function () {
        $("#myModal").modal('show');
    });
</script>
