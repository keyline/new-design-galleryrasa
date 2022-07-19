<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
             <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                <h2 class="sub-header">Products List</h2>

                <div class="table-responsive">
               
                    <table class="table table-striped" id="example">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Hits</th>
                            <th>Discount</th>
			   <th>Stock</th>
		          <th>Status</th>
                            <th>Action</th>
                              <th>Feature</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($product_list)): ?>
                        <?php foreach ($product_list as $k => $v): ?>

                        <tr id="rw<?php echo $v['prodid'] ?>">
                            <td><?php echo $v['img'] ?></td>
                            <td><?php echo $v['name'] ?></td>
                            <td><?php echo $v['price'] ?></td>
                            <td><?php echo $v['views'] ?></td>
                            <td><?php echo $v['discount'] ?>%</td>
			   <td><?php echo $v['stockt'] ?></td>
			  <td><input id="<?php echo $v['prodid'] ?>" name="pstat" type="checkbox" data-on-text="Live"
                                       data-size="mini" data-off-color="warning"
                                       data-on-color="success" <?php echo $v['status'] ?>></td>
                            <td><a href="edit-product.php?id=<?php echo $v['prodid'] ?>"><span
                                        class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp; &nbsp;
                                <span id="del_product" data-id="<?php echo $v['prodid'] ?>"
                                      class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>&nbsp;
                                &nbsp;
                                <a target="_blank"
                                   href="../pdetails/<?php echo $v['prodid'] ?>/<?php echo $v['lnk_name'] ?>"><span
                                        class="glyphicon glyphicon-globe" aria-hidden="true"></span></a>
                            </td>
                            <td><input type="checkbox" name="feature[]" value="<?php echo $v['prodid'] ?>"></td>
                              </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>

                      

                        </tbody>
                    </table>
         
                </div>
                <div class="row">
  <div class="col-md-9">    <?php echo $pages['nav'] ?> </div>
   <div class="col-md-3"><br /><button type="submit" class="btn btn-primary">Feature Selected</button></div>
</div>
            
           </form>

            </div>
        </div>
    </div>
</div>