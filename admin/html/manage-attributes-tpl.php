<div class="col-sm-9 col-md-9">

   <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Manage Attribute Sets</h3>
      </div>
      <div class="panel-body">
         
            <!-- Nav tabs -->
            
            <!-- Tab panes -->
            <div id="mainContainer" class="panel-body box-maincontainer">
                
                <?php foreach ($list AS $k =>$v) {
                    echo '<div mainitemid="attr-' . $v['id'] .'" itemName= "'.$v['id'] . '" class="btn btn-default main-item">' . $v['name'] .'</div>&nbsp;';
                }
                echo '</div>';?>
            
            </div>
            
         
      </div>
       
       
       
   </div>
    <div class="container-fluid">
        <div class="row">
            <div id="response">
            </div>
        </div>
    </div>
    
