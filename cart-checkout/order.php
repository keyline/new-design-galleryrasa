<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . PAYU_FILES . "PayUMoney.php");

$conn = dbconnect();
$cust_id = $_SESSION['user-id'];

// print_r($_POST);
// die;


if (!isset($_SESSION['bill_addr_exist'])) {

    

    $street_address = $_SESSION["bill_address"]['street_address'];
    $city = $_SESSION["bill_address"]['city'];
    $state = $_SESSION["bill_address"]['state'];
    $country = $_SESSION["bill_address"]['country'];
    $zip = $_SESSION["bill_address"]['zip'];
    $landmark = $_SESSION["bill_address"]['landmark'];

    $qry1 = "insert into customer_address(id,customer_id,name,phone,street_address,city,state,country,zip,landmark,parent_id) "
            . "values('','$cust_id','','','$street_address','$city','$state','$country','$zip','$landmark','0')";

    $q1 = $conn->prepare($qry1);
    $q1->execute();

    $bill_par_id = get_last_user_addr($cust_id);
    $ship_address_id = $bill_par_id['id'];
    if (isset($_SESSION["ship_address"])) {
        $filter_ship_array = array_filter($_SESSION["ship_address"]);

        if (!empty($filter_ship_array)) {
//            var_dump($_SESSION["ship_address"]);
//exit;
            $bill_par = get_last_user_addr($cust_id);
            $bill_addr_id = $bill_par['id'];

            $ship_cust_name = $_SESSION["ship_address"]['ship_cust_name'];
            $ship_cust_phone = $_SESSION["ship_address"]['ship_cust_phone'];
            $ship_street_address = $_SESSION["ship_address"]['ship_street_address'];
            $ship_city = $_SESSION["ship_address"]['ship_city'];
            $ship_state = $_SESSION["ship_address"]['ship_state'];
            $ship_country = $_SESSION["ship_address"]['ship_country'];
            $ship_zip = $_SESSION["ship_address"]['ship_zip'];
            $ship_landmark = $_SESSION["ship_address"]['ship_landmark'];

            $qry2 = "insert into customer_address(id,customer_id,name,phone,street_address,city,state,country,zip,landmark,parent_id) "
                    . "values('','$cust_id','$ship_cust_name','$ship_cust_phone',$ship_street_address','$ship_city','$ship_state','$ship_country','$ship_zip','$ship_landmark','$bill_addr_id')";

            $q2 = $conn->prepare($qry2);
            $q2->execute();

            $ship_id_arr = get_cur_ship_addr($cust_id);

            $ship_address_id = $ship_id_arr['max_id'];
        }
    }
//    echo $ship_address_id;
//    exit;
} else {

    $street_address = $_SESSION["bill_address"]['street_address'];
    $city = $_SESSION["bill_address"]['city'];
    $state = $_SESSION["bill_address"]['state'];
    $country = $_SESSION["bill_address"]['country'];
    $zip = $_SESSION["bill_address"]['zip'];
    $landmark = $_SESSION["bill_address"]['landmark'];

    $qry1 = "update customer_address set street_address = '$street_address',city = '$city',state = '$state' ,country = '$country',zip = '$zip',landmark = '$landmark' "
            . "where customer_id = '$cust_id' and parent_id = '0'";
    $q1 = $conn->prepare($qry1);
    $q1->execute();

    $bill_par_id = get_last_user_addr($cust_id);
    $ship_address_id = $bill_par_id['id'];
    if (isset($_SESSION["ship_address"])) {
        if (!isset($_SESSION['sel_old_addr'])) {
            //$cust_addr = $_SESSION['sel_old_addr'];
            //$addr_array = get_user_addr($cust_addr);
            //$ship_street_address = $addr_array['street_address'];

            $filter_ship_array = array_filter($_SESSION["ship_address"]);
            if (!empty($filter_ship_array)) {

                $bill_par = get_last_user_addr($cust_id);
                $bill_addr_id = $bill_par['id'];

                $ship_cust_name = $_SESSION["ship_address"]['ship_cust_name'];
                $ship_cust_phone = $_SESSION["ship_address"]['ship_cust_phone'];
                $ship_street_address = $_SESSION["ship_address"]['ship_street_address'];
                $ship_city = $_SESSION["ship_address"]['ship_city'];
                $ship_state = $_SESSION["ship_address"]['ship_state'];
                $ship_country = $_SESSION["ship_address"]['ship_country'];
                $ship_zip = $_SESSION["ship_address"]['ship_zip'];
                $ship_landmark = $_SESSION["ship_address"]['ship_landmark'];

                $qry2 = "insert into customer_address(id,customer_id,name,phone,street_address,city,state,country,zip,landmark,parent_id) "
                        . "values('','$cust_id','$ship_cust_name','$ship_cust_phone','$ship_street_address','$ship_city','$ship_state','$ship_country','$ship_zip','$ship_landmark','$bill_addr_id')";
                $q2 = $conn->prepare($qry2);
                $q2->execute();
                $ship_id_arr = get_cur_ship_addr($cust_id);

                $ship_address_id = $ship_id_arr['max_id'];
            }
        } else {
            $ship_address_id = $_SESSION['sel_old_addr'];
        }
    }
}

