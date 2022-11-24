<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Class/config.inc.php';
require_once __DIR__ . '/Class/db_config.php';
require_once __DIR__ . '/Class/Excelreader.php';
require_once __DIR__ . '/Class/ChunkReadFilter.php';
require_once __DIR__ . '/Class/Upload.php';
require_once __DIR__ . '/Class/functionsInc.php';
require_once __DIR__ . '/Class/pdo-debug.php';


//Checking Database Connection
$conn = dbconnect();
if(!$conn)
{
    die("PDO Connection error");
}

$postName = "file";
$path = __DIR__ . '\\uploads\\';
$handleUpload = new Upload($postName, $path);

if(isset($handleUpload) && is_object($handleUpload))
    {
        $filePath_Name = $handleUpload->n_upload_dir;
		
		/*	Getting Category input	*/
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
                case 'Catalogue Solo':
                                $sub=9;
                                $parent=1;
                                $ass= 'title_of_article';
                                break;
                case 'Catalogue Group':
                                $sub=16;
                                $parent=1;
                                $ass='title_of_article';
                                break;
                case 'Catalogue Annual':
                                $sub=18;
                                $parent=1;
                                $ass= 'title_of_article';
                                break;
                default:
                    exit(0);
                                


                }
    }else{
		die("Caegory Doesn\'t match");
	}
        
    }else
    {
        echo "File Upload error";
    }
    foreach ($handleUpload->result AS $result)
    {
        $filePath_Name.= $result;
    }
//STEP:2 Now Reading the File 
$handleExcelReader = new Excelreader($conn, $parent_category, $sub, $parent, $ass);
$sheetData =$handleExcelReader->readFileAndDumpInDB($filePath_Name, 10);
//$dbF = get_all_inputtype_fields();


?>