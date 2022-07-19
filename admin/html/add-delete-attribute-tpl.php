<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $producttype; ?></h3>

        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <?php
                    $i = 0;
                    foreach ($product_value_list as $k => $v):
                        if ($i == 0) {
                            ?>
                            <h2 class="sub-header"><?php echo $v['product']; ?></h2>
                            <?php
                        } else {
                            continue;
                        }
                        $i++;
                    endforeach;
                    ?>
                    <?php
                    if (isset($_SESSION['succ'])) {
                        ?>
                        <span class="label label-success"><?php echo $_SESSION['succ'] ?></span>
                        <?php
                        unset($_SESSION['succ']);
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['fail'])) {
                        ?>
                        <span class="label label-danger"><?php echo $_SESSION['fail'] ?></span>
                        <?php
                        unset($_SESSION['fail']);
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['succes-add-val'])) {
                        ?>
                        <span class="label label-success"><?php echo $_SESSION['succes-add-val'] ?></span>
                        <?php
                        unset($_SESSION['succes-add-val']);
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['succes-add-val-fail'])) {
                        ?>
                        <span class="label label-danger"><?php echo $_SESSION['succes-add-val-fail'] ?></span>
                        <?php
                        unset($_SESSION['succes-add-val-fail']);
                    }
                    ?>   
                    <?php
                    if (isset($_SESSION['succes-del-val'])) {
                        ?>
                        <span class="label label-success"><?php echo $_SESSION['succes-del-val'] ?></span>
                        <?php
                        unset($_SESSION['succes-del-val']);
                    }
                    
                    ?>
                        
                    <div class="table-responsive">

                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>Attribute Name</th>
                                    <th>Values</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_value_list)): ?>
                                    <?php foreach ($product_value_list as $k => $v): ?>

                                        <tr id="rw<?php echo $v['prod_id'] ?>">
                                            <td style="text-align: left;"><?php echo $v['alias'] ?></td>
                                            <td style="text-align: left;"><?php echo $v['value'] ?></td>

                                            <td>
                                                <a href="add-attribute.php?prod_id=<?php echo $v['prod_id'] ?>&attr_value_id=<?php echo $v['value_id'] ?>&alias=<?php echo $v['alias'] ?>&attribute_id=<?php echo $v['attribute_id'] ?>&attr_value=<?php echo $v['value'] ?>&type=<?php echo $inputvalue ?>"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                            </td>


                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>

            </div>




            <h3>New Attribute Values To Add</h3>



            <div role="tabpanel">

                <div class="table-responsive">

                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Attribute Name</th>
                                <th>Values</th>
                                <th>Add Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($attr_list)): ?>
                                <?php foreach ($attr_list as $k2 => $v2): ?>

                                    <tr id="rw<?php echo $v2['prod_id'] ?>">
                                        <td style="text-align: left;"><?php echo $v2['name_alias'] ?></td>
                                        <td style="text-align: left;"><?php echo $v2['value'] ?></td>

                                        <td>
                                            <a href="add-new-attribute-value.php?prod_id=<?php echo $prod_id ?>&alias=<?php echo $v2['name_alias'] ?>&attribute_id=<?php echo $v2['attrid'] ?>&type=<?php echo $inputvalue ?>"><span
                                                    class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>












        </div>
    </div>
</div>