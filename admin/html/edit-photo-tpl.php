<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Podcast</h3>
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
                

                <form id="add-new-form" role="form" action="db-edit-photo.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>                            
                            <div class="form-group">
                                <label for="pname">Name</label>
                                <input type="hidden" name="photo" value="<?php echo $photo['event_id'] ?>">
                                <input type="text" class="form-control" id="photoname" name="photoname" required value="<?php echo $photo['event_title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tags">Photo</label>
                                <input name="OldImageFile" type="hidden" value="<?php echo $photo['event_img']; ?>" class="btn btn-success">
                                <input name="ImageFile" type="file"  class="btn btn-success">
                                <?php
                                if ($photo['event_img'] != '') {
                                    ?>
                                    <img src="<?php echo SITE_URL . '/' . PHOTOBOOK_THUMB_IMGS . $photo['event_img']; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="tags">Date</label>
                                <input type="date" class="form-control" id="photodate" name="photodate" value="<?php echo $photo['event_date']; ?>">
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