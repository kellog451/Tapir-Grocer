<?php session_start(); ?>
<html>
	<title>Tapir Grocer</title>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
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
				<li class="active"><a href="#"><?php echo $_SESSION["user_name"];?></a></li>
      	</ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="sign_up.php">Sign Up <i class="fa fa-user-plus"></i></a></li>
        <li>
					<form method="post" id="logout_form">
						<input role="button" type="submit" name="logout" value="Log Out">
						<i class="fa fa-user"></i>
					</form>
				</li>       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" id="center_container">
  <div class="row">
  	<div class="col-lg-12">
  	  <div id="content">
  	    <h1>TAPIR GROCER</h1>
				<div id="link_form">
					<h2>Create a Link for your Store</h2>
					
					<div class="input-container">
						<i class="fas fa-link icon"></i>
						<input id="qr-text" type="text" placeholder="www.yourstore.com/checkin"/>
					</div>
					
					<button class="btn" role="button" onclick="generateQRCode();">Create QR Code</button>
					<p id="qr-result">This is a default QR code:</p>
					<div id="canvas_container">
						<canvas id="qr-code"></canvas>						
					</div>
					<button id="downloadbtn" class="btn btn-danger" onclick="download_image();"><i class="fas fa-download"></i>Download</button>
				</div>
        
  	  </div>
  	</div>
  </div>
</div>

<?php
	// check if user logs out.
	if(isset($_POST['logout'])){                       
			//session_destroy();
			unset($_SESSION["user_name"]);
			header("location: login.php");
	}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script type="text/javascript" src="js/qr_code.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>