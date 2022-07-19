<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        array_walk_recursive($_POST, create_function('&$val', '$val = trim($val);'));
        $jpegname=$img='';
      if(preg_match("/src=[\"']([^\"']+\.jpg)/", $_POST['page_content'], $jpeg))
     $jpegname = basename($jpeg[1]);
        
        if($jpegname!='')  {
        	create_thumb('../'.SITE_IMGS.$jpegname, '../'.BLOG_IMGS_THUMBS . $jpegname, 600, 400,95);
        	if(file_exists('../'.BLOG_IMGS_THUMBS .$jpegname)) $img=$jpegname;
        	}

        $columns = array(
            'cid'          => 'null',
            'title'   => ':title',
            'detail'  => ':content',
            'thumb'  => ':img',
            'status' => ':page_status',
            'author' => ':author',
 
        );
    
         $bind = array(
            ':title'   => $_POST['title'],
            ':content'  => $_POST['page_content'],
            ':img'   => $img,
            ':page_status' => $_POST['page_status'],
            ':author' => $_POST['author'],
        );
        
         if (isset($_POST["ftr"])) {
             $columns['feature'] = 'now()';
        }
   

        try {
            if (isset($_POST['pid'])) {
                $columns['cid'] = $_POST['pid'];
              $qry = update(CMS_TBL, $columns, array('cid'=> $_POST['pid']), true);
                $q = $conn->prepare($qry);
                $q->execute($bind);
            }
            else {
            	  $columns['postdate']='now()';
            	  $columns['feature']='now()';
                $qry = insert(CMS_TBL, $columns);
                $q   = $conn->prepare($qry);
                $q->execute($bind);
                $nid = $conn->lastInsertId();
                 
            }
         save_latest_blog($conn);
            if (isset($_POST['rtn']) && !isset($_POST['pid']))
            goto_location('cms?id='.$nid);
            elseif (isset($_POST['rtn']) && isset($_POST['pid']))
            goto_location('cms?id='.$_POST['pid']);
            else
            goto_location('pages');

        } catch (PDOException $pe) {

            echo db_error($pe->getMessage());

        }


    } else {
        try {
           $sql   = "SELECT * FROM " . CMS_TBL. " ORDER BY postdate desc LIMIT 15";
            $q     = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $count = $q->rowCount();
            $get_it= (isset($_GET['id'])) ? (true):(false);
            $page_id = $author= $pdate=$pname =$ldate =  $hits =$lvdate=$feature = $ptitle  = $plink   = $ptxt    = $pstat   = null;
            $pages_list = array();
            if ($q->rowCount() > 0) {
                while ($rows = $q->fetch()) {
                    $pages_list[] = array(
                        'cid'     => $rows['cid'],
                        'title'   => $rows['title'],
                    );
                    if ($get_it && $_GET['id'] == $rows['cid']) {
                        $page_id = $rows['cid'];
                        $ptitle  = stripslashes($rows['title']);
                        $ptxt    = htmlspecialchars($rows['detail']);
                        $pstat   = $rows['status'];
                        $pdate     = $rows['postdate'];
                        $ldate   = $rows['lastedit'];
                        $lvdate     = $rows['lastviewdate'];
                        $hits   = $rows['views'];
                        $feature   = $rows['feature'];
                        $author   = stripslashes($rows['author']);
                    }
                }
            }
        } catch (PDOException $pe) {

            echo db_error($pe->getMessage());

        }
        include(ADMIN_HTML . "admin-headerInc.php");
        include(ADMIN_HTML . "cms-tpl.php");
        include(ADMIN_HTML . "admin-footerInc.php");
    }

?>  