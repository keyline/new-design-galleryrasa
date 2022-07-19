<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

$email_id = $_GET['email_id'];
try {
    $sql = "select * from "
            . "email_template where id = '$email_id'";
    $q = $conn->prepare($sql);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $count = $q->rowCount();
    $row = $q->fetch();

    $email_id = $row['id'];
    $email_name = $row['email_name'];
    $receiver = $row['receiver'];
    $subject = $row['subject'];
    $content = $row['content'];
    $status = $row['status'];
} catch (PDOException $pe) {
    echo db_error($pe->getMessage());
}

include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . 'edit-email-tpl.php');
?>


<?php
include(ADMIN_HTML . "admin-footerInc.php");
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/admin/plugins/ckeditor/ckeditor.js"></script>


<script language="javascript" type="text/javascript">
    window.onload = function () {
        CKEDITOR.replace('editor1');
    };
</script>