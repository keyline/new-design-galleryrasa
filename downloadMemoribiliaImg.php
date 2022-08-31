<?php
if(!empty($_GET['file'])){
    $filename = basename($_GET['file']);
    $filename = 'images/'.$filename;
    // echo $filename;
    if(!empty($filename)&& file_exists($filepath)){
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding:binery");
        readfile($filepath);
        exit();
    }
    else{
        echo "This file Does not exist";
    }
}
?>