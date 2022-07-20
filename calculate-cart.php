<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");   
        
        
$conn = dbconnect();
if (isset($_POST)) {
    

    $_SESSION['cart_product_id'] = $_POST['product_id'];
    $_SESSION['cart_image_id'] = $_POST['image_id'];
    $_SESSION['cart_price'] = $_POST['price'];
    //if (isset($_POST['size'])) {
    $_SESSION['cart_size'] = $_POST['size'];


    $qry1 = "SELECT prodname from products_ecomc where prodid ='" . $_POST['product_id'] . "'";
    $q1 = $conn->prepare($qry1);
    $q1->execute();
    $q1->setFetchMode(PDO::FETCH_ASSOC);
    $row1 = $q1->fetch();
    $product_name = $row1['prodname'];

    $qry2 = "SELECT m_image_name from memorabilia_images where m_image_id ='" . $_POST['image_id'] . "'";
    $q2 = $conn->prepare($qry2);
    $q2->execute();
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    $row2 = $q2->fetchAll();
//    print '<pre>';
//    print_r($row2);
    if (isset($_SESSION["cart_item"])) {
        $tmp = end($_SESSION["cart_item"]);
        $last_count = $tmp['count'];
        $count_cart = $last_count + 1;
        settype($count_cart, "string");
    } else {
        $count_cart = 1;
        settype($count_cart, "string");
    }
    $image_name = $row2[0]['m_image_name'];

    $image_name_new = $count_cart . '_' . $image_name;


    //$itemArray =  array($row2[0]['m_image_name'] => array('product_id' => $_POST['product_id'], 'product_name' => $product_name, 'image_id' => $_POST['image_id'], 'image_name' => $image_name, 'quantity' => '1', 'size' => $_POST['size'], 'price' => $_POST['price']));

    $itemArray = array($image_name_new => array('count' => $image_name_new, 'product_id' => $_POST['product_id'], 'product_name' => $product_name, 'image_id' => $_POST['image_id'], 'image_name' => $image_name, 'quantity' => '1', 'type' => $_POST['type'], 'size' => $_POST['size'], 'price' => $_POST['price']));

//        print '<pre>';
//        var_dump($itemArray);
//        exit;

    if (!empty($_SESSION["cart_item"])) {
//            print '<pre>';
//            var_dump($itemArray);
//        exit;

        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);

        var_dump($_SESSION["cart_item"]);
    } else {
        $_SESSION["cart_item"] = $itemArray;
    }

    goto_location('cart.php');
}
 