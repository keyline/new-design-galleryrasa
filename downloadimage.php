<?php

try {
    //code...

    session_start();
    require_once("require.php");
    require_once(INCLUDED_FILES . "config.inc.php");
    require_once(INCLUDED_FILES . "dbConn.php");


    if (!empty($_REQUEST['item'])) {
        //get image name from $_REQUEST param
        $conn = dbconnect();

        $item= $_REQUEST['item'];

        $stmt = $conn->prepare(
            "SELECT `photo` as `imageName` FROM exhibition WHERE id=:exhibitionIdVar"
        );

        $stmt->bindParam(':exhibitionIdVar', $item, PDO::PARAM_INT);

        $stmt->execute();

        if (! $stmt->rowCount()) {
            throw new Exception("File not found", 1);
        }

        $filename = $stmt->fetchColumn();
        $temp= explode('.', $filename);
        $extension= end($temp);
        $filename = base64_encode($temp[0]) . '.' . $extension;
        $filepath= $_REQUEST['catg'] . '/' . $filename;


        // Process download
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    } else {
        throw new Exception("Error Processing Request", 1);
    }
} catch (\Exception $ex) {
    //throw $th;
    echo $ex->getMessage();
}
