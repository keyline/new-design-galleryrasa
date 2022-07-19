<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
check_auth_admin();
$conn = dbconnect();

//update****************************************

if(isset($_REQUEST['UpdateADD']) && $_REQUEST['UpdateADD'] == 'Update')
{    
	$columns = array(
                    'title'=> ':pagetitle',
                    'detail'=> ':content',
                    'status'=> ':page_status',
                    'postdate'=> 'now()',
        );
        $bind = array(
            ':pagetitle'=> $_POST['title'],
            ':content'  => $_POST['editor1'],
            ':page_status'=>1
            
        );
        try{
            
            $qry = update(CMS_TBL, $columns, array('cid'=> $_POST['Id']), true);
            
            $q = $conn->prepare($qry);
            $q->execute($bind);
            $count = $q->rowCount();
        } catch (PDOException $pe){
            echo db_error($pe->getMessage());
        }
	
	if ($count) 
	{
		$msg = "Content update successfully."; 
	}
	else 
	{ 
		$msg = "Problem arised in Content updation."; 
	}
	$_SESSION['MESSAGE'] = $msg;
	header('location:list-cms.php');
	exit();
}

// delete*************************************************

if(isset($_REQUEST['Action']) && $_REQUEST['Action'] == 'Delete')
{
	$sql="Delete  from content_cafes where ID = '".$_REQUEST['Id']."';" or die(mysql_error($conn));
	if(mysqli_query($conn,$sql))
	{
		$msg = "Content  deleted successfully.";
	}
	else
	{
		$msg = "Problem arised in Content deletion.";
	}
	$_SESSION['MESSAGE'] = $msg;
	header('location:list.php');
	exit();
}

// insert***********************************************

if(isset($_REQUEST['UpdateADD']) && $_REQUEST['UpdateADD'] == 'Add New')
{
    
        array_walk_recursive($_POST, create_function('&$val', '$val = trim($val);'));
        if (empty($_POST['title']) || empty($_POST['UpdateADD']) || empty($_POST['editor1'])) {
            goto_location('list-cms');
            exit;
        }
        
	$columns = array(
                    'cid'=> 'null',
                    'title'=> ':pagetitle',
                    'detail'=> ':content',
                    'status'=> ':page_status',
                    'postdate'=> 'now()',
        );
        $bind = array(
            ':pagetitle'=> $_POST['title'],
            ':content'  => $_POST['editor1'],
            ':page_status'=>1
            
        );
	
        try{
            $qry = insert(CMS_TBL, $columns);
            $q   = $conn->prepare($qry);
            $q->execute($bind);
            $nid = $conn->lastInsertId();
            if ($nid)
	{
		$msg = "Content create successfully.";
	}
	else
	{
		$msg = "Problem arised in Content Creation.";
	}
	$_SESSION['MESSAGE'] = $msg;
	header('location:list-cms.php');
	exit();
            
        }catch (PDOException $pe) {

            echo db_error($pe->getMessage());

        }
	
	
	
}
?>