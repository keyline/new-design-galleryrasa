<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{CSSPATH}bootstrap.css" rel="stylesheet">
  <link href="{CSSPATH}style.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
 

    <div class="container" style="margin-top:10em">
   <form method="post" action="login" name="_loginForm">

  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
   <h3 class="panel-title"><strong>Sign in </strong></h3></div>
        <div class="panel-body">
	{MSG} 
	
	<div class="form-group">
      <!-- Username -->
      <label class="control-label"  for="user-id">Username</label>
 
<input name="username" type="text" maxlength=50 autocomplete=off placeholder="Username" class="form-control" > 
 </div>
 
    <div class="form-group">
      <label class="control-label" for="pw-id">Password</label>
 
<input name="passwd"  type="password" maxlength=16  autocomplete=off class="form-control" placeholder="Password" >
    </div>
<!-- <span id="helpBlock" class="help-block"> <a href="lost-password">Forgot password</a></span>-->
    <div class="form-group">
      <!-- Button -->
      <div class="controls">
<button class="btn btn-primary" type="submit">Sign in</button>
      </div>
    </div>
    </div> <!--panel-->
  </div> <!--col-->
</div> <!--container-->

</form>

    </div> 
  <!-- /container -->



  </body>
</html>
