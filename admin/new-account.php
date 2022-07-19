<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");

    $tpl = file_get_contents("../" . VIEWS_FOLDER . "new-admin-account.inc");
    try {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (CREATE_ADMIN_ACCOUNT) {
                if (no_admin_exist()) {
                    echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_RQ}', '{ALRT_SUC}', '{ALRT_ERR}', '{PANEL}'),
                        array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, 'hidden', 'hidden', '', 'hidden'), $tpl);
                    exit;
                }
            }

            array_walk_recursive($_POST, create_function('&$val', '$val = trim($val);'));
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
                && !empty($_POST['userid'])
                && !empty($_POST['passwd'])
            ) {
                $conn = dbconnect();
                $qry = insert(ADMIN_TBL,
                    array('user' => ':usr', 'pass' => ':pass', 'email' => ':email', 'dateadded' => 'now()'));
                $hash = crypt($_POST['passwd'], PASSWRD_SALT);
                $bind = array(':usr' => $_POST['userid'], ':pass' => $hash, ':email' => $_POST['email']);
                $q = $conn->prepare($qry);
                $q->execute($bind);
                echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_RQ}', '{ALRT_SUC}', '{ALRT_ERR}', '{PANEL}'),
                    array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, 'hidden', '', 'hidden', 'hidden'), $tpl);
            } else {

                echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_RQ}', '{ALRT_SUC}', '{ALRT_ERR}', '{PANEL}'),
                    array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, '', 'hidden', 'hidden', ''), $tpl);
                exit;
            }


        } else {

            echo str_replace(array('{JSPATH}', '{CSSPATH}', '{ALRT_RQ}', '{ALRT_SUC}', '{ALRT_ERR}', '{PANEL}'),
                array(SITE_URL . JS_FOLDER, SITE_URL . CSS_FOLDER, 'hidden', 'hidden', 'hidden', ''), $tpl);
        }

    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
        exit;
    }
?>