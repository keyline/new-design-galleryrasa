<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL.'/login-register');
    exit;
}
$conn = dbconnect();
include("../" . INC_FOLDER . "headerInc.php");

$cust_id = $_SESSION['user-id'];
?>
<main>
<div class="container arial">
    <h2 class="client-admin-heading">Customer Address</h2>
    <div class="row">
    <div class="col-md-3 client-admin-left-panel">
        <?php
        include("customer-menu.php");
        ?>
    </div>
    <div class="col-md-9 dashboardAddress">
        <?php
        if (isset($_SESSION['succ-addr'])) {
            ?>
            <span class="label-success"><?php echo $_SESSION['succ-addr'] ?></span>
            <?php
            unset($_SESSION['succ-addr']);
        }
        ?>

        <h3>Billing Address</h3>
        <?php
        $bill_addr = get_user_bill_addr($cust_id);
        ?>

        <div class="col-md-12 mb-5">
            <ul class="p-0 m-0"> 
                <li>
                    <span>Address</span>
                    <span><?php echo $bill_addr['street_address']; ?></span>
                </li>
                <li>
                    <span>City</span>
                    <span><?php echo $bill_addr['city']; ?></span>
                </li>
                <li>
                    <span>State</span>
                    <span><?php echo $bill_addr['state']; ?></span>
                </li>
                <li>
                    <span>Country</span>
                    <span><?php echo $bill_addr['country']; ?></span>
                </li>
                <li>
                    <span>Zip</span>
                    <span><?php echo $bill_addr['zip']; ?></span>
                </li>
                <li>
                    <span>Landmark</span>
                    <span><?php echo $bill_addr['landmark']; ?></span>
                </li>
            </ul>
            <button id="edit_bill_addr" data-id="<?php echo $addr_opt['id']; ?>" class="btn btn-sm btn-info form-control mt-4">Edit</button>
        </div>
        <div id="bill_form" style="display: none;">
            <form method="POST" action="function_edit_bill_addr.php">
                <div class="row">
                    <input type="hidden" name="addr_id" id="addr_id_<?php echo $bill_addr['id']; ?>" value="<?php echo $bill_addr['id']; ?>">   
                    <div class="col-md-2">
                        <label for="address">Address <strong>*</strong></label>
                    </div>
                    <div class="col-md-10">
                        <input name="street_address" class="form-control" id="street_address" type="text" value="<?php echo $bill_addr['street_address']; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="city">City <strong>*</strong></label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo $bill_addr['city']; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="city">State <strong>*</strong></label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="state" id="state" value="<?php echo $bill_addr['state']; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="city">Country <strong>*</strong></label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="country" id="country" value="<?php echo $bill_addr['country']; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="zip">Zip Code <strong>*</strong></label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $bill_addr['zip']; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="zip">Landmark</label>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control" name="landmark" id="landmark"><?php echo $bill_addr['landmark']; ?></textarea>
                    </div>
                    <div class="col-md-10">
                        <input type="submit" class="btn form-control mt-4 mb-5" name="Submit" id="submit_bill">
                    </div>
                </div>
            </form>
        </div>

        <?php
        if (check_cust_addr_child($cust_id)) {
            ?>
            <h3>Shipping Address</h3>
            <?php
            $ship_addr = get_user_addr_ship($cust_id);
            ?>

            <?php
            foreach ($ship_addr as $addr_opt) {
                ?>

                <div class="col-md-12 mb-5" id="all_addr_<?php echo $addr_opt['id']; ?>">
                    <ul class="p-0 m-0">
                        <li>
                            <span>Name</span>
                            <span><?php echo $addr_opt['name']; ?></span>
                        </li>
                        <li>
                            <span>Phone</span>
                            <span><?php echo $addr_opt['phone']; ?></span>
                        </li>
                        <li>
                            <span>Address</span>
                            <span><?php echo $addr_opt['street_address']; ?></span>
                        </li>
                        <li>
                            <span>City</span>
                            <span><?php echo $addr_opt['city']; ?></span>
                        </li>
                        <li>
                            <span>State</span>
                            <span><?php echo $addr_opt['state']; ?></span>
                        </li>
                        <li>
                            <span>Country</span>
                            <span><?php echo $addr_opt['country']; ?></span>
                        </li>
                        <li>
                            <span>Zip</span>
                            <span><?php echo $addr_opt['zip']; ?></span>
                        </li>
                        <li>
                            <span>Landmark</span>
                            <span><?php echo $addr_opt['landmark']; ?></span>
                        </li>
                    </ul>
                    <button id="edit_ship_addr" data-id="<?php echo $addr_opt['id']; ?>" class="btn btn-sm btn-info form-control mt-4">Edit</button>
                    
                    <div id="ship_form_<?php echo $addr_opt['id']; ?>" class="mt-5 mb-5">

                    </div>

                </div>
                <?php
            }
            ?>

            <?php
        }
        ?>
    </div>
    </div>
</div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#edit_bill_addr").click(function () {

            $("#bill_form").show();
        });
//        var dataid = $("#edit_ship_addr").data('id');
//        $("#edit_ship_addr").click(function (e) {
//            var dataid = $(this).data('id');
//            $("#ship_form_" + dataid).show();
//            e.preventDefault();
//        });

    });
</script>

<script type="text/javascript">
    $(function () {
        $(document).on('click', '#edit_ship_addr', function (e) {
            e.preventDefault();
            var dataid = $(this).data('id');
            //var edit_addr_id = $('#ship_form_' + dataid).val();
            //alert(dataid);
            $.ajax({
                url: 'edit-ship-address.php',
                type: 'GET',
                data: 'edit_addr_id=' + dataid,
                dataType: 'html'
            })
                    .done(function (data) {
                        console.log(data);
                        $('#ship_form_' + dataid).html(data); // hide loader  
                    })
        });
    });
</script>



<?php
include("../" . INC_FOLDER . "footerInc.php");
?>
