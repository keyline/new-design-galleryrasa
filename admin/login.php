<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");

if (CREATE_ADMIN_ACCOUNT) {
    if (!no_admin_exist()) {
        goto_location('new-account');
        exit;
    }
}
$username = isset($_POST['username']) ? (trim($_POST['username'])) : (null);
$pass = isset($_POST['passwd']) ? (trim($_POST['passwd'])) : (null);
if ($username != null && $pass != null) {
    $conn = dbconnect();

    $q = $conn->prepare("SELECT * FROM " . ADMIN_TBL . "
	            				 WHERE user=:usr");
    $q->bindParam(':usr', $username);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);

    if ($q->rowCount() > 0) {
        $row = $q->fetch();
        $pass_hash = crypt($pass, PASSWRD_SALT);
        // $pass_hash = md5($pass);
        if (strcasecmp($pass_hash, $row['pass']) == 0) {
            $_SESSION['valid_admin'] = $row['user'];
            ### Clear Older Basket
            //$qry="DELETE FROM " . SHOPPING_BASKET_TBL . " WHERE TO_DAYS(NOW()) - TO_DAYS(dateadded) >= 31";
            //$q     = $conn->query($qry);
              ######
            goto_location('dashboard');
            exit;
        } else {
            $tpl = file_get_contents("../" . VIEWS_FOLDER . "admin-login.inc.php");
            echo str_replace(array('{CSSPATH}', '{MSG}'),
                array(SITE_URL . OLD_CSS_FOLDER, '<span class="text-danger"> Invalid/Username/Passward</span>'), $tpl);
            exit;
        }

       
    } else {
        $tpl = file_get_contents("../" . VIEWS_FOLDER . "admin-login.inc.php");
        echo str_replace(array('{CSSPATH}', '{MSG}'), array(SITE_URL . OLD_CSS_FOLDER, '<p> Account not found</p>'), $tpl);
        exit;
    }


} else {
    $tpl = file_get_contents("../" . VIEWS_FOLDER . "admin-login.inc.php");
    echo str_replace(array('{CSSPATH}', '{MSG}'), array(SITE_URL .OLD_CSS_FOLDER, ''), $tpl);
}


?>