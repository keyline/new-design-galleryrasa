<div class="col-sm-9 col-md-9">

   <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">New Product</h3>
      </div>
      <div class="panel-body">
         
            <!-- Nav tabs -->
            
            <!-- Tab panes -->
            <form id="add-new-form" role="form" action="add-new-product" method="post">
                <div class="form-group">
                    <label for="attribute-set">Attribute Set</label>
                <?php echo $select_category;?>
                </div>
                <input type="submit" value="Continue" id="product-setting" class="btn btn-default">
                
                </form>
         
      </div>
   </div>