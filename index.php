<?php
include('kt_auto_login.php');	
?>
<!DOCTYPE html>

	<html lang="en">

	<head>

		<title><?php echo $job; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta name="keywords" content="Teslateq,teslateq,tesla,canhnguyen" />

		<link rel="icon" type="image/png" href="images/logo_vms.png" >

		<link rel="stylesheet" href="bootstrap/css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 

		<!-- <link rel="stylesheet" href="css/font-awesome.css"> --> <!-- Font-Awesome-Icons-CSS -->

		<link rel="stylesheet" href="bootstrap/fonts/awesome/css/font-awesome.min.css">


		<style type="text/css" >

		.required

		{

			color: red;

			font-size: 15px;

			padding-top: 10px;

		}			

	</style>	

</head>

<body>

<div class="w3-agile-banner" > 

	<!--</div>-->

	<div class="center-container">

		<!--header-->

		<div class="header-w3l" style="color:#00a9e0;">

			<h1><?php echo $job; ?></h1>

			<!--<img src="images/logo-01-01.png" alt="">-->

		</div>


		<div class="main-content-agile" >

			<div class="wthree-pro" style="background:#00a9e0;"  >

				<h2 style="">Please Login</h2>

			</div>

			<div class="sub-main-w3">	

				<form action="login.php" method="POST"  >

					<input placeholder="Username" name="user" type="text" pattern="[A-Za-z0-9]{1,20}" >
					<input  placeholder="Password" name="pass" type="password" pattern="[^' ']{1,20}" >

					<div class="rem-w3" >

						<span class="check-w3" style="margin-right:65px"><input name="remember" id="remember" type="checkbox" >Remember Me</span>

						<a  href="dangki.php">Sign up</a>





					</div>


					<input   type="submit" value="Enter">



					<div style="text-align: center;">

						<?php

						if(isset($message))

							echo "$message";



						?></div>



					</form>

				</div>

			</div>

			<!--//main-->

			<!--footer-->

			<div class="footer"   >

				<p>Design by <a class="tesla" href="<?php echo $web; ?>" target="_blank"><?php echo $company; ?></a> <a class="for" href="forgot.php" >Forget Pass ?</a></p>

			</div>

			<!--//footer-->

			<div ></div>

		</div>

	</div>

</body>

</html>
