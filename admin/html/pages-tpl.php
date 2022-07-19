<div class="col-sm-7 col-md-7">

   <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Create Pages</h3>
      </div>
      <div class="panel-body">
   <form role="form" action="pages" method="post" >
<div class="row">
                                <div class="col-md-12">
                                  
                                    
                                     <div class="form-group">
                 
                                        <div class="input-group">
                                            <span class="input-group-addon">Page Title &nbsp; &nbsp; &nbsp; </span>
                                              <input type="text" class="form-control" name="mainptitle" placeholder="Page Title" value="<?php echo $ptitle?>" required />
                                        </div>
                                    </div>
                                    
                                                        <div class="form-group">
					<textarea name="page_content" id = "page_content"><?php echo $ptxt?></textarea>
               
                                    </div>
					
 
                                </div>
                            </div>
                
 <div class="row">
                                <div class="col-md-6">
                                    <div class="well well-sm">
                                      <div class="form-group">
                 
                                        <div class="input-group">
                                            <span class="input-group-addon">Page Url Text</span>
                                       <input type="text" class="form-control" name="pagetitle" placeholder="Page Url Text" value="<?php echo $pname?>" required />
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Page Url</span>
                                            <input type="text" id="page_id" name="page_id" class="form-control" value="<?php echo $plink?>" placeholder="Page Url" required />
                                        </div>
                                           </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="well well-sm well-primary">
                                        <form class="form form-inline " role="form">
                                          
                                        <div class="form-group">
                                            <select class="form-control"name="page_status" >
						
                                                <option value="0" <?php echo ($pstat==0) ? ('selected') : ('')?>>Draft</option>
                                                <option value="1" <?php echo ($pstat==1) ? ('selected') : ('')?>>Publish<?php echo ($pstat==1) ? ('ed') : ('')?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            &nbsp; &nbsp; <button type="submit" class="btn btn-success" disabled>
                                                <span class="glyphicon glyphicon-floppy-disk"> </span> Save</button> &nbsp; &nbsp;
                                 
						 <div class="checkbox">
						    <label>
						  
						      &nbsp;  &nbsp; <input type="checkbox" name="rtn" checked> Return on Save
						    </label>
						  </div>
						 <?php echo ( $page_id!='') ? (' <input type="hidden" name="pid" value="'.$page_id.'">') : ('')?>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
			   </form>

         </div>
      </div>
   </div>
<div class="col-sm-2 col-md-2">
<ul class="list-group">
  <li class="list-group-item">
<h4>Pages</h4>
 </li>
<?php if (!empty($pages_list)): ?>
<?php foreach ($pages_list as $k => $v): ?>
<li class="list-group-item">
    <span class="badge "><a style="color:#fff" href="page-delete?id=<?php echo $v['pg_id'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span>
    <a href="pages?id=<?php echo $v['pg_id'] ?>"><?php echo $v['pg_name'] ?></a>
  </li>
<?php endforeach; ?>
 <?php endif; ?>
</ul>
</div>