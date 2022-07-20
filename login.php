<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

$email = $_POST['email'];
$pass = $_POST['pass'];

if (isset($_POST['prevurl'])) {
    $prevurl = $_POST['prevurl'];
} else {
    $prevurl = '';
}

if (check_valid_customerlogin($email, $pass)) {
    //check_valid_customerlogin($email, $pass);
    $cust_data = get_user_data($email);

    $_SESSION['user-email'] = $email;
    $_SESSION['user-id'] = $cust_data['id'];
    $cust_id = $_SESSION['user-id'];
    $_SESSION['user-name'] = $cust_data['fname'] . ' ' . $cust_data['lname'];

    if (isset($_SESSION["cart_item"])) {

        foreach ($_SESSION["cart_item"] as $item) {
            $product_id = $item['product_id'];
            $product_name = $item['product_name'];
            $image_id = $item['image_id'];
            $image_name = $item['image_name'];
            $quantity = $item['quantity'];
            $imagetype = $item['imagetype'];
            $type = (!empty($item['type'])) ? $item['type'] : "";
            $size = (!empty($item['size'])) ? $item['size'] : "";
            $price = $item['price'];
            $taxable = $item['taxable'];
            $date = date("Y-m-d H:i:s");

//            $columns = array(
//                'id' => "'" . "'",
//                'customer_id' => "'" . $cust_id . "'",
//                'product_id' => "'" . $product_id . "'",
//                'image_id' => "'" . $image_id . "'",
//                'quantity' => "'" . $quantity . "'",
//                'imagetype' => "'" . $imagetype . "'",
//                'type' => "'" . $type . "'",
//                'size' => "'" . $size . "'",
//                'price' => "'" . $price . "'",
//                'date' => "'" . $date . "'",
//            );
            $columns = array(
                'id' => 'null',
                'customer_id' => ':custID',
                'product_id' => ':prodID',
                'image_id' => ':imageID',
                'quantity' => ':quan',
                'imagetype' => ':imageT',
                'type' => ':typeDesc',
                'size' => ':sizeDesc',
                'price' => ':priceProd',
                'taxable' => ':taxable',
                'date' => 'now()'
            );

            $bind = array(
                ':custID' => $cust_id,
                ':prodID' => $product_id,
                ':imageID' => $image_id,
                ':quan' => $quantity,
                ':imageT' => $imagetype,
                ':typeDesc' => $type,
                ':sizeDesc' => $size,
                ':priceProd' => $price,
                ':taxable' => $taxable
            );

            try {
                $pqr = insert(PROD_CART, $columns);
//exit;
                $q = $conn->prepare($pqr);
                $q->execute($bind);
                // echo PdoDebugger::show($pqr, $bind);
            } catch (PDOException $pe) {
                $err = true;
                echo $er = db_error($pe->getMessage());
            }
        }

        unset($_SESSION["cart_item"]);
        goto_location(SITE_URL . '/cart-checkout/cart.php');
    } else {

        if ($prevurl == '') {
            goto_location(SITE_URL . '/index.php');
        }else if(strpos($prevurl, 'visualarchive') !== false){
            goto_location(SITE_URL . '/visualarchive-search');
        }else if(strpos($prevurl, 'memorabilia') !== false){
            goto_location(SITE_URL . '/memorabilia-search');
        }else if(strpos($prevurl, 'beforeSearch') !== false){
            goto_location(SITE_URL . '/beforeSearch');
        }else if(strpos($prevurl, 'galleryrasa.com/search') !== false){
            goto_location(SITE_URL . '/beforeSearch');
        }else if(strpos($prevurl, 'galleryrasa.com/details/') !== false){
            goto_location(SITE_URL . '/beforeSearch');
        }else{
          goto_location(SITE_URL . '/index.php');  
        }
    }
} else {
    $_SESSION['login-error'] = "Wrong Email or Password";
    goto_location(SITE_URL . '/login-register.php');
}