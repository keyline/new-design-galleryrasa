<div class="col-sm-9 col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Excel Import</h3>
        </div>
        <div class="panel-body">
            <form action="../test_upload/import-wizard" method="POST" name="frmexcelImport" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pname">Choose Category First</label>
                    <div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Books" type="radio">Book
			</label>
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Book Section" type="radio">Book Section
			</label>
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Journal Article" class="active" type="radio">Journal Article
			</label>
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Journal" class="active" type="radio">Journal
			</label>
			
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Catalogue Solo" class="active" type="radio">Catalogue[Solo]
			</label>
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Catalogue Essay" class="active" type="radio">Catalogue Essay
			</label>
				<label class="btn btn-default">
				<input name="category[Bibliography]" value="Catalogue Group" class="active" type="radio">Catalogue[Group]
			</label>
			<label class="btn btn-default">
				<input name="category[Bibliography]" value="Catalogue Annual" class="active" type="radio">Catalogue[Annual]
			</label>
        
                </div>
                </div>
                <div class="form-group">
                        <label for="pname">Attach File Here</label>
                        <input type="file" class="form-control" id="excelImport" name="file" required="required">
                     </div>
                <div class="col-xs-6"><input type="submit"  id="SubmitButton" class="btn btn-default" value="Upload" /></div>
            </form>
        </div>
        
            
            
    </div>