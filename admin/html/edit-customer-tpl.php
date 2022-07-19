<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit User Details</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <?php
                if (isset($_SESSION['succ-pass'])) {
                    ?>
                    <span class="success"><?php echo $_SESSION['succ-pass']; ?></span>
                    <?php
                    unset($_SESSION['succ-pass']);
                }
                ?>
                <form method="POST" action="edit-function-customer.php" id="passwordForm">
                    <input type="hidden" name="cust_id" value="<?php echo $customer_id; ?>" class="form-control" required>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Firstname:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Lastname:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Email Id:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Lasttname:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Enter Password:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Re-Enter Password:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="password" name="re_password" id="re_password" class="form-control" value="<?php echo $password; ?>" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Active:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="checkbox" name="status_change" id="status_change" <?php if($status == 0){ ?> checked <?php } ?> value="0">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">

                        </div>  
                        <div class="col-md-4">
                            <input type="submit" value="Update Information" class="btn btn-info">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                </form>

            </div>
        </div>
    </div>
</div>