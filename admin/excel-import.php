<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
//require_once __DIR__ . '/../Class/Bootstrap.php';

check_auth_admin();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $keys = array_keys($_POST['category']);
    
    $parent_category = $keys[0];
    $current_import_sheet = $_POST['category'][$parent_category];
    
    if(in_array($current_import_sheet, $_POST['category'])){
        
        switch($current_import_sheet){
                case 'Films' : 
                                $sub = null;
                                $parent = 2;
                                $ass = 'film';
                                break;
                case 'Catalogue': 
                                $sub = 9;
                                $parent = 1;
                                $ass = 'title1_of_parent';
                                break;
                case 'Books': 
                                $sub = 5;
                                $parent = 1;
                                $ass = 'title1_of_parent';
                                break;
                case 'Journal': 
                                $sub = 6;
                                $parent = 1;
                                $ass = 'title1_of_parent';
                                break;
                case 'Journal Article': 
                                $sub = 7;
                                $parent = 1;
                                $ass = 'title_of_article';
                                break;
                case 'Catalogue Essay': 
                                $sub = 10;
                                $parent = 1;
                                $ass = 'title_of_article';
                                break;
                case 'Book Section': 
                                $sub = 8;
                                $parent = 1;
                                $ass = 'title_of_article';
                                break;


                }
    }
    
    $status = 'False';
    $dbF = get_all_inputtype_fields();
    $inputFileType = 'Excel2007';
    $allowedexts = array("xlsx", "xls");
    $extension = explode(".", strtolower($_FILES['file']['name']));
    $exts = end($extension);
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
    print "<pre>";
    print_r($_FILES['file']);
    //$uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/rasa_server/uploads/";
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    if (($_FILES['file']['size'] < 500000000) && in_array($exts, $allowedexts)) {

        $newname = date('d-m-y') . "_" . time() . "." . $exts;
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath . $newname);
       $path = $uploadPath . $newname;
       //include $_SERVER['DOCUMENT_ROOT'] . '/Class/PHPExcel/IOFactory.php';
       //include $_SERVER['DOCUMENT_ROOT'] . '/rasa_server/Class/PHPExcel/IOFactory.php';
        $inputFileName = $uploadPath . $newname;
    }
    $start = microtime(true);
        try {
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            //$objReader = PHPExcel_IOFactory::createReader($inputFileType);
//$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $objPHPExcel = $objReader->load($inputFileName);
//$sheet = $objPHPExcel->getActiveSheet();
        } catch (Exception $ex) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $ex->getMessage());
        }

