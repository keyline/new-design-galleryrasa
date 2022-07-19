<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Artwork</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h2 class="sub-header">Artist List</h2>
                    
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
                                    <th>Sl No</th>
                                    <th>Artist Name</th>
                                    <th>Artwork</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($profile_list)): ?>
                                    <?php 
                                    $i=1;
                                    foreach ($profile_list as $k => $v): ?>

                                        <tr>
                                            <td style="text-align: left;"><?php echo $i; ?></td>
                                            <td style="text-align: left;"><?php echo $v['p_name'] ?></td>

                                            <td style="text-align: left;"> 
                                                <a href="add-artwork?people_id=<?php echo $v['attr_value_id']; ?>&people_name=<?php echo $v['p_name']; ?>"><span id="del_product" data-id="<?php echo $v['profile_id'] ?>"
                                                                 class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            </td>
                                            
                                        </tr>
                                    <?php 
                                    $i++;
                                    endforeach; ?>
                                <?php endif; ?>



                            </tbody>
                        </table>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>