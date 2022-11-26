<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Exhibition</h3>
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

                <form id="add-new-form" role="form" action="db-edit-exhibition.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

                            <div class="form-group">
                                <label for="pname">Exhibition Name</label>
                                <input type="hidden" name="exhibition" value="<?php echo $exhibitionarr['id'] ?>">
                                <textarea class="form-control ckeditor" id="exname" name="exname" required=""><?php echo $exhibitionarr['exhibition_name']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Essay1</label>
                                <textarea class="form-control ckeditor" rows="3" name="desc"><?php echo $exhibitionarr['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Essay2</label>
                                <textarea class="form-control ckeditor" rows="3" name="desc2"><?php echo $exhibitionarr['essay_2'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Essay3</label>
                                <textarea class="form-control ckeditor" rows="3" name="desc3"><?php echo $exhibitionarr['essay_3'] ?></textarea>
                            </div>



                            <div class="form-group">
                                <label for="tags">Photo</label>
                                <input name="OldImageFile" type="hidden" value="<?php echo $exhibitionarr['photo']; ?>" class="btn btn-success">
                                <input name="ImageFile" type="file"  class="btn btn-success">
                                <?php
                                if ($exhibitionarr['photo'] != '') {
                                    ?>
                                    <img src="<?php echo SITE_URL . '/' . EXHIBITION_THUMB_IMGS . $exhibitionarr['photo']; ?>">
                                    <?php
                                }
                                ?>
                            </div>


                            <div class="form-group">
                                <label for="tags">Start Exhibition Date</label>
                                <input type="datetime-local" class="form-control" id="start_exdate" name="start_exdate" value="<?php echo $exhibitionarr['from_exhibition_date'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">End Exhibition Date</label>
                                <input type="datetime-local" class="form-control" id="end_exdate" name="end_exdate" value="<?php echo $exhibitionarr['end_exhibition_date'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Exhibition City</label>
                                <input type="text" class="form-control" id="excity" name="excity" value="<?php echo $exhibitionarr['city'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tags">Full Address</label>
                                <textarea class="form-control" rows="2" name="exfull_address"><?php echo $exhibitionarr['full_address'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="stock">Exhibition Status</label>
                                <select class="form-control" name="status">
                                    <option value="?php echo $exhibitionarr['status'] ?>">
                                        <?php
                                        if ($exhibitionarr['status'] == '1') {
                                            echo 'Archived';
                                        } else if ($exhibitionarr['status'] == '0') {
                                            echo 'Open';
                                        } else {
                                            echo 'Canceled';
                                        }
                                        ?>
                                    </option>                                    
                                    <option value="0">Open</option>
                                    <option value="1">Archived</option>
                                    <option value="2">Canceled</option>
                                </select>
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