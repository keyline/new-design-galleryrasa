<?php

try {
    //code...

    session_start();
    require_once("require.php");
    require_once(INCLUDED_FILES . "config.inc.php");
    require_once(INCLUDED_FILES . "dbConn.php");


    //get image name from $_REQUEST param
    $conn = dbconnect();

    $item= $_REQUEST['item'];


    if (isset($_REQUEST['catg']) && $_REQUEST['catg'] === 'painting') {
        if (!empty($_REQUEST['item'])) {
            //Query
            $stmt= $conn->prepare(
                "SELECT `s`.`image` as `imageName` FROM `exhibition_paintings` `s` WHERE `s`.`id`=:paintingIdVar"
            );

            $stmt->bindParam(':paintingIdVar', $item, PDO::PARAM_INT);

            $stmt->execute();

            if (! $stmt->rowCount()) {
                throw new Exception("File not found", 1);
            }


            $filename = $stmt->fetchColumn();
            $temp= explode('.', $filename);
            $extension= end($temp);
            $filename = base64_encode($temp[0]) . '.' . $extension;
            $filepath= 'exhibition' . '/' . $filename;
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    } elseif (isset($_REQUEST['catg']) && $_REQUEST['catg'] === 'exhibition') {
        # code...

        if (!empty($_REQUEST['item'])) {
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
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    } else {
        throw new Exception("Download category does not match", 1);
    }

    downloadFile($filepath);
} catch (\Exception $ex) {
    //throw $th;
    echo $ex->getMessage();
}

function downloadFile($filepath="")
{
    try {
        //code...

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
    } catch (\Throwable $th) {
        throw $th;
    }
}
