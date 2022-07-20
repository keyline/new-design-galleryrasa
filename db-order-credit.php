<?php

require_once("require.php");
require_once("" . INCLUDED_FILES . "config.inc.php");
require_once("" . INCLUDED_FILES . "dbConn.php");
require_once("" . INCLUDED_FILES . "functionsInc.php");
require_once("". PAYU_FILES . "PayUMoney.php");

//$conn = dbconnect();
$cust_id = $_SESSION['user-id'];


echo $credit = $_POST['credit'];

exit;


$adminsettingarr = get_admin_setting();

print_r($adminsettingarr);
exit;

//$credit_value = $adminsettingarr['credit_value'];
//
//$creditrupees = $credit_value * $credit;
//
//
//$gateway_id = $_POST['gateway'];
//
//$order_date = date("Y-m-d H:i:s");
//
//$date_for_id = strtotime(date("Y-m-d"));
//
//
//$custarr = customer_details($cust_id);
//
//$username = $custarr['fname'].' '.$custarr['lname'];
//
//$email = $custarr['email'];
//
//$phone = $custarr['phone'];
//
//$produc_info = 'Buy Credit';
//
//$creditexistscheck = customer_in_credit($cust_id);
//
//
//if ($creditexistscheck == false) {
//    $creditentrycolumns = array(
//        'id' => "'" . "'",
//        'customer_id' => "'" . $_SESSION['user-id'] . "'",
//        'credit' => "'" . '0.00' . "'",
//        'created_at' => "'" .$order_date. "'",
//        'updated_at' => "'" .$order_date . "'"
//    );
//
//    $pqr1 = insert('customer_credit', $creditentrycolumns);
//
//    $q1 = $conn->prepare($pqr1);
//    $q1->execute();
//    
//    
//    $lastinseridrow = lastinsertid();
//    $creditid = $lastinseridrow['LAST_INSERT_ID()'];
//    
//    
//    $ord_org_id = $creditid.'_'.'1';
//    
//    
//    
//}else{
//    $custcreditarr = get_customer_credit($param);
//    
//    $creditid = $custcreditarr['id'];
//    
//    
//    $creditbuycntarr = count_customer_credit_buy($param1);
//    
//    $creditbuycnt = $creditbuycntarr['creditbuyno'];
//    $creditbuycnt1 = $creditbuycnt+1;
//    $ord_org_id = $creditid.'_'.$creditbuycnt1;
//    
//    
//}
//
//
//
//$gateway_arr = get_particular_gateway($gateway_id);
//$gateway_name = $gateway_arr['name'];
//
//
//if ($gateway_name == 'Direct Bank Transfer') {
//    $gateway_des = '' . $gateway_name . '<br>'
//            . 'Bank: SBI<br>'
//            . 'Branch: Kolkata<br>'
//            . 'Current A/c: RASAGALLERY<br>'
//            . 'A/c No: 000000000000000<br>'
//            . 'IFSC Code: SBI0000000<br>';
//} else {
//    $gateway_des = $gateway_name;
//}
//
//
//
//
//$payUData = array();
//if ($gateway_name == 'Direct Bank Transfer') {
//    $_SESSION['direct_bank'] = 'Direct Bank Transfer';
//    //$_SESSION['direct_bank_orderno'] = $ord_org_id;
//    $_SESSION['direct_bank_amount'] = $creditrupees;
//}
//
//
//
//switch ($gateway_name) {
//
//    case 'PayUMoney':
//        $currentTime = round(microtime(true) * 1000);
//        $dParams = array(
//            'key' => 'rjQUPktU',
//            'txnid' => implode("_", array($ord_org_id, $currentTime)),
//            'amount' => floatval($creditrupees),
//            'firstname' => $username,
//            'email' => $email,
//            'phone' => $phone,
//            'productinfo' => htmlspecialchars(implode("\n", $produc_info)),
//            'surl' => SITE_URL . '/payu-credit-return',
//            'furl' => SITE_URL . '/payu-credit-return'
//        );
//        $obj = new PayUMoney([
//            'merchantId' => 'rjQUPktU',
//            'secretKey' => 'e5iIg1jwi8',
//            'testMode' => true
//        ]);
//        echo $obj->initializePurchase($dParams);
//        break;
//    default :
//        goto_location('success-payment.php');
//}
//
//
//
