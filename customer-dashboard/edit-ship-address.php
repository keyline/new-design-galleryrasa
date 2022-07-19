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
$addr_id = $_GET['edit_addr_id'];
$qry_sel = "SELECT * from customer_address where id = '$addr_id'";
$q_sel = $conn->prepare($qry_sel);
$q_sel->execute();
$q_sel->setFetchMode(PDO::FETCH_ASSOC);
$row_sel = $q_sel->fetch();
?>
<form method="POST" action="function_edit_ship_addr.php">
    <input type="hidden" name="ship_addr_id" id="addr_id_<?php echo $row_sel['id']; ?>" value="<?php echo $row_sel['id']; ?>">  
    <div class="form-group row">
        <div class="col-md-2">
            <label for="address">Name <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input name="ship_cust_name" class="form-control" id="street_address" type="text" value="<?php echo $row_sel['name']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="address">Phone <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input name="ship_cust_phone" class="form-control" id="street_address" type="text" value="<?php echo $row_sel['phone']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="address">Address <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input name="ship_street_address" class="form-control" id="street_address" type="text" value="<?php echo $row_sel['street_address']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="city">City <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="ship_city" id="city" value="<?php echo $row_sel['city']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="city">State <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="ship_state" id="state" value="<?php echo $row_sel['state']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="city">Country <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="ship_country" id="country" value="<?php echo $row_sel['country']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="zip">Zip Code <strong>*</strong></label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="ship_zip" id="zip" value="<?php echo $row_sel['zip']; ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="zip">Landmark</label>
        </div>
        <div class="col-md-10">
            <textarea class="form-control" name="ship_landmark" id="landmark"><?php echo $row_sel['landmark']; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <input type="submit" class="btn form-control" name="Submit" id="submit_bill">
    </div>
</form>