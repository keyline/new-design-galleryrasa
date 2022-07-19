<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Change Email</h3>
        </div>
        <div class="panel-body">

            <form id="update-email-form" role="form" method="post">
                <div class="form-group">
                    <label for="passwd">Enter Password</label>
                    <input type="password" class="form-control" name="passwd" id="passwd" required>
                </div>

                <div class="form-group">
                    <label for="email">Enter New Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>" id="email"
                           required>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
</div>