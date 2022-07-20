<?php
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
include(INC_FOLDER . "headerInc.php");
?>
<main>
<div class="container arial">

    <?php
    if (isset($_SESSION['forgot-error'])) {
        ?>
        <span class="label-danger"><?php echo $_SESSION['forgot-error']; ?></span>
        <?php
        unset($_SESSION['forgot-error']);
    }
    ?>
    <form method="POST" action="forget-check.php" class="forgot-pass">
        <div class="row justify-content-center text-center">
            <div class="col-md-4">
                <h3>Forgot Password</h3>
                <div class="form-group">
                    <label>Type your registered Email <strong>*</strong></label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
                    <input type="submit" class="btn form-control" value="Reset">
            </div>
        </div>
    </form>


</div>
</main>
<?php
include(INC_FOLDER . "footerInc.php");
?>