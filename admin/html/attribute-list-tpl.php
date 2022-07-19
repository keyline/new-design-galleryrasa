<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Memorabilia Products</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h2 class="sub-header">Attribute List</h2>
                    <div class="table-responsive">
                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($attribute_list)): ?>
                                    <?php foreach ($attribute_list as $k => $v): ?>

                                        <tr id="rw<?php echo $v['id'] ?>">
                                            <td><?php echo ucfirst($v['attr_name']); ?></td>

                                            <td>                
                                                <a href="list-attr-value.php?attr_id=<?php echo $v['id'] ?>"><span
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