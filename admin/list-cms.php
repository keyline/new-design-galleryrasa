<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
$page = $_SERVER['PHP_SELF'];

include(ADMIN_HTML . "admin-headerInc.php");
?>
<div class="col-sm-9 col-md-9">
        
            
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"> CMS -> Page's </h4> </div>
                    <div class="col-md-12">
            
            <!-- /.row -->
			
            
                
                    
						
<!--*********************************** start content *******************************-->

<div class="AddIcon">
	<a href="add-edit-cms.php?Action=Add New">Add New (+)</a>
</div>

<?php
	if(isset($_SESSION['MESSAGE']) && $_SESSION['MESSAGE'] != "")  
	{
?>
		<div class="label_error">
<?php
		echo '<script>alert("'.$_SESSION['MESSAGE'].'");</script>'; 
		unset($_SESSION['MESSAGE']);
?>						   
		</div>
<?php
	}
?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Page's Name</th><th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
        $conn = dbconnect();
        
	$SQL = "Select * from cms_ecomc";
        $q= $conn->query($SQL);
        
	$num = $q->rowCount();
	
	if($num > 0)
	{
		while($FVAL = $q->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<tr>
			<td><?= $FVAL['title']; ?></td>
			<td>
				<a href="add-edit-cms.php?Id=<?= $FVAL['cid']; ?>&Action=Update">
					<i class="glyphicon glyphicon-pencil"></i>
				</a>
				<a href='#' title="Click Delete" onClick="delete_item(<?php echo $FVAL['cid'] ?>);">
					<i class="glyphicon glyphicon-trash"></i>
				</a>
			</td>
		</tr>
	<?php
		}
	}
	else
	{
	?>
		<tr><td colspan="3">No Data Available</td></tr>
	<?php
	}
	?>
	</tbody>
</table>

<!-- *********************************end content********************************* -->
						
					
				
            
            <!-- /.row -->
            
                    </div>
        <!-- /.container-fluid -->
        
    </div>

      
<?php include(ADMIN_HTML . "admin-footerInc.php");?>