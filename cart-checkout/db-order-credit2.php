<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-id'])) {
    goto_location('../login-register');
    exit;
}

//include_once ('../common/conn.php');
//date_default_timezone_set('Asia/Kolkata');

$conn = dbconnect();





$cust_id = $_SESSION['user-id'];





$credit = $_POST['credit'];


$adminsettingarr = get_admin_setting();




$credit_value = $adminsettingarr['credit_value'];

$creditrupees = $credit_value * $credit;

$creditrupees = sprintf('%.2f', $creditrupees);

$order_date = date("Y-m-d H:i:s");

$date_for_id = strtotime(date("Y-m-d"));

$creditexistscheck = customer_in_credit($cust_id);



if ($creditexistscheck == false) {
    $creditentrycolumns = array(
        'id' => "'" . "'",
        'customer_id' => "'" . $cust_id . "'",
        'credit' => "'" . '0.00' . "'",
        'created_at' => "'" . $order_date . "'",
        'updated_at' => "'" . $order_date . "'"
    );

    $pqr1 = insert('customer_credit', $creditentrycolumns);

    $q1 = $conn->prepare($pqr1);
    $q1->execute();

    $lastinseridrow = lastinsercredit($cust_id);
    $creditid = $lastinseridrow['lastcreditid'];

//    $lastinseridrow = lastinsertid();
//    $creditid = $lastinseridrow['LAST_INSERT_ID()'];


    $ord_org_id = $creditid . '_' . '1';
} else {
    $custcreditarr = get_customer_credit($cust_id);



    $creditid = $custcreditarr['id'];


    $creditbuycntarr = count_customer_credit_buy($cust_id);



    $creditbuycnt = $creditbuycntarr['creditbuyno'];
    $creditbuycnt1 = $creditbuycnt + 1;
    $ord_org_id = $creditid . '_' . $creditbuycnt1;
}



$credithistorycolumns = array(
    'id' => "'" . "'",
    'customer_id' => "'" . $cust_id . "'",
    'credit_id' => "'" . $creditid . "'",
    'prodid' => "" . 'null' . "",
    'transaction_type' => "'" . '0' . "'",
    'credit' => "'" . '0.00' . "'",
    'amount' => "'" . '0.00' . "'",
    'credit_date' => "'" . $order_date . "'"
);

$pqr2 = insert('customer_credit_history', $credithistorycolumns);

$q2 = $conn->prepare($pqr2);
$q2->execute();


$lastinseridcrhistory = lastinsercredithistory($cust_id);

 $credithistoryid = $lastinseridcrhistory['lastid'];

//$lastinseridcrhistory = lastinsertid();
//echo $credithistoryid = $lastinseridcrhistory['LAST_INSERT_ID()'];
//exit;

$currentTime = round(microtime(true) * 1000);
$txnid = implode("_", array($ord_org_id, $currentTime));


$creditpaymentcolumns = array(
    'id' => "'" . "'",
    'transactionid' => "'" . $txnid . "'",
    'customer_id' => "'" . $cust_id . "'",
    'credit_id' => "'" . $creditid . "'",
    'credit_history_id' => "'" . $credithistoryid . "'",
    'amount' => "'" . $creditrupees . "'",
    'payment_status' => "'" . 'initiated' . "'",
    'date_added' => "'" . $order_date . "'"
);

$pqr3 = insert('tbl_credit_payment', $creditpaymentcolumns);

$q3 = $conn->prepare($pqr3);
$q3->execute();













$insert = FALSE;

//function payment_insert($name, $std_id, $std_email, $txnid, $amount) {
//
//
//    $mode = 'online';
//    $date = date('Y-m-d H:i:s');
//    $qry = "INSERT INTO `aksee_payment` (`id`, `student_uid`, `student_email`, `txnid`, `amount`,`pay_date`, `mode_payment`)" .
//            " VALUES ('', '$std_id', '$std_email', '$txnid', '$amount', '$date', '$mode')";
//    $res = mysql_query($qry);
//    if ($res) {
//        $insert = TRUE;
//    }
//
//    return $insert;
//}
// Merchant key here as provided by Payu
$MERCHANT_KEY = "YdMFZwfh";

