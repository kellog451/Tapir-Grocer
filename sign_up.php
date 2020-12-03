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
        <li class="active"><a href="sign_up.php">Sign Up <i class="fa fa-user-plus"></i></a></li>
        <li><a href="login.php">Log In <i class="fa fa-user"></i></a></li>        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" id="center_container">
  <div class="row">
  	<div class="col-lg-12">
  	  <div id="content">
  	    <h1>TAPIR GROCER</h1>
		<!-- Location Sign Up Form -->
  	    <form  method="post" action="">
					<h2>Sign Up Form</h2>
					
					<!-------------------------------- processing sign up data -------------------------------->
					<?php
            
            $error1 = '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong><i class="fas fa-exclamation-circle" style="font-size:18px;color:#D38181;margin:0px 10px">
                          </i></strong> Passwords do Not match.
                        </div>';
												
            $error2 = '<div class="alert alert-danger alert-dismissible">
                       <button type="button" class="close" data-dismiss="alert">×</button>
                       <strong><i class="fas fa-exclamation-circle" style="font-size:18px;color:#D38181;margin:0px 10px">
                       </i></strong> User IC is already registered.
                     </div>';
    
            if (isset($_POST['sign_up'])) {
               //connect to db and check connection
               include("includes/dbconnection.inc");
               
         
               $user_name = $conn->real_escape_string($_POST["name"]);
               $ic = $conn->real_escape_string($_POST["ic"]);
               $password = $conn->real_escape_string($_POST["pwd"]);
               $cpassword = $conn->real_escape_string($_POST["pwd2"]);
               $store_name = $conn->real_escape_string($_POST["sname"]);
							 $store_location = $conn->real_escape_string($_POST["location"]);
               
               
               
               if ($password == $cpassword){
                    $passwordhash = password_hash($cpassword, PASSWORD_DEFAULT);
										
                    $sql = "INSERT INTO location_owners (user_name, ic, user_password, store_name, store_location) 
                          VALUES('$user_name', '$ic', '$passwordhash', '$store_name', '$store_location')";        
                  
                    if ($conn->query($sql) == true) {
											//success
                      header("location: login.php");
                    }else{
                      echo $error2;
                    }
                  } 
                  else {
                     echo $error1;
                  }
                  
                  // Close connection
                  $conn->close();
         
               }
      
            
            ?>
					<div class="input-container">
						<i class="fas fa-user-circle icon"></i>
						<input class="input-field" type="text" placeholder="Store Owner Name" name="name" required>
					</div>
					
					<div class="input-container">
						<i class="fas fa-id-card icon"></i>
						<input class="input-field" type="text" id="IC_Number" placeholder="Store Owner IC" name="ic" required>
					</div>
					
					<div class="input-container">
						<i class="fas fa-lock icon"></i>
						<input class="input-field" type="password" id="pwd" placeholder="Password" name="pwd" required>
						<i class='fas fa-eye eyeshow' onclick="ShowPassword();" style='font-size:15px'></i>
					</div>
					
					<div class="input-container">
						<i class="fas fa-lock icon"></i>
						<input class="input-field" type="password" id="pwd2" placeholder="Confirm Password" name="pwd2" required>
						<i class='fas fa-eye eyeshow' onclick="ShowPassword2();" style='font-size:15px'></i>
					</div>
					
					<div class="input-container">
						<i class="fas fa-store icon"></i>
						<input class="input-field" type="text" placeholder="Store Name" name="sname" required>
					</div>
					
					<div class="input-container">
						<i class="fas fa-map-marker-alt icon"></i>
						<input class="input-field" type="text" placeholder="Store Location" name="location" required>
					</div>
			
					<button type="submit" name="sign_up" class="btn">Sign Up</button>
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