$order_note = $_POST['order_note'];
$gateway_id = $_POST['gateway'];
//$total_price = $_SESSION['tot_price'];
$order_date = date("Y-m-d H:i:s");

$date_for_id = strtotime(date("Y-m-d"));

if (isset($_SESSION['tax_percentage'])) {
    $tax_percentage = $_SESSION['tax_percentage'];
    //$tax_amount = $_SESSION['tax_amount'];
} else {
    $tax_percentage = '';
    //$tax_amount = '';
}

//taxable


$qry_sh_addr = "SELECT * from customer_address where id = '$ship_address_id'";
$q_sh_addr = $conn->prepare($qry_sh_addr);
$q_sh_addr->execute();
$q_sh_addr->setFetchMode(PDO::FETCH_ASSOC);
$row_sh_addr = $q_sh_addr->fetch();
$parent_id = $row_sh_addr['parent_id'];
if($parent_id == 0){
$billing_country = $row_sh_addr['country'];
} else{
$qry_get_billad= "SELECT * from customer_address where id = '$parent_id'";
$q_get_billad = $conn->prepare($qry_get_billad);
$q_get_billad->execute();
$q_sh_addr->setFetchMode(PDO::FETCH_ASSOC);
$row_get_billad = $q_get_billad->fetch();
$billing_country = $row_get_billad['country'];
}
if ($billing_country != 'India') {
    $qry_cart_updt = "update cart set taxable = '0' where customer_id = '$cust_id'";
    $q_cart_updt = $conn->prepare($qry_cart_updt);
    $q_cart_updt->execute();

    $qry_tot_pr = "SELECT sum(price) tot_price from cart where customer_id = '$cust_id'";
    $q_tot_pr = $conn->prepare($qry_tot_pr);
    $q_tot_pr->execute();
    $q_tot_pr->setFetchMode(PDO::FETCH_ASSOC);
    $row_tot_pr = $q_tot_pr->fetch();
    $total_price = $row_tot_pr['tot_price'];
} else {

    $qry_tot_pr = "select sum(a.tot_amt) total_pr from "
            . "(SELECT "
            . "(case
    when taxable='1' then price+(price*('$tax_percentage'/100))
    else price+(price*(0/100))
    end) tot_amt "
            . "FROM `cart` where customer_id = '$cust_id')a";

    $q_tot_pr = $conn->prepare($qry_tot_pr);
    $q_tot_pr->execute();
    $q_tot_pr->setFetchMode(PDO::FETCH_ASSOC);
    $row_tot_pr = $q_tot_pr->fetch();
    $total_price = $row_tot_pr['total_pr'];
}

//taxable




$qry_ord = "insert into tbl_order(order_id,order_org_id,customer_id,address_id,gateway_id,note,price,date) "
        . "values('','','$cust_id','$ship_address_id','$gateway_id','$order_note','$total_price','$order_date')";

$q_ord = $conn->prepare($qry_ord);
$q_ord->execute();

$qry_sel = "SELECT max(order_id) max_id from tbl_order";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
$ord_id = $row_sel['max_id'];


$ord_org_id = $date_for_id . $ord_id;
$qry_orgid = "update tbl_order set order_org_id = '$ord_org_id' where order_id = '$ord_id'";
$q_orgid = $conn->prepare($qry_orgid);
$q_orgid->execute();


$qry_org = "SELECT * from tbl_order where order_id = '$ord_id'";
$q_org = $conn->prepare($qry_org);
$q_org->execute();
$q_org->setFetchMode(PDO::FETCH_ASSOC);
$row_org = $q_org->fetch();
$main_org_id = $row_org['order_org_id'];


