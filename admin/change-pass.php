<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");

$tpl = file_get_contents("../" . VIEWS_FOLDER . "admin-reset-password.inc");
$conn = dbconnect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $qry = "UPDATE " . ADMIN_TBL;
        $qry .= " SET pass=:pass WHERE rcode=:id ";
        $q = $conn->prepare($qry);
        $hash = crypt($_POST['npasswd'], PASSWRD_SALT);
        $q->bindParam(':pass', $hash);
        $q->bindParam(':id', $_GET['id']);
        $q->execute();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
        exit;
    }

    echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_EXP}', '{ALRT_SUC}', '{PANEL}'),
        array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, 'hidden', '', 'hidden'), $tpl);


} else {
    try {
        $sql = "SELECT *, TIME_FORMAT(TIMEDIFF(NOW(), dateadded), '%H') as t FROM " . ADMIN_TBL . " WHERE rcode=:id";
        $q = $conn->prepare($sql);
        $q->bindParam(':id', $_GET['id']);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q->fetch();
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
        exit;
    }

    if ($q->rowCount() == 0 || $row['t'] > 24) {
        echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_EXP}', '{ALRT_SUC}', '{PANEL}'),
            array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, '', 'hidden', 'hidden'), $tpl);
    } else {

        echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_EXP}', '{ALRT_SUC}', '{PANEL}'),
            array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, 'hidden', 'hidden', ''), $tpl);
    }


}

?>