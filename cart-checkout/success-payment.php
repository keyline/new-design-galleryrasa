<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");
check_auth_user();

?>
<div class="container">
    <?php
    if (isset($_SESSION['direct_bank'])) {
        ?>
        <h2>Direct Bank Transfer</h2>
        <h4><strong>Order Number: <?php echo $_SESSION['direct_bank_orderno']; ?></strong></h4>
        <h4><strong>Total Amount: Rs. <?php echo $_SESSION['direct_bank_amount']; ?></strong></h4>
        <h2>How do I make a payment</h2>
        <p>Please make the payment via one of the following methods:</p>
        <ul>
            <li>Online Transfer via NEFT (to any bank account mentioned below), or</li>
            <li>Cheque Deposit (in any bank ATM or branch mentioned below), or</li>
            <li>Cash Deposit (to any of the following bank Branch, across India)</li>
        </ul>
        <p>Note: Use one of the accounts given below. All cheques need to be in favour of "GALLERYRASA".</p>
        <h2>After you make the payment</h2>
        <ul>
            <li>Please keep the Order Number (725540) and cheque/cash deposit receipt and date of payment handy while making the payment.</li>
            <li>Please send an email to info@rasagallery.com with the order number above and the payment details after you have made a payment</li>
            <li>Once we receive the email, we will activate the premium membership</li>
        </ul>
        <div class="col-md-4" style="border: #000 solid 1px; padding-top: 6px; background: #f1f1f1;">
            <p>Bank: SBI</p>
            <p>Branch: Kolkata</p>
            <p>Current A/c: RASAGALLERY</p>
            <p>A/c No: 000000000000000</p>
            <p>IFSC Code: SBI0000000</p>
        </div>
        <div class="clearfix"></div>
        <br>
        <?php
        unset($_SESSION['direct_bank']);
        unset($_SESSION['direct_bank_orderno']);
        unset($_SESSION['direct_bank_amount']);
    } else {
        ?>
        <h1>Order has been placed successfully.</h1>
        <br>
        <?php
    }
    ?>
</div>
<?php
include("../" . INC_FOLDER . "footerInc.php");
?>