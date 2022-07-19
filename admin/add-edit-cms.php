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
            
			
            
                
						
<!--**************************** start content ***********************-->
<?php
$conn= dbconnect();
$query = "Select * from cms_ecomc where cid = :pageID";
$q = $conn->prepare($query);
$q->bindParam(':pageID', $_REQUEST['Id']);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);
while($row = $q->fetch()){
    $data[] = array(
                'id'=> $row['cid'],
                'pageTitle'=> $row['title'],
                'author'    => $row['author'],
                'content'   => $row['detail'],
                'date'      => $row['postdate'],
                'status'    => $row['status']
        
    );
}



?>
<form action="process.php" name="commentForm" class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" >     
    <div align="center">
		<h2 align="left"><?= $_REQUEST['Action'] ?> <b>Page</b> </h2>

        <div class="FomHolder">
        
            <input type="hidden" value="<?=  $_REQUEST['Action'] ?>" name="UpdateADD" id="UpdateADD" />
            <input value="<?= $data[0]['id'] ?>" name="Id" type="hidden"  /><br />  <br />  
			
			<div class="EachSectionForm">
                <label>Page Name</label><br>
				<input type="text" value="<?php echo !empty($data[0]['pageTitle']) ? $data[0]['pageTitle'] : ''; ?>" name="title">
            </div>
            
            
            
            <div class="EachSectionForm">
				<br><br>
                <label>Content</label>
                <textarea class="textarea_editor form-control" rows="5" name="editor1" ><?php echo !empty($data[0]['content']) ? $data[0]['content'] : ''; ?></textarea>
            </div>
            
            
            
            
            <div class="new_each_section">
				<br><br>
                <input type="submit" class="submit" value="Submit">
            </div>
    
        </div>
    </div>
</form>

<!--********************************* end content *****************************-->
						
					
				
         
                </div>  
        <!-- /.container-fluid -->
        
    </div>

<?php include(ADMIN_HTML . "admin-footerInc.php");?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/admin/plugins/ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript">
   window.onload = function () {
       CKEDITOR.replace('editor1');
   };
</script>
