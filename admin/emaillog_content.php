<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

//if ($_SERVER['REQUEST_METHOD'] == "POST") {
//    print "<pre>";
//    print_r($_REQUEST);
//} else {
$log_id = $_GET['log_id'];
try {
    $sql = "select * from "
            . "email_log where id = '$log_id'";
    $q = $conn->prepare($sql);
    //$category_id = 2;

    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    $row = $q->fetch();

    $id = $row['id'];
    $email = $row['email'];
    $email_name = $row['email_name'];
    $subject = $row['subject'];
    $text = $row['text'];
    $date = $row['date'];
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}

include(ADMIN_HTML . "admin-headerInc.php");
?>
<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Email Log</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
                <?php
                if (isset($_SESSION['mail-success'])) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION['mail-success'] ?></div>
                    <br>
                    <?php
                    unset($_SESSION['mail-success']);
                }
                ?> 
                    <?php
                if (isset($_SESSION['mail-fail'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION['mail-fail'] ?></div>
                    <br>
                    <?php
                    unset($_SESSION['mail-fail']);
                }
                ?> 
                <h2 class="sub-header">Email</h2>
                <br>
                <p><strong>Email ID</strong>: <?php echo $email; ?><br></p>
                <p><strong>Email Name</strong>: <?php echo $email_name; ?><br></p>
                <p><strong>Subject</strong>: <?php echo $subject; ?><br></p>
                <p><strong>Date</strong>: <?php echo $date; ?><br></p>
                <h4>Email Content</h4>
                <?php echo $text; ?>
                <br>
                <form method="post" action="send-mail-again.php">
                    <input type="hidden" name="log_id" value="<?php echo $log_id; ?>">
                    <input type="hidden" name="to" value="<?php echo $email; ?>">
                    <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                    <input type="hidden" name="message" value='<?php echo $text; ?>'>
                    <button type="submit" class="btn btn-info">Send Mail</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include(ADMIN_HTML . "admin-footerInc.php");
//}