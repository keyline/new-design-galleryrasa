<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  

    <title>Create Admin Account</title>

    <!-- Bootstrap core CSS -->
    <link href="{CSSPATH}bootstrap.css" rel="stylesheet">
     <link href="{CSSPATH}style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
 

    <div class="container" style="margin-top:10em">

  <div class="col-md-6 col-md-offset-3">
 <div class="alert alert-info {ALRT_RQ}" role="alert"><h4> All fields are required.</h4> </div>
    <div class="alert alert-success {ALRT_SUC}" role="alert"><h4>Admin account created successfully. </h4>
 <p><a href="login" class="btn btn-default">Login</a></p></div>
  
 <div class="alert alert-info {ALRT_ERR}" role="alert"><h4>Admin account already exists. If you wish to create it again, please go to your database and empty your ADMIN table</h4>
<p><a href="login" class="btn btn-default">Login</a></p></div>
<div class="panel panel-default {PANEL}">
      <div class="panel-heading">
 
   <h3 class="panel-title"><strong>Create Admin Account</strong></h3></div>
 <div class="panel-body">

<form id="new-account-form" role="form" method="post" action="new-account">
   <div class="form-group">
    <label for="userid">Username</label>
    <input type="text" class="form-control" name="userid" id="userid" required>
  </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" required>
  </div>
   <div class="form-group">
    <label for="passwd">Password</label>
    <input type="password" class="form-control" name="passwd" id="passwd" required>
  </div>
  
 <div class="form-group">
    <label for="cpasswd">Confirm Password</label>
    <input type="password" class="form-control" name="cpasswd"  id="cpasswd" required>
  </div>
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>

    


    </div>
  </div> 
</div> 



    </div> 



<script src="{JSPATH}jquery-1.11.3.min.js"></script>
<script src="{JSPATH}jquery.validate.js"></script>
<script src="{JSPATH}forms.js"></script>
  </body>
</html>
