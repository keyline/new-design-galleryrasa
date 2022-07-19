<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Bibliography Products</h3>
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
                        foreach ($selectOptions['h'] AS $option){ 
                            $class = ($subcategory_id == $option['id']) ? 'active !important' : '';
                            $optionsHtml .= '<a class="btn btn-primary '. $class . '" href="manage-bibliography?catg='.$option['id'] .'">'. ucwords($option['name']) . '</a>&nbsp;';
                            
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
                        <div class="clearfix"></div>
                    <div class="table-responsive">

                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>#PrID</th>
                                    <th>Bibliography name</th>
                                    <th>Attachment</th>
                                    <th>PDF</th>
                                    <th>Edit Bibliography</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Manage Attribute</th>
                                    <th>Action</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_list)): ?>
                                    <?php foreach ($product_list as $k => $v): 
                                        
                                        
                                        ?>

                                        <tr id="rw<?php echo $v['prodid'] ?>">
                                            <td><?php echo $v['prodid'] ?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['count'];?>
                                            &nbsp; &nbsp;<a href="edit-product.php?id=<?php echo $v['prodid']; ?>&section=bibliography"><span
                                                        class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                                            </td>
                                            <td>
                                                
                                                <?php echo $v['pdfcount'];?>
                                                <a href="add-bib-pdf.php?id=<?php echo $v['prodid']; ?>&section=bibliography"><span
                                                        class="glyphicon glyphicon-picture" aria-hidden="true"></span></a></td>
                                            <td>                
                                                <a href="edit-bib-product-name.php?prod_id=<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>  
                                            </td>
                                            
                                            <td><?php echo $v['stockt'] ?></td>
                                            <td><input id="<?php echo $v['prodid'] ?>" name="pstat" type="checkbox" data-on-text="Live"
                                                       data-size="mini" data-off-color="warning"
                                                       data-on-color="success" <?php echo $v['status'] ?>></td>
                                            <td>
                                                <a href="add-delete-attribute.php?prod_id=<?php echo $v['prodid'] ?>&type=bib"><span
                                                        class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a>  
                                            </td>
                                            <td> 
                                                <a href="delete-bibliography?prod_id=<?php echo $v['prodid']; ?>&prod_name=<?php echo $v['name']; ?>"><span id="del_product" data-id="<?php echo $v['prodid'] ?>"
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