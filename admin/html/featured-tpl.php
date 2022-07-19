<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Featured Items</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">
            <div class="row">
   <form  method="post" action="featured_items.php">
   <?php if (!empty($list)): ?>
   <?php $i=1; foreach ($list as $k => $v): ?>
   <?php  reset($img_list); ?> 
<div class="col-sm-6 col-md-4">
<?php $im=''; 
$im.= (trim($v['img']) !='') ? ('<option  value="'.$v['img'].'" data-img-src="../'. THUMB_IMGS . $v['img'].'">'.$v['img'].'</option>'):('');
foreach ($img_list as $a => $b): ?>
 <?php $d=explode("|",$b);    $isel= (strcasecmp($d[1], $v['cimg']) == 0) ? (' selected') :('');
 $im.= ($d[0]==$v['prodid'] && $d[1]!='') ? ('<option  value="'.$d[1].'" data-img-src="../'. THUMB_IMGS . $d[1].'" '.$isel.'>'.$d[1].'</option>'):(''); ?>
   <?php endforeach; ?>
    
    <div class="thumbnail featured_item">
     <?php echo ' <select class="img-select" data-imgid="'.$i.'" name="img-select['.$i.']"  id="img-select'.$i.'" >'.$im.'</select>';?>   
     <?php $isel= (isset($v['cimg'])  && $v['cimg']!='') ? ($v['cimg']) :($v['img']);?>
       <img src="../<?php echo THUMB_IMGS . $isel ?>" name="img-elem<?php echo $i?>">
       
      <div class="caption">
      <input type="hidden"  name="pid[<?php echo $i?>]" value="<?php echo $v['prodid']?>">
     <p><input type="text" class="form-control" name="title[<?php echo $i?>]" value="<?php echo stripslashes($v['title'])?>"></p>
      <p><a href="edit-product.php?id=<?php echo $v['prodid']?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></p>
      </div>
    </div> 
  </div>
  
    <?php $i++; endforeach; ?>
    <?php endif; ?>

<div class="row" style="padding:1em">
  <div class="col-sm-12">
    	<input type="hidden"  id="img-path" value="<?php echo '../'.THUMB_IMGS?>">
    	<input type="hidden"  name="url" value="<?php echo isset($_GET['id']) ? ($_GET['id']):('')?>">
    	<button type="submit" class="btn btn-primary">Save/Publish</button>
    
    	<button type="submit" name="delete" class="btn btn-danger">Delete</button>
 </div></div> 
        </form>
                  
</div>            </div>
        </div>
    </div>
</div>

