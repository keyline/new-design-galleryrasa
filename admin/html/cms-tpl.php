<div class="col-sm-7 col-md-7">

   <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Blog</h3>
      </div>
      <div class="panel-body">
   <form role="form" action="cms" method="post" >
<div class="row">
                                <div class="col-md-12">                                 
                                     <div class="form-group">
                 
                                        <div class="input-group">
                                            <span class="input-group-addon">Page Title &nbsp; &nbsp; &nbsp; </span>
                                              <input type="text" class="form-control" name="title" placeholder="Page Title" value="<?php echo $ptitle?>" required />
                                        </div>
                                    </div>
                                    
                                                        <div class="form-group">
					<textarea name="page_content" id = "page_content"><?php echo $ptxt?></textarea>
               
                                    </div>
					
 
                                </div>
                            </div>
                
 <div class="row">
                                <div class="col-md-6">
                               <div class="form-group">
                 
                                        <div class="input-group">
                                            <span class="input-group-addon">Author &nbsp; &nbsp; &nbsp; </span>
                                              <input type="text" class="form-control" name="author"  value="<?php echo $author?>"  />
                                        </div>
                                    </div>
                                <?php if($get_it) {?>
                                    <dl class="dl-horizontal">

                        <dt>Views:</dt>
                        <dd><?php echo $hits?></dd>
                       <dt>Last View Date:</dt>
                        <dd><?php echo $lvdate?></dd>

                        <dt>Edited:</dt>
                        <dd><?php echo $ldate?></dd>

                        <dt>Created:</dt>
                        <dd><?php echo $pdate?></dd>

                        <dt><input type="checkbox" name="ftr"></dt>
                        <dd>Push Up</dd>
                    </dl>
                  <?php }  ?>
                                                 </div>
                                <div class="col-md-6">
                                    <div class="well well-sm well-primary">
                                        
                                          
                                        <div class="form-group">
                                            <select class="form-control"name="page_status" >
						
                                                <option value="0" <?php echo ($pstat==0) ? ('selected') : ('')?>>Draft</option>
                                                <option value="1" <?php echo ($pstat==1) ? ('selected') : ('')?>>Publish<?php echo ($pstat==1) ? ('ed') : ('')?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            &nbsp; &nbsp; <button type="submit" class="btn btn-success">
                                                <span class="glyphicon glyphicon-floppy-disk"> </span> Save</button> &nbsp; &nbsp;
                                 
						 <div class="checkbox">
						    <label>
						  
						      &nbsp;  &nbsp; <input type="checkbox" name="rtn" checked> Return on Save
						    </label>
						  </div>
						 <?php echo ( $page_id!='') ? (' <input type="hidden" name="pid" value="'.$page_id.'">') : ('')?>
                                        </div>
                                    
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
<h4>Latest <small> &nbsp; &nbsp; <a href="cms-view-all">All</a></small></h4>
 </li>
<?php if (!empty($pages_list)): ?>
<?php foreach ($pages_list as $k => $v): ?>
<li class="list-group-item">
    <span class="badge "><a style="color:#fff" href="cms-delete?id=<?php echo $v['cid'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span>
    <a href="cms?id=<?php echo $v['cid'] ?>"><?php echo $v['title'] ?></a>
  </li>
<?php endforeach; ?>
 <?php endif; ?>
</ul>
</div>