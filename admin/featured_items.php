<?php
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['delete'])) {
            if (file_exists('../'.INC_FOLDER . CACHE_FILE .'fjson.txt')) unlink('../'.INC_FOLDER . CACHE_FILE .'fjson.txt');
            if (file_exists('../'.INC_FOLDER . CACHE_FILE .'fhtml.txt')) unlink('../'.INC_FOLDER . CACHE_FILE .'fhtml.txt');
            if (file_exists('../'.INC_FOLDER . CACHE_FILE .'fids.txt')) unlink('../'.INC_FOLDER . CACHE_FILE .'fids.txt');

            $d = opendir ('../'.FEATURED_ITEMS);
            while (false !== ($file = readdir($d))) {
                if ($file == ".." || $file == ".")
                continue;
                unlink('../'.FEATURED_ITEMS."/".$file);

            }

            closedir ($d);
            goto_location('index');
            exit;
        }


        if (!is_dir('../'.FEATURED_ITEMS)) {
            $old_musk = umask(0);
            mkdir('../'.FEATURED_ITEMS , 0755);
            umask($old_musk);
        }

        $f_file = null;
        try {
            $tpl=file_get_contents(ADMIN_HTML . "featured-list-tpl.php"); 
            foreach ($_POST['img-select'] as $k =>$v) {

                $featured_cache[$_POST['pid'][$k]]['title'] = $_POST['title'][$k];
                $featured_cache[$_POST['pid'][$k]]['pid'] = $_POST['pid'][$k];
                $featured_cache[$_POST['pid'][$k]]['img'] = $_POST['img-select'][$k];
                $sql = "SELECT
                exp_time, price, discount, timer_stat,
                date_format(exp_time, '%M %e, %Y %H:%i:%s') as exptime
                FROM
                " . PRODUCTS_TBL . "
                WHERE
                " . PRODUCTS_TBL . ".prodid='".(int) $_POST['pid'][$k]."'";
                $q           = $conn->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $row         = $q->fetch();
                $timer = ($row['exp_time'] != '0000-00-00 00:00:00')
                ? ('<span class="onsale item-price"></span>
 			<div id="timings" data-index="'.$_POST['pid'][$k].'" data-time="'.$row['exptime'].'">                
   			<div id="timer" class="timer'.$_POST['pid'][$k].'" style="font-size:16px;"></div><br />
    			</div>') :('');

                if (!file_exists('../'.FEATURED_ITEMS.'/'.$_POST['img-select'][$k])) {
                    create_thumb('../' . IMGSRC . $_POST['img-select'][$k], '../'.FEATURED_ITEMS.'/'.$_POST['img-select'][$k], 200, 260, 95);
                }
          
		if ($row['discount'] > 0) {
	        $with_discount = product_discount($row['price'], $row['discount']);
	        $discount_percentage = $row['discount'];
	        $price = '<span class="badge label-danger item-title">' . CURRENCY_CODE .  number_format	($with_discount, 2) . '</span>';
	        $price .= ' &nbsp;  <span class="original_price text-muted"><s>' . CURRENCY_CODE .  number_format	($row['price'],2) . '</s></span><br />';
	   	 } else {
	        $discount_percentage = 0;
	        $price = '<span class="badge label-danger item-title">' . CURRENCY_CODE . number_format	($row['price'],2). '</span> <br />';
	    }
	                 
       $replace = array(
	       '{TIMER}',
	       '{URL}',
	       '{IMG}',
	       '{TITLE}',
	       '{PRICE}');
        $search = array(
	          $timer,
	          SITE_URL . '/pdetails/' . $_POST['pid'][$k]. '/' . clean_link($_POST['title'][$k]),
	         FEATURED_ITEMS.'/'.$_POST['img-select'][$k],
	         stripslashes($_POST['title'][$k]),
	         $price
        );
               $f_file.= str_replace($replace, $search,$tpl);   
            }
        
            $cache = json_encode($featured_cache);
            cachefile('../'.INC_FOLDER . CACHE_FILE .'fjson.txt', $cache);
            cachefile('../'.INC_FOLDER . CACHE_FILE .'fhtml.txt', TOP_DEALS_TILE.'<div class="row">'.$f_file.'</div>');

        } catch (PDOException $pe) {
            echo db_error($pe->getMessage());
        }

        goto_location('featured_items?id='.$_POST['url']);
        exit;
    }
    else {
        if (!isset($_GET['id'])) {
            if (file_exists('../'.INC_FOLDER . CACHE_FILE .'fids.txt'))
            $id = file_get_contents('../'.INC_FOLDER . CACHE_FILE .'fids.txt');
            if(trim($id)=='')
            goto_location('index');
            else goto_location('featured_items?id='.$id);
            exit;
        }

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id       = explode(",",$_GET['id']);
            $img_list = array();
            $list = array();
            $cache_exists = false;

            if (file_exists('../'.INC_FOLDER . CACHE_FILE .'fjson.txt')) {
                $cache_exists = true;
                $file = file_get_contents('../'.INC_FOLDER . CACHE_FILE .'fjson.txt');
                $cache= json_decode($file, true);
            }
            try {
                $i = 0;
                foreach ($id as $pid) {
                    $sql = "SELECT
                    " . PRODUCTS_TBL . ".prodid,
                    " . PRODUCTS_TBL . ".prodname,
                    " . PRODUCTS_TBL . ".img1,
                    " . IMAGES_TBL . ".*
                    FROM
                    " . PRODUCTS_TBL . "
                    LEFT OUTER JOIN
                    " . IMAGES_TBL . " ON " . PRODUCTS_TBL . ".prodid=" . IMAGES_TBL . ".prodid
                    WHERE
                    " . PRODUCTS_TBL . ".prodid='".(int) $pid."'
                    AND " . PRODUCTS_TBL . ".img1!=''";


                    $q    = $conn->query($sql);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    $imgs = null;
                    $c = 0;
                    while ($row = $q->fetch()) {
                        $img_list[] = $pid.'|'.$row['img_name'];
                        if ($c == 0) {
                            $keep_id[] = $pid;
                            $title = $row['prodname'];
                            $cimg  = '';
                            if ($cache_exists) {
                                if (isset($cache[$pid]['pid'])) $title = $cache[$pid]['title'];
                                if (isset($cache[$pid]['img'])) $cimg = $cache[$pid]['img'];
                            }
                            $list[] = array(
                                'title' => substr(stripslashes($title), 0, 50),
                                'prodid'=> $pid,
                                'img'   => $row['img1'],
                                'cimg'  => $cimg
                            );
                            $i++;
                        }

                        $c++;

                    }
                    if ( $i == 3) break;
                }
                if (count($keep_id > 0)) {
                    $itms = join(',', $keep_id);
                    cachefile('../'.INC_FOLDER . CACHE_FILE .'fids.txt', $itms);
                }

            } catch (PDOException $pe) {
                echo db_error($pe->getMessage());
            }
        }

    }
    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'featured-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");


    ?>