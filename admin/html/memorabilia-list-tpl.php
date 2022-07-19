<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Memorabilia Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h2 class="sub-header">Products List</h2>
                    <a href="add-new-product" class="btn btn-info">Add New</a>
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
                                    <th>#PrID</th>
                                    <th>Film name</th>
                                    <th>Poster/Card/Synopsis</th>
                                    <th>Edit Film</th>
                                    <th>Video</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Manage Attribute</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_list)): ?>
                                    <?php foreach ($product_list as $k => $v): ?>

                                        <tr id="rw<?php echo $v['prodid'] ?>">
                                            <td><?php echo $v['prodid'] ?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['count']; ?>
                                                &nbsp; &nbsp;<a href="edit-product.php?id=<?php echo $v['prodid']; ?>"><span
                                                        class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                                            </td>
                                            <td>                
                                                <a href="edit-product-name.php?prod_id=<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>  
                                            </td>
                                            <td>                
                                                <a href="video.php?prod_id=<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                                    <?php
                                                    $qry_sel = "select * from video where product_id = '".$v['prodid']."'";
                                                    $q_sel = $conn->prepare($qry_sel);
                                                    $q_sel->execute();
                                                    $q_sel->setFetchMode(PDO::FETCH_ASSOC);
                                                    $count_sel = $q_sel->rowCount();
                                                    echo $count_sel > 0 ? '/ 1' : '/ 0';
                                                    ?>  
                                            </td>
                                            <td><?php echo $v['stockt'] ?></td>
                                            <td><input id="<?php echo $v['prodid'] ?>" name="pstat" type="checkbox" data-on-text="Live"
                                                       data-size="mini" data-off-color="warning"
                                                       data-on-color="success" <?php echo $v['status'] ?>></td>
                                            <td>
                                                <a href="add-delete-attribute.php?prod_id=<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a>  
                                            </td>
                                            <td> 
                                                <a href="delete-memorabilia?prod_id=<?php echo $v['prodid']; ?>&prod_name=<?php echo $v['name']; ?>"><span id="del_product" data-id="<?php echo $v['prodid'] ?>"
                                                                                                                                                           class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></a>


                                                &nbsp;
                                                &nbsp;
                                                <a target="_blank"
                                                   href="../memorabilia-details/<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-globe" aria-hidden="true"></span></a>
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