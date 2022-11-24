<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Artist</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <br>
                <a class="btn btn-info" href="exhibition-artists.php">Back to Artist List</a>
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
                                <label for="pname">Artist Name</label>
                                <input type="text" class="form-control" id="exname" name="artistname" required="">
                            </div>
                            <div class="form-group">
                                <label for="tags">About the artist</label>
                                <textarea class="form-control" rows="3" name="desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">About the artist</label>
                                <textarea class="form-control" rows="3" name="desc2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">About the artist</label>
                                <textarea class="form-control" rows="3" name="desc3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tags">Year of birth</label>
                                <input type="text" class="form-control" name="birth">
                            </div>

                            <div class="form-group">
                                <label for="tags">Year of death</label>
                                <input type="text" class="form-control" name="death">
                            </div>

                            <div class="form-group">
                                <label for="tags">Photo</label>
                                <input name="ImageFile" type="file"  class="btn btn-success">
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


