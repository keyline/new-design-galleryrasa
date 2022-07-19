<?php 
require_once("require.php");
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();

$title = "{MAIN_TITLE}";
require_once(INCLUDED_FILES ."headerInc.php");
?>

<div class="container">
<div class="row">
 <div class="col-md-8 col-md-offset-2 page_text_size">
   <div class="page-header">
 <h1 class="text-primary">{MAIN_TITLE}</h1>
 </div>

{CONTENT}

</div>

</div>
<p>&nbsp;</p>
</div>

<?php require_once("includes/footerInc.php"); ?>