<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
 

    <title>Lost Password</title>

    <!-- Bootstrap core CSS -->
    <link href="{CSSPATH}bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
 

    <div class="container" style="margin-top:10em">
 

  <div class="col-md-4 col-md-offset-4">
 <div class="alert alert-info {ALRT_EXP}" role="alert"> This link does not exist or has expired. <a href="login">Login</a></div>
    <div class="alert alert-success {ALRT_SUC}" role="alert"> Your password updated successfully. <a href="login">Login</a></div>
  <div class="panel panel-default {PANEL}">
      <div class="panel-heading">
 
   <h3 class="panel-title"><strong>Create New Password </strong></h3></div>
        <div class="panel-body">
	
<div class="{MSG}">
<form id="reset-password-form" role="form" method="post" action="change-pass">
   <div class="form-group">
    <label for="npasswd">New Password</label>
    <input type="password" class="form-control" name="npasswd" id="npasswd" required>
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



    </div> 



<script src="{JSPATH}jquery-1.11.1.min.js"></script>
<script src="{JSPATH}jquery.validate.js"></script>
<script src="{JSPATH}forms.js"></script>
  </body>
</html>