$qry_stat = "insert into order_status(id,order_id,status,comment,date) "
        . "values('','$main_org_id','initiated','','$order_date')";
$q_stat = $conn->prepare($qry_stat);
$q_stat->execute();


$user_cart = get_cart($cust_id);




foreach ($user_cart as $item) {

    $customer_id = $cust_id;
    $product_id = $item["product_id"];
    $prod_arr = get_prod_name($product_id);
    $product_name = $prod_arr["prodname"];

    $image_id = $item["image_id"];
    $img_arr = get_image_name($image_id);
    $image_name = $img_arr["m_image_name"];
    $quantity = $item["quantity"];
    $price = $item["price"];
    $imagetype = $item["imagetype"];
    $type = $item["type"];

    if ($item["taxable"] == '1') {
        $tax_per = $tax_percentage;
        $tax_amt = $price * ($tax_percentage / 100);
    } else {
        $tax_per = 0;
        $tax_amt = 0;
    }

    $qry_prod = "insert into order_products(id,order_id,customer_id,product_id,product_name,image_id,image_name,quantity,price,tax_percentage,tax_amount,imagetype,details) "
            . "values('','$ord_id','$customer_id','$product_id','$product_name','$image_id','$image_name','$quantity','$price','$tax_per','$tax_amt','$imagetype','$type')";
    $q_prod = $conn->prepare($qry_prod);
    $q_prod->execute();
    $produc_info[] = $item["imagetype"] . "-" . $img_arr["m_image_name"] . "-" . $item["type"];
}



$gateway_arr = get_particular_gateway($gateway_id);
$gateway_name = $gateway_arr['name'];
$email = $_SESSION['user-email'];

$ord_prod_arr = ordered_item($ord_id);
//var_dump($ord_prod_arr);
//exit;
$prod_html = '';
$prod_html .= '<table border="1">'
        . '<thead><tr>'
        . '<th>Product Name</th>'
        . '<th>Description</th>'
        . '<th>Quantity</th>'
        . '<th>Price Per Item</th>'
        . '<th>Tax</th>'
        . '</tr></thead>';
$prod_html .= '<tbody>';
foreach ($ord_prod_arr as $item_prod) {

    $prod_html .= '<tr>'
            . '<td>' . $item_prod['product_name'] . '</td>'
            . '<td>' . $item_prod['imagetype'] . ' ' . $item_prod['details'] . '</td>'
            . '<td>' . $item_prod['quantity'] . '</td>'
            . '<td>' . $item_prod['price'] . '</td>'
            . '<td>' . $item_prod['tax_amount'] .'('.$item_prod['tax_percentage'].'%)' .'</td>'
            . '</tr>';
}
$prod_html .= '</tbody></table>';
//print_r($_SESSION["bill_address"]);
//print_r($_SESSION["ship_address"]);
if (isset($_SESSION["ship_address"])) {
    $filter_ship_array = array_filter($_SESSION["ship_address"]);
} else {
    $filter_ship_array = '';
}
if (isset($_SESSION["ship_address"]) && !empty($filter_ship_array)) {

//print_r($_SESSION["ship_address"]);
//exit;
    //if (!empty($filter_ship_array)) {
    //print_r($filter_ship_array);
    $delivery_addr_html = '';
    $delivery_addr_html .= 'Name: <strong>' . $_SESSION["ship_address"]['ship_cust_name'] . '</strong>';
    $delivery_addr_html .= '<br>Phone: <strong>' . $_SESSION["ship_address"]['ship_cust_phone'] . '</strong>';
    $delivery_addr_html .= '<br>Address: <strong>' . $_SESSION["ship_address"]['ship_street_address'] . '</strong>';
    $delivery_addr_html .= '<br>City: <strong>' . $_SESSION["ship_address"]['ship_city'] . '</strong>';
    $delivery_addr_html .= '<br>State: <strong>' . $_SESSION["ship_address"]['ship_state'] . '</strong>';
    $delivery_addr_html .= '<br>Country: <strong>' . $_SESSION["ship_address"]['ship_country'] . '</strong>';
    $delivery_addr_html .= '<br>Zip: <strong>' . $_SESSION["ship_address"]['ship_zip'] . '</strong>';
    $delivery_addr_html .= '<br>Landmark: <strong>' . $_SESSION["ship_address"]['ship_landmark'] . '</strong><br><br>';
    // }
} else {
    // echo 'hello';
    $delivery_addr_html = '';

    $delivery_addr_html .= 'Address: <strong>' . $_SESSION["bill_address"]['street_address'] . '</strong>';
    $delivery_addr_html .= '<br>City: <strong>' . $_SESSION["bill_address"]['city'] . '</strong>';
    $delivery_addr_html .= '<br>State: <strong>' . $_SESSION["bill_address"]['state'] . '</strong>';
    $delivery_addr_html .= '<br>Country: <strong>' . $_SESSION["bill_address"]['country'] . '</strong>';
    $delivery_addr_html .= '<br>Zip: <strong>' . $_SESSION["bill_address"]['zip'] . '</strong>';
    $delivery_addr_html .= '<br>Landmark: <strong>' . $_SESSION["bill_address"]['landmark'] . '</strong><br><br>';
}

