<?php

use Mpdf\Tag\Pre;

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

if (!isset($_GET['pid']) || empty($_GET['pid'])) {
    $pid = 0;
}

$pid = $_GET['pid'];
count_click('bibliography', $pid);
try {
    $conn = dbconnect();
    $html = '';
    /**
      $qry = "SELECT tbl2.id productId, tbl2.n product, tbl2.pc category, tbl2.an attribute_name, group_concat(tbl2.v SEPARATOR ', ') AS value FROM ( SELECT p.prodid AS id, p.prodname AS n, pt.product_type_name AS pc, f.name_alias AS an, v.`value` AS v FROM products_ecomc AS p LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id WHERE t.product_id IN (
      SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id
      LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id
      LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id
      WHERE t.product_id =" . $pid . ")) as tbl2 GROUP BY tbl2.n, tbl2.an";
     *
     */
    $qry = "SELECT 
tbl2.id productId,
tbl2.n product, 
tbl2.pc category, 
tbl2.an attribute_name, 
group_concat(tbl2.v ORDER BY tbl2.v SEPARATOR ', ') AS value 
FROM 
(
 SELECT p.prodid AS id, 
 p.prodname AS n, 
 pt.product_type_name AS pc, 
 f.name_alias AS an,
 v.`value` AS v 
 FROM 
 products_ecomc AS p 
 LEFT JOIN product_attribute_value AS t ON p.prodid = t.product_id 
 LEFT JOIN attribute_value_ecomc AS v ON t.attribute_value_id = v.attr_value_id 
 LEFT JOIN attr_common_flds_ecomc AS f ON v.attr_id = f.id 
 LEFT JOIN product_type_ecomc AS pt ON p.subcatid = pt.product_type_id 
 WHERE t.product_id IN (:prodID)
 ) as tbl2 
 GROUP BY tbl2.n, tbl2.an";
    $q = $conn->prepare($qry);
    $q->bindParam(':prodID', $pid, PDO::PARAM_INT);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);

    $count = $q->rowCount();
    if ($count) {
        $rows = $q->fetchAll();
        $q->closeCursor();
        // $html = 1;
    }

    if (!empty($rows)) {
        $articleflag = 0;
        $productnameflag = 0;

        foreach ($rows as $k1 => $v1) {
            if ($v1['attribute_name'] == 'Title of Article\/Essay') {
                $articleflag = 1;
            }

            if ($v1['attribute_name'] == 'Title of the {{Product}}') {
                $productnameflag = 1;
            }
        }




        if ($articleflag == '1' && $productnameflag == '0') {
            $cntrows = count($rows);
            $cntindex = 0;
            foreach ($rows as $k2 => $v2) {
                if ($v2['attribute_name'] == 'Title of Article\/Essay') {
                    $rows[$cntindex]['attribute_name'] = 'Title of the {{Product}}';
                }

                $cntindex++;
            }
        }
    }


    if (!empty($rows)) {
        $data = array();
        foreach ($rows as $row) {
            $data[$row['category']][$row['product']][$row['productId']][$row['attribute_name']] = $row['value'];
            //    $data[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
        }
    }

