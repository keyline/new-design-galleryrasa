<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
require_once(INCLUDED_FILES . "pdo-debug.php");
$html = 0;

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
        
        $firstkey = '';
        $adv_author = trim($_POST['author']);
        $adv_attr = $_POST['attr'];
        $ref_type = $_POST['ref_type'];
        //$edition = trim($_POST['edition']);
        $language = trim($_POST['language']);
        //$place_of_publication = trim($_POST['place_of_publication']);
        $publisher = trim($_POST['publisher']);
        //$title_of_the_book = trim($_POST['title_of_the_book']);
        $date_year = trim($_POST['gregorian_year']);

        //$country = trim($_POST['country']);
       // $keyword = '';
        foreach ($_POST as $k => $v) {
            if ($k == 'adv_submit')
                continue;
            $params_qry[$k] = $v;
        }
        
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
        
        if ($ref_type != '') {
            $reference = "AND pte.product_type_name = '" . $ref_type . "'";
            }elseif ($ref_type == '' && !empty ($params_qry['title1_of_parent'])) {
                foreach ($params_qry['title1_of_parent'] AS $k => $ref){
                    $ref = ($k == 2) ?  'Catalogue' : 'Book'; 
                    
                }
                $reference = "AND pte.product_type_name = '" . $ref . "'";
            } else{
            $reference = '';
            }


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
            } elseif($keys[$i] == 'title1_of_parent'){
                    foreach ($params_qry[$keys[$i]] as $ind => $title){
                        $indK = ($ind == 1) ? 'Book' : 'Catalogue';
                        $new[][$indK] = $title; 
                    }
            } else {

                $new[] = array(
                    $keys[$i] => $params_qry[$keys[$i]]
                );
            }
        }
        
        $_SESSION['fParam'] = (!empty($new)) ? $new : null;

        array_walk_recursive($new, function($k, $v) use(&$new_arr) {
            // echo $k . "-" . $v . "<br>";
            $new_arr[] = $v . '-' . $k;
        });
        $keyword = implode(",", $new_arr);  
        
        /*
         * FOR DEBUGING PURPOSE
        
        print "<pre>";
        print_r($params_qry);
        echo "Count Of param is -". count($params_qry);
        //print_r($new);
        //print_r($new_arr);
        echo $keyword;
        //exit;
        */ 
        
        if ((count($params_qry) === 1) && (array_key_exists('ref_type', $params_qry))) {
            $firstkey = 'author';
            $qry_inner = '';
            $qry_inner = "(SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE  pte.product_type_name = '" . $ref_type . "' GROUP BY t.product_id) author";
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
                    if ($qk == 'ref_type')
                        continue;
                    if ($i == 0) {
                        //$firstkey = $qk;
                        $firstkey = 'author';
                    }
                    if ($qk == 'author')
                        continue;
                    if ($qk == 'attr')
                        continue;
                    if($qk == 'title1_of_parent'){
                        foreach ($qv as $q){
                            $qry_inner.= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                        }
                       $join = $qk; 
                    }else{
                        $qry_inner.= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
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
                    //echo $params_qry[$qk];
                    if ($qk == 'ref_type')
                        continue;
                    if ($i == 0) {
                        $firstkey = $qk;
                        if($qk == 'title1_of_parent'){
                            foreach ($qv as $q){
                                $qry_inner.= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                        }
                        }else{
                        $qry_inner.= " (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ";
                        }
                        $join = $qk;
                    } else {
                        if($qk == 'title1_of_parent'){
                            foreach ($qv as $q){
                                $qry_inner.= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $q . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
                            }
                        }else{
                            $qry_inner.= " INNER JOIN (SELECT t.product_id FROM product_type_ecomc pte LEFT JOIN products_ecomc p ON pte.product_type_id = p.subcatid 
                        LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id 
                        LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE v.value like '%" . $params_qry[$qk] . "%' AND f.attribute_name = '" . $qk . "' " . $reference . " GROUP BY t.product_id)" . $qk . " ON " . $join . ".product_id=" . $qk . ".product_id ";
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
        //exit;
        //Query for Count
        $count_adv_search_result = get_adv_search($firstkey, $qry_inner, true);
        
//        print "<pre>";
//        print_r($adv_search_result);
//        exit;
    }
    $keys = array('reference_type' => 10,
                          'artist'=>11, 
                          'author' => 12, 
                          'editor' => 13, 
                          'language'=>14,
                          'place_of_publication'=>15,
                          'publisher'=>16,
                          'gregorian_year'=>17);
    //Attributes that come in frontend Right hand part
    $rightKeys = array('translated_title'=>1, 'editor'=>1, 'date'=>1, 'author'=>1, 'title_of_article'=>1);
    //Restrucring mysql row
    if (!empty($adv_search_result) && !empty($count_adv_search_result)) {
        $data = array();
        $countData = array();
        foreach ($adv_search_result as $row) {

            $data[$row['category']][$row['productId']][$row['product']][$row['attribute_name']] = $row['value'];
            
            //    $data[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
        }
        foreach ($count_adv_search_result as $countrow){
            $countData[$countrow['attribute_name']][] = array('name' => $countrow['value'],'count' => $countrow['relationcount']);
        }
        /**
         * Format result data for getting left part HTML
         * as because books name not required in filter we ommit that
         */
        $leftData = array();
        foreach ($adv_search_result as $row) {
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
        
        foreach ($filter_data as $key => $res){
                        
                        if(is_array($res)){
                            foreach ($res AS $k => $v){
                               
                                $attr = $k;
                                foreach ($v as $value){
                                    
                                $result[$attr][] = $value;
                                }
                            }
                        }
                    }
                    //Pushing to result array SELECT ALL Checkbox value
                    $key = 'reference_type';
                    $key2= 'language';
                    $countR = !empty($result['reference_type']) ? count($result['reference_type']) : 0;
                    $countL = !empty($result['language']) ? count($result['language']) : 0;
                    $udfArray = array(
                                        'reference_type' => array(
                                                                    $countR  => 'Select All'
                                                                )
                                    );    
                    $udfArray1 = array(
                                        'language' => array(
                                                                    $countL  => 'Select All'
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
        $leftHtml = left_filter_html($filter_data_af, $keys, $countData);
        /**
         * Get Total Search Result Row Count
         
        foreach ($data as $key => $val) {
            $result_count += (sizeof($val));
        }
         * 
         */
        $array_value_sum = create_function('$array,$key', '$total = 0; foreach($array as $row) $total = $total + $row[$key]; return $total;');
        //Getting count reference_type
        $result_count = $array_value_sum($countData['reference_type'], 'count');
        $html = 1;
        $options = get_subCategory_options();
        $select_sub = $options['s'];
        $search_view = file_get_contents(VIEWS_FOLDER . 'adv-search-resultInc.php');
        $search = array('{subcategory_list}','{leftFilter}', '{searchedKeyword}', '{TotalResult}', '{searchList}');
        $replace = array($select_sub, $leftHtml, $keyword, $result_count, $Searchhtml);
        $finalView = str_replace($search, $replace, $search_view);
    } else {
        goto_location('adv-search');
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
<!--    <a id="myBtn" data-toggle="modal" data-target="#myModal">Advanced Search</a>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Search</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body" style="margin-bottom: 27px;">

                    <form action="adv-search" method="POST" >
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <label>Person Name</label>
                                <input type="text" name="author" class="form-control"/>

                            </div>
                            <div class="col-md-6">
                                <label>Select In/As</label>
                                <select name="attr" class="form-control">
                                    <option value="">Select All</option>
                                    <option value="author">Author</option>
                                    <option value="contributor">Contributor</option>
                                    <option value="editor">Editor</option>
                                    <option value="artist_mentioned">Artist Mentioned</option>
                                    <option value="curator">curator</option>
                                </select>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>     
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Reference type</label>
                                <select name="ref_type" class="form-control">
                                    <option value="">Select All</option>
                                    <option value="Books">Books</option>
                                    <option value="Newspaper Article">Newspaper Article</option>
                                    <option value="Periodical Article">Periodical Article</option>
                                    <option value="Book Section">Book Section</option>
                                    <option value="Thesis">Thesis</option>
                                    <option value="Catalogue Essay">Catalogue Essay</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Edition</label>
                                <input type="text" name="edition" class="form-control"/>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br>     
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Language</label>
                                <input type="text" name="language" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Place of Publication</label>
                                <input type="text" name="place_of_publication" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Publisher</label>
                                <input type="text" name="publisher" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Title</label>
                                <input type="text" name="title_of_the_book" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Year</label>
                                <input type="text" name="date_year" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input type="submit" name="adv_submit" class="btn" value="Search"/>

                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>-->
    <?php
    echo $finalView;
}
include(INC_FOLDER . "footerInc.php");

function array_filter_recursive($input){
    foreach ($input as &$value){
        if (is_array($value)){
            $value = array_filter_recursive($value);
        }
    }
    return array_filter($input);
}
    ?>
