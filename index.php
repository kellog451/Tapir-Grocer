<?php session_start(); ?>
<html>
	<title>Tapir Grocer</title>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
      	<li class="active"><a href="index.php">Home</a></li>
      	</ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="sign_up.php">Sign Up <i class="fa fa-user-plus"></i></a></li>
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
		<!-- Contact Tracing Form -->
  	    <form method="post" id="check_form">
					<h2>Check In Form</h2>
					<div class="input-container">
						<i class="fas fa-user-circle icon"></i>
						<input class="input-field" type="text" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];} ?>"
						placeholder="Full Name" name="name" required>
					</div>
					
					<div class="input-container">
						<i class="fas fa-id-card icon"></i>
						<input class="input-field" type="text" value="<?php if(isset($_COOKIE['ic_number'])) { echo $_COOKIE['ic_number'];} ?>"
						placeholder="IC/Passport Number" id="IC_Number" name="ic" required>
					</div>
					
					<div class="input-container">
						<i class="fas fa-thermometer-three-quarters icon"></i>
						<input class="input-field" type="number" step="any" id="temp" placeholder="Temperature &deg; C" name="temp" required>
					</div>
					<br>
					<div class="inputbox">
						<input class="input-field" type="checkbox" name="cookies"> <span>Remember Me</span>
					</div><br>
					
					<button type="submit" name="check_in" class="btn">Submit</button>
				</form>
				
				<?php
				
    
					if (isset($_POST['check_in'])) {
							
						//database connection
            include("includes/dbconnection.inc");

						$username = $conn->real_escape_string($_POST["name"]);                    
						$ic_number = $conn->real_escape_string($_POST["ic"]);
						$temperature  = $conn->real_escape_string($_POST["temp"]); 
						if (isset($_POST["cookies"])) $cookie_status = true;
						else
							$cookie_status = false;
						
						
						$message_success = '<div class="alert alert-success alert-dismissible">
																	<button type="button" class="close" data-dismiss="alert">×</button>
																	<p><strong><i class="fas fa-check" style="font-size:38px;color:#50C96A;margin-right:30px">
																	</i></strong> Checked In Successfully.</p>
																</div>';
						
						$message_error = '<div class="alert alert-danger alert-dismissible" style="width:100%">
																<button type="button" class="close" data-dismiss="alert">×</button>
																<strong><i class="fas fa-exclamation-circle" style="font-size:18px;color:#D38181;margin:0px 10px">
																</i></strong> Check In Error.</p>
																</div>';

						 
						$sql = "INSERT INTO check_in_log (Names, IC_Number, Temperature)
											
										VALUES('$username', '$ic_number', '$temperature')";        
								
								if ($conn->query($sql) == true) {
									
									if($cookie_status == true){
										//set cookie storage duration to a month.
										$duration = time() + (3600 * 24 * 30);
										//store name and ic of user.
										setcookie("username", $username, $duration);
										setcookie('ic_number', $ic_number, $duration);										
									}
									
									//echo $message_success;
									echo '<script>check_in_complete = true; </script>';
									
								}
								else{
									echo $message_error . $conn->error;
								}
								
								if($temperature < 37){
									$risk = "Low";
								}else{
									$risk = "High";
								}
								
								date_default_timezone_set("Asia/Kuala_Lumpur");
								$now = new DateTime();
								$today = $now->format('d-m-Y'); //date("Y-m-d");
								$time = $now->format('h:ia');
								// Close connection
								$conn->close();
					}
			?>
			
			<div id="check_in_success">
				<h1>Check In Details</h1>
				<p class="info">Name : <span><?php echo $username; ?></span></p>
				<p class="info">IC : <span><?php echo $ic_number; ?></span></p>
				<p class="info">Temp (&deg;C): <span><?php echo $temperature; ?></span></p>
				<p class="info">Date : <span><?php echo $today; ?></span></p>
				<p class="info">Time : <span><?php echo $time; ?></span></p>
				<p class="info">Risk : <span id="risk"><?php echo $risk; ?></span></p>
			</div>
			
  	  </div>
  	</div>
  </div>
</div>
<script>
//checkin success
	var check_in_complete;
//change color according to risk level.
	var risk_level = document.getElementById("risk").innerHTML;
	console.log(risk_level);
	console.log(11);
	
	if (risk_level == "Low") {
		document.getElementById("risk").parentElement.style.backgroundColor =  "#6FC968";
	}
	if (risk_level == "High") {
		document.getElementById("risk").parentElement.style.backgroundColor = "#D33F3F";
		document.getElementById("risk").style.color = "white";
	}
		
		
	if(check_in_complete == true){
	//hide the check in form.
		document.getElementById("check_form").style.display = "none";
	//show the result div.
		document.getElementById("check_in_success").style.display = "block";
	}
	
	var ic_number = document.getElementById("IC_Number");
	var temperature = document.getElementById("temp");
	//simple IC field validation
	ic_number.onkeyup = function(){
		if ((ic_number.value.length < 8) || (ic_number.value.length > 12) ) {
			 ic_number.style.border = "solid 2px red";
		 }
		 else {
			 ic_number.style.border = "solid 2px #ccc";
		 }
	};
	
	
	//simple Temperature field validation
	temperature.onkeyup = function(){
		if ((temperature.value < 0) || (temperature.value > 50) ) {
			 temperature.style.border = "solid 2px red";
		 }
		 else {
			 temperature.style.border = "solid 2px #ccc";
		 }
	};
</script>
<script type="text/javascript" src="js/qr_code.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type=text/javascript src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>