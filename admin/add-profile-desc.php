<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();
$people_id = $_GET['people_id'];
//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    print "<pre>";
//    print_r($_REQUEST);
//} else {
try {
    $sql_p = "SELECT * from profile where person_id = '$people_id'";
    $q_p = $conn->prepare($sql_p);
    $q_p->execute();
    $q_p->setFetchMode(PDO::FETCH_ASSOC);
    $count_p = $q_p->rowCount();
    $row = $q_p->fetch();

    $profile_id = $row['id'];
    $person_id = $row['person_id'];
    $image = $row['image'];
    $details = $row['details'];
    $dob = $row['dob'];
    $dod = $row['dod'];
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}

include(ADMIN_HTML . "admin-headerInc.php");
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Profile of <?php echo $_GET['people_name']; ?></h3>
        </div>
        <?php
        if (isset($_SESSION['succ-pr-image'])) {
            ?>
            <span class="label label-success"><?php echo $_SESSION['succ-pr-image'] ?></span>
            <?php
            unset($_SESSION['succ-pr-image']);
        }
        ?>
        <div class="panel-body">

            <form method="POST" action="add-function-profdet.php" id="passwordForm" enctype="multipart/form-data">
                <input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>" class="form-control" required>
                <input type="hidden" name="person_id" value="<?php echo $people_id; ?>" class="form-control" required>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label>Profile Details:</label>
                    </div> 
                    <div class="col-md-8">
                        <textarea name="details" id="editor1" required><?php echo $count_p > 0 ?  htmlspecialchars_decode($details) : ''; ?></textarea>
                    </div>  
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label>Year of Birth:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="dob" value="<?php echo $count_p > 0 ? $dob : ''; ?>" class="form-control" >
                    </div> 
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label>Year of Death:</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="dod" value="<?php echo $count_p > 0 ? $dod : ''; ?>" class="form-control" >
                    </div> 
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit">                   
                    </div> 
                </div>
                <div class="clearfix"></div>
                <br>
            </form>
        </div>
    </div>
</div>
<?php
//include(ADMIN_HTML . 'profile-list-tpl.php');
include(ADMIN_HTML . "admin-footerInc.php");
//}
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/admin/plugins/ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript">
    window.onload = function () {
        CKEDITOR.replace('editor1');
    };
</script>