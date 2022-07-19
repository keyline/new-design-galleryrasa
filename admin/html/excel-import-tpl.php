<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Excel Import</h3>
        </div>
        <div class="panel-body">
            <form action="excel-import" method="POST" name="frmexcelImport" enctype="multipart/form-data">
                <input name="category[Memorabilia]" value="Films" type="hidden">
                <div class="form-group">
                        <label for="pname">Attach File Here</label>
                        <input type="file" class="form-control" id="excelImport" name="file" required="required">
                     </div>
                <div class="col-xs-6"><input type="submit"  id="SubmitButton" class="btn btn-default" value="Upload" /></div>
            </form>
        </div>
        
            
            
    </div>