
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Exhibition</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <br>
                <a class="btn btn-info" href="exhibition-list.php">Back to Exhibiiton List</a>
                <br>
                
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

                <form id="add-new-form" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>

                            <div class="form-group">
                                <label for="pname">Exhibition Name</label>
                                <textarea class="form-control ckeditor" id="exname" name="exname" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Essay1</label>
                                <textarea class="form-control ckeditor" rows="3" name="desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Essay2</label>
                                <textarea class="form-control ckeditor" rows="3" name="desc2"></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="tags">Essay3</label>
                                <textarea class="form-control ckeditor" rows="3" name="desc3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tags">Photo</label>
                                <input name="ImageFile" type="file"  class="btn btn-success">
                            </div>


                            <div class="form-group">
                                <label for="tags">Start Exhibition Date</label>
                                <input type="datetime-local" class="form-control" id="start_exdate" name="start_exdate">
                            </div>

                            <div class="form-group">
                                <label for="tags">End Exhibition Date</label>
                                <input type="datetime-local" class="form-control" id="end_exdate" name="end_exdate">
                            </div>

                            <div class="form-group">
                                <label for="tags">Exhibition City</label>
                                <input type="text" class="form-control" id="excity" name="excity">
                            </div>

                            <div class="form-group">
                                <label for="tags">Full Address</label>
                                <textarea class="form-control" rows="2" name="exfull_address"></textarea>
                            </div>

                            <!-- <div class="form-group">
                                <label for="stock">Exhibition Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Open</option>
                                    <option value="0">Archived</option>
                                    <option value="2">Canceled</option>
                                </select>
                            </div> -->


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