// Merchant Salt as provided by Payu
//$SALT = "5GBnz42JiU";
$SALT = "5GBnz42JiU";


// TEST_URL = 'https://test.payu.in/_payment';
// PRODUCTION_URL = 'https://secure.payu.in/_payment';
// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://secure.payu.in/";
$PAYU_BASE_URL = "https://sandboxsecure.payu.in"; //Sandbox Mode

$action = '';



$posted = array();
if (!empty($_POST)) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}


$formError = 0;

//if(empty($posted['txnid'])) {
//  
//  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
//} else {
//  $txnid = $posted['txnid'];
//}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {



    if (
            empty($posted['key']) || empty($txnid) || empty($creditrupees) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider']) || empty($posted['udf1'])
    ) {
        //print_r($posted);
        $formError = 1;
    } else {




        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        //$insert_op = payment_insert($posted['firstname'], $posted['udf1'], $posted['email'], $posted['txnid'], $posted['amount']);
        $hashVarsSeq = explode('|', $hashSequence);


        $hash_string = '';
        
        
        $hash_string = $MERCHANT_KEY.'|'.$txnid.'|'.$creditrupees.'|'.$posted['productinfo'].'|'.$posted['firstname'].'|'.$posted['email']. "|".  $posted['udf1'] .'||||||||||'.$SALT;
        
        
//        foreach ($hashVarsSeq as $hash_var) {
//            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
//            $hash_string .= '|';
//        }
//
//        $hash_string .= $SALT;
        
        
        //echo $insert_op;

        //$hash = strtolower(hash('sha512', $hash_string));
        
        //$hash = hash('sha512', $hash_string);
        //echo '<br>';
        $hash = hash('sha512', $hash_string);
        
        //exit;

        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}

?>
<html>
    <head>
        <script>
            var hash = '<?php echo $hash ?>';


            function submitPayuForm() {
                if (hash == '') {
                    return;
                }
                var payuForm = document.forms.payuForm;
                payuForm.submit();
            }
        </script>
    </head>
    <body onload="submitPayuForm()">
        <h2>PayU Form</h2>
        <br/>
        <?php if ($formError) { ?>

            <span style="color:red">Please fill all mandatory fields.</span>
            <br/>
            <br/>
        <?php } ?>
        <form action="<?php echo $action; ?>" method="post" name="payuForm">
            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            
            <table>
                <tr>
                    <td><b>Mandatory Parameters</b></td>
                </tr>
                <tr>
                    <td>Amount: </td>
                    <td><input name="amount" value="<?php echo (empty($creditrupees)) ? '' : $creditrupees ?>" /></td>
                    <td>First Name: </td>
                    <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
                    <td>Phone: </td>
                    <td><input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
                </tr>
                <tr>
                    <td>Product Info: </td>
                    <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
                </tr>
                <tr>
                    <td>Success URI: </td>
                    <td colspan="3"><input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
                </tr>
                <tr>
                    <td>Failure URI: </td>
                    <td colspan="3"><input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
                </tr>

                <tr>
                    <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
                </tr>

                <tr>
                    <td><b>Optional Parameters</b></td>
                </tr>
                <tr>
                    <td>Last Name: </td>
                    <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
                    <td>Cancel URI: </td>
                    <td><input name="curl" value="" /></td>
                </tr>
                <tr>
                    <td>Address1: </td>
                    <td><input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
                    <td>Address2: </td>
                    <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>
                </tr>
                <tr>
                    <td>City: </td>
                    <td><input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
                    <td>State: </td>
                    <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
                </tr>
                <tr>
                    <td>Country: </td>
                    <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
                    <td>Zipcode: </td>
                    <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
                </tr>
                <tr>
                    <td>UDF1: </td>
                    <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
                    <td>UDF2: </td>
                    <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
                </tr>
                <tr>
                    <td>UDF3: </td>
                    <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
                    <td>UDF4: </td>
                    <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
                </tr>
                <tr>
                    <td>UDF5: </td>
                    <td>
                        <input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
                    <td>PG: </td>
                    <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
                </tr>
                <tr>
                    <?php if (!$hash) { ?>
                        <td colspan="4"><input type="submit" value="Submit" /></td>
                    <?php } ?>
                </tr>
            </table>
        </form>
    </body>
</html>
