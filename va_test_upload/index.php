<?php
$myDebugFlag=true;
?>
<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Excel Import</h3>
        </div>
        <div class="panel-body">
            <form action="import-wizard.php" method="POST" name="frmexcelImport" enctype="multipart/form-data">
<!--                <input name="category[Bibliography]" value="Films" type="hidden">-->
                <input name="category[visual archive]" value="visual archive" type="hidden">
                <div class="form-group">
                        <label for="pname">Attach File Here</label>
                        <input type="file" class="form-control" id="excelImport" name="file" required="required" onchange="checkfile(this);">
                     </div>
                <div class="col-xs-6"><input type="submit"  id="SubmitButton" class="btn btn-default" value="Upload" /></div>
            </form>
        </div>
        
            
            
    </div>

    <script type="text/javascript" language="javascript">
        function checkfile(sender) {
    var validExts = new Array(".xlsx", ".xls");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
      alert("Invalid file selected, valid files are of " +
               validExts.toString() + " types.");
      return false;
    }
    else return true;
}
</script>