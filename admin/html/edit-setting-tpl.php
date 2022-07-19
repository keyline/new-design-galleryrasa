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
                <form method="POST" action="edit-function-setting.php" id="passwordForm" enctype="multipart/form-data">
                    <input type="hidden" name="set_id" value="<?php echo $id; ?>" class="form-control" required>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>User:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="user" value="<?php echo $user; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Password:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="hidden" name="old_pass" value="<?php echo $pass; ?>" class="form-control" required>
                            <input type="password" name="pass" value="<?php echo $pass; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Email Id:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" required>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Tax:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="tax" value="<?php echo $tax; ?>" class="form-control" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Conversion Rate:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="conv_rate" value="<?php echo $conv_rate; ?>" class="form-control" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Website Name:</label>
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="website_name" value="<?php echo $website_name; ?>" class="form-control" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Logo:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="file" name="logo" class="form-control">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Home Archive Animation:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="text" name="arc_anim" value="<?php echo $arc_anim; ?>" class="form-control">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Artwork Credit Dayspan:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="text" name="credit_dayspan" id="re_password" class="form-control" value="<?php echo $credit_dayspan; ?>" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Credit Value(In Rupees):</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="text" name="credit_value" id="re_password" class="form-control" value="<?php echo $credit_value; ?>" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    
                    
                    
                    
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Maximum Download Count(To Send Email):</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="text" name="max_download_mail_send" id="re_password" class="form-control" value="<?php echo $max_download_mail_send ?>" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    
                    
                    
                    
                    
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Keyword:</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="text" name="keyword" id="re_password" class="form-control" value="<?php echo $keyword; ?>" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-8">
                        <div class="col-md-4">
                            <label>Description</label>
                        </div>  
                        <div class="col-md-4">
                            <input type="text" name="description" id="re_password" class="form-control" value="<?php echo $description; ?>" >
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