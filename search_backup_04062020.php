<?php

header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Initialize variables
    $params = '';
    $subParams = '';
    $paramCount = 0;
    $countofRows = 0;
    $result_count = $html = 0;
    $qstr = array();
    $data = array();
    $keyword = '';
    $getResult = array();
    $countData = array();
    $entryPoint = array();

    $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    
    
    //$qry_arr = $_POST;
    if (empty($qry_arr)) {
        goto_location("beforeSearch");
        exit;
    }


    if (isset($_POST['bibliography-search-entry']) && $_POST['bibliography-search-entry'] == 'entry-point') {
        //print '<pre>';
        // print_r($_POST);
        /**
         * Resetting bibliography session params here
         */
        unset($_SESSION['bParam']);
        unset($_SESSION['biblioCategory']);
        $searchTerm = 'OR';
        $limitCount = 3;

        //For displaying artist searched for
        if (count($qry_arr) > 0) {
            foreach ($qry_arr as $k => $v) {
                if ($k == 'bibliography') {
                    $keyword = implode(',', array_map('ucwords', $v));
                    foreach ($v as $val) {
                        $entryPoint[] = extractKeyValuePairs($val, ":");
                    }
                }
                if ($k == 'sub-item') {
                    if (is_array($v)) {
                        for ($i = 0; $i < count($v); $i++) {
                            $qstr[] = $v[$i];
                            $subParams .= '%u,';
                        }
                    }
                    $subParams = substr($subParams, 0, strlen($subParams) - 1);
                }
//            } else{
//                $search = get_subcategoryList_by_name();
//                print_r($search);
//            }
            } //Closing of foreach
        }
        if (empty($subParams)) {
            $search = get_subcategoryList_by_name();
            if (is_array($search)) {
                // for ($i=0; $i<count($search); $i++){
                foreach ($search as $sub) {
                    $qstr[] = $sub;
                    $subParams .= '%u,';
                    //}
                }
            }
            $subParams = substr($subParams, 0, strlen($subParams) - 1);
        }


        $_SESSION['bParam'] = (!empty($entryPoint)) ? $entryPoint : null;
        $_SESSION['biblioCategory'] = (!empty($qstr)) ? $qstr : null;

        /**
         * Preparing query with POST data
         */
        if (!empty($entryPoint)) {
            foreach ($entryPoint as $value) {
                if (is_array($value)) {

                    foreach ($value as $k => $v) {
                        $params2[] = '(f.attribute_name="' . $k . '" AND v.value ="' . $v . '")';
                    }
                }
            }
            $params = implode(" OR ", $params2);
        }


        /**
         * Change query due to count anomalies
         * We separate data query and count  query from now
         */
        //Data Query
        $qry = mainSearch_query($params, $subParams, $qstr);
        //echo $qry;
        //Count Query
        $count_qry = mainSearch_query($params, $subParams, $qstr, true);
        //echo $count_qry;
    } elseif (isset($_POST['submitButton']) && $_POST['submitButton'] == 'BiblioSearch') {

        $params_qry = array();

        $search = get_subcategoryList_by_name();

        foreach ($qry_arr as $k => $v) {
            if ($k == 'submitButton' || $k == 'objSearch')
                continue;
            if (is_array($v)) {
                foreach ($v as $p => $m) {
                    if (array_key_exists($m, $search)) {
                        $params_qry[$k][] = $search[$m];
                    } else {
                        $params_qry[$k][] = $m;
                    }
                }
            }
        }

//        print "<pre>";
//        print_r($search);
//        print_r($params_qry);
//        exit;
        /**
         * Defaults values for Reference-type and language
         */
        //$defaultKeys = array('reference-type'=>1, 'language'=>1);
        if (!(array_key_exists('reference_type', $params_qry)) && !(array_key_exists('language', $params_qry))) {

            foreach ($search as $m) {
                $params_qry['reference_type'][] = $m;
            }
            $language = get_uniqueLanguages();
            foreach ($language as $lng) {
                $params_qry['language'][] = $lng;
            }
        } elseif (!array_key_exists('reference_type', $params_qry)) {
            foreach ($search as $m) {
                $params_qry['reference_type'][] = $m;
            }
        } elseif (!array_key_exists('language', $params_qry)) {
            $language = get_uniqueLanguages();
            foreach ($language as $lng) {
                $params_qry['language'][] = $lng;
            }
        }

//              print "<pre>";
//            print_r($_POST);
//            print_r($search);
//            print_r($params_qry);
        //var_dump($params_qry);
        //Setting default values for reference-type and language

        $childKeys = array_keys($params_qry);
        //print_r($childKeys);
        $parentCount = count($params_qry);
        $queryInner = '';
        $j = 0;
        $flag = 0;

        for ($i = 0; $i < count($childKeys); $i++) {

            if ($childKeys[$i] === 'reference_type') {
                $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND (p.subcatid IN (" . implode(",", $params_qry[$childKeys[$i]]) . ")) GROUP BY t.product_id)t" . ($j + 1);
                $j++;
                $flag++;
            } elseif ($childKeys[$i] === 'language') {

                foreach ($params_qry[$childKeys[$i]] AS $k => $v) {
                    $lan[] = "v.value='$v'";
                }
                $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND (" . implode(" OR ", $lan) . ") AND f.attribute_name = 'language' GROUP BY t.product_id)t" . ($j + 1);

                $j++;
                $flag++;
            } else {
                continue;
            }

            if ($flag === 1)
                $queryInner .= " INNER JOIN ";
            if ($j >= 2) {
                $queryInner .= " ON t" . ($j - 1) . ".product_id = t" . $j . ".product_id INNER JOIN ";
                break;
            }
        }

        //Excluding integers from keywords which are mainly used for categoryID and Year range false post
        $exclude = array(1, 2, 3, 4, 5, 6, 7, 8, -1, -1, 'Bengali', 'English');
        $new = array_filter($params_qry, function ($var) use ($exclude) {
            if (count(array_intersect($var, $exclude)) === 0) {
                return true;
            } else {
                // There is at least one value from array1 present in array2
                return false;
            }
        });

        $keyword = implode(", ", r_implode($new, ","));

        $i = 2;
        $p = 1;
        $arrayCount = 0;

        foreach ($params_qry AS $k => $value) {
            if ($k == 'reference_type')
                continue;
            if ($k == 'language')
                continue;
            if ($k == 'year_range') {
                $match = "-1";

                $stringCheck = implode(" ", $params_qry['year_range']);
                if (stripos($stringCheck, $match) === false) {
                    $j = $i++;
                    $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
                    attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
                p.category_id = 1 AND v.value BETWEEN " . implode(" AND ", $params_qry['year_range']) . " AND f.attribute_name = 'gregorian_year' GROUP BY t.product_id)t" . $i;

                    if ($i >= 3)
                        $queryInner .= " ON t" . $j . ".product_id = t" . $i . ".product_id INNER JOIN ";
                }

                //continue;
            }else {
                $key = $k;
                $arrayCount += sizeof($value);
                if (is_array($value)) {
                    foreach ($value AS $v) {

                        $j = $i++;


                        $queryInner .= '(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND v.value="' . $v . '" AND f.attribute_name ="' . $k . '" GROUP BY t.product_id)t' . $i;


                        if ($i >= 3)
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


        $outerQuery = "SELECT tbl2.id productId,
                              tbl2.n product, 
                              tbl2.pc category, 
                              tbl2.an attribute_name, 
                              group_concat(tbl2.v SEPARATOR '$') AS value 
                        FROM (
                        SELECT
                        p.prodid AS id,
                        p.prodname  AS n,
                        pt.product_type_name AS pc,
                        f.attribute_name AS an,
                        v.`value` AS v
                        FROM
                        products_ecomc AS p
                        LEFT JOIN product_attribute_value AS t 
                        ON p.prodid = t.product_id
                        LEFT JOIN attribute_value_ecomc AS v 
                        ON t.attribute_value_id = v.attr_value_id
                        LEFT JOIN attr_common_flds_ecomc AS f 
                        ON v.attr_id = f.id 
                        LEFT JOIN product_type_ecomc AS pt 
                        ON p.subcatid = pt.product_type_id
                        WHERE t.product_id IN ((SELECT 
t1.product_id
FROM 
(%s))) GROUP BY t.product_attr_val_id) as tbl2 GROUP BY tbl2.id, tbl2.n, tbl2.an";

        //Count Query Outer
        $count_outer_qry = "SELECT
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
                            WHERE t.product_id IN ((SELECT 
t1.product_id
FROM 
(%s))) GROUP BY t.attribute_value_id";

        //Merge Queries
        $qry = sprintf($outerQuery, $queryInner);
        $count_qry = sprintf($count_outer_qry, $queryInner);
    }else {

        if (isset($_SESSION['bParam'])) {
            $keyword = implode(", ", r_implode($_SESSION['bParam'], ","));
            foreach ($_SESSION['bParam'] as $value) {
                if (is_array($value)) {

                    foreach ($value as $k => $v) {
                        $params2[] = '(f.attribute_name="' . $k . '" AND v.value ="' . $v . '")';
                    }
                }
            }
            $params = implode(" OR ", $params2);
        }


        if (isset($_SESSION['biblioCategory'])) {
            $sessArray = $_SESSION['biblioCategory'];


            for ($i = 0; $i < count($sessArray); $i++) {
                $qstr[] = $sessArray[$i];
                $subParams .= '%u,';
            }

            $subParams = substr($subParams, 0, strlen($subParams) - 1);
        }

        $qry = mainSearch_query($params, $subParams, $qstr);
        $count_qry = mainSearch_query($params, $subParams, $qstr, true);
    }

    try {
        //print_r($_SESSION);
        $conn = dbconnect();
        $referenceType_sorted = get_subCategory_options($conn);
        $sortedReferenceType = [];
        array_walk($referenceType_sorted['h'], function($v, $k) use (&$sortedReferenceType) {
            $sortedReferenceType[] = $v['name'];
        });
        if (strlen($qry) > 0) {
            $q = $conn->query($qry);
            $q1 = $conn->query($count_qry);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $q1->setFetchMode(PDO::FETCH_ASSOC);
            $items = '';
            $count = $q->rowCount();
            $attr_count = $q1->rowCount();
            if ($count && $attr_count) {
                $rows = $q->fetchAll();
                $count_rows = $q1->fetchAll();
            }
            //Attributes that come in frontend Left filter part
            $keys = array('reference_type' => 10,
                'artist' => 11,
                'author' => 12,
                'editor' => 13,
                'language' => 14,
                'place_of_publication' => 15,
                'publisher' => 16,
                'gregorian_year' => 17);
            //Attributes that come in frontend Right hand part
            //$rightKeys = array('translated_title' => 1, 'beditor' => 1, 'gregorian_month' => 1, 'gregorian_year' => 1, 'author' => 1);
            $rightKeys = array('translated1_title_of_parent'=>1,'translated_title' => 1, 'beditor' => 1, 'gregorian_month' => 1, 'gregorian_year' => 1, 'author' => 1, 'gallery_museum'=>1);
            //Restructuring mysql row
            if (!empty($rows) && !empty($count_rows)) {
                $data = array();
                foreach ($rows as $row) {

                    $data[$row['category']][$row['productId']][$row['product']][$row['attribute_name']] = $row['value'];
                }
                foreach ($count_rows as $count) {
                    $countData[$count['an']][] = array('name' => $count['v'], 'count' => $count['cn']);
                }



                /**
                 * Format result data for getting left part HTML
                 * as because books name not required in filter we ommit that
                 */
                $leftData = array();
                foreach ($rows as $row) {
                    //$leftData[$row['pc']][$row['id']][$row['an']][] = $row['v'];
                    $leftData[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
                }

                /**
                 * Search result page result body
                 * @get_html function
                 * params array $data
                 * params array $rightKeys(for displaying fewer attributes)
                 * Output mixed $searchhtml
                 */
                $Searchhtml = get_html($data, $rightKeys);



                /**
                 * Search filter left comes from $leftData
                 * @left_filter_data() will gather all values from comma separated strings
                 * Then we merged the multidimensional array into one with @call_user_func_array()
                 * Then at last we filter duplicate data with @assoc_Array_unique()
                 */
                $filter_data = left_filter_data($leftData, $keys);
                //$sArray=array_value_recursive($sortedReferenceType, $filter_data);
                //print "<pre>";
                //print_r($sArray);
                //exit();
                //$mergedArray = call_user_func_array('array_merge_recursive', $filter_data);

                foreach ($filter_data as $key => $res) {

                    if (is_array($res)) {
                        foreach ($res AS $k => $v) {

                            $attr = $k;
                            foreach ($v as $value) {

                                $result[$attr][] = $value;
                            }
                        }
                    }
                }
                //Pushing to result array SELECT ALL Checkbox value
                $key = 'reference_type';
                $key2 = 'language';
                $countR = !empty($result['reference_type']) ? count($result['reference_type']) : 0;
                $countL = !empty($result['language']) ? count($result['language']) : 0;
                $udfArray = array(
                    'reference_type' => array(
                        $countR => 'Select All'
                    )
                );
                $udfArray1 = array(
                    'language' => array(
                        $countL => 'Select All'
                    )
                );
                $aif = array_insert_after($result, $key, $udfArray);
                $last_aif = array_insert_after($aif, $key2, $udfArray1);

                $filter_data_af = assoc_Array_unique($last_aif);
                //print_r($filter_data_af);
                //exit;
                // print "<pre>";
                // print_r($filter_data);
                // exit;
                /**
                 * Get Left side filter values
                 * @left_filter_html
                 * params array $filter_data
                 * params array $keys (Only which keys are required for filter)
                 * 
                 */
                $leftHtml = left_filter_html($filter_data_af, $keys, $countData);
                //print "<pre>";
                //print_r($filter_data_af);
                //exit();

                /**
                 * Get Total Search Result Row Count
                 * Old Code 

                  foreach ($countData as $key => $val) {

                  $result_count += (sizeof($val));
                  }
                 * 
                 * @alternate
                 * $totalCharacterLength = array_sum(array_map(function($item) { 
                  return $item['values']['character_length'];
                  }, $totalCharacterLength));

                  $totalWordCount = array_sum(array_map(function($item) {
                  return $item['values']['word_count'];
                  }, $totalWordCount));
                 *  */
                /**
                 * @Changed on 30/04/2019 AT 6:14PM
                 * Get Total Search Result Count 
                 */
                $array_value_sum = create_function('$array,$key', '$total = 0; foreach($array as $row) $total = $total + $row[$key]; return $total;');
                //Getting count reference_type
                $result_count = $array_value_sum($countData['reference_type'], 'count');
                $html = 1;
                $options = get_subCategory_options($conn);
                $select_sub = $options['s'];
                $search_view = file_get_contents(VIEWS_FOLDER . 'search-result.inc.php');
                $search = array('{subcategory_list}', '{leftFilter}', '{searchedKeyword}', '{TotalResult}', '{searchList}');
                $replace = array($select_sub, $leftHtml, $keyword, $result_count, $Searchhtml);
                $finalView = str_replace($search, $replace, $search_view);
            }
        } else {
            goto_location($_SERVER['HTTP_REFERER']);
            exit;
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(INC_FOLDER . "headerInc.php");

    if ($html == 0) {
        $heading = '<p>&nbsp;</p>';
        $items = NO_PRODUCT_FOUND_MSG;
        include(VIEWS_FOLDER . "no-results-index.php");
    } else {
        echo $finalView;
    }
    include(INC_FOLDER . "footerInc.php");
}