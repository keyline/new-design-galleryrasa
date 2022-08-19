<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL . '/login-register');
    exit;
}

$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");
$cust_id = $_SESSION['user-id'];
?>
<main>
<div>
    <?php
    if (isset($_SESSION['succ-pass'])) {
        ?>
        <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $_SESSION['succ-pass']; ?></div>
        <?php
        unset($_SESSION['succ-pass']);
    }
    ?>
    <?php
    if (isset($_SESSION['error-pass'])) {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['error-pass']; ?></div>
        <?php
        unset($_SESSION['error-pass']);
    }
    ?>
    <?php
    if (isset($_SESSION['succ-addr'])) {
        ?>
        <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['succ-addr'] ?></div>
        <?php
        unset($_SESSION['succ-addr']);
    }
    ?>
</div>
    <div class="visual-search-details-page exhibition-details-page cart-page dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="right-details">
                        <div class="cart-top">
                            <div class="cart-img-box">
                                <div class="cart-img">
                                    <span class="material-icons">dashboard</span>
                                </div>
                            </div>
                            <div class="dashboard-info">
                                <div class="exhibition-search-title">
                                    Dashboard
                                </div>
                                <div class="exhibition-search-content">
                                    Manage your profile, address and orders.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="start-body podcast-page artist-search get-page profile dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-left">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                    <div class="tab-box"><span class="material-icons">account_circle</span></div>PROFILE
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    <div class="tab-box"><span class="material-icons">lock</span></div>
                                    PASSWORD
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    <div class="tab-box"><span class="material-icons">shopping_basket</span></div>
                                    ORDERS
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-addresses-tab" data-toggle="pill" href="#pills-addresses" role="tab" aria-controls="pills-addresses" aria-selected="false">
                                    <div class="tab-box"><span class="material-icons">place</span></div>
                                    ADDRESSES
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="podcast-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="get-form">
                                <form method="POST" action="change-profile.php" id="passwordForm">
                                    <?php
                                    $sql_user = "select * from customer_login where email = '" . $_SESSION['user-email'] . "'";
                                    // echo $sql_user;
                                    //     exit();
                                    $q_user = $conn->prepare($sql_user);
                                    $q_user->execute();
                                    $q_user->setFetchMode(PDO::FETCH_ASSOC);
                                    $row_user = $q_user->fetch();
                                    ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>First Name</label>
                                                <input type="text" name="fname" class="form-control"  value="<?php echo $row_user['fname']; ?>" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lname" value="<?php echo $row_user['lname']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>E-mail Address</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['user-email']; ?>" readonly>
                                            </div>
                                        </div>
                                        <button type="submit" class="submit-btn">update profile</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="get-form">
                                    <form method="POST" action="change-password.php" id="passwordForm">
                                        <?php
                                        $sql_user = "select * from customer_login where email = '" . $_SESSION['user-email'] . "'";
                                        // echo $sql_user;
                                        $q_user = $conn->prepare($sql_user);
                                        $q_user->execute();
                                        $q_user->setFetchMode(PDO::FETCH_ASSOC);
                                        $row_user = $q_user->fetch();
                                        // print_r($row_user);
                                        ?>
                                        <input type="hidden" name="email" id="email" value="<?php echo $row_user['email']; ?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Enter Password</label>
                                                <input type="password" name="password" id="password" class="form-control" value="<?php echo $row_user['password']; ?>" required >
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Re-Enter Password</label>
                                                <input type="password" name="re_password" id="re_password" class="form-control" value="<?php echo $row_user['password']; ?>" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="submit-btn">update password</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="history">Order History<img class="img-fluid" src="<?php echo SITE_URL ?>images/refresh.png"></div>
                                <div class="dashboard-acco">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        <div class="dashboard-cart">
                                                            <div class="dashboard-order">
                                                                <div class="order-inner">
                                                                    <p>ORDER #123456</p><span>|</span>
                                                                    <p>26th May 2022</p>
                                                                </div>
                                                                <div class="order-action green">
                                                                    DELIVERED
                                                                </div>
                                                            </div>
                                                            <div class="cart-box">
                                                                <div class="cart-box-left">
                                                                    <div class="cart-left">
                                                                    </div>
                                                                    <div class="cart-right">
                                                                        <div class="cart-right-box">
                                                                            <div class="cart-name">
                                                                                Akash Patal
                                                                            </div>
                                                                            <div class="cart-content">
                                                                                PDF of Song Synopsis Book, 6 pages + covers
                                                                            </div>
                                                                        </div>
                                                                        <div class="cart-count">₹ 100 / $ 1.33</div>
                                                                    </div>
                                                                </div>
                                                                <p>+ 3 Items</p>
                                                            </div>
                                                        </div>
                                                        <div class="order-btn">view order details<i class="zmdi zmdi-chevron-down"></i></div>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="order-border">
                                                        <div class="order-info">
                                                            <div class="order-left">
                                                                1. Akash Patal-PDF of Song Synopsis Book, 6 pages + covers x 1
                                                            </div>
                                                            <div class="order-right">
                                                                ₹ 100 / $ 1.33
                                                            </div>
                                                        </div>
                                                        <div class="order-info">
                                                            <div class="order-left">
                                                                2. Akash Patal-PDF of Song Synopsis Book, 6 pages + covers x 1
                                                            </div>
                                                            <div class="order-right">
                                                                ₹ 100 / $ 1.33
                                                            </div>
                                                        </div>
                                                        <div class="order-info">
                                                            <div class="order-left">
                                                                3. Akash Patal-PDF of Song Synopsis Book, 6 pages + covers x 1
                                                            </div>
                                                            <div class="order-right">
                                                                ₹ 100 / $ 1.33
                                                            </div>
                                                        </div>
                                                        <div class="order-info">
                                                            <div class="order-left">
                                                                4. Akash Patal-PDF of Song Synopsis Book, 6 pages + covers x 1
                                                            </div>
                                                            <div class="order-right">
                                                                ₹ 100 / $ 1.33
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="order-shipped">
                                                        <div class="shipped-title">
                                                            Shipped to:
                                                        </div>
                                                        <div class="shipped-content">
                                                            3 C N R BId, Mangammana Plya Road, Bommana Halli,<br>
                                                            Bengaluru, Karnataka - 560068
                                                        </div>
                                                    </div>

                                                    <div class="order-shipped">
                                                        <div class="shipped-title">
                                                            Payment Method:
                                                        </div>
                                                        <div class="shipped-content">
                                                            Online Payment
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-addresses" role="tabpanel" aria-labelledby="pills-addresses-tab">
                                <div class="row">
                                    <div class="col-xl-6">
                                    <div class="get-form">
                                    <?php
                                        $bill_addr = get_user_bill_addr($cust_id);
                                    ?>
                                        <form method="POST" action="function_edit_bill_addr.php">
                                        <input type="hidden" name="addr_id" id="addr_id_<?php echo $bill_addr['id']; ?>" value="<?php echo $bill_addr['id']; ?>">
                                        <div class="history">Billing Address<span class="material-icons">receipt</span></div>
                                        <div class="form-row">
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $bill_addr['name']; ?>" readonly >
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Phone</label>
                                                    <input type="tel" class="form-control" value="<?php echo $bill_addr['phone']; ?>" readonly >
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Address</label>
                                                    <input type="text" name="street_address" class="form-control" id="street_address" class="form-control" value="<?php echo $bill_addr['street_address']; ?>">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>City</label>
                                                    <input type="text" name="city" id="city" class="form-control" value="<?php echo $bill_addr['city']; ?>">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $bill_addr['state']; ?>">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="country" id="country" value="<?php echo $bill_addr['country']; ?>">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Zip Code</label>
                                                    <input type="text" class="form-control"  name="zip" id="zip" value="<?php echo $bill_addr['zip']; ?>">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Landmark</label>
                                                    <input type="text" class="form-control" name="landmark" id="landmark" value="<?php echo $bill_addr['landmark']; ?>">
                                                </div>
                                            </div>
                                            <button type="submit" class="submit-btn">update address</button>
                                        </form>
                                    </div>
                                    </div>
                                    <div class="col-xl-6">
                                    <div class="get-form">
                                        <div class="shipping-box">
                                            <div class="history">Shipping Address<span class="material-icons">local_shipping</span></div>
                                             <div class="form-check form-check-inline ">
                                                <input class="form-check-input greencheck" type="checkbox" id="inlineCheckbox2" value="option2">
                                                <label class="form-check-label" for="inlineCheckbox1">Same as Billing Address</label>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Phone</label>
                                                    <input type="tel" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Phone</label>
                                                    <input type="tel" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>State</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Zip Code</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Landmark</label>
                                                    <input type="text" class="form-control" >
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- <script src="<?php echo SITE_URL . JS_FOLDER ?>jquery-1.11.3.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>bootstrap.min.js">
</script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.js"></script>
<script src="<?php echo SITE_URL . JS_FOLDER ?>jquery.validate2.js"></script> -->


<?php
include("../" . INC_FOLDER . "footerInc.php");
?>

