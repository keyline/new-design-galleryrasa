<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/ChunkReadFilter.php';

//require_once __DIR__ . '/../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Html;

class Excelreader {

    protected $dbConn; //DB Instance
    protected $EmbossUser; //Logged in Embossing User Id
    private static $dbTable = 'TVS_TEMP_FILE_DATA';
    private static $proc_temp_Insert = 'SP_TTFD_TEMP_TBL_INSERT';
    private static $proc_tampMaster_Insert = 'SP_TTFM_TEMP_MASTER_TBL_INSERT';

    //private static $inputFileType = 'Xls';

    public function __construct($db) {
        $this->dbConn = $db;
        //$this->EmbossUser = $embId;
    }

    /**
     * This function is used to read data from excel file in chunks and insert into database
     * @param string $filePath
     * @param integer $chunkSize
     */
    public function readFileAndDumpInDB($filePath, $chunkSize) {
        echo("Loading file " . $filePath . " ....." . PHP_EOL);
        $startRow = 1;
        $arrStrHeadings = [];
        /**  Identify the type of $inputFileName  * */
        $inputFileType = IOFactory::identify($filePath);

        /**  Create a new Reader of the type that has been identified  * */
        $objReader = IOFactory::createReader($inputFileType);
        /**  Create a new Instance of our Read Filter  * */
        $chunkFilter = new ChunkReadFilter();
        /**  Tell the Reader that we want to use the Read Filter that we've Instantiated  * */
        $objReader->setReadFilter($chunkFilter);
        $objReader->setReadDataOnly(true);
        while (true) {
            $chunkFilter->setRows($startRow, $chunkSize);
            $objPHPExcel = $objReader->load($filePath)->getActiveSheet();
            $pRange = 'A' . $startRow . ':' . $objPHPExcel->getHighestColumn() . $objPHPExcel->getHighestRow();
            $arrStrSheetData = $objPHPExcel->rangeToArray($pRange, $nullValue = null, $calculateFormulas = true, $formatData = true, $returnCellRef = false);
            if (0 == count($arrStrSheetData)) {
                break;
            }
            if (1 == $startRow && empty($arrStrHeadings)) {
                $arrStrHeadings = array_map('strtolower', array_shift($arrStrSheetData));
            }
            
            foreach ($arrStrSheetData as $arrStrSheetDatum) {

                $arrStrSheetDatum = array_combine($arrStrHeadings, $arrStrSheetDatum);
                $this->dumpInDb($arrStrSheetDatum);
                // Do oprations...
            }
            $startRow += $chunkSize;
        }




        $objPHPExcel->disconnectWorksheets();
        unset($objPHPExcel, $arrStrSheetDatum);

        echo("File " . $filePath . " has been uploaded successfully in database" . PHP_EOL . "<br>");
    }

    /**
     * Insert data into database table 
     * @param Array $sheetData
     * @return boolean
     * @throws Exception
     * THE METHOD FOR THE DATABASE IS NOT WORKING, JUST THE PUBLIC METHOD..
     */
    public function dumpInDb($sheetData) {
        try {
            //Getting Master Data
            $inserData = $data = [];
            $dbKeys = get_attrKeys_by_category();
            $dbF = get_all_inputtype_fields();
            $toalRowCount = count($sheetData);

            foreach ($sheetData AS $key => $val) {
                for ($i = 0; $i < count($dbKeys); $i++) {
                    if (stristr($key, $dbKeys[$i]) !== FALSE) {
                        $key_matched = $dbKeys[$i];
                        $data[$key_matched][] = self::remove_specialChar_spaces($val);
                    }
                    $result = r_implode($data);
                    foreach ($dbF AS $k => $v) {
                        if (array_key_exists($k, $result)) {
                            $inserData[$dbF[$k]] = addslashes($result[$k]);
                        }
                    }
                }
                set_time_limit(1000);
            }
            // Getting the attributes id or insert text type attributes and get last id
            
            
            $field_type = get_input_type_fields();
            $attrLastID = (Excel_data_insert($inserData, $field_type));
            //print_r($attrLastID);
            //Product Entry Starts here
            //Get title of the book
            //$bookTitle = $result['title1_of_parent'];
            $bookTitle = $result['title_of_article']; // Dynamic in nature
            $subCatID = 7; //Dynamic in nature
            $catID = 1; //Dynamic in nature
            $columns = array(
                'prodid' => 'null',
                'category_id' => ':category',
                'subcatid' => ':Subcategory',
                'prodname' => ':pname',
                'price' => ':price',
                'dateadded' => 'now()',
            );
            $bind = array(
                ':category' => (!empty($catID)) ? $catID : NULL,
                ':Subcategory' => (!empty($subCatID)) ? $subCatID : NULL,
                ':pname' => $bookTitle,
                ':price' => 0,
            );
            $err = FALSE;
            $qry_insert = insert(PRODUCTS_TBL, $columns);
            $stmt_insert = $this->dbConn->prepare($qry_insert);
            $stmt_insert->execute($bind);
            $id = $this->dbConn->lastInsertId();
            //Inserting Attributes
            for ($i = 0; $i < count($attrLastID); $i++) {

                $columns_p['product_attr_val_id'] = 'null';
                $columns_p['attribute_value_id'] = ':attr_value';
                $columns_p['product_id'] = ':p_id';

                $bind_p[':attr_value'] = $attrLastID[$i];
                $bind_p[':p_id'] = $id;
                $pqr = insert(PROD_ATTR_VALUE, $columns_p);
                $q = $this->dbConn->prepare($pqr);
                $q->execute($bind_p);
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            var_dump($exc);
        }
    }

    /**
     * This function returns list of files corresponding to given directory path
     * @param String $dataFolderPath
     * @return Array list of file
     */
    protected function getFileList($dataFolderPath) {
        if (!is_dir($dataFolderPath)) {
            throw new Exception("Directory " . $dataFolderPath . " is not exist");
        }
        $root = scandir($dataFolderPath);
        $fileList = array();
        foreach ($root as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_file("$dataFolderPath/$value")) {
                $fileList[] = "$dataFolderPath/$value";
                continue;
            }
        }
        return $fileList;
    }

    public function r_implode($array, $delim = "$") {
        $data = array();
        foreach ($array as $key => $val) {
            $dbK = strtolower(replace_space_underscore($key));
            if (is_array($val)) {
                if (count($val) > 1) {
                    foreach ($val as $k => $v) {
                        $data[$dbK] = implode($delim, array_filter($val, 'rempty'));
                    }
                } else {
                    foreach ($val as $k => $v) {
                        $data[$dbK] = $v;
                    }
                }
            }
        }

        return $data;
    }

    static public function remove_specialChar_spaces($value) {


        //Removing all spaces(in-between)
        $string_af = trim(preg_replace('/\s\s+/', '', $value));
        return $string_af;
    }

}
