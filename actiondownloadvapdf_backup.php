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



    $imgstr .= '<img src="' . '../artworkimage/' . $orgnameexcptextnd . '/' . $ext . '" alt="' . $dbimage . '" style="display: block; margin: 0 auto; max-width: 100%;">';
}


$userarr = get_user_databyid($userid);

$username = $userarr['fname'].' '.$userarr['lname'];


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

    for ($j = 0; $j < $arr3count; $j++) {
        $contentHtml .= ' <li style="margin: 10px 0; border-bottom: 1px solid #ccc; padding: 0 0 10px 0; display: flex;">'
                . '<strong style="min-width: 170px; position: relative; display: block; margin-right: 5px;">' 
                . $arr3[$j] . '<span style="position: absolute; right: 0">:</span></strong>' . $arr3val[$j] . '</li>';
    }

} catch (PDOException $pe) {
    echo $error = db_error($pe->getMessage());
}



$date = date('Y-m-d');
$time = date('H:i:s');
$convdate = str_replace('-', '', $date);
$convtime = str_replace(':', '', $time);
$datetime = $convdate . $convtime;
$filename = 'GalleryRASA_' . $prodid . '_' . $userid . '_' . $datetime . '.' . 'pdf';

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


$mpdf = new MyPdf(['mode' => 'utf-8', 'format' => [290, 336]], 75 / 27);
$html = <<<EOD

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gallery Rasa Product PDF</title>
</head>

<body style="">
    <table width="1140" cellspacing="0" cellpadding="0" border="0" style="margin: 0 auto; line-height: normal; font-family: sans-serif; font-size: 14px;">
        <tr>
            <td style="line-height: 0; height: 30px;"></td>
        </tr>
        <tr>
            <td>
                <img src="logo.gif" alt="..." width="189" height="105" style="display: block; margin: 0 auto; max-width: 100%;">
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background: #ced1ac; padding: 15px;">
                    <td>
                        Downloaded by : <strong>{$username}</strong>
                    </td>
                    <td style="text-align: right">
                        Downloaded on : <strong>{$date}</strong>
                    </td>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <h1>{$productName}</h1>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="">
                    <tr>
                        <td width="40%" style="vertical-align: top; padding: 0 15px 0 0;">
                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                        {$contentHtml}
                                
                            </ul>
                        </td>
                        <td style="vertical-align: top; padding: 0 0 0 15px">
                            {$imgstr}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="line-height: 0; height: 30px;"></td>
        </tr>
    </table>
</body>

</html>    
        
        
        
        
        
    
EOD;
$mpdf->SetTitle('GALLERYRASA');
$mpdf->SetDefaultFont('arial');
$mpdf->WriteHTML($html);
$mpdf->Output($filename, 'D');
