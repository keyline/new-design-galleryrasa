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
if (!$conn) {
    die("PDO Connection error");
} elseif (isset($_POST) && !empty($_POST['category'])) {
    $postName = "file";
    $path = __DIR__ . '\\uploads\\';
    $handleUpload = new Upload($postName, $path);

    if (isset($handleUpload) && is_object($handleUpload)) {
        $filePath_Name = $handleUpload->n_upload_dir;
    } else {
        echo "File Upload error";
    }
    foreach ($handleUpload->result AS $result) {
        $filePath_Name.= $result;
    }
//STEP:2 Now Reading the File 
    $handleExcelReader = new Excelreader($conn, 19, NULL);
    $sheetData = $handleExcelReader->readFileAndDumpInDB($filePath_Name, 10);
    //var_dump($sheetData);
//$dbF = get_all_inputtype_fields();
}  else {
    echo "Invalid Operation";
}
?>