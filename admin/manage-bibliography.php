<?php    
    require_once("../require.php");
    require_once("../" . INCLUDED_FILES . "config.inc.php");
    require_once("../" . INCLUDED_FILES . "dbConn.php");
    require_once("../" . INCLUDED_FILES . "functionsInc.php");
    check_auth_admin();
    $conn = dbconnect();
    if(isset($_REQUEST['catg']) && !empty($_REQUEST)){
        $subcategory_id = $_REQUEST['catg'];
    }
   
    try{
        $selectOptions = get_subCategory_options($conn);
        
        $sql = "SELECT * FROM " . PRODUCTS_TBL . " WHERE `category_id` = :categoryID AND `subcatid`= :subcatID ORDER by dateadded desc";
        $q = $conn->prepare($sql);
        $category_id = 1;
        $subcategory_id= (!empty($subcategory_id)) ? $subcategory_id : 5;
        $q->bindParam(':categoryID', $category_id, PDO::PARAM_INT);
        $q->bindParam(':subcatID', $subcategory_id, PDO::PARAM_INT);
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
                'count' => get_PDF_count_bibliography($row['prodid'],true),
                
                'pdfcount' => get_allPDF_count_bibliography($row['prodid'],true)
                
            );

        }
    } catch (PDOException $pe){
        echo db_error($pe->getMessage());
    }
    
    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'bibliograply-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
    