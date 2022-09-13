<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Podcast</h3>
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
                <form id="add-new-form" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>&nbsp;</p>
                            <div class="form-group">
                                <label for="pname">Press Name</label>
                                <input type="text" class="form-control" id="pressname" name="pressname" required="">
                            </div>
                            <div class="form-group">
                                <label for="pname">Date</label>
                                <input type="date" class="form-control" id="pressdate" name="pressdate" required="">
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


