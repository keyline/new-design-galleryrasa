<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Visual Archive Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h2 class="sub-header">Products List</h2>
                   
                    <div class="category-choice">
                        <label>Choose by Category </label>
                        <?php
//                        $optionsHtml ='';
//                        foreach ($selectOptions AS $k => $v){ 
//                            //$class = ($subcategory_id == $option['id']) ? 'active !important' : '';
//                            //$optionsHtml .= '<a class="btn btn-primary '. $class . '" href="manage-bibliography?catg='.$option['id'] .'">'. ucwords($option['name']) . '</a>&nbsp;';
//                            $optionsHtml .= '<a class="btn btn-primary " href="visual-archive?atrvalid='.$v['attr_value_id'] .'">'. ucwords($v['value']) . '</a>&nbsp;';
//                            
//                        }
//                       echo $optionsHtml;
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

                                    <th>Edit Archivist Remarks</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_list)): ?>
                                    <?php foreach ($product_list as $k => $v): ?>

                                        <tr id="rw<?php echo $v['prodid'] ?>">
                                            <td><?php echo $v['prodid'] ?></td>
                                            <td><?php echo strtoupper($v['name']) . " (" . $v['pagination'] . ")"; ?> </td>
                                                  
                                            <td>
                                                <a href="edit-archivist-remarks.php?prod_id=<?php echo $v['prodid'] ?>"><span
                                                        class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a>  
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