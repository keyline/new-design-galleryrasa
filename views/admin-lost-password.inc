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
    <form method="post" action="lost-password">

        <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-success {ALRT_SUC}" role="alert"> You have been sent a link to your email address
                which you should use to reset your email. <a href="login">Login</a></div>

            <div class="panel panel-default {PANEL}">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Lost Password </strong></h3></div>
                <div class="panel-body">
                    {MSG}

                    <div class="form-group">
                        <!-- Username -->
                        <label class="control-label" for="email">Enter your email</label>

                        <input name="email" type="text" maxlength="50" class="form-control" required>
                    </div>


                    <div class="form-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            &nbsp; &nbsp; &nbsp; <a href="login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>


</body>
</html>