//print_r($_SESSION["bill_address"]);
//echo $delivery_addr_html;
//exit;
if ($gateway_name == 'Direct Bank Transfer') {
    $gateway_des = '' . $gateway_name . '<br>'
            . 'Bank: SBI<br>'
            . 'Branch: Kolkata<br>'
            . 'Current A/c: GALLERYRASA<br>'
            . 'A/c No: 000000000000000<br>'
            . 'IFSC Code: SBI0000000<br>';
} else {
    $gateway_des = $gateway_name;
}

$qry_em = "SELECT admin_ecomc.email admin_email from admin_ecomc";
$q_em = $conn->prepare($qry_em);
$q_em->execute();
$q_em->setFetchMode(PDO::FETCH_ASSOC);
$row_em = $q_em->fetch();
$admin_email = $row_em['admin_email'];


$to = $email . ',' . $admin_email;
$username = $_SESSION['user-name'];

//$subject = 'Thank you '. $username.' for your Order';

$get_mail = get_particular_email('Customer Order Mail');
$cf = html_entity_decode($get_mail['content']);
$sub = $get_mail['subject'];
$subject = str_replace(array('{name}'), array($username), $sub);
//$cf = file_get_contents('customer-order-mail.txt');
$message = str_replace(array('{name}', '{order_id}', '{amount}', '{pay_method}', '{ord_prod}', '{delivery_address}'), array($username, $ord_org_id, $total_price, $gateway_des, $prod_html, $delivery_addr_html), $cf);


$emailname = 'GALLERYRASA';
$nameform = 'GALLERYRASA';
send_mail($to, $subject, $message, $emailname, $nameform);


$qry_mail = "insert into email_log(id,email,email_name,subject,text,date) "
        . "values('','$to','Customer Order Mail','$subject','$message','$order_date')";
$q_mail = $conn->prepare($qry_mail);
$q_mail->execute();




$qry_del = "delete from cart where customer_id = '$cust_id'";
$q_del = $conn->prepare($qry_del);
$q_del->execute();



/**
 * @var array PayUData
 * This data will be sent to payu gateway
 */
$payUData = array();
if ($gateway_name == 'Direct Bank Transfer') {
    $_SESSION['direct_bank'] = 'Direct Bank Transfer';
    $_SESSION['direct_bank_orderno'] = $ord_org_id;
    $_SESSION['direct_bank_amount'] = $total_price;
}
unset($_SESSION['bill_addr_exist']);
unset($_SESSION["bill_address"]);
unset($_SESSION["ship_address"]);
unset($_SESSION['sel_old_addr']);
unset($_SESSION['tax_percentage']);
//unset($_SESSION['tax_amount']);
switch ($gateway_name) {

    case 'PayUMoney':
        $currentTime = round(microtime(true) * 1000);
        $dParams = array(
            'key' => 'rjQUPktU',
            'txnid' => implode("_", array($ord_org_id, $currentTime)),
            'amount' => floatval($total_price),
            'firstname' => $username,
            'email' => $email,
            'phone' => '9903985585',
            'productinfo' => htmlspecialchars(implode("\n", $produc_info)),
            'surl' => SITE_URL . '/cart-checkout/payu-return',
            'furl' => SITE_URL . '/cart-checkout/payu-return'
        );
        $obj = new PayUMoney([
            'merchantId' => 'rjQUPktU',
            'secretKey' => 'e5iIg1jwi8',
            'testMode' => true
        ]);
        echo $obj->initializePurchase($dParams);
        break;
    default :
        goto_location('success-payment.php');
}







