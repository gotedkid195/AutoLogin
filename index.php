<?php
session_start(); 
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {

	$redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	header("Location: $redirect_url");

	exit();}
	include('inc/myconnect.php');
	include('inc/function.php');
	$sql="SELECT * FROM project WHERE id=1";
	$result_min=mysqli_query($dbc,$sql);          
	while($row = mysqli_fetch_array($result_min,MYSQLI_ASSOC)) 
	{  
		$job = $row['job'];
		$web = $row['web'];
		$company = $row['company'];
	} 

	if(isset ($_COOKIE["cookie_name"]) )

	{ 

		parse_str($_COOKIE['cookie_name']);

		$usr=$usr;

		$query = "SELECT * FROM users WHERE username ='{$usr}' AND status=1 ";

		$result = mysqli_query($dbc, $query);  

		kt_query($result,$query);

		while ($ex=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

			$coki=  $ex["hash"];  

			$id = $ex["id"];  

			$username =	$ex["username"];  

			$role =	$ex["role"];  		

		}

		if($coki == $_COOKIE["cookie_name"] ){

			$_SESSION['id']=$id;	

			$_SESSION['username']=$username;		

			$tachcheckrole=explode(',',$role);

			$demthay=1;

			foreach ($tachcheckrole as $tachcheckrole_it) {

				if($demthay==2){

					$tachcheckrole2=explode('-',$tachcheckrole_it);}

					$demthay++;   

				}   			

				if(!empty($tachcheckrole2[1]))	
			  		//echo "daluucookie".$tachcheckrole2[1];			  		 				

					header('Location:'.$tachcheckrole2[1]);		 	
			}

		} 

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

		<?php

		if($_SERVER ['REQUEST_METHOD'] == 'POST')

		{
			$errors=array();  

			if(empty($_POST['user']))

			{

				$errors[]='username';
				$message= "<p class='required'> Bạn hãy nhập đầy đủ thông tin </p>";

			}

			else{

				$kt_user=str_replace(' ','',$_POST['user']); 

				$user=mysqli_real_escape_string($dbc,$kt_user); 

			}

			if (empty($_POST['pass']))

			{

				$errors[]='password'; 

				$message= "<p class='required'> Bạn hãy nhập đầy đủ thông tin </p>";    

			}

			else{

				$kt_pass=str_replace(' ','',$_POST['pass']); 

				$pass=mysqli_real_escape_string($dbc,$kt_pass);             

			}

			if(empty($errors))

			{	 

				$query = "SELECT * FROM users WHERE username ='{$user}' AND status=1 ";

				$result = mysqli_query($dbc, $query);  

				kt_query($result,$query);

				if(mysqli_num_rows($result)==1)
				{
				list($id,$username,$password,$status,$seri,$role,$admin)= mysqli_fetch_array($result,MYSQLI_NUM);
				if($pass==$password){
					$_SESSION['id']=$id;

					$_SESSION['username']=$user;

					$_SESSION['seri']=$seri;
					$_SESSION['ad']=$admin;				


					$tachcheckrole=explode(',',$role);

					$demthay=1;

					foreach ($tachcheckrole as $tachcheckrole_it) {

						if($demthay==2){

							$tachcheckrole2=explode('-',$tachcheckrole_it);}

							$demthay++;   

						}   						
							
					if(isset($_POST['remember'])){
						$config_username=$user;
						$config_password=$id.'t'.$user;	
						$password_hash = md5($config_password); 						
						
						setcookie('cookie_name', 'usr='.$config_username.'&hash='.$password_hash.'s8', time() + 2592000,'/'); //1 tháng

						$query_in="UPDATE users SET hash='{$_COOKIE["cookie_name"]}' WHERE id='{$id}'";

						$result_in=mysqli_query($dbc,$query_in);

						if(!$result_in)

						{
							die("Query {$result_in} \n <br> MYSQL Error:".mysqli_error($dbc));
						}

						echo $_COOKIE['cookie_name']."</br>";
					} 					

					if(!empty($tachcheckrole2[1]))			 				
						//echo $tachcheckrole2[1];
					header('Location:'.$tachcheckrole2[1]);
				}
			}
			$message= "<p class='required'> Tài khoản không đúng</p>";
		}
	}
	?>    

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

					<form action="#" method="post"  >

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
				<div >
				</div>

			</div>

		</div>

	</body>

	</html>
