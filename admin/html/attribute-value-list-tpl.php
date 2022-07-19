<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php
                if (isset($_GET['type'])) {
                    if ($_GET['type'] == 'vi') {
                        $type = 'mb';
                        echo 'Visual Archive Products';
                    }
                } else {
                    $type = 'mb';
                    echo 'Memorabilia Products';
                }
                ?>

            </h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <?php
                if (isset($_SESSION['succes-add'])) {
                    ?>
                    <span class="success"><?php echo $_SESSION['succes-add'] ?></span>

                    <?php
                    unset($_SESSION['succes-add']);
                }
                ?>
                <?php
                if ($_GET['attr_id'] == '206') {
                    ?>
                    <h4>Add Attribute Value</h4>
                    <form method="post" action="db-add-vi-attr.php">
                        <input type="hidden" name="type" value="<?php echo $type; ?>">
                        Enter Descriptive Tag: <input type="hidden" name="attrid" value="<?php echo $_GET['attr_id']; ?>">
                        <input type="text" name="attrval"  required="">
                        <input type="submit" value="Add" class="btn btn-sm btn-info">
                    </form>
                    <?php
                }
                ?>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h2 class="sub-header">Attribute Value List</h2>
                    <br>

                    <br>
                    <div class="table-responsive">

                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <?php
                                    if ($attr_id == '197' || $attr_id =='205') {
                                        ?>
                                        <th>Product</th>
                                        <?php
                                    }
                                    ?>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($attribute_value_list)): ?>
                                    <?php foreach ($attribute_value_list as $k => $v): ?>

                                        <tr id="rw<?php echo $v['id'] ?>">

                                            <td><?php echo $v['value'] ?></td>
                                            <?php
                                            if ($attr_id == '197'|| $attr_id =='205') {
                                                ?>
                                                <td><?php echo $v['prodid'] . '(' . $v['prodname'] . ')' ?></td>
                                                <?php
                                            }
                                            ?>

                                            <td>
                                                <a href="edit-value.php?att_id=<?php echo $v['attr_id'] ?>&attr_value_id=<?php echo $v['id'] ?>&type=<?php echo $type; ?>"><span
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
        </div>
    </div>
</div>