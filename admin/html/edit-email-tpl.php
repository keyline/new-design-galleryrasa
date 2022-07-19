<style>
    .side{
        position:fixed;
        top:0;
        left:0;
        height:100%;
        padding:0;
    }

    .scroll-area{
        width:100%;
        height:200px;
        margin-top:50px;
        background-color:#f5f5f5;
        float:left;
        overflow-y:scroll;
    }
</style>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Email Template</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <?php
                if (isset($_SESSION['succ-email'])) {
                    ?>
                    <span class="success"><?php echo $_SESSION['succ-email']; ?></span>
                    <?php
                    unset($_SESSION['succ-email']);
                }
                ?>
                <form method="POST" action="edit-function-email.php" id="passwordForm">
                    <input type="hidden" name="email_id" value="<?php echo $email_id; ?>" class="form-control" required>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Email Template Name:</label>
                        </div> 
                        <div class="col-md-9">
                            <strong><?php echo $email_name; ?></strong>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Receiver:</label>
                        </div> 
                        <div class="col-md-9">
                            <strong><?php echo $receiver; ?></strong>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Subject:</label>
                        </div> 
                        <div class="col-md-9">
                            <input type="text" name="subject" value="<?php echo $subject; ?>" >
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Content:</label>
                        </div> 
                        <div class="col-md-9">
                            <textarea name="email_content" id="editor1">
                                <?php echo htmlspecialchars_decode($content); ?>
                                <?php //echo $content; ?>
                            </textarea>
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <div class="col-md-12">
                        <div class="col-md-3">

                        </div>  
                        <div class="col-md-9">
                            <input type="submit" value="Update Template" class="btn btn-info">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <br>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div style="position:relative;width:100%;height:100%;">
                        <div class="scroll-area">
                            <br>
                            <h3>Email Keyword Guide</h3>
                            <br>
                            <strong>{name}</strong> - Name of the Customer<br>
                            <strong>{order_id}</strong> - Order id<br>
                            <strong>{amount}</strong> - Total ordered amount<br>
                            <strong>{pay_method}</strong> - Payment Method<br>
                            <strong>{ord_prod}</strong> - Ordered products<br>
                            <strong>{delivery_address}</strong> - Delivery Address<br>
                            <strong>{customer_email}</strong> - Customer Email<br>
                            <strong>{password}</strong> - Customer Password<br>
                            <strong>{order_date}</strong> - Order Date<br>
                            <strong>{order_status}</strong> - Order Status<br>
                            <strong>{order_comment}</strong> - Comments provided by Admin for a Particular Order<br>
                            <strong>{forgot_link}</strong> - Forget Password Link<br>
                                 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>