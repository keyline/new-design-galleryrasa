<?php

session_start();
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

require_once 'MyPdf.php';

$prodid = $_POST['prodid'];
$userid = $_POST['userid'];

$adminsettingarr = get_admin_setting();

$prodimagearr = vaprodimages($prodid);

$imgstr = '';

foreach ($prodimagearr as $k => $v) {

    $dbimage = $v['va_image_name'];

    $imgarr = explode(".", $dbimage);

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



    $imgstr .= '<img src="' . '../artworkimage/' . $orgnameexcptextnd . '/' . $ext . '" alt="' . $dbimage . '" style="display: block; margin: 0 auto; max-width: 100%; max-height: 500px;">';
}


$userarr = get_user_databyid($userid);

$username = $userarr['fname'] . ' ' . $userarr['lname'];


$pid = $prodid;



try {

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
    if (!empty($rows)) {
        $data = array();
        foreach ($rows as $row) {
            $data[$row['product']][$row['alias']] = $row['value'];
        }
    }


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

            $dataImage[$row['prodname']][$row['va_image_category_text']][] = array('id' => $row['va_image_id'], 'name' => $row['va_image_name'], 'featured' => $row['va_is_featured'], 'product_id' => $row['prodid'],
                'imageDetails' => $row['va_image_details']
            );
        }
    }

    $dbKeys = get_attrKeys_by_category('Visual Archive');

    $ommitKey = array('Name of Visual Archive' => 1, 'Language' => 1,);

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

            foreach ($value as $k => $v) {



                if ($k == 'Language')
                    $language = $v;

                if (array_key_exists($k, $ommitKey))
                    continue;


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
                                    if ($kv1val != '')
                                        $length = $kv1val;
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
                                        if ($kv1val != '')
                                            $length = $kv1val;
                                    }
                                }



                                //$length = $lengtharr[0][0];


                                preg_match_all('!\d+\.*\d*!', trim($cmarr1[1]), $breadtharr);

                                foreach ($breadtharr as $kl2 => $kv2) {
                                    foreach ($kv2 as $kv2key => $kv2val) {
                                        if ($kv2val != '')
                                            $breadth = $kv2val;
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
                                        if ($kv1val != '')
                                            $length = $kv1val;
                                    }
                                }


                                //$length = $lengtharr[0][0];

                                preg_match_all('!\d+\.*\d*!', trim($cmarr1[1]), $breadtharr);

                                foreach ($breadtharr as $kl2 => $kv2) {
                                    foreach ($kv2 as $kv2key => $kv2val) {
                                        if ($kv2val != '')
                                            $breadth = $kv2val;
                                    }
                                }

                                //$breadth = $breadtharr[0][0];

                                preg_match_all('!\d+\.*\d*!', trim($cmarr1[2]), $heightarr);

                                foreach ($heightarr as $kl3 => $kv3) {
                                    foreach ($kv3 as $kv3key => $kv3val) {
                                        if ($kv3val != '')
                                            $height = $kv3val;
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
$yartstr = '';
    for ($j = 0; $j < $arr3count; $j++) {
        $contentHtml .= ' <table cellpadding="5" style="border-bottom: 1px solid #ccc;" width="100%">
                                <tr>
                                    <td style="width: 300px; vertical-align: top; padding-left: 0;"><strong >' . $arr3[$j] . '</strong><strong style="display: inline; float: right;">:</strong></td>
                                    <td style="padding-left: 0; width: calc(100% - 300px); vertical-align: bottom;">' . $arr3val[$j] . '</td>
                                </tr>
                            </table>';
        
        
        if($arr3[$j] == 'Name of the Artist'){
            $artststr = $arr3val[$j];
        }
         if($arr3[$j] == 'Title of the Artwork'){
            $titlestr = $arr3val[$j];
        }
        if($arr3[$j] == 'Year of Artwork'){
            $yartstr = $arr3val[$j];
        }
        
    }
} catch (PDOException $pe) {
    echo $error = db_error($pe->getMessage());
}

$date = date('Y-m-d');

$originaldate = $date;

$explodeddate = explode("-", $originaldate);

$explodeddate = array_reverse($explodeddate);

$newFormatdate = implode("/", $explodeddate);




$time = date('H:i:s');
$convdate = str_replace('-', '', $date);
$convtime = str_replace(':', '', $time);
$datetime = $convdate . $convtime;

          

$artststr2 = str_replace(' ', '-', $artststr);

$titlestr2 = substr(str_replace(' ', '-', $titlestr), 0, 40);
$yartstr2 = str_replace(' ', '-', $yartstr);
  



$filename = $artststr2. '_'  . $titlestr2 . '_' . $yartstr2 . '_' . $datetime . '.' . 'pdf';

$orgdate = date('Y-m-d H:i:s');
$downloadhistorycolumns = array(
    'id' => "'" . "'",
    'customer_id' => "'" . $userid . "'",
    'prodid' => "'" . $prodid . "'",
    'file' => "'" . $filename . "'",
    'download_date' => "'" . $orgdate . "'"
);

$pqr2 = insert('customer_va_download_history', $downloadhistorycolumns);

$q2 = $conn->prepare($pqr2);
$q2->execute();



$count_downloadedarr = count_downloaded_pdf($userid);


if ($adminsettingarr['max_download_mail_send'] <= $count_downloadedarr['count_download']) {
    $userarr = get_user_databyid($userid);

    $to = $adminsettingarr['admin_email'];
    $subject = 'Download Limit crossed for ' . $userarr['fname'] . ' ' . $userarr['lname'];

    $message = "Download Limit crossed for " . $userarr['fname'] . " " . $userarr['lname'] . "(" . $userarr['email'] . ") for Visual Archive Artworks<br><br>"
            . "Download Count: " . $count_downloadedarr['count_download'];

    $emailname = 'Gallery Rasa <galleryrasa@gmail.com>';
    $nameform = '';
    
    send_mail($to, $subject, $message, $emailname, $nameform);
}


//$mpdf = new MyPdf(['mode' => 'utf-8', 'format' => [290, 336]], 75 / 27);
$mpdf = new MyPdf(['mode' => 'utf-8', 'format' => 'A4'], 75 / 27);
$html = <<<EOD
        <div style="text-align: center;">
            <img src="gallery-rasa-logo.png" alt="..." width="200" height="63" style="display: block; margin: 0 auto 12px;">
        </div>
        <div style="padding: 0 40px; font-size: 14px;">
        <p>Welcome to the Gallery Rasa website (the "Website") operated by “Gallery Rasa”, a unit of Rajyoti Creative Pursuits Private Limited of 828/1 Block P, New Alipore Kolkata: 700 053.</p>
        <p><u>Disclaimer: </u><br> 
           The contents of this Website, including (but not limited to) all literary/artistic works, written material, images, photos, and code, are protected under international copyright and trademark laws by its various respective copyright owners. 
               User/You may not copy, reproduce, modify, republish, transmit or distribute any material from this site without express written permission from said respective copyright owners. All efforts have been made to ensure the accuracy of the information presented on this site. 
                   Gallery Rasa reserves the right, however, to make changes at its discretion affecting policies or other matters announced on this site. Gallery Rasa is not responsible for the quality, accuracy or appropriateness of content on other sites to which links have been provided on Gallery Rasa’s pages. In the event any literary/artistic works deems to infringe the right of the respective owner, such person may kindly get in touch with us at <u>info@galleryrasa.com</u>  
   </p>
        
         <p><u>Take Down Policy: </u><br> 
         Gallery Rasa hereby advises the User to peruse through the Take Down Policy on our Terms and Conditions of Website. 
             Gallery Rasa shall take reasonable steps to take down the content, if required and prevent such incident, if any.     
   </p>
        
     <p><u>Permission: </u><br> 
        By using this Website, the User is given limited, non-exclusive, non-transferable, and revocable permission to use the content of the Website for non commercial purposes only.
        </p>
<p><u>Credit: </u><br> 
        Literary/Artistic Work License Courtesy of Respective Copyright Owner/Holder
Literary/Artistic Work: Courtesy of Gallery Rasa Archives

        </p>
        </div>
    <table width="1140" cellspacing="0" cellpadding="0" border="0" style="margin: 0 auto; line-height: normal; font-family: sans-serif; font-size: 22px; page-break-inside: avoid" align="top">
        <tr>
            <td style="line-height: 0; height: 10px;" ></td>
        </tr>
        
        <tr>
            <td style="line-height: 0; height: 30px;" ></td>
        </tr>
        <tr>
            <td style="background: #d2cfca;">
                <table width="100%" style="color: #71675b;">
                    <tr>
                        <td style="padding: 15px;">
                            Downloaded by <strong>{$username}</strong>
                        </td>
                        <td style="text-align: right; padding: 15px;">
                            Downloaded on <strong>{$newFormatdate}</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="line-height: 0; height: 30px;"></td>
        </tr>
        <tr>
            <td align="center">
                {$imgstr}
            </td>
        </tr>
        <tr>
            <td style="line-height: 0; height: 30px;"></td>
        </tr>
        <tr>
            <td>
                {$contentHtml}
            </td>
        </tr>
        <tr>
            <td style="line-height: 0; height: 30px;"></td>
        </tr>
        
        <tr>
            <td style="line-height: 0; height: 30px;" ></td>
        </tr>
    </table>
    
EOD;
$mpdf->setFooter('{PAGENO}');
$mpdf->SetTitle('GALLERYRASA');
$mpdf->SetDefaultFont('arial');
$mpdf->WriteHTML($html);
$mpdf->Output($filename, 'D');