//    print('<pre>');
//    print_r($data);
    //Getting Image details
    $qry_image = "SELECT
                        p.prodname,
                        m.m_image_name,
                        m.m_image_category_text,
                        m.status,
                        m.m_image_details,
                        m.is_featured,
                        m.m_image_id,
                        p.prodid
                        FROM
                        products_ecomc p
                        INNER JOIN memorabilia_images m ON m.product_id = p.prodid
                        WHERE m.product_id =" . $pid;
    $q = $conn->prepare($qry_image);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $imageCount = $q->rowCount();
    $dataImage = array();
    $imageDetails = array();
    if ($imageCount) {
        while ($row = $q->fetch()) {
            $dataImage[$row['prodname']][$row['m_image_category_text']][] = array('id' => $row['m_image_id'], 'name' => $row['m_image_name'], 'featured' => $row['is_featured'], 'product_id' => $row['prodid'],
                'imageDetails' => $row['m_image_details']
            );
            $imageDetails[] = $row['m_image_details'];
        }
    }


    $key_order = array(
        'Book Section' => array(
            'Title of Article\/Essay' => 10,

            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Title of the {{Product}}' => 13,
            'Translated Title of Article\/Essay' => 14,
//            'Title of Article\/Essay' => 10,
//            'Language' => 11,
//            'Translated Title of Article\/Essay' => 12,
//            'Title of the {{Product}}' => 13,
//            'Translated Title of the {{Product}}' => 14,
            'Author\/s' => 17,
            'Editor' => 18,
            'Reference Type' => 20,
            'Date' => 21,
            'Month' => 22,
            'Year' => 23,
            'Vernacular Year' => 24,
            'Volume' => 25,
            'DOI \/ URL' => 26,
            'Publisher\/s' => 27,
            'Place Of Publication' => 33,
            'Country Of Publication' => 34,
            'Edition' => 35,
            'Pagination' => 36,
            'Translated By\/Form' => 37,
            'Illustrator\/s' => 38,
            'Artist\/s Mentioned' => 39,
            'Other Person Mentioned' => 40,
            'Archivist Remarks' => 41,
            'Descriptive Tags' => 42,
            'Location' => 43,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Book' => array(
            'Title of the {{Product}}' => 10,
            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Author\/s' => 13,
            'Editor' => 14,
            'Subject' => 15,
            '{{Product}} Type' => 19,
            'Reference Type' => 20,
            'Date' => 21,
            'Month' => 22,
            'Year' => 23,
            'Vernacular Year' => 24,
            'Volume' => 25,
            'DOI \/ URL' => 26,
            'Publisher\/s' => 27,
            'Place Of Publication' => 28,
            'Country Of Publication' => 29,
            'Edition' => 32,
            'Pagination' => 33,
            'Translated By\/From' => 34,
            'Foreword' => 38,
            'Preface' => 39,
            'Compiler' => 40,
            'Book Cover/Book Designer' => 41,
            'Illustrator\/s' => 42,
            'Artist\/s Mentioned' => 43,
            'Other Person Mentioned' => 44,
            'Contributors in the {{Product}}' => 45,
            'Archivist Remarks' => 46,
            'Descriptive Tags' => 47,
            'Location' => 48,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Journal Article' => array(
            'Title of the {{Product}}' => 10,

            'Translated Title of the {{Product}}' => 11,
            'Title of Article\/Essay' => 12,
            'Translated Title of Article\/Essay' => 13,
            'Language' => 14,
//            'Title of Article\/Essay' => 10,
//            'Language' => 11,
//            'Translated Title of Article\/Essay' => 12,
            'Author\/s' => 15,
            'Title of the {{Product}}' => 16,
            'Reference Type' => 20,
            'Volume' => 25,
            'Issue' => 26,
            'No' => 27,
            'Date' => 28,
            'Month' => 29,
            'Year' => 30,
            'Vernacular Year' => 31,
            'Pagination' => 32,
            'Editor' => 33,
            'Illustrator\/s' => 34,
            'Translated By\/From' => 35,
            'DOI \/ URL' => 36,
            'Translator' => 37,
            'Publisher\/s' => 38,
            'Place Of Publication' => 39,
            'Country Of Publication' => 40,
            'Artist\/s Mentioned' => 41,
            'Other Person Mentioned' => 42,
            'Archivist Remarks' => 43,
            'Descriptive Tags' => 44,
            'Location' => 45,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Catalogue Essay' => array(
            'Title of Article\/Essay' => 10,

            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Title of the {{Product}}' => 13,
            'Translated Title of Article\/Essay' => 14,
//            'Title of Article\/Essay' => 10,
//            'Language' => 11,
//            'Translated Title of Article\/Essay' => 12,
//            'Title of the {{Product}}' => 13,
//            'Translated Title of the {{Product}}' => 14,
            'Author\/s' => 17,
            'Reference Type' => 20,
            'Volume' => 24,
            'Place' => 25,
            'Date' => 26,
            'Month' => 27,
            'Year' => 28,
            'Vernacular Year' => 29,
            'Pagination' => 30,
            'Editor' => 31,
            'Curator' => 32,
            'Compiler' => 33,
            'Gallery/Museum' => 34,
            'DOI \/ URL' => 35,
            'Publisher\/s' => 36,
            'Place Of Publication' => 37,
            'Country Of Publication' => 38,
            'Translated By\/From' => 39,
            'Artist\/s Mentioned' => 40,
            'Other Person Mentioned' => 41,
            'Archivist Remarks' => 42,
            'Descriptive Tags' => 43,
            'Location' => 44,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Catalogue[Solo]' => array(
            'Title of the {{Product}}' => 10,
            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Title of Article\/Essay' => 13,
            'Translated Title of Article\/Essay' => 14,
//            'Author\/s' => 13,
//            'Editor' => 14,
//            'Reference Type' => 15,
//            'Volume' => 16,
//            'Place' => 17,
//            'Date' => 18,
//            'Month' => 19,
//            'Year' => 20,
//            'Vernacular Year' => 21,
//            'Pagination' => 22,
//            'Curator' => 23,
//            'Compiler' => 24,
//            'Gallery/Museum' => 25,
//            'DOI \/ URL' => 26,
//            'Publisher\/s' => 27,
//            'Place Of Publication' => 28,
//            'Country Of Publication' => 29,
//            'Translated By\/From' => 30,
//            'Artist\/s Mentioned' => 31,
//            'Other Person Mentioned' => 32,
//            'Contributors in the {{Product}}' => 33,
//            'Foreword' => 34,
//            'Preface' => 35,
//            'Archivist Remarks' => 36,
//            'Descriptive Tags' => 37,
//            'Location' => 38,
            'Author\/s' => 15,
            'Editor' => 16,
            'Reference Type' => 17,
            'Volume' => 18,
            'Place' => 19,
            'Date' => 20,
            'Month' => 21,
            'Year' => 22,
            'Vernacular Year' => 23,
            'Pagination' => 24,
            'Curator' => 25,
            'Compiler' => 26,
            'Gallery/Museum' => 27,
            'DOI \/ URL' => 28,
            'Publisher\/s' => 29,
            'Place Of Publication' => 30,
            'Country Of Publication' => 31,
            'Translated By\/From' => 32,
            'Artist\/s Mentioned' => 33,
            'Other Person Mentioned' => 34,
            'Contributors in the {{Product}}' => 35,
            'Foreword' => 36,
            'Preface' => 37,
            'Archivist Remarks' => 38,
            'Descriptive Tags' => 39,
            'Location' => 40,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Catalogue' => array(
            'Title of the {{Product}}' => 10,
            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Author\/s' => 13,
            'Editor' => 14,
            'Reference Type' => 15,
            'Volume' => 16,
            'Place' => 17,
            'Date' => 18,
            'Month' => 19,
            'Year' => 20,
            'Vernacular Year' => 21,
            'Pagination' => 22,
            'Curator' => 23,
            'Compiler' => 24,
            'Gallery/Museum' => 25,
            'DOI \/ URL' => 26,
            'Publisher\/s' => 27,
            'Place Of Publication' => 28,
            'Country Of Publication' => 29,
            'Translated By\/From' => 30,
            'Artist\/s Mentioned' => 31,
            'Other Person Mentioned' => 32,
            'Contributors in the {{Product}}' => 33,
            'Foreword' => 34,
            'Preface' => 35,
            'Archivist Remarks' => 36,
            'Descriptive Tags' => 37,
            'Location' => 38,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Catalogue[Group]' => array(
            'Title of the {{Product}}' => 10,
            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Author\/s' => 13,
            'Editor' => 14,
            'Reference Type' => 15,
            'Volume' => 16,
            'Place' => 17,
            'Date' => 18,
            'Month' => 19,
            'Year' => 20,
            'Vernacular Year' => 21,
            'Pagination' => 22,
            'Curator' => 23,
            'Compiler' => 24,
            'Gallery/Museum' => 25,
            'DOI \/ URL' => 26,
            'Publisher\/s' => 27,
            'Place Of Publication' => 28,
            'Country Of Publication' => 29,
            'Translated By\/From' => 30,
            'Artist\/s Mentioned' => 31,
            'Other Person Mentioned' => 32,
            'Contributors in the {{Product}}' => 33,
            'Foreword' => 34,
            'Preface' => 35,
            'Archivist Remarks' => 36,
            'Descriptive Tags' => 37,
            'Location' => 38,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        ),
        'Catalogue[Annual]' => array(
            'Title of the {{Product}}' => 10,
            'Language' => 11,
            'Translated Title of the {{Product}}' => 12,
            'Author\/s' => 13,
            'Editor' => 14,
            'Reference Type' => 15,
            'Volume' => 16,
            'Place' => 17,
            'Date' => 18,
            'Month' => 19,
            'Year' => 20,
            'Vernacular Year' => 21,
            'Pagination' => 22,
            'Curator' => 23,
            'Compiler' => 24,
            'Gallery/Museum' => 25,
            'DOI \/ URL' => 26,
            'Publisher\/s' => 27,
            'Place Of Publication' => 28,
            'Country Of Publication' => 29,
            'Translated By\/From' => 30,
            'Artist\/s Mentioned' => 31,
            'Other Person Mentioned' => 32,
            'Contributors in the {{Product}}' => 33,
            'Foreword' => 34,
            'Preface' => 35,
            'Archivist Remarks' => 36,
            'Descriptive Tags' => 37,
            'Location' => 38,
            'category' => 0,
            'pname' => 1,
            'pid' => 100
        )
    );
    //print "<pre>";
    //print_r($rows);
    //$details_html = get_details_html($data, $key_order);
    //print_r($details_html);
    /**
     * Change in bibliography details on 27/11/2017
     */
    $arrayFlatten = bibliography_details_flatten_array($data);
    /**
     * Sorting the arrays according to weight given to bibliography key
     */
