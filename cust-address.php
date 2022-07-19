<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
check_auth_user();
include(INC_FOLDER . "headerInc.php");
$conn = dbconnect();
$cust_id = $_SESSION['user-id'];
?>

<div class="container">
    <a href="customer-dashboard.php"><h3>Dashboard</h3></a>
    <a href="cust-orders.php"><h3>List of Orders</h3></a>
    <a href="cust-address.php"><h3>Customer Address</h3></a>
    <h2>Customer Address</h2>

    <h3>Billing Address</h3>

    <?php
    $bill_addr = get_user_bill_addr($cust_id);
    ?>


    Address: <?php echo $bill_addr['street_address']; ?><br>
    City: <?php echo $bill_addr['city']; ?><br>
    State: <?php echo $bill_addr['state']; ?><br>
    Country: <?php echo $bill_addr['country']; ?><br>
    Zip: <?php echo $bill_addr['zip']; ?><br>
    Landmark: <?php echo $bill_addr['landmark']; ?><br>
    <button id="edit_bill_addr" data-id="<?php echo $addr_opt['id']; ?>" class="btn btn-sm btn-info">Edit</button>
    <div id="bill_form" style="display: none;">
        <form method="POST" action="function_edit_bill_addr.php">
            <input type="hidden" name="addr_id" id="addr_id_<?php echo $bill_addr['id']; ?>" value="<?php echo $bill_addr['id']; ?>">   
            <div class="col-md-4">
                <label for="address">Address <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input name="street_address" class="form-control" id="street_address" type="text" value="<?php echo $bill_addr['street_address']; ?>" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="city">City <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="city" id="city" value="<?php echo $bill_addr['city']; ?>" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="city">State <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="state" id="state" value="<?php echo $bill_addr['state']; ?>" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="city">Country <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="country" id="country" value="<?php echo $bill_addr['country']; ?>" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="zip">Zip Code <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $bill_addr['zip']; ?>" required>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-4">
                <label for="zip">Landmark</label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" name="landmark" id="landmark"><?php echo $bill_addr['landmark']; ?></textarea>
            </div>
            <div class="clearfix"></div>
            <br> 
            <div class="col-md-4">

            </div>
            <div class="col-md-8">
                <input type="submit" class="btn btn-success" name="Submit" id="submit_bill">
            </div>
        </form>
    </div>


    <br>
    <br>


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

            <div id="all_addr_<?php echo $addr_opt['id']; ?>">
                Address: <?php echo $addr_opt['street_address']; ?><br>
                City: <?php echo $addr_opt['city']; ?><br>
                State: <?php echo $addr_opt['state']; ?><br>
                Country: <?php echo $addr_opt['country']; ?><br>
                Zip: <?php echo $addr_opt['zip']; ?><br>
                Landmark: <?php echo $addr_opt['landmark']; ?><br>
                <button id="edit_ship_addr" data-id="<?php echo $addr_opt['id']; ?>" class="btn btn-sm btn-info">Edit</button>



                <div id="ship_form_<?php echo $addr_opt['id']; ?>">
                    
                </div>



                <br>
                <br>
            </div>
            <?php
        }
        ?>

        <?php
    }
    ?>
</div>


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
            //alert(del_addr_id);
            $.ajax({
                url: 'edit-ship-address.php',
                type: 'GET',
                data: 'edit_addr_id=' + dataid,
                dataType: 'html'
            })
                    .done(function (data) {
                        console.log(data);
//                            $('#res-coup').html(''); // blank before load.
                        //$('#show_addr').html(data); // load here
                        $('#ship_form_' + dataid).show(); // hide loader  
                    })
        });
    });
</script>



<?php
include(INC_FOLDER . "footerInc.php");
?>
