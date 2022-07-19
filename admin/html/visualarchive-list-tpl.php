<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Visual Archive Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h2 class="sub-header">Products List</h2>
                    <a href="add-new-product" class="btn btn-info">Add New</a>
                    <div class="category-choice">
                        <label>Choose by Category </label>
                        <?php
                        $optionsHtml ='';
                        foreach ($selectOptions AS $k => $v){ 
                            //$class = ($subcategory_id == $option['id']) ? 'active !important' : '';
                            //$optionsHtml .= '<a class="btn btn-primary '. $class . '" href="manage-bibliography?catg='.$option['id'] .'">'. ucwords($option['name']) . '</a>&nbsp;';
                            $optionsHtml .= '<a class="btn btn-primary " href="visual-archive?atrvalid='.$v['attr_value_id'] .'">'. ucwords($v['value']) . '</a>&nbsp;';
                            
                        }
                       echo $optionsHtml;
?>
                        
                    </div>
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
                                    <th>Name of the Art Work</th>
                                    <th>Credit</th>
                                    <th>Images</th>
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
                                            <td><?php echo strtoupper($v['name']) . " (" . $v['pagination'] . ")"; ?> &nbsp; 
                                                <a href="edit-product-name.php?prod_id=<?php echo $v['prodid'] ?>&type=va"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                                                        
                                             <td><a href="edit-vaproduct-credit.php?prod_id=<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>           
                                                        
                                                        
                                            <td><?php echo $v['count']['count_fid']; ?>
                                                &nbsp; &nbsp;<a href="edit-va-product.php?id=<?php echo $v['prodid']; ?>"><span
                                                        class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                                            </td>
                                            
                                            
                                            <td><input id="<?php echo $v['prodid'] ?>" name="pstat" type="checkbox" data-on-text="Live"
                                                       data-size="mini" data-off-color="warning"
                                                       data-on-color="success" <?php echo $v['status'] ?>></td>
                                            <td>
                                                <a href="add-delete-attribute.php?prod_id=<?php echo $v['prodid'] ?>&type=va"><span
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