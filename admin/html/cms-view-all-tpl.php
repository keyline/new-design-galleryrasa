<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Blog</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <h2 class="sub-header">Blog List</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                             <th>Image</th>
                            <th>Title</th>          
                            <th>Created</th>
			      <th>Hits</th>
			       <th>Edit</th>
			      <th>Status</th>
                         </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($article_list)): ?>
                        <?php foreach ($article_list as $k => $v): ?>
                          <tr id="rw<?php echo $v['cid'] ?>">
                            <td><?php echo $v['img'] ?></td>
                            <td><a href="<?php echo SITE_URL.'/view-blog/'.$v['cid'] .'/'.$v['edit'] ?>"><?php echo $v['name'] ?></a></td>
                            <td><?php echo $v['pdate'] ?></td>
                            <td><?php echo $v['views'] ?></td>
                            <td><a href="cms?id=<?php echo $v['cid'] ?>">Edit</a></td>
		             <td><input id="<?php echo $v['cid'] ?>" name="cmstat" type="checkbox" data-on-text="Live"
                                       data-size="mini" data-off-color="warning"
                                       data-on-color="success" <?php echo $v['status'] ?>></td>                          
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </tr>

                        </tbody>
                    </table>
                </div><?php echo $pages['nav'] ?>


            </div>
        </div>
    </div>
</div>