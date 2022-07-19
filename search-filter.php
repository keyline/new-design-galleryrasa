<?php
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire'); // works
    require_once("require.php");
    require_once(INCLUDED_FILES . "config.inc.php");
    require_once(INCLUDED_FILES . "dbConn.php");
    require_once(INCLUDED_FILES . "functionsInc.php");
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
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
            
        $qry_arr = filter_var_array($_POST, FILTER_SANITIZE_STRING);
        if (empty($qry_arr)) {
            goto_location("beforeSearch");
            exit;
        }
        
        if(isset($_POST['submitButton']) && $_POST['submitButton'] == 'BiblioSearch'){
            
                foreach ($qry_arr as $k => $v) {
            if ($k == 'submitButton' OR $k == 'objSearch')
                continue;

            //$params_qry[$k] = $v;
            $search = get_subcategoryList_by_name();
            //Removing Value All from array with array filter
            $params_qry[$k] = array_filter($v, function($val) { return $val != 'All'; });
        }
        
        //Setting category values instead of text
        foreach ($params_qry as $k => $v){
                
                if(is_array($v)){
                    foreach($v as $p => $m){
                        if(array_key_exists($m, $search)){
                            $pp[$k][] = $search[$m];
                        }else{
                        $pp[$k][] = $m;
                        }
                    }

                }

            }
            /**
             * for Debugging purpose
             */
            /*
            print "<pre>";
            print_r($_POST);
            print_r($search);
            print_r($params_qry);
            print_r($pp);
            */
            //Setting default values for reference-type and language
            
            $childKeys = array_keys($pp);
            $parentCount = count($pp);
            $queryInner = '';
for($i=0; $i<=count($parentCount); $i++){
    
    if($childKeys[$i] == 'reference-type'){
       $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND (p.subcatid IN (" . implode(",",$pp[$childKeys[$i]]) . ")) GROUP BY t.product_id)t" . ($i+1);
    
    }elseif($childKeys[$i] == 'language'){
        
        foreach ($pp[$childKeys[$i]] AS $v){
            $lan[] = "v.value='$v'";
            
        }
        $queryInner .= " INNER JOIN (SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND (" . implode(" OR ", $lan) .") AND f.attribute_name = 'language' GROUP BY t.product_id)t" . ($i+1);
        
    }
            
    $j = $i;
    if ($i >= 1 && $i <= $parentCount){
                        $queryInner .= " ON t" . $j . ".product_id = t" . ($i+1) . ".product_id INNER JOIN ";
                }
        
 
}
            
        
        

        
        $keyword = implode(", ", r_implode($params_qry, ","));
        
        $i = 2;
        $p = 1;
        $arrayCount = 0;
        foreach ($pp AS $k => $value) {
                if($k == 'reference-type') continue;
                if($k == 'language') continue;
            $key = $k;
            $arrayCount += sizeof($value);
            if (is_array($value)) {
                foreach ($value AS $v) {
                    
                    $j = $i++;


                    $queryInner .= "(SELECT t.product_id FROM products_ecomc p LEFT JOIN product_attribute_value t ON p.prodid = t.product_id LEFT JOIN 
attribute_value_ecomc v ON t.attribute_value_id = v.attr_value_id LEFT JOIN attr_common_flds_ecomc f ON v.attr_id = f.id WHERE 
p.category_id = 1 AND v.value='" . $v . "' AND f.attribute_name = '" . $k . "' GROUP BY t.product_id)t" . $i;


                    if ($i >= 3)
                        $queryInner .= " ON t" . $j . ".product_id = t" . $i . ".product_id INNER JOIN ";
                   
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


        $outerQuery = "SELECT tbl2.id productId, tbl2.n product, tbl2.pc category, tbl2.an attribute_name, tbl2.cn relationcount, group_concat(tbl2.v SEPARATOR ', ') AS value 
                        FROM (
                        SELECT
                        p.prodid AS id,
                        p.prodname  AS n,
                        pt.product_type_name AS pc,
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
                        LEFT JOIN product_type_ecomc AS pt 
                        ON p.subcatid = pt.product_type_id
                        WHERE t.product_id IN ((SELECT 
t1.product_id
FROM 
(%s))) GROUP BY t.attribute_value_id) as tbl2 GROUP BY tbl2.id, tbl2.n, tbl2.an";
        //Merge Queries
          $qry = sprintf($outerQuery, $queryInner);
            
        }else{
                print_r($_SESSION);
        foreach ($_SESSION['bParam'] as $value) {
            if (is_array($value)) {

                foreach ($value as $k => $v) {
                    $params2[] = "(f.attribute_name='" . $k . "' AND v.value ='" . $v . "')";
                }
            }
        }
        $params = implode(" OR ", $params2);
        
        if(isset($_SESSION['biblioCategory'])){
         $sessArray = $_SESSION['biblioCategory'];   
        
                    
                        for($i=0;$i<count($sessArray); $i++){
                            $qstr[] = $sessArray[$i];
                            $subParams .= '%u,';
                        }
                    
        $subParams = substr($subParams, 0, strlen($subParams) - 1);
      }
        
        $qry = mainSearch_query($params, $subParams, $qstr);
        }
    }else{
        goto_location($_SERVER['HTTP_REFERER']);
            exit;
    }
    
        try{
            $conn = dbconnect();
                       
            if (strlen($qry)> 0) {
            $q = $conn->query($qry);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $items = '';
            $count = $q->rowCount();
            if ($count) {
                $rows = $q->fetchAll();
            }
            //Attributes that come in frontend Left filter part
            $keys = array('author' => 1, 'editor' => 1, 'reference-type' => 1, 'language'=>1, 'artist_mentioned'=>1);
            //Attributes that come in frontend Right hand part
            $rightKeys = array('translated_title_of_essay'=>1, 'editor'=>1, 'date'=>1, 'author'=>1, 'title_of_article'=>1);
            //Restructuring mysql row
            if (!empty($rows)) {
                $data = array();
                foreach ($rows as $row) {

                    $data[$row['category']][$row['productId']][$row['product']][$row['attribute_name']] = $row['value'];
                    $countData[$row['attribute_name']][] = array('name' => $row['value'],'count' => $row['relationcount']);
                    //    $data[$row['category']][$row['productId']][$row['attribute_name']] = $row['value'];
                }
//                print "<pre>";
//                print_r($data);
                /**
                 * Format result data for getting left part HTML
                 * as because books name not required in filter we ommit that
                 */
                $leftData = array();
                foreach ($rows as $row) {
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
                
                
                //$mergedArray = call_user_func_array('array_merge_recursive', $filter_data);
                $result['reference-type'][] = 'Select All';
                $result['language'][] = 'Select All';
                foreach ($filter_data as $key => $res){
                        $result['reference-type'][] = $key;
                        if(is_array($res)){
                            foreach ($res AS $k => $v){
                               
                                $attr = $k;
                                foreach ($v as $value){
                                    
                                $result[$attr][] = $value;
                                }
                            }
                        }
                    }
                    
                $filter_data = assoc_Array_unique($result);
//                print "<pre>";
//                print_r($leftData);
//                exit;
                /**
                 * Get Left side filter values
                 * @left_filter_html
                 * params array $filter_data
                 * params array $keys (Only which keys are required for filter)
                 * 
                 */
                
                
                
                $leftHtml = left_filter_html($filter_data, $keys);
                
                /**
                 * Get Total Search Result Row Count
                 */
                foreach ($data as $key => $val) {

                    $result_count += (sizeof($val));
                }
                $html = 1;
                
                $search_view = file_get_contents(VIEWS_FOLDER . 'search-filter-result.inc.php');
                $search = array('{leftFilter}', '{searchedKeyword}', '{TotalResult}', '{searchList}');
                $replace = array($leftHtml, $keyword, $result_count, $Searchhtml);
                $finalView = str_replace($search, $replace, $search_view);
            }
        } else {
            goto_location($_SERVER['HTTP_REFERER']);
            exit;
        }
            
        }catch(PDOException $pe){
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
