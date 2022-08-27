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
                                                <input type="text" name="fname" id="fname" class="form-control"  value="<?php echo $row_user['fname']; ?>" required >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $row_user['lname']; ?>" required >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>E-mail Address</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['user-email']; ?>" readonly>
                                            </div>
                                        </div>
                                        <span id="err_message" class="text-danger"></span>
                                        <span id="succ_message" class="text-primary"></span>
                                        <input type="submit" id="processdata" class="submit-btn" value="update profile">
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
                                                <input type="password" name="password" id="password" class="form-control" value="<?php echo $row_user['password']; ?>" >
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Re-Enter Password</label>
                                                <input type="password" name="re_password" id="re_password" class="form-control" value="<?php echo $row_user['password']; ?>" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="submit-btn" id="processdata" >update password</button>
                                    </form>                 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <?php
                                // echo  $_SESSION['user-id'];
                                // exit();
                                // $sql_user = "select * from order_products where customer_id = '" . $_SESSION['user-id'] . "' ORDER BY `order_products`.`id` DESC";
                                // // echo $sql_user;
                                // $q_user = $conn->prepare($sql_user);
                                // $q_user->execute();
                                // $q_user->setFetchMode(PDO::FETCH_ASSOC);
                                // $row_user = $q_user->fetchAll();
                                // print_r($row_user);

                                $sql = "select ord.*,cust.fname,cust.lname,cust.email,cust.phone,gateway.name gateway_name,c_add.name ship_cust_name,c_add.phone ship_cust_phone,c_add.street_address,c_add.city,c_add.state,c_add.country,c_add.zip,c_add.landmark,c_add.parent_id from tbl_order ord,customer_login cust,gateway,customer_address c_add  where ord.customer_id=cust.id and ord.gateway_id=gateway.id and ord.address_id=c_add.id and c_add.customer_id = '" . $_SESSION['user-id'] . "' order by ord.order_id desc";

                                // echo $sql;
                                // exit;
                                $q = $conn->prepare($sql);
                                //$category_id = 2;

                                $q->execute();
                                $q->setFetchMode(PDO::FETCH_ASSOC);
                                $count = $q->rowCount();
                                $row = $q->fetchAll();
                                // print_r($row);
                                // die;
                                ?>                                        
                                <div class="history">Order History<img class="img-fluid" src="<?php echo SITE_URL ?>images/refresh.png"></div>
                                <div class="dashboard-acco">
                                    <div class="accordion" id="accordionExample">
                                    <?php // foreach($row_user as $row){ ?>
                                        <?php foreach($row as $data){ ?>                                              
                                        <div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour<?php echo  $data['order_id']; ?>" aria-expanded="false" aria-controls="collapseFour">
                                                        <div class="dashboard-cart">
                                                            <div class="dashboard-order">
                                                                <div class="order-inner">
                                                                    <p><?php echo  $data['order_org_id']; ?></p><span>|</span>
                                                                    <p><?php // echo  $data['added_on']; ?><br></p>
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
                                                                            <?php // echo  $row['product_name']; ?><br>
                                                                            </div>
                                                                            <div class="cart-content">
                                                                            <?php // echo  $row['details']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cart-count">₹ <?php echo  $data['price']; ?></div>
                                                                    </div>
                                                                </div>
                                                                <p>+ 3 Items</p>
                                                            </div>
                                                        </div>
                                                        <div class="order-btn">view order details<i class="zmdi zmdi-chevron-down"></i></div>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFour<?php echo  $data['order_id']; ?>" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="order-border">
                                                        <?php
                                                            $demo =$data['order_id'];
                                                            $query = "select * from order_products where order_id ='$demo'";
                                                            echo $query;
                                                            $q = $conn->prepare($query);
                                                            //$category_id = 2;
                                                            $q->execute();
                                                            $q->setFetchMode(PDO::FETCH_ASSOC);
                                                            // $count = $q->rowCount();
                                                            $row_data = $q->fetchAll();
                                                            // print_r($row_data);
                                                        ?>
                                                        <div class="order-info">
                                                            <div class="order-left">
                                                                <?php 
                                                                    foreach($row_data as $demo){
                                                                ?>
                                                                1. <?php echo $demo['product_name'] ?>-<?php echo $demo['details'] ?> x <?php echo $demo['quantity'] ?>  -  ₹<?php echo $demo['price'] ?>
                                                                <br>
                                                                <?php } ?>
                                                            </div>
                                                            <!-- <div class="order-right">
                                                                ₹ 100 / $ 1.33
                                                            </div> -->
                                                        </div>                                                        
                                                    </div>
                                                    <div class="order-shipped">
                                                        <div class="shipped-title">
                                                            Shipped to:
                                                        </div>
                                                        <div class="shipped-content">
                                                        <?php echo  $data['street_address']; ?>,<br>
                                                        <?php echo  $data['state']; ?>,  <?php echo  $data['landmark']; ?>,  <?php echo  $data['country']; ?> , <?php echo  $data['city']; ?> - <?php echo  $data['zip']; ?>
                                                        </div>
                                                    </div>

                                                    <div class="order-shipped">
                                                        <div class="shipped-title">
                                                            Payment Method:
                                                        </div>
                                                        <div class="shipped-content">
                                                        <?php echo  $data['gateway_name']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
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
                                            <input type="hidden" name="demodata" value="pills-addresses"  >
                                        <input type="hidden" name="addr_id" id="addr_id_<?php echo $bill_addr['id']; ?>" value="<?php echo $bill_addr['id']; ?>">
                                        <div class="history">Billing Address<span class="material-icons">receipt</span></div>
                                        <div class="form-row">
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $bill_addr['name']; ?>">
                                                    <span class="text-danger" id="name-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Phone</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $bill_addr['phone']; ?>" >
                                                    <span class="text-danger" id="phone-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Address</label>
                                                    <input type="text" name="street_address" class="form-control" id="street_address" class="form-control" value="<?php echo $bill_addr['street_address']; ?>">
                                                    <span class="text-danger" id="address-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>City</label>
                                                    <input type="text" name="city" id="city" class="form-control" value="<?php echo $bill_addr['city']; ?>">
                                                    <span class="text-danger" id="city-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $bill_addr['state']; ?>">
                                                    <span class="text-danger" id="state-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="country" id="country" value="<?php echo $bill_addr['country']; ?>">
                                                    <span class="text-danger" id="country-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Zip Code</label>
                                                    <input type="text" class="form-control"  name="zip" id="zip" value="<?php echo $bill_addr['zip']; ?>">
                                                    <span class="text-danger" id="zip-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Landmark</label>
                                                    <input type="text" class="form-control" name="landmark" id="landmark" value="<?php echo $bill_addr['landmark']; ?>">
                                                    <span class="text-danger" id="landmark-error"></span>
                                                </div>
                                            </div>
                                            
                                       
                                    </div>
                                    </div>
                                    <div class="col-xl-6">
                                    <div class="get-form">
                                        <div class="shipping-box">
                                            <div class="history">Shipping Address<span class="material-icons">local_shipping</span></div>
                                             <div class="form-check form-check-inline ">
                                                <input class="form-check-input greencheck" type="checkbox" id="check-address" value="option2">
                                                <label class="form-check-label" for="inlineCheckbox1">Same as Billing Address</label>
                                            </div>
                                        </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Name</label>
                                                    <input type="text" id="shipping_name" name="shipping_name" class="form-control" value="<?php echo $bill_addr['shipping_name']; ?>" >
                                                    <span class="text-danger" id="shipping_name-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Phone</label>
                                                    <input type="tel" id="shipping_phone" name="shipping_phone" class="form-control" value="<?php echo $bill_addr['shipping_phone']; ?>" >
                                                    <span class="text-danger" id="shipping_phone-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Address</label>
                                                    <input name="shipping_address" id="shipping_address" value="<?php echo $bill_addr['shipping_address']; ?>" type="text" class="form-control" >
                                                    <span class="text-danger" id="shipping_address-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>City</label>
                                                    <input type="text" name="shipping_city" id="shipping_city" class="form-control" value="<?php echo $bill_addr['shipping_city']; ?>" >
                                                    <span class="text-danger" id="shipping_city-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>State</label>
                                                    <input type="text" name="shipping_state" id="shipping_state" value="<?php echo $bill_addr['shipping_state']; ?>" class="form-control">
                                                    <span class="text-danger" id="shipping_state-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="shipping_country" id="shipping_country" value="<?php echo $bill_addr['shipping_country']; ?>" >
                                                    <span class="text-danger" id="shipping_country-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Zip Code</label>
                                                    <input type="text"  class="form-control" name="shipping_zip" id="shipping_zip" value="<?php echo $bill_addr['shipping_zip']; ?>">
                                                    <span class="text-danger" id="shipping_zip-error"></span>
                                                </div>
                                                <div class="form-group col-md-12 p-1">
                                                    <label>Landmark</label>
                                                    <input type="text" class="form-control" name="shipping_landmark" id="shipping_landmark" value="<?php echo $bill_addr['shipping_landmark']; ?>" >
                                                    <span class="text-danger" id="shipping_landmark-error"></span>
                                                </div>
                                            </div>
                                            <span id="error_message" class="text-danger"></span>
                                            <span id="success_message" class="text-primary"></span>
                                            <button type="submit" class="submit-btn" id="submitdata" >update address</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        // alert();
        // var add= $('#street_address').val();
        // alert(add);
        $('#check-address').click(function(){
            // alert();
            // var add= $('#phone').val();
            // alert(add);
            if($('#check-address').is(":checked")){
                // alert();
                $('#shipping_name').val($('#name').val());
                $('#shipping_phone').val($('#phone').val());
                $('#shipping_address').val($('#street_address').val());
                $('#shipping_city').val($('#city').val());
                $('#shipping_state').val($('#state').val());
                $('#shipping_country').val($('#country').val());
                $('#shipping_zip').val($('#zip').val());
                $('#shipping_landmark').val($('#landmark').val());
            }else{
                $('#shipping_name').val("");
                $('#shipping_phone').val("");
                $('#shipping_address').val("");
                $('#shipping_city').val("");
                $('#shipping_state').val("");
                $('#shipping_country').val("");
                $('#shipping_zip').val("");
                $('#shipping_landmark').val("");
            }
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        // alert();
        $('#submitdata').click(function(event){
            // alert();
            event.preventDefault();
            var form = document.getElementById('form')
            var addr_id=$('#addr_id_<?php echo $bill_addr['id']; ?>').val();
            var name=$('#name').val();
            var phone=$('#phone').val();
            var street_address=$('#street_address').val();
            var city=$('#city').val();
            var state=$('#state').val();
            var country=$('#country').val();
            var zip=$('#zip').val();
            var landmark=$('#landmark').val();
            var shipping_name=$('#shipping_name').val();
            var shipping_phone=$('#shipping_phone').val();
            var shipping_address=$('#shipping_address').val();
            var shipping_city=$('#shipping_city').val();
            var shipping_state=$('#shipping_state').val();
            var shipping_country=$('#shipping_country').val();
            var shipping_zip=$('#shipping_zip').val();
            var shipping_landmark=$('#shipping_landmark').val();
            if(name=='' || phone==''||street_address==''||city=='' || state == '' || zip == '' || country=='' || landmark =='' || shipping_name =='' || shipping_phone =='' || shipping_address ==''|| shipping_city ==''|| shipping_state ==''|| shipping_country ==''|| shipping_zip =='' || shipping_landmark ==''){
                $('#error_message').html("<strong>All fields are required*</strong>");
            }
            else {
                // alert();
                var name_regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                var name_validation = name_regex.test(name);
                var shipping_name_validation = name_regex.test(shipping_name);
                // alert(name_validation);
                var phone_regex = /(7|8|9)\d{9}/;
                var phone_validation = phone_regex.test(phone);
                var shipping_phone_validation = phone_regex.test(shipping_phone);
                // alert(phone_validation);    
                if(name_validation == false && shipping_name_validation == false ) {            
                    if(phone_validation && shipping_phone_validation ){
                        $('#error_message').html('');
                    jQuery.ajax({
                        url:"function_edit_bill_addr.php",
                        method:"POST",
                        data:{addr_id:addr_id,name:name,phone:phone,street_address:street_address,city:city,state:state,zip:zip,landmark:landmark,country:country,shipping_name:shipping_name,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_city:shipping_city,shipping_state:shipping_state,shipping_country:shipping_country,shipping_zip:shipping_zip,shipping_landmark:shipping_landmark},
                        success:function(rply){
                            //console.log(rply);
                            //alert(rply.response.message);
                            if(!rply.status){
                                    if(rply.response['inputId'] == 'name'){
                                        $('#name-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'phone'){
                                        $('#phone-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'city'){
                                        $('#city-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'address'){
                                        $('#address-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'state'){
                                        $('#state-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'country'){
                                        $('#country-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'zip'){
                                        $('#zip-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'landmark'){
                                        $('#landmark-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_name'){
                                        $('#shipping_name-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_phone'){
                                        $('#shipping_phone-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_address'){
                                        $('#shipping_address-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_city'){
                                        $('#shipping_city-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_state'){
                                        $('#shipping_state-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_country'){
                                        $('#shipping_country-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_zip'){
                                        $('#shipping_zip-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_landmark'){
                                        $('#shipping_landmark-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'special_name'){
                                        $('#name-error').html(rply.response.message);
                                    }
                                    if(rply.response['inputId'] == 'shipping_name'){
                                        $('#shipping_name-error').html(rply.response.message);
                                    }
                                } 
                            $('#success_message').html("<strong>Successfully data saved</strong>").fadeOut(5000);
                            }
                        });
                    }else {
                         $('#error_message').html("<strong>Please Enter Valid Phone Number*</strong>");
                    }          
                } else {
                    $('#error_message').html("<strong>Please Enter a Valid Name*</strong>");
                }                
            }    
        });
    });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        // alert();
        $('#processdata').click(function(event){
            // alert();
            event.preventDefault();
            // var form = document.getElementById('form')
            var fname=$('#fname').val();
            var phone=$('#lname').val();
            // alert(fname);
            if(fname=='' || lanme==''){
                $('#err_message').html("<strong>All fields are required*</strong>");
            }
            else {
                var fname_regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                var fname_validation = fname_regex.test(fname);
                alert(fname_validation);
                if(fname_validation == false ) {
                        $('#err_message').html('');
                    jQuery.ajax({
                        url:"change-profile.php",
                        method:"POST",
                        data:{fname:fname,lname:lname},
                        success:function(rply){
                            //console.log(rply);
                            //alert(rply.response.message);
                            if(!rply.status){
                                    if(rply.response['inputId'] == 'name'){
                                        $('#name-error').html(rply.response.message);
                                    }                                    
                                } 
                            $('#success_message').html("<strong>Successfully data saved</strong>").fadeOut(5000);
                            }
                        });          
                } else {
                    $('#error_message').html("<strong>Please Enter a Valid Name*</strong>");
                }                
            }    
        });
    });
</script> -->