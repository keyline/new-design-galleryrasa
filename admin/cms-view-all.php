<?php
/* Project Name: e-Com Cart
 * Author: LobisDev
 * Author URI: http://www.lobisdev.one/ecom-cart
 * Author e-mail: admin@lobisdev.one
 * Created: Nov 2015
 * License: http://codecanyon.net/
 */

    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();

    try {
        $sql   = "SELECT * FROM " . CMS_TBL . " ORDER by postdate desc";
        $q     = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        $sql2  = '';
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $pages = pagination($_GET['page'], $count, PER_PAGE, 'cms-view-all?', 0);
        $sql2 .= $sql . " LIMIT  " . $pages['qstart'] . "," . PER_PAGE;
        $q     = $conn->query($sql2);

        $q->setFetchMode(PDO::FETCH_ASSOC);
        $items = $p     = '';
        while ($row = $q->fetch()) {
            $status       = $row['status'] == 1 ? (' checked') : ('');
            $img          = $row['thumb'] != '' ? ('<img src="product-img.php?t=3&img=' . $row['thumb'] . '" />') : ('');
            $article_list[] = array(
                'status'      => $status,
                'cid'      => $row['cid'],
                'img'         => $img,
                'name'        => substr(stripslashes($row['title']), 0, 80),
                'pdate'       => $row['postdate'],
                'views'       => number_format($row['views']),
                'edit'    => clean_link($row['title']),
          
            );
        }

    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'cms-view-all-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");


?>