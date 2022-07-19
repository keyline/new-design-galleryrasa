<?php
require_once ("../require.php");
 require_once("../".INCLUDED_FILES."config.inc.php");
  require_once("../".INCLUDED_FILES."dbConn.php");
  require_once("../".INCLUDED_FILES."functionsInc.php");

 $_SESSION=array();
 session_destroy();
goto_location(ADMIN_URL);

?>