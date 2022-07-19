<?php
/* Project Name: e-Com Cart
 * Author: LobisDev
 * Author URI: http://www.lobisdev.one/ecom-cart
 * Author e-mail: admin@lobisdev.one
 * Created: Nov 2015
 * License: http://codecanyon.net/
 */
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

   $qry = "SELECT * FROM " . PAGES_TBL." WHERE id=:id";
   try {
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_POST['pid'], PDO::PARAM_INT);
            $q->execute();
	    $row = $q->fetch();
            if ($q->rowCount() > 0){ 
     /*
            	if(file_exists('../'.$row['page_link'].'.php')) {
            		            		unlink('../'.$row['page_link'].'.php');
	        
	       }
          
           $qry = "DELETE FROM " . PAGES_TBL." WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_POST['pid'], PDO::PARAM_INT);
            $q->execute();
	   save_pages($conn); 
	   */
	    goto_location('pages');
            	}
            	  } catch (PDOException $pe) {

          echo db_error($pe->getMessage());

    }
 
} else {
	 try {
	$get_id=(isset($_GET['id'])) ? (true):(false);
	$name=$id='';
	if($get_id) {
	
          $qry = "SELECT * FROM " . PAGES_TBL." WHERE id=:id";
            $q = $conn->prepare($qry);
            $q->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $q->execute();
	    $row = $q->fetch();
            if ($q->rowCount() > 0){
	  	$name=stripslashes(ucwords($row['page_name']));	
		$pid=$_GET['id'];
		$action_page='page-delete';
		$return_page='pages';
	  }
      }

	    } catch (PDOException $pe) {

          echo db_error($pe->getMessage());

    }
    include(ADMIN_HTML . "admin-headerInc.php");
     include(ADMIN_HTML . "page-delete.tpl.php");
    include(ADMIN_HTML . "admin-footerInc.php");
}

?>  