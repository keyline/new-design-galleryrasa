<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");
check_auth_user();
?>
<section class="artist-search bibliography-search bengali-film-search faq payment">
        <div class="container">
            <?php
                if (isset($_SESSION['direct_bank'])) {
            ?>
            <div class="row">
                <div class="col-lg-12">
                <div class="payment-inner">
                    <h3>Payment Process</h3>
                    <h4>Direct Bank Transfer</h4>
                    <p>Order Number: <?php echo $_SESSION['direct_bank_orderno']; ?></p>
                    <p>Total Amount: Rs. <?php echo $_SESSION['direct_bank_amount']; ?></p>
                    <h4>How do I make a payment</h4>
                    <ul>
                        <li>Online Transfer via NEFT (to any bank account mentioned below), or</li>
                        <li>Cheque Deposit (in any bank ATM or branch mentioned below), or</li>
                        <li>Cash Deposit (to any of the following bank Branch, across India)</li>
                    </ul>
                    <p><b>Note:</b> Use one of the accounts given below. All cheques need to be in favour of "GALLERYRASA".</p>
                    <h4>After you make the payment</h4>
                    <ul>
                        <li>Please keep the Order Number (725540) and cheque/cash deposit receipt and date of payment handy while making the payment.</li>

                        <li>Please send an email to info@rasagallery.com with the order number above and the payment details after you have made a
                        payment</li>
                        <li>Once we receive the email, we will activate the premium membership</li>
                    </ul>
                    <div class="payment-info">
                        <p>Bank: SBI</p>
                        <p>Bränch: Kolkata</p>
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
                </div>
            </div>
        </div>
    </section>
<?php
include("../" . INC_FOLDER . "footerInc.php");
?>