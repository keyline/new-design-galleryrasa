<div class="col-sm-9 col-md-9">
   
   
   <form role="form" action="<?php echo $action_page?>" method="post" >       
<div class="alert alert-info alert-dismissible fade in" role="alert">  
<h4 style="font-size:22px"><?php echo $name?></h4> 
<p style="font-size:17px">This page will be deleted Permanently if you continue?</p> 
 <p> 
<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>&nbsp; 
<input type="hidden" name="pid" value="<?php echo $pid ?>">
<a href="<?php echo $return_page?>" class="btn btn-default">Cancel</a>
          </p>     
            </div>
      </form>  
</div>
	