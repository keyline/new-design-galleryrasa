<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print "<pre>";
    print_r($_REQUEST);
} else {
    try {

        $sql = "SELECT * FROM exhibition WHERE status = 0 ORDER BY from_exhibition_date DESC";
        $q = $conn->prepare($sql);
       
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $count = $q->rowCount();
        while ($row = $q->fetch()) {
            
            $exhibition_list[] = array(
                'id' => $row['id'],
                'exhibition_name' => $row['exhibition_name'],
                'description' => $row['description'],
                'photo' => $row['photo'],
                'from_exhibition_date' => $row['from_exhibition_date'],
                'end_exhibition_date' => $row['end_exhibition_date'],
                'city' => $row['city'],
                'full_address' => $row['full_address'],                
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            );
        }
    } catch (PDOException $pe) {
        echo db_error($pe->getMessage());
    }

    include(ADMIN_HTML . "admin-headerInc.php");
    include(ADMIN_HTML . 'exhibition-list-tpl.php');
    include(ADMIN_HTML . "admin-footerInc.php");
}
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" crossorigin="anonymous"></script>
<script>
    $(function(){
        $('.delete-exhibition').on('click',function(){
        var exhibition = $(this).data('exhibition');
        $('#dialog').dialog('open');
    });

    $('#dialog').dialog({
        autoOpen: false,
        draggable: false,
        width: 400,
        open: function () {                         // open event handler
            $(this)                                // the element being dialogged
                .parent()                          // get the dialog widget element
                .find(".ui-dialog-titlebar-close") // find the close button for this dialog
                .hide();                           // hide it
        },
        buttons: [
            {
                text: "Delete",
                click: function () {
                    //$(this).dialog("close");
                    alert("Delete");
                }
            },
            {
                text: "Archeive",
                click: function () {
                    //$(this).dialog("close");
                    alert("Archeive");
                }
            },

        ]
        
    });
});
    

</script> -->