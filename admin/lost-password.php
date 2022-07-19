<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");

    $tpl = file_get_contents("../" . VIEWS_FOLDER . "admin-lost-password.inc");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $conn = dbconnect();
            $sql = "SELECT * FROM " . ADMIN_TBL . " WHERE email=:email";
            $q = $conn->prepare($sql);
            $q->bindParam(':email', $_POST['email']);
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $row = $q->fetch();


            if ($q->rowCount() > 0) {
                $code = gen_id(15);
                $link = SITE_URL . ADMIN_FOLDER . 'change-pass?id=' . $code;
                $m = file_get_contents("../" . EMAILS_TPL_FOLDER . "reset-pass.txt");
                $msg = str_replace('{LINK}', $link, $m);
                $qry = "UPDATE " . ADMIN_TBL . "
                SET rcode='" . $code . "',
                 dateadded=now()
                        WHERE email=:email";
                $q = $conn->prepare($qry);
                $q->bindParam(':email', $_POST['email']);
                $q->execute();
                send_mail(SITE_EMAIL, 'Reset Password', $msg, 1, $_POST['email']);

            } else {

                echo str_replace(array('{JSPATH}', '{CSSPATH}', '{MSG}', '{ALRT_SUC}', '{PANEL}'), array(
                    SITE_URL . JS_FOLDER,
                    SITE_URL . CSS_FOLDER,
                    '<span class="text-danger">Account not found</span>',
                    'hidden',
                    ''
                ), $tpl);
                exit;
            }


            echo str_replace(array('{JSPATH}', '{CSSPATH}', '{MSG}', '{ALRT_SUC}', '{PANEL}'),
                array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, '', '', 'hidden'), $tpl);
            exit;
        } else {

            echo str_replace(array('{JSPATH}', '{CSSPATH}', '{MSG}', '{ALRT_SUC}', '{PANEL}'), array(
                SITE_URL . JS_FOLDER,
                SITE_URL . CSS_FOLDER,
                '<span class="text-danger">Invalid Email</span>',
                'hidden',
                ''
            ), $tpl);
        }
    } else {

        echo str_replace(array('{JSPATH}', '{CSSPATH}', '{MSG}', '{ALRT_SUC}', '{PANEL}'),
            array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, '', 'hidden', ''), $tpl);
    }


?>