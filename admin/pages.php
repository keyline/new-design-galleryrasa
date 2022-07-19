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

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        array_walk_recursive($_POST, create_function('&$val', '$val = trim($val);'));
        $columns = array(
            'id'          => 'null',
            'page_name'   => ':page_name',
            'page_link'   => ':page_link',
            'page_content'=> ':page_content',
            'page_status' => ':page_status',
            'main_title'  => ':main_title',
        );
        $bind = array(
            ':page_name'   => $_POST['pagetitle'],
            ':main_title'  => $_POST['mainptitle'],
            ':page_link'   => $_POST['page_id'],
            ':page_content'=> $_POST['page_content'],
            ':page_status' => $_POST['page_status'],
        );

        try {
            if (isset($_POST['pid'])) {
                $columns['id'] = $_POST['pid'];
                $qry = update(PAGES_TBL, $columns, array('id'=> $_POST['pid']), true);
                $q = $conn->prepare($qry);

                $q->execute($bind);
            }
            else {
                $qry = insert(PAGES_TBL, $columns);
                $q   = $conn->prepare($qry);
                $q->execute($bind);
                $nid = $conn->lastInsertId();
            }
            if ($_POST['page_status'] == 0 && file_exists('../'.$_POST['page_status'].'.php')) unlink('../'.$_POST['page_status'].'.php');
            save_pages($conn);
            if (isset($_POST['rtn']) && !isset($_POST['pid']))
            goto_location('pages?id='.$nid);
            elseif (isset($_POST['rtn']) && isset($_POST['pid']))
            goto_location('pages?id='.$_POST['pid']);
            else
            goto_location('pages');

        } catch (PDOException $pe) {

            echo db_error($pe->getMessage());

        }


    } else {
        try {
            $sql   = "SELECT * FROM " . PAGES_TBL;
            $q     = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $count = $q->rowCount();
            $get_it= (isset($_GET['id'])) ? (true):(false);
            $page_id = $pname   = $ptitle  = $plink   = $ptxt    = $pstat   = null;
            $pages_list = array();
            if ($q->rowCount() > 0) {
                while ($rows = $q->fetch()) {
                    $pages_list[] = array(
                        'pg_id'     => $rows['id'],
                        'pg_name'   => $rows['page_name'],
                        'pg_link'   => $rows['page_link'],
                        'pg_content'=> $rows['page_content'],
                        'pg_status' =>  $rows['page_status'],
                    );
                    if ($get_it && $_GET['id'] == $rows['id']) {
                        $page_id = $rows['id'];
                        $pname   = stripslashes($rows['page_name']);
                        $ptitle  = stripslashes($rows['main_title']);
                        $plink   = stripslashes($rows['page_link']);
                        $ptxt    = htmlspecialchars($rows['page_content']);
                        $pstat   = $rows['page_status'];
                    }
                }
            }
        } catch (PDOException $pe) {

            echo db_error($pe->getMessage());

        }
        include(ADMIN_HTML . "admin-headerInc.php");
        include(ADMIN_HTML . "pages-tpl.php");
        include(ADMIN_HTML . "admin-footerInc.php");
    }

?>  