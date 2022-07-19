<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Email Log</h3>
        </div>
        <?php
        if (isset($_SESSION['error-delete'])) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['error-delete'] ?></div>
            <?php
            unset($_SESSION['error-delete']);
        }
        ?> 
        <?php
        if (isset($_SESSION['succ-delete'])) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['succ-delete'] ?></div>
            <?php
            unset($_SESSION['succ-delete']);
        }
        ?> 
        <h3 >Delete Log</h3>
        <form method="post" action="delete-access.php">
            <div class="col-md-8">
                <div class="col-md-4">
                    <label>From:</label>
                </div> 
                <div class="col-md-4"> 
                    <input type="date" name="from-range" class="form-control">
                </div>  
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-8">
                <div class="col-md-4">
                    <label>To:</label>
                </div> 
                <div class="col-md-4">  
                    <input type="date" name="to-range" class="form-control">
                </div>  
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-8">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Delete</button>
                </div>
            </div>
        </form>
        <div class="panel-body">
            <div role="tabpanel">
<!--                <form method="post" action="<?php // echo $_SERVER["PHP_SELF"]            ?>">-->
                <h2 class="sub-header">Access Log</h2>
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>IP</th>
                                <th>Link</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Details</th>
                                <th>Date</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($alog_list)): ?>
                                <?php
                                $i = 1;
                                foreach ($alog_list as $k => $v):
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $v['ip']; ?></td>
                                        <td><?php echo $v['link']; ?></td>
                                        <td>
                                            <?php
                                            if ($v['type'] == 'memoribilia')
                                                echo 'Memoribilia';
                                            if ($v['type'] == 'memoribilia_image')
                                                echo 'Memoribilia Image';
                                            if ($v['type'] == 'bibliography')
                                                echo 'Bibliography';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($v['type'] == 'memoribilia' || $v['type'] == 'bibliography') {
                                                $al_prod = get_prod_name($v['prod_id']);
                                                echo $al_prod['prodname'];
                                            }
                                            if ($v['type'] == 'memoribilia_image') {
                                                $mem_img = get_image_name($v['prod_id']);
                                                ?>
                                                <img src="<?php echo SITE_URL . '/product_images/' . strtolower($mem_img['m_image_category_text']) . '/' . $mem_img['m_image_name']; ?>" style="height: 80px; width: 80px;">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            if ($v['type'] == 'memoribilia_image') {
                                                $mem_img_det = get_image_name($v['prod_id']);
                                                $det_prod = get_prod_name($mem_img_det['product_id']);
                                                ?>
                                                Image Type: <?php echo $mem_img_det['m_image_category_text'] ?><br>
                                                Product:  <?php echo $det_prod['prodname'] ?>
                                                <?php
                                            }
                                            ?></td>
                                        <td><?php echo $v['date']; ?></td>

                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!--                </form>-->
            </div>
        </div>
    </div>
</div>