//    print "<pre>";
//    print_r($data);
//    print_r($arrayFlatten);
    //exit;
    $category = $arrayFlatten['category'];

//    print "<pre>";
//    print_r($arrayFlatten);
    //print_r($key_order);
//    print_r($a);
//    print_r($b);
    //exit;
    uksort($arrayFlatten, function ($a, $b) use ($key_order, $category) {
//        print "<pre>";
//        print_r($category);
//       print "<pre>";
//        print_r($a);
//        print_r($b);
//        echo '<br>';
//        print "<pre>";
//        print_r($key_order[$category][$b]);
//        echo '<br>';


        if (!isset($key_order[$category][$b])) {
            return 0;
        } elseif (!isset($key_order[$category][$a])) {
            return 0;
        } else {
            if ($key_order[$category][$a] > $key_order[$category][$b]) {
                return 1;
            } elseif ($key_order[$category][$a] < $key_order[$category][$b]) {
                return -1;
            } else {
                return 0;
            }
        }
    });
//        print "<pre>";
//        print_r($arrayFlatten);
//    exit;
//             print "<pre>";
//        print_r(json_decode($imageDetails[0], true));
    //Now we are printing the html according to sorted array flatten
    //$html ='';
    $whitelist = array('Date', 'Month', 'Year');
    $filtered = array();
    $filtered = array_intersect_key($arrayFlatten, array_flip($whitelist));

    /**
     * Added on 14/05/2020
     * Now we can filter any attribute key dynamically
     * First: add actual attribute key to filtered section(in $filterKeys variable)
     * Second: if you need to replace some portion of key with value then embrace with {{<portion you want to replace>}}
     */
    $filterKeys = array(
        "Reference Type" => 'Classification',
        "Title of Article\/Essay" => 'Title of {{Article}}'
    );



    $final_keys = array_map(function ($v) use (&$filterKeys) {
//        print('<pre>');
//        print_r($v);

        return in_array($v, array_keys($filterKeys)) ? $filterKeys[$v] : $v;
    }, array_keys($arrayFlatten));





    //Use array_combine to map formatted keys to array values
    $arrayFinal = array_combine($final_keys, $arrayFlatten);

    //var_dump($arrayFinal);
    //var_dump($arrayFlatten);exit();


    $flag = 0;
    $html .= '<section class="visual-search-details-page bibliography-search-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="visual-inner">
                    <div class="back-action">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                          <div class="col-lg-9">
                <div class="right-details">
                    <table class="table table-bordered">
                        <tbody>';
    /**
     * <tr>
      <th>' . $arrayFlatten['category'] . ' </th><td><strong>' . $arrayFlatten['pname'] . '</strong></td>
      </tr>
     */
    //Getting Cart html
    $type = 'Bibliography';
    $cartHtml = '';
    //$cartHtml = (!empty($imageDetails)) ? get_add_to_cart_button($imageDetails[0], $type, true) : '';
    //Getting images HTML
    $imageDetailsHTML = '';

    foreach ($dataImage as $key => $bibloTitle) {
        foreach ($bibloTitle as $k => $v) {
            $imageDetailsHTML .= '<div class="details-info ' . $k . '">
                                    <div class="left-details">
                                        <div class="details-sticky">';
            if (is_array($v)) {
                for ($i = 0; $i < count($v); $i++) {
                    $imageDetailsHTML .= '<div class="details-img-' . $i . '">'

                            . '<img class="img-fluid" src="' . ORG_SITE_URL . '/product_images/thumbs/' . $v[$i]['name'] . '" alt="bibliography"></a></div>
                            <div class="sticky-sec blue">
                                    <div class="book">
                                        <a class="book-btn lightbox" href="#dog">
                                            <span class="material-icons">zoom_out_map</span>
                                        </a>
                                        <div class="lightbox-target" id="dog">
                                            <img class="img-fluid" src="' . ORG_SITE_URL . '/product_images/bibliography/' . $v[$i]['name'] . '" alt="bibliography">
                                            <a class="lightbox-close" href="#"></a>
                                        </div>
                                    </div>
                                </div>';
                    if (!empty($v[$i]['imageDetails'])) {
                        $cartHtml = get_add_to_cart_button($v[$i]['imageDetails'], $type, true);
                    } else {
                        $cartHtml = '';
                    }
                }
            }
            $imageDetailsHTML .= '</div></div></div>';
        }
    }

    // print_r($arrayFinal);
    // exit();

    foreach ($arrayFinal as $key => $val) {
        if ($key == 'category' || $key == 'pname' || $key == 'pid') {
            continue;
        }

        if (array_key_exists($key, $filtered)) {
            $array_keys = array_keys($filtered);

            $vv = array_values($filtered);
            if (!$flag) {
                if (!empty($array_keys)) {
                    //$content = str_replace("â€¦", "'", $val);
                    $html .= '<tr>
                                                <td class="table-title">' . implode("/", $array_keys) . ':' . '</th>
                                                <td class="table-border">' . implode("/", $vv) . '</td>
                                            </tr>';
                    $flag++;
                }
            }
        } else {
            if (!empty($key)) {
                $key = (strpos($key, 'Reference Type') > -1) ? preg_replace('/\bReference Type\b/', 'Classification', $key) : stripslashes($key);
                $html .= '<tr>
                                                                <td class="table-title" >' . stripslashes($key) . ':' . '</th>
                                                                <td class="table-border">' . str_replace("â€¦", "'", $val) . '</td>
                                                            </tr>
                                                            </div>';
            }
        }
    }
    $html .= '</tbody></table></div>
                        
                                    </div><div class="col-lg-3">
                                    <div class="bibliography-cite">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#citethis" class="btn form-control"><i class="btn btn-default" data-toggle="tooltip" title="" data-original-title="Cite this" data-placement="left" onclick="javascript:CiteThis(' . $arrayFlatten['pid'] . ');">Cite This</i></a>
                                    </div>';
