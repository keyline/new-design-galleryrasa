<?php

require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");

$conn = dbconnect();

$adminsettingarr = get_admin_setting();
if (isset($_POST['adv_submit_form1'])) {
    include_once 'va-adv-search-form1.php';
} elseif (isset($_POST['adv_submit_form2'])) {
    include_once 'va-adv-search-form2.php';
} elseif (isset($_POST['adv_submit_form3'])) {
    include_once 'va-adv-search-form3.php';
} elseif (isset($_POST['adv_submit_form4'])) {
    include_once 'va-adv-search-form4.php';
} elseif (isset($_POST['adv_submit_form5'])) {
    include_once 'va-adv-search-form5.php';
} else {
    print "<pre>";
    print_r($_POST);
    exit();
}


?>
<script>
    function confirmFunction() {
        var txt;
        var r = confirm("Are you sure you want to spent credit to view this artwork!");
        if (r == true) {
            //txt = "You pressed OK!";
        } else {
            //txt = "You pressed Cancel!";
            event.preventDefault();
        }

    }
</script>


<script>
    (function ($) {
        $(document).on('contextmenu', 'img', function () {
            return false;
        })
    })(jQuery);
</script>