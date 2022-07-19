<?php
/* Project Name: Rasa Gallery
 * Author: Keyline
 * Author URI: http://www.keylines.net/
 * Author e-mail: info@keylines.net
 * Created: OCT 2017
 * License: http://keylines.net/
 */


    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();
    
     if(isset($_POST['feature'])) {
		foreach($_POST['feature'] as $mid)
		{
		 $items[]= $mid;
		
		}
	      
	       if(file_exists('../'.INC_FOLDER . CACHE_FILE .'fids.txt')){
	       	$file=file_get_contents('../'.INC_FOLDER . CACHE_FILE .'fids.txt');
	   	  if(trim($file!='')){
		  $id = explode(",",$file);
	   	  $f=array_merge ($id,$items);
	   	  $ff=array_unique($f);
	   	  $itms = join(',', $ff);
	   	 	
		 }
	   	  
	   }
	   else {
	 	$itms = join(',', $items);
	 }
		goto_location('featured_items?id='.$itms);
              exit;
}
          
        try {
        $sql   = "SELECT * FROM " . PRODUCTS_TBL . " ORDER by dateadded desc";
        $q     = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        $sql2  = '';
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $pages = pagination($_GET['page'], $count, PER_PAGE, 'index?', 0);
        $sql2 .= $sql . " LIMIT  " . $pages['qstart'] . "," . PER_PAGE;
        $q     = $conn->query($sql2);

        $q->setFetchMode(PDO::FETCH_ASSOC);
        $items = $p     = '';
        while ($row = $q->fetch()) {
            $status       = $row['status'] == 1 ? (' checked') : ('');
            $stock_status = $row['stock_status'] == 1 ? (' checked') : ('');
            $img          = $row['img1'] != '' ? ('<img src="product-img.php?img=' . $row['img1'] . '" />') : ('');
            $product_list[] = array(
                'status'      => $status,
                'prodid'      => $row['prodid'],
                'img'         => $img,
                'name'        => substr(stripslashes($row['prodname']), 0, 50),
                'price'       => CURRENCY_CODE . number_format($row['price']),
                'views'       => number_format($row['views']),
                'discount'    => $row['discount'],
                'lnk_name'    => clean_link($row['prodname']),
                'stock_status'=> $stock_status,
                'stockt' => $row['stocktotal'],
            );

        }

    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'products-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");

