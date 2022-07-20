<?php
require_once("require.php");
require_once( INCLUDED_FILES . "config.inc.php");
require_once( INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

//print_r($_POST);
//exit;
//echo '<br>';
$status = $_POST["status"];
$firstname = $_POST["firstname"];
if ($status == 'failure') {
    $amount = $_POST["amount"];
} else {

    $amount = $_POST["net_amount_debit"];
}
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$udf1 = $_POST["udf1"];
$udf5 = $_POST["udf5"];

$amount = sprintf('%.2f', $amount);

$salt = "5GBnz42JiU";

$adminsettingarr = get_admin_setting();

$credit_value = $adminsettingarr['credit_value'];


$userarr = get_user_data($email);


$payarr = last_payment_stat($userarr['id']);

If (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {



    $retHashSeq = $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;

    //$retHashSeq = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|' . $udf1 . '||||||||||' . $salt;
}
//echo '<br>';
$hash = hash("sha512", $retHashSeq);
//exit;
$lasthistoryarr = last_entered_credithistory($userarr['id']);

$totalcredit = ($amount / $credit_value);

$totalcredit = sprintf('%.2f', $totalcredit);

$orgcreditarr = customer_credit($userarr['id']);



$oldcredit = $orgcreditarr['credit'];

include(INC_FOLDER . "headerInc.php");
?>

<div class="container">
    <div class="col-md-9">
        <?php
        if ($hash != $posted_hash) {
            echo "Invalid Transaction. Please try again";
        } else {
            if ($status == 'success') {
                echo "<h3>Thank You. Your payment is successfull.</h3>";
                echo "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";

                echo "<h4>We have received a payment of Rs. " . $amount . " to purchase credit " . $totalcredit . "</h4>";
            } else {
                echo "<h3>Thank You. Your payment is " . $status . ".</h3>";
                echo "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";
            }
        }
        switch ($status) {
            case 'success':

                $lastorgcredit = $oldcredit + $totalcredit;

                $creditarr = array(
                    'credit' => $lastorgcredit
                );

                $wherearr1 = array(
                    'id' => $lasthistoryarr['credit_id']
                );

                $pqr1 = update('customer_credit', $creditarr, $wherearr1);

                $q1 = $conn->prepare($pqr1);
                $q1->execute();


                $credithistoryarr = array(
                    'credit' => $totalcredit,
                    'amount' => $amount,
                );

                $wherearr2 = array(
                    'id' => $lasthistoryarr['id']
                );

                $pqr2 = update('customer_credit_history', $credithistoryarr, $wherearr2);

                $q2 = $conn->prepare($pqr2);
                $q2->execute();


                $creditpayarr = array(
                    'payment_status' => 'success'
                );


                break;

            case 'failure':

                $creditpayarr = array(
                    'payment_status' => 'failed'
                );
                break;
        }

        $wherearr3 = array(
            'id' => $payarr['id']
        );
        $pqr3 = update('tbl_credit_payment', $creditpayarr, $wherearr3);

        $q3 = $conn->prepare($pqr3);
        $q3->execute();
        ?>

    </div>
</div>
<?php
include(INC_FOLDER . "footerInc.php");




