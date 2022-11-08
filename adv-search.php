<?php

session_start();
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
require_once(INCLUDED_FILES . "pdo-debug.php");
$html = 0;
$conn = dbconnect();
$advsearch = true;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    unset($_SESSION['fParam']);
    //Initializing variables
    $html = $result_count = 0;
    $params = $subParams = '';
    $digitCount = 0;
    $paramCount = 0;
    $countData = array();
    //Filter Search



    if (isset($_POST['adv_submit']) && $_POST['adv_submit'] == 'Search') {
        $advsearch = true;

        if (isset($_POST['author'])) {
            $_SESSION['author'] = $_POST['author'];
        }
        if (isset($_POST['attr'])) {
            $_SESSION['attr'] = $_POST['attr'];
        }
        if (isset($_POST['ref_type'])) {
            $_SESSION['ref_type'] = $_POST['ref_type'];
        }
        if (isset($_POST['language'])) {
            $_SESSION['language'] = $_POST['language'];
        }
        if (isset($_POST['publisher'])) {
            $_SESSION['publisher'] = $_POST['publisher'];
        }
        if (isset($_POST['gregorian_year'])) {
            $_SESSION['gregorian_year'] = $_POST['gregorian_year'];
        }
        if (isset($_POST['descriptive_tags'])) {
            $_SESSION['descriptive_tags'] = $_POST['descriptive_tags'];
        }
        $_SESSION['post'] = $_POST;


        $firstkey = '';
        $adv_author = trim($_POST['author']);

        $adv_attr = $_POST['attr'];

        if (isset($_POST['ref_type'])) {
            $ref_type = $_POST['ref_type'];
        } else {
            $ref_type = "";
        }
        //$edition = trim($_POST['edition']);
        $language = trim($_POST['language']);
        //$place_of_publication = trim($_POST['place_of_publication']);
        $publisher = trim($_POST['publisher']);
        //$title_of_the_book = trim($_POST['title_of_the_book']);
        $date_year = trim($_POST['gregorian_year']);

        $descriptive_tags = trim($_POST['descriptive_tags']);

        //$country = trim($_POST['country']);
        // $keyword = '';
        foreach ($_POST as $k => $v) {
            if ($k == 'adv_submit') {
                continue;
            }
            $params_qry[$k] = $v;
        }



//        print_r($params_qry['extract']);
//
//        print_r($params_qry);
//        exit;


        /*
         * AS array filter cannot handle subarrays and we have title_of_parent as an array
         * So we make the recursive function array_filter_recursive() to filter our post paramers
         */
        //$params_qry = array_filter($params_qry);
        $params_qry = array_filter_recursive($params_qry);




        /*
         * Filter for -1 value
         * AS we are having a validation for selecting role
         * below script not required
         * LAST Edited on 21-03-2018 by Shuvadeep

          $filterArray = array_filter($params_qry, function ($var) {
          return (strpos($var, '-1') === false);
          });
         */
        if (false !== $key = array_search(-1, $params_qry)) {
            unset($params_qry[$key]);
        }

//        print_r($params_qry);
//        exit;
        $reference = "";
        $reference2 = "";
        if (!empty($ref_type)) {
            $cntreftype = count($ref_type);
            $refi = 1;

            foreach ($ref_type as $kref_type => $vref_type) {
                if ($vref_type != '') {
                    if ($refi == '1' || $cntreftype == '1') {
                        $reference .= " AND pte.product_type_name = '" . $vref_type . "'";


                        $reference2 .= " pte.product_type_name = '" . $vref_type . "'";
                    } else {
                        $reference .= " OR pte.product_type_name = '" . $vref_type . "'";

                        $reference2 .= " OR pte.product_type_name = '" . $vref_type . "'";
                    }
                } elseif ($vref_type == '' && !empty($params_qry['title1_of_parent'])) {
                    foreach ($params_qry['title1_of_parent'] as $k => $ref) {
                        //$ref = ($k == 2) ? 'Catalogue' : 'Book';
                        //$ref = ($k == 2) ? 'Journal Article' : 'Book';
                        if ($k == 2) {
                            $ref = 'Journal Article';
                        }
                    }


                    if ($refi == '1' || $cntreftype == '1') {
                        $reference .= " AND pte.product_type_name = '" . $ref . "'";
                        $reference2 .= " pte.product_type_name = '" . $ref . "'";
                    } else {
                        $reference .= " OR pte.product_type_name = '" . $ref . "'";
                        $reference2 .= " OR pte.product_type_name = '" . $ref . "'";
                    }
                } else {
                    $reference .= '';
                    $reference2 .= '';
                }
                $refi++;
            }
        } else {
            $reference .= '';
            $reference2 .= '';
        }
//        echo $reference;
//        echo $reference2;
//    print_r($filterArray);
//    exit;
        //Trimmed array for spaces
        #@last edited on  21-03-2018        //$trimmed_array = array_map('trim', $filterArray);
        //print_r($trimmed_array);
        $keys = array_keys($params_qry);
        //print_r($keys);
        $count = count($params_qry);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 1 && $keys[$i] == 'attr') {
                $new[] = array(
                    $params_qry[$keys[$i]] => $params_qry[$keys[$i - 1]]
                );
            } elseif ($i == 0 && $keys[$i] == 'author') {
                continue;
            } elseif ($keys[$i] == 'title1_of_parent') {
                foreach ($params_qry[$keys[$i]] as $ind => $title) {
                    //$indK = ($ind == 1) ? 'Book' : 'Catalogue';
                    $indK = ($ind == 1) ? 'Book' : 'Journal';
                    $new[][$indK] = $title;
                }
            } else {
                $new[] = array(
                    $keys[$i] => $params_qry[$keys[$i]]
                );
            }
        }

        $_SESSION['fParam'] = (!empty($new)) ? $new : null;

        array_walk_recursive($new, function ($k, $v) use (&$new_arr) {
            //echo $k . "-" . $v . "<br>";
            $new_arr[] = $v . '-' . $k;
        });
        $keyword = implode(",", $new_arr);
        //exit;
        /*
         * FOR DEBUGING PURPOSE

        print "<pre>";
        print_r($params_qry);
        echo "Count Of param is -". count($params_qry);
        //print_r($new);
        //print_r($new_arr);
        echo $keyword;
        exit;
        */

        if ((count($params_qry) === 1) && (array_key_exists('ref_type', $params_qry))) {
            $firstkey = 'author';
            $qry_inner = '';
            $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE  " . $reference2 . " GROUP BY t.product_id) author";
        } else {
            $qry_inner = '';


            if (array_key_exists('author', $params_qry)) {
                //$qry_inner = '';
                if (array_key_exists('attr', $params_qry)) {
                    $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry['author'] . "%' AND f.attribute_name = '" . $params_qry['attr'] . "' " . $reference . " GROUP BY t.product_id)author";
                } else {
                    $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry['author'] . "%' " . $reference . " GROUP BY t.product_id)author";
                }
                $join = 'author';
                $i = 0;
                foreach ($params_qry as $qk => $qv) {
                    if ($qk == 'ref_type') {
                        continue;
                    }
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
                    if ($qk == 'title1_of_parent') {
                        foreach ($qv as $q) {
                            $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                        }
                        $join = $qk;
                    } else {
                        $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                        $join = $qk;
                    }


                    $i++;
                }
            } else {
                //$qry_inner = '';
                $i = 0;
                if (array_key_exists('attr', $params_qry)) {
                    unset($params_qry['attr']);
                }
                foreach ($params_qry as $qk => $qv) {
                    //echo $qk;

                    if ($qk == 'ref_type') {
                        continue;
                    }
                    if ($i == 0) {
                        $firstkey = $qk;
                        if ($qk == 'title1_of_parent') {
//                            print('<pre>');
//                            print_r($qv);

                            if (($qv['2'] != '' || isset($qv['2'])) && !isset($qv['1'])) {
                                $jflag = true;
                                $jstr = " AND pte.product_type_id = '7' ";
                            } elseif (($qv['1'] != '' || isset($qv['1'])) && !isset($qv['2'])) {
                                # code...

                                $jflag = true;
                                $jstr = " AND pte.product_type_id IN (5,8) ";
                            } else {
                                $jflag = false;
                                $jstr = '';
                            }


                            foreach ($qv as $q) {
                                if ($qk == 'extract') {
                                    $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                                } else {
                                    $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' " . $jstr . " AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                                }
                            }
                        } else {
                            if ($qk == 'extract') {
                                $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%'  " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                            } else {
                                $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                            }
                        }
                        $join = $qk;
                    } else {
                        if ($qk == 'title1_of_parent') {
                            if (($qv['2'] != '' || isset($qv['2'])) && !isset($qv['1'])) {
                                $jflag = true;
                                $jstr = " AND pte.product_type_id = '7' ";
                            } elseif (($qv['1'] != '' || isset($qv['1'])) && !isset($qv['2'])) {
                                # code...

                                $jflag = true;
                                $jstr = " AND pte.product_type_id IN (5,8) ";
                            } else {
                                $jflag = false;
                                $jstr = '';
                            }

                            foreach ($qv as $q) {
                                if ($qk == 'extract') {
                                    $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                                } else {
                                    $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' " . $jstr . " AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                                }
                            }
                        } else {
                            if ($qk == 'extract') {
                                $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                            } else {
                                $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                            }
                        }
                        $join = $qk;
                    }
                    $i++;
                }
            }
        }
//
        //echo $qry_inner;
        //exit;
        //Query For Data
        $adv_search_result = get_adv_search($firstkey, $qry_inner);

        $productstr = '';

        foreach ($adv_search_result as $kadv1 => $vkadv1) {
            $productstr .= $vkadv1['productId'] . ',';
        }



        //exit;
        //Query for Count
        $count_adv_search_result = get_adv_search($firstkey, $qry_inner, true);

    //echo $adv_search_result;
//        exit;
//        print "<pre>";
//        print_r($adv_search_result);
//        exit;
    } elseif (isset($_POST['submitButton']) && $_POST['submitButton'] == 'BiblioSearch') {
//        print('<pre>');
//        print_r($_POST);
//        exit;

        $advsearch = false;
        $qry_arr = $_POST;
        $params_qry = array();

        $search = get_subcategoryList_by_name();

        foreach ($qry_arr as $k => $v) {
            if ($k == 'submitButton' || $k == 'objSearch') {
                continue;
            }
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



        $childKeys = array_keys($params_qry);

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
                foreach ($params_qry[$childKeys[$i]] as $k => $v) {
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

            if ($flag === 1) {
                $queryInner .= " INNER JOIN ";
            }
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

        foreach ($params_qry as $k => $value) {
            if ($k == 'reference_type') {
                continue;
            }
            if ($k == 'language') {
                continue;
            }
            if ($k == 'year_range') {
                $match = "-1";

                $stringCheck = implode(" ", $params_qry['year_range']);
                if (stripos($stringCheck, $match) === false) {
                    $j = $i++;
                    $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
                    attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
                p.category_id = 1 AND v.value BETWEEN " . implode(" AND ", $params_qry['year_range']) . " AND f.attribute_name = 'gregorian_year' GROUP BY t.product_id)t" . $i;

                    if ($i >= 3) {
                        $queryInner .= " ON t" . $j . ".product_id = t" . $i . ".product_id INNER JOIN ";
                    }
                }
            } else {
                $key = $k;
                $arrayCount += sizeof($value);
                if (is_array($value)) {
                    foreach ($value as $v) {
                        $j = $i++;


                        $queryInner .= '(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND v.value="' . $v . '" AND f.attribute_name = "' . $k . '" GROUP BY t.product_id)t' . $i;


                        if ($i >= 3) {
                            $queryInner .= " ON t" . $j . ".product_id = t" . $i . ".product_id INNER JOIN ";
                        }
                    }
                }
            }
        }

        $count = strlen($queryInner);
        $queryInner = substr($queryInner, 0, ($count - 12));

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
(%s))) GROUP BY t.product_attr_val_id) as tbl2 GROUP BY tbl2.id, tbl2.n, tbl2.an order by tbl2.n";

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
(%s))) GROUP BY t.attribute_value_id order by p.prodname";

        //Merge Queries
        $qry = sprintf($outerQuery, $queryInner);



        $count_qry = sprintf($count_outer_qry, $queryInner);
    } else {
        //WHen resetting happens
        $advsearch = true;
        $firstkey = '';
        $adv_author = trim($_SESSION['author']);
        $adv_attr = $_SESSION['attr'];

        if (isset($_SESSION['ref_type'])) {
            $ref_type = $_SESSION['ref_type'];
        } else {
            $ref_type = "";
        }

        $language = trim($_SESSION['language']);

        $publisher = trim($_SESSION['publisher']);

        $date_year = trim($_SESSION['gregorian_year']);

        $descriptive_tags = trim($_SESSION['descriptive_tags']);

        foreach ($_SESSION['post'] as $k => $v) {
            if ($k == 'adv_submit') {
                continue;
            }
            $params_qry[$k] = $v;
        }



//        $adv_author = trim($_POST['author']);
//        $adv_attr = $_POST['attr'];
//
//        if (isset($_POST['ref_type'])) {
//            $ref_type = $_POST['ref_type'];
//        } else {
//            $ref_type = "";
//        }
//
//        $language = trim($_POST['language']);
//
//        $publisher = trim($_POST['publisher']);
//
//        $date_year = trim($_POST['gregorian_year']);
//
//        $descriptive_tags = trim($_POST['descriptive_tags']);
//
//        foreach ($_POST as $k => $v) {
//            if ($k == 'adv_submit')
//                continue;
//            $params_qry[$k] = $v;
//        }


        $params_qry = array_filter_recursive($params_qry);


        if (false !== $key = array_search(-1, $params_qry)) {
            unset($params_qry[$key]);
        }


        $reference = "";
        $reference2 = "";
        if (!empty($ref_type)) {
            $cntreftype = count($ref_type);
            $refi = 1;

            foreach ($ref_type as $kref_type => $vref_type) {
                if ($vref_type != '') {
                    if ($refi == '1' || $cntreftype == '1') {
                        $reference .= " AND pte.product_type_name = '" . $vref_type . "'";


                        $reference2 .= " pte.product_type_name = '" . $vref_type . "'";
                    } else {
                        $reference .= " OR pte.product_type_name = '" . $vref_type . "'";

                        $reference2 .= " OR pte.product_type_name = '" . $vref_type . "'";
                    }
                } elseif ($vref_type == '' && !empty($params_qry['title1_of_parent'])) {
                    foreach ($params_qry['title1_of_parent'] as $k => $ref) {
                        $ref = ($k == 2) ? 'Journal Article' : 'Book';
                    }


                    if ($refi == '1' || $cntreftype == '1') {
                        $reference .= " AND pte.product_type_name = '" . $ref . "'";
                        $reference2 .= " pte.product_type_name = '" . $ref . "'";
                    } else {
                        $reference .= " OR pte.product_type_name = '" . $ref . "'";
                        $reference2 .= " OR pte.product_type_name = '" . $ref . "'";
                    }
                } else {
                    $reference .= '';
                    $reference2 .= '';
                }
                $refi++;
            }
        } else {
            $reference .= '';
            $reference2 .= '';
        }

        $keys = array_keys($params_qry);

        $count = count($params_qry);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 1 && $keys[$i] == 'attr') {
                $new[] = array(
                    $params_qry[$keys[$i]] => $params_qry[$keys[$i - 1]]
                );
            } elseif ($i == 0 && $keys[$i] == 'author') {
                continue;
            } elseif ($keys[$i] == 'title1_of_parent') {
                foreach ($params_qry[$keys[$i]] as $ind => $title) {
                    $indK = ($ind == 1) ? 'Book' : 'Journal';
                    $new[][$indK] = $title;
                }
            } else {
                $new[] = array(
                    $keys[$i] => $params_qry[$keys[$i]]
                );
            }
        }

        $_SESSION['fParam'] = (!empty($new)) ? $new : null;

        array_walk_recursive($new, function ($k, $v) use (&$new_arr) {
            $new_arr[] = $v . '-' . $k;
        });
        $keyword = implode(",", $new_arr);


        if ((count($params_qry) === 1) && (array_key_exists('ref_type', $params_qry))) {
            $firstkey = 'author';
            $qry_inner = '';


            $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE  " . $reference2 . " GROUP BY t.product_id) author";
        } else {
            $qry_inner = '';


            if (array_key_exists('author', $params_qry)) {
                if (array_key_exists('attr', $params_qry)) {
                    $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry['author'] . "%' AND f.attribute_name = '" . $params_qry['attr'] . "' " . $reference . " GROUP BY t.product_id)author";
                } else {
                    $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry['author'] . "%' " . $reference . " GROUP BY t.product_id)author";
                }
                $join = 'author';
                $i = 0;
                foreach ($params_qry as $qk => $qv) {
                    if ($qk == 'ref_type') {
                        continue;
                    }
                    if ($i == 0) {
                        $firstkey = 'author';
                    }
                    if ($qk == 'author') {
                        continue;
                    }
                    if ($qk == 'attr') {
                        continue;
                    }
                    if ($qk == 'title1_of_parent') {
                        foreach ($qv as $q) {
                            $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                        }
                        $join = $qk;
                    } else {
                        $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                        $join = $qk;
                    }


                    $i++;
                }
            } else {
                $i = 0;
                if (array_key_exists('attr', $params_qry)) {
                    unset($params_qry['attr']);
                }
                foreach ($params_qry as $qk => $qv) {
                    //echo $qk;
                    if ($qk == 'ref_type') {
                        continue;
                    }
                    if ($i == 0) {
                        $firstkey = $qk;
                        if ($qk == 'title1_of_parent') {
                            if (($qv['2'] != '' || isset($qv['2'])) && !isset($qv['1'])) {
                                $jflag = true;
                                $jstr = " AND pte.product_type_id = '7' ";
                            } elseif (($qv['1'] != '' || isset($qv['1'])) && !isset($qv['2'])) {
                                # code...

                                $jflag = true;
                                $jstr = " AND pte.product_type_id IN (5,8) ";
                            } else {
                                $jflag = false;
                                $jstr = '';
                            }

                            foreach ($qv as $q) {
                                if ($qk == 'extract') {
                                    $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                                } else {
                                    $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%'". $jstr . " AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                                }
                            }
                        } else {
                            if ($qk == 'extract') {
                                $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%'  " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                            } else {
                                $qry_inner .= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                            }
                        }
                        $join = $qk;
                    } else {
                        if ($qk == 'title1_of_parent') {
                            /**
                             * added by shuvadeep@keylines.net on 07/11/2022
                             * for specific search on particular category
                             * Book/Journal Article
                             */
                            if (($qv['2'] != '' || isset($qv['2'])) && !isset($qv['1'])) {
                                $jflag = true;
                                $jstr = " AND pte.product_type_id = '7' ";
                            } elseif (($qv['1'] != '' || isset($qv['1'])) && !isset($qv['2'])) {
                                # code...

                                $jflag = true;
                                $jstr = " AND pte.product_type_id IN (5,8) ";
                            } else {
                                $jflag = false;
                                $jstr = '';
                            }

                            foreach ($qv as $q) {
                                if ($qk == 'extract') {
                                    $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                                } else {
                                    $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%'". $jstr ." AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                                }
                            }
                        } else {
                            if ($qk == 'extract') {
                                $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                            } else {
                                $qry_inner .= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                            }
                        }
                        $join = $qk;
                    }
                    $i++;
                }
            }
        }



        $adv_search_result = get_adv_search($firstkey, $qry_inner);

        /**
         * added by shuvadeep@keylines.net on 07/11/200
         * issue was after reset, left search not delivering result with
         * modified selection in left panel
         */

        $productstr = '';

        foreach ($adv_search_result as $kadv1 => $vkadv1) {
            $productstr .= $vkadv1['productId'] . ',';
        }


        $count_adv_search_result = get_adv_search($firstkey, $qry_inner, true);
    }




    if ($advsearch == false) {
        try {
            $conn = dbconnect();
            $referenceType_sorted = get_subCategory_options($conn);
            $sortedReferenceType = [];
            array_walk($referenceType_sorted['h'], function ($v, $k) use (&$sortedReferenceType) {
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
                $keys = array('reference_type' => 10,
                                'artist' => 11,
                    'author' => 12,
                    'editor' => 13,
                                'language' => 14,
                                'place_of_publication' => 15,
                                'publisher' => 16,
                                'gregorian_year' => 17);
                $rightKeys = array('title_of_article' => 1, 'translated1_title_of_parent' => 1, 'translated_title' => 1, 'beditor' => 1, 'gregorian_month' => 1, 'gregorian_year' => 1, 'author' => 1, 'gallery_museum' => 1);

                if (!empty($rows) && !empty($count_rows)) {
//                    print('<pre>');
//                    print_r($count_rows);
//                    exit;
                    //print "<pre>";
                    //print_r($rows);
                    //print_r($allproductsidarr);


                    if (isset($_POST['allproductsid'])) {
                        $allproductsidarr = (explode(",", $_POST['allproductsid']));


                        $rowsfiltered = [];
                        $rowsfilteredindex = 0;

                        foreach ($rows as $kr1 => $vr1) {
                            foreach ($allproductsidarr as $kr2 => $vr2) {
                                if ($vr1['productId'] == $vr2) {
                                    $rowsfiltered[$rowsfilteredindex]['productId'] = $vr1['productId'];

                                    $rowsfiltered[$rowsfilteredindex]['product'] = $vr1['product'];
                                    $rowsfiltered[$rowsfilteredindex]['category'] = $vr1['category'];
                                    $rowsfiltered[$rowsfilteredindex]['attribute_name'] = $vr1['attribute_name'];
                                    $rowsfiltered[$rowsfilteredindex]['value'] = $vr1['value'];

                                    $rowsfilteredindex++;
                                }
                            }
                        }



                        $count_rowsfiltered = [];
                        $count_rowsfilteredindex = 0;

                        foreach ($count_rows as $kr3 => $vr3) {
                            if (in_array($vr3['id'], $allproductsidarr)) {
                                $count_rowsfiltered[$count_rowsfilteredindex]['id'] = $vr3['id'];

                                $count_rowsfiltered[$count_rowsfilteredindex]['n'] = $vr3['n'];
                                $count_rowsfiltered[$count_rowsfilteredindex]['an'] = $vr3['an'];
                                $count_rowsfiltered[$count_rowsfilteredindex]['cn'] = $vr3['cn'];
                                $count_rowsfiltered[$count_rowsfilteredindex]['v'] = $vr3['v'];

                                $count_rowsfilteredindex++;
                            }
                        }


                        $productidarr = [];
                        $productidindex = 0;
                        foreach ($count_rowsfiltered as $kr4 => $vr4) {
                            $productidarr[$productidindex] = $vr4['id'];
                            $productidindex++;
                        }

                        $productid2arr = [];
                        $productid2arr = (array_unique($productidarr));

                        $noofsearchedproducts = count($productid2arr);
                    } else {
                        $rowsfiltered = $rows;
                        $count_rowsfiltered = $count_rows;
                    }


                    $data = array();
                    foreach ($rowsfiltered as $row) {
                        if ($row['category'] == "Journal Article" && $row['attribute_name'] == "title_of_article") {
                            continue;
                        } elseif ($row['category'] == "Catalogue Essay" && $row['attribute_name'] == "title_of_article") {
                            continue;
                        } else {
                            $data[$row['category']][$row['productId']][$row['product']][$row['attribute_name']] = $row['value'];
                        }
                    }
                    foreach ($count_rows as $count) {
                        $countData[$count['an']][] = array('name' => $count['v'], 'count' => $count['cn']);
                    }


//                    print("<pre>");
//                    print_r($count_rows);
//                    exit;




                    $leftData = array();
                    foreach ($rowsfiltered as $row) {
                        //foreach ($rows as $row) {
                        $leftData[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
                    }

                    if (isset($_SESSION)) {
                        if (isset($_SESSION['user-id'])) {
                            $usersession = true;
                        } else {
                            $usersession = false;
                        }
                    } else {
                        $usersession = false;
                    }

                    $Searchhtml = get_html($data, $rightKeys, $usersession);
                    $filter_data = left_filter_data($leftData, $keys);

                    foreach ($filter_data as $key => $res) {
                        if (is_array($res)) {
                            foreach ($res as $k => $v) {
                                $attr = $k;
                                foreach ($v as $value) {
                                    $result[$attr][] = $value;
                                }
                            }
                        }
                    }

                    $key = 'reference_type';
                    $key2 = 'language';

                    array_unshift($result['reference_type'], "");
                    array_unshift($result['language'], "Select All");

                    $countR = !empty($result['reference_type']) ? count($result['reference_type']) : 0;
                    $countL = !empty($result['language']) ? count($result['language']) : 0;

                    $udfArray = array(
                        'reference_type' => array(
                            '0' => 'Select All'
                        )
                    );
                    $udfArray1 = array(
                        'language' => array(
                            '0' => 'Select All'
                        )
                    );

                    $aif = array_insert_after($result, $key, $udfArray);
                    $last_aif = array_insert_after($aif, $key2, $udfArray1);

                    $filter_data_af = assoc_Array_unique($last_aif);


//                    if (isset($_POST['allproductsid'])) {
//
//
//
//                        $leftHtml = left_filter_html_adv_filtered($filter_data_af, $keys, $countData, $noofsearchedproducts);
//                    } else {

                    $leftHtml = left_filter_html_adv($filter_data_af, $keys, $countData);
//                    }

                    $alljournaldropdownarr = alljournaldropdown($conn);

                    $alllanguagedropdownarr = alllanguagedropdown($conn);

                    //$array_value_sum = create_function('$array,$key', '$total = 0; foreach($array as $row) $total = $total + $row[$key]; return $total;');

                    if (!isset($countData['reference_type'])||$countData['reference_type']=='') {
                        $countData = [];
                        $countData['reference_type'] = '0';
                    }

                    //$result_count = $array_value_sum($countData['reference_type'], 'count');

                    $result_count= array_reduce($countData['reference_type'], function ($carry, $item) {
                        $carry += $item['count'];
                        return $carry;
                    });

                    $html = 1;
                    $options = get_subCategory_options($conn);
                    $select_sub2 = $options['s'];

                    $options2 = get_subCategory_optionsBib($conn);
                    $select_sub = $options2['s'];

                    $search_view = file_get_contents(VIEWS_FOLDER . 'adv-search-resultInc.php');
                    $search = array('{filter_search_subcategory_list}','{languagelist}', '{journallist}', '{leftFilter}', '{searchedKeyword}', '{TotalResult}', '{searchList}', '{adv-search-options}');


//                     print("<pre>");
//                        print_r($noofsearchedproducts);
//                        exit;


                    if (isset($_POST['allproductsid'])) {
                        $replace = array($select_sub2, $alllanguagedropdownarr, $alljournaldropdownarr,  $leftHtml, $keyword, $noofsearchedproducts, $Searchhtml, $options2['op']);
                    } else {
                        $replace = array($select_sub2, $alllanguagedropdownarr, $alljournaldropdownarr,  $leftHtml, $keyword, $result_count, $Searchhtml, $options2['op']);
                    }



//                    $replace = array($alllanguagedropdownarr, $alljournaldropdownarr, $select_sub2, $leftHtml, $keyword, $result_count, $Searchhtml, $options2['op']);
                    $finalView = str_replace($search, $replace, $search_view);
                }
            } else {
                goto_location($_SERVER['HTTP_REFERER']);
                exit;
            }
        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }
    } else {
        $keys = array('reference_type' => 10,
            'artist' => 11,
            'author' => 12,
            'editor' => 13,
            'language' => 14,
            'place_of_publication' => 15,
            'publisher' => 16,
            'gregorian_year' => 17
                //'productId' => 18
        );
        //Attributes that come in frontend Right hand part
        $rightKeys = array('translated_title' => 1, 'editor' => 1, 'date' => 1, 'author' => 1, 'title_of_article' => 1);
        //Restrucring mysql row
        if (!empty($adv_search_result) && !empty($count_adv_search_result)) {
            $data = array();
            $countData = array();
            foreach ($adv_search_result as $row) {
                if ($row['category'] == "Journal Article" && $row['attribute_name'] == "title_of_article") {
                    continue;
                //echo "found it";
                } elseif ($row['category'] == "Catalogue Essay" && $row['attribute_name'] == "title_of_article") {
                    continue;
                } else {
                    $data[$row['category']][$row['productId']][$row['product']][$row['attribute_name']] = $row['value'];
                }


                //$data[$row['category']][$row['productId']][$row['product']][$row['attribute_name']] = $row['value'];
                //    $data[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
            }
            foreach ($count_adv_search_result as $countrow) {
                $countData[$countrow['attribute_name']][] = array('name' => $countrow['value'], 'count' => $countrow['relationcount']);
            }
            /**
             * Format result data for getting left part HTML
             * as because books name not required in filter we ommit that
             */
            $leftData = array();
            foreach ($adv_search_result as $row) {
                $leftData[$row['category']][$row['productId']]['productId'] = $row['productId'];
                $leftData[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
            }



            /**
             * Search result page result body
             * @get_html function
             * params array $data
             * params array $rightKeys(for displaying fewer attributes)
             * Output mixed $searchhtml
             */
            if (isset($_SESSION)) {
                if (isset($_SESSION['user-id'])) {
                    $usersession = true;
                } else {
                    $usersession = false;
                }
            } else {
                $usersession = false;
            }



            $Searchhtml = get_html($data, $rightKeys, $usersession);
            /**
             * Search filter left comes from $leftData
             * @left_filter_data() will gather all values from comma separated strings
             * Then we merged the multidimensional array into one with @call_user_func_array()
             * Then at last we filter duplicate data with @assoc_Array_unique()
             */
            $filter_data = left_filter_data($leftData, $keys);

            foreach ($filter_data as $key => $res) {
                if (is_array($res)) {
                    foreach ($res as $k => $v) {
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
            /**
             * Get Left side filter values
             * @left_filter_html
             * params array $filter_data
             * params array $keys (Only which keys are required for filter)
             *
             */
            $leftHtml = left_filter_html_only_adv($filter_data_af, $keys, $countData, $productstr);
            /**
             * Get Total Search Result Row Count

              foreach ($data as $key => $val) {
              $result_count += (sizeof($val));
              }
             *
             */
            $alljournaldropdownarr = alljournaldropdown($conn);

            $alllanguagedropdownarr = alllanguagedropdown($conn);



            //$array_value_sum = create_function('$array,$key', '$total = 0; foreach($array as $row) $total = $total + $row[$key]; return $total;');
            //Getting count reference_type
            //$result_count = $array_value_sum($countData['reference_type'], 'count');
            $result_count= array_reduce($countData['reference_type'], function ($carry, $item) {
                $carry += $item['count'];
                return $carry;
            });

            $html = 1;
            $options = get_subCategory_options();
            $select_sub = $options['s'];


            $options2 = get_subCategory_optionsBib($conn);
            $select_sub2 = $options['s'];


            $search_view = file_get_contents(VIEWS_FOLDER . 'adv-search-resultInc.php');
            $search = array('{filter_search_subcategory_list}','{languagelist}', '{journallist}', '{adv-search-options}', '{leftFilter}', '{searchedKeyword}', '{TotalResult}', '{searchList}');
            $replace = array($select_sub2, $alllanguagedropdownarr, $alljournaldropdownarr, $options2['op'], $leftHtml, $keyword, $result_count, $Searchhtml);
            $finalView = str_replace($search, $replace, $search_view);
        } else {
            goto_location('adv-search');
        }
    }
}
include(INC_FOLDER . "headerInc.php");
//echo $html;
//exit();
if ($html == 0) {
    $heading = '<p>&nbsp;</p>';
    $items = NO_PRODUCT_FOUND_MSG;
    include(VIEWS_FOLDER . "no-results-index.php");
} else {
    ?>

    <?php

    echo $finalView;
}
include(INC_FOLDER . "footerInc.php");

function array_filter_recursive($input)
{
    foreach ($input as &$value) {
        if (is_array($value)) {
            $value = array_filter_recursive($value);
        }
    }
    return array_filter($input);
}
?>
