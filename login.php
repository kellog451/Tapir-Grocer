<html>
	<title>Tapir Grocer</title>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
	</head>

<body>

<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><span id="logo"><i class="fas fa-shopping-cart"></i></span>Tapir Grocer</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a href="index.php">Home</a></li>
      	</ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="sign_up.php">Sign Up <i class="fa fa-user-plus"></i></a></li>
        <li class="active"><a href="login.php">Log In <i class="fa fa-user"></i></a></li>        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" id="center_container">
  <div class="row">
  	<div class="col-lg-12">
  	  <div id="content">
  	    <h1>TAPIR GROCER</h1>
				<!-- Login Form -->
  	    <form method="post">
					<h2>Login Form</h2>
					
					<?php
					//start user session
					session_start();
						
            if (isset($_POST['login'])) {
							
               //database connection
               include("includes/dbconnection.inc");
         
               $ic = $conn->real_escape_string($_POST["ic"]);
               $user_password = $conn->real_escape_string($_POST["password"]);
               
               $error = '<div class="alert alert-danger alert-dismissible" style="width:100%">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong><i class="fas fa-exclamation-circle" style="font-size:18px;color:#D38181;margin:0px 10px">
                          </i></strong> Invalid Password.
                        </div>';
               $error2 = '<div class="alert alert-danger alert-dismissible" style="width:100%">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong><i class="fas fa-exclamation-circle" style="font-size:18px;color:#D38181;margin:0px 10px">
                          </i></strong> IC Number Not Registered.
                        </div>';
                        
                // Check db for corresponding IC Number
                $sql = "SELECT * FROM location_owners WHERE ic = '$ic'";
                
                if ($result = $conn->query($sql)) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_array();

                        $user_name = $row['user_name'];
                        $ic_number = $row['ic'];
                        $passwordhash = $row['user_password'];
                      
                         //authenticate password
                        if (password_verify($user_password, $passwordhash)) {
													//store user session variables.
                            $_SESSION['user_name'] = $user_name;                                               
                          // log user in.                           
                            header("Location: link.php"); 
                        } 
                        else {
													//password cant be verified.
                           echo $error;
                        }

                   }
                   else{
										//IC cant be found.
                      echo $error2;
                   }
                }
          
                // Close connection
                $conn->close();
            }
            ?>
					<div class="input-container">
						<i class="fas fa-id-card icon"></i>
						<input class="input-field" type="text" placeholder="Store Owner IC" name="ic" required>
					</div>
					
					<div class="input-container">
						<i class="fas fa-lock icon"></i>
						<input class="input-field" type="password" id="pwd" placeholder="Password" name="password" required>
						<i class='fas fa-eye eyeshow' onclick="ShowPassword();" style='font-size:15px'></i>
					</div>
			
					<button type="submit" name="login" class="btn">Log In</button>
				</form>
  	  </div>
  	</div>
  </div>
</div>


<script type="text/javascript" src="js/qr_code.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
<script type=text/javascript src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>