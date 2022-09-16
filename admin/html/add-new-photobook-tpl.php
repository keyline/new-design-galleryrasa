<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Photo Book</h3>
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
                                <label for="pname">Event Title</label>
                                <input type="text" class="form-control" id="eventtitle" name="eventtitle" placeholder="Enter Event name" required="">
                            </div>
                            <div class="form-group">
                                <label for="pname">Event Details</label>
                                <input type="text" class="form-control" id="eventtitle" name="eventdetails" placeholder="Enter Event Details" required="">
                            </div>
                            <div class="form-group">
                                <label for="tags">Event Image</label>
                                <input name="eventImg" type="file"  class="btn btn-success">
                            </div>
                            <div class="form-group">
                                <label for="pname">Event Date</label>
                                <input type="date" class="form-control" id="eventdate" name="eventdate" required="">
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