//$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
// $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
        $worksheetNames = $objReader->listWorksheetNames($inputFileName);
        $dbKeys = get_attrKeys_by_category($parent_category);
        $nameConcat = array('surname', 'middle', 'name');
        $concat = array();
        //print "<pre>";
        foreach ($worksheetNames as $sheetIndex => $sheetName) {
            if ($sheetName == $current_import_sheet) {
                //Reinitializing variable
                $data= array();
                $objPHPExcel->setActiveSheetIndex($sheetIndex);
                $sheet = $objPHPExcel->getActiveSheet();
                $allDataInsheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//$row_index = $objWorksheet->getHighestRow(); // e.g. 5
//Getting highest row
                $highestrow = $sheet->getHighestDataRow();
//Getting highest column
                $highestColumn = $sheet->getHighestColumn(); // e.g. B
//Getting column count
                $columncount = PHPExcel_Cell::columnIndexFromString($highestColumn);
//$col_index = PHPExcel_Cell::columnIndexFromString($col_name); // e.g. 1 (which is equivalent to B)
                $titles = $sheet->rangeToArray('A1:' . $highestColumn . "1");
                $boddy = $sheet->rangeToArray('A2:' . $highestColumn . $highestrow);
                for ($row = 0; $row <= $highestrow - 2; $row++) {
                    set_time_limit(1000);
                    $a = array();
                    $count = 0;
                    for ($column = 0; $column <= $columncount - 1; $column++) {
                        //$a[$titles[0][$column]] = $boddy[$row][$column];
                           set_time_limit(1000); 
                        for ($j = 0; $j < count($dbKeys); $j++) {

                            if (stristr($titles[0][$column], $dbKeys[$j]) !== false) {
                                $key = $dbKeys[$j];
                                $data[$key][$column] = $boddy[$row][$column];
                                //echo "Column-" . $column . 'match Found |' . $count . "| excel_title|" . $titles[0][$column] . "| db_title|" . $dbKeys[$j] . "|Value:-" . $boddy[$row][$column] . "<br>";
                               // $count++;
                                
                                //break;
                            }
                            $result = r_implode($data);
                            
                            //Before going to next row check database for atrributes present or not
                            //if not then insert and get id's of that attributes to insert into products table
                        foreach ($dbF AS $k => $v){
                            if(array_key_exists($k, $result)){
                                $inserData[$dbF[$k]] = addslashes($result[$k]);
                            }
                        }
                        }
                       
                } //Finsihing column traversing for row
                
                
                
                // Getting the attributes id or insert text type attributes and get last id
                    $field_type = get_input_type_fields();

                    
                    $attrLastID = (Excel_data_insert($inserData, $field_type));
                //echo "Finished under Sheet-". $sheetName .": Row Number :". $row;
                    
                    /**
                        * For Logging  purpose
                    */
                        $array = array_filter(array_map('array_filter', $data));
                        $countData = (array_sum(array_map('count',$array ))); 
                        $count_of_insert = count($attrLastID);
                        if($count_of_insert == $countData) $status = "OK";
                        $logData = "Finished under Sheet- %s | Row Number : %d | count of Excel Fields: %d | Count of Insert: %d | Status %s";
                    
                        $logarray = array( $sheetName, $row, $countData, $count_of_insert, $status);   
                            
                    
                    //Product Entry Starts here
                    //Get title of the book
                    $bookTitle = $result[$ass];
                    $subCatID = $sub;
                    $catID= $parent;
                    $columns = array(
                        'prodid'   => 'null',
                        'category_id' => ':category',
                        'subcatid'    => ':Subcategory',
                        'prodname' => ':pname',
                        'price'    => ':price',
                        'dateadded'=> 'now()',
                        );
                    $bind = array(
                    ':category'=> (!empty($catID)) ? $catID : NULL ,
                    ':Subcategory'=> (!empty($subCatID)) ? $subCatID : NULL ,
                    ':pname'   => $bookTitle,
                    ':price'   => 0,
                       );
                    try {
                           $err = false;
                           $conn= dbconnect();
                           $qry = insert(PRODUCTS_TBL, $columns);
                            $q   = $conn->prepare($qry);
                            $q->execute($bind);
                            $id  = $conn->lastInsertId();
                            
                            //Inserting attributes
                            for($i = 0; $i<count($attrLastID); $i++){
                
                                $columns_p['product_attr_val_id'] = 'null';
                                $columns_p['attribute_value_id'] = ':attr_value';
                                $columns_p['product_id'] = ':p_id';

                                $bind_p[':attr_value'] = $attrLastID[$i];
                                $bind_p[':p_id']    = $id;
                                $pqr = insert(PROD_ATTR_VALUE, $columns_p);
                                $q   = $conn->prepare($pqr);
                                $q->execute($bind_p);
                            }
                            $logDataFinal = vsprintf($logData, $logarray);
                            m_log($logDataFinal);
                       } catch (PDOException $pe) {
                           $err = true;
                            $er = db_error($pe->getMessage());
                       }
                       echo "Inserting data for Row Number " . $row . " total fields " . $column . "<br>";
//                if ($row == 3)
//                        break;   
                
            }
            
            
        }
        
        
        }
        // print_r($data);
        // print_r($dbKeys);
        // print_r($result);
        // print_r($inserData);
        // print_r($attrLastID);
        
       echo $time_elapsed_secs = microtime(true) - $start;

    
} else {
        $search = array('bibliography', 'memorabilia');
        $cat = $_GET['import'];
        
        if(in_array($cat, $search)){
           $page =  ($cat == 'memorabilia') ? "excel-import-tpl.php" : "bibliography-excel-import-tpl.php";
                include(ADMIN_HTML . "admin-headerInc.php");
                include(ADMIN_HTML . $page);
                include(ADMIN_HTML . "admin-footerInc.php");                      
        }else{
            
            goto_location("index");
        }
        
}