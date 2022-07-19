<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Change Password</h3>
        </div>
        <div class="panel-body">

            <form id="update-account-form" role="form" method="post">
                <div class="form-group">
                    <label for="opasswd">Old Password</label>
                    <input type="password" class="form-control" id="opasswd" name="opasswd" required>
                </div>
                <div class="form-group">
                    <label for="npasswd">New Password</label>
                    <input type="password" class="form-control" name="npasswd" id="npasswd" required>
                </div>
                <div class="form-group">
                    <label for="cpasswd">Confirm Password</label>
                    <input type="password" class="form-control" name="cpasswd" id="cpasswd" required>
                </div>


                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
</div>