//                                        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#pdf-preview"><i class="btn btn-default" data-toggle="tooltip" title="" data-original-title="Preview" data-placement="left" onclick="javascript:PreviewPdf(' . $arrayFlatten['pid'] . ');">Sneak Preview</i></a></li><br>

    $html .= $imageDetailsHTML . $cartHtml;






    $querypdf = "SELECT * FROM bibliography_pdf where prodid = %s";

    $sqlpdf = sprintf($querypdf, $pid);


    $qpdf = $conn->prepare($sqlpdf);

    $qpdf->execute();
    $qpdf->setFetchMode(PDO::FETCH_ASSOC);

    $pdfarr = $qpdf->fetchAll();


    foreach ($pdfarr as $kpdf => $vpdf) {
        $pdfname = $vpdf['bib_pdf'];

        $imgarr = explode(".", $pdfname);

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


        $html .= '<a class="btn form-control" href=" ' . '../bibpdf?pdf=' . urlencode($orgnameexcptextnd) . '&ext=' . $ext . '">Download PDF</a><br><br>';
    }




    $html .= '</ul>
                                   </div>
                                   
                                </div>
                                </div>
                                ';

    //Replace the Wrapping template values
    $parentCategory = strtok($category, " ");
    $substitutionArr = array('Article' => $category, 'Product' => $parentCategory);
    //$terms = array($category, $title);
    //$count = 0;
    //Defining a preg classback function to replace the wrapping
    $html = preg_replace_callback('/\{{2}(.*?)\}{2}/', function ($match) use (&$substitutionArr) {
        $replaceStr = (!empty($match)) ? $substitutionArr[$match[1]] : '#####';

        return $replaceStr;
    }, $html);
    $search_view = file_get_contents(VIEWS_FOLDER . 'seemore.Inc.php');
    $search = array('{details}');
    $replace = $html;
    $finalView = str_replace($search, $replace, $search_view);
} catch (PDOException $pe) {
    echo $error = db_error($pe->getMessage());
}
include(INC_FOLDER . "headerInc.php");
if (strlen($html) == 0) {
    $heading = '<p>&nbsp;</p>';
    $items = NO_PRODUCT_FOUND_MSG;
    include(VIEWS_FOLDER . "no-results-index.php");
} else {
    echo $finalView;
}
include(INC_FOLDER . "footerInc.php");
