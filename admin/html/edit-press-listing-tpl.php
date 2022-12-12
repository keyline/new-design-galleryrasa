<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit article </h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

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
                <!-- Nav tabs -->

                <!-- Tab panes -->
                

                <form id="add-new-form" role="form" action="db-edit-article.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>  
                            <div class="form-group">
                            <label for="pname">Press Name</label>
                                <select class="form-control js-example-basic-multiple" name="pressid">  
                                    <?php                                                      foreach ($allpress as $k1 => $v1) {?>                

                                            <option value="<?php echo $v1['press_id'] ?>"<?php echo $v1['press_id'] == $img['press_id'] ? 'selected' : '';?>><?php echo $v1['press_name'] ?></option>
                                            <?php
                                        }
                                    
                                    ?>
                                </select>
                            </div>                          
                            <div class="form-group">
                                <label for="pname">Article Name</label>
                                <input type="hidden" name="articleid" value="<?php echo $img['img_id'] ?>">
                                <input type="text" class="form-control" id="pressname" name="articlename" required value="<?php echo $img['title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Image</label>
                                <input name="OldImageFile" type="hidden" value="<?php echo $img['title_img']; ?>" class="btn btn-success">
                                <input name="ImageFile" type="file"  class="btn btn-success">
                                <?php
                                if ($img['title_img'] != '') {
                                    ?>
                                    <img src="<?php echo SITE_URL . '/' . PRESS_THUMB_IMGS . $img['title_img']; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="tags">Date</label>
                                <input type="date" class="form-control" id="pressdate" name="articledate" value="<?php echo $img['create_at']; ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <input type="submit" value="Submit" class="btn btn-default">
                                </div> 

                            </div>
                        </div>

                    </div>
                </form> 
            </div>
        </div>
    </div>