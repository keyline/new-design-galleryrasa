<?php    
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        print "<pre>";
        print_r($_REQUEST);
    }else{
    try{
        $sql = "SELECT * FROM " . PRODUCTS_TBL . " WHERE `category_id` = :categoryID ORDER by dateadded desc";
        $q = $conn->prepare($sql);
        $category_id = 2;
        $q->bindParam(':categoryID', $category_id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
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
                'count' => get_poster_count_memoribilia($row['prodid'], true) . " / " .  get_synopsis_count_memoribilia($row['prodid'], true) ." / " .get_card_count_memoribilia($row['prodid'], true) 
            );

        }
    } catch (PDOException $pe){
        echo db_error($pe->getMessage());
    }
    
    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'memorabilia-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
    }