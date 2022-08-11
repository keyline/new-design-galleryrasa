<?php

require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
require_once("../" . INCLUDED_FILES . "pdo-debug.php");
check_auth_admin();
$conn = dbconnect();

$podcast_thumb_destination = '../' . PODCAST_THUMB_IMGS;
$podcast_destination = '../' . 'podcast' . '/';

$episode_id = $_GET['episode_id'];

$episode = singlepodcast($episode_id);



include(ADMIN_HTML . "admin-headerInc.php");
include(ADMIN_HTML . "edit-podcast-tpl.php");
include(ADMIN_HTML . "admin-footerInc.